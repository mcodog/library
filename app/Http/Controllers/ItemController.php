<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Stock;
use App\Mail\Checkout;
use Mail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getItems()
    {
        $books = Book::select('books.id as id', 'title', 'date_released', 'genre_name', 'imgpath', 'name', 'deleted_at', 'stocks')
        ->join('authors as a', 'a.id', '=', 'books.author_id')
        ->join('genres as g', 'g.id', '=', 'books.genre_id')
        ->join('stocks as s', 's.book_id', '=', 'books.id')
        ->withTrashed()
        // ->whereNull('books.deleted_at')
        ->where('s.stocks', '>', 0) // Add this condition to fetch books with stock
        ->get();
    
    return view('dashboard.index', compact('books'));
    
    }

    public function addToCheckout(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $checkout = session()->get('checkout', []);
        if (isset($checkout[$id])) {
            $checkout[$id]['quantity']++; // add quantity to existing item
        } else {
            $checkout[$id] = [
                'id' => $book->id,
                'img_path' => $book->imgpath,
                'title' => $book->title,
                'due_date' => Carbon::parse($request->input('return_date'))->toDateString(),
                'quantity' => 1, // add quantity to new item
            ];
        }

        session()->put('checkout', $checkout);

        return redirect()->back()->with('success', 'Book added to checkout successfully!');
    }
    public function viewCheckout()
    {
        $checkout = session()->get('checkout', []);
        // dd($checkout);
        return view('dashboard.checkout', compact('checkout'));
    }
    public function removeBookFromCheckout($id)
    {
        $checkout = session()->get('checkout');

        if (isset($checkout[$id])) {
            unset($checkout[$id]);
            session()->put('checkout', $checkout);
        }

        return redirect()->back()->with('success', 'Book removed from checkout successfully!');
    }
    public function checkout()
    {
        $checkout = session()->get('checkout', []);
    
        foreach ($checkout as $book) {
            $borrowedBook = new Borrow();
            $borrowedBook->user_id = Auth::check() ? Auth::user()->id : null;
            $borrowedBook->book_id = $book['id'];
            $borrowedBook->date = $book['due_date'];
            $borrowedBook->quantity = $book['quantity'];
            $borrowedBook->save();
    
            $bookToUpdate = Book::find($book['id']);
            if ($bookToUpdate) {
                $bookToUpdate->nums += $book['quantity']; // Increment the nums column
                $bookToUpdate->save();
            }
    
            $bookToStock = Stock::where('book_id', $book['id'])->first();
            if ($bookToStock) {
                $bookToStock->stocks -= $book['quantity']; // Decrement the stock column
                $bookToStock->save();
            }
        }
        Mail::to(Auth::user()->email)->send(new Checkout($checkout));
        session()->forget('checkout');
    
        return redirect()->route('getItems')->with('success', 'Books borrowed successfully!');
    }
    

    
    public function restore($id)
    {
        $book = Book::withTrashed()->find($id);
    
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found!');
        }
    
        $book->restore();
    
        // $borrow = Borrow::withTrashed()->find($id);
    
        // if (!$borrow) {
        //     return redirect()->back()->with('error', 'Borrow not found!');
        // }
    
        // $stock = Stock::where('book_id', $borrow->book_id)->first();
    
        // if (!$stock) {
        //     return redirect()->back()->with('error', 'Stock not found!');
        // }
    
        // $stock->stock += $borrow->quantity; // Add the quantity of the restored borrow to the stock
        // $stock->save();
    
        return redirect()->back()->with('success', 'Book restored successfully!');
    }
    
    


    public function borrow()
    {
        if (Auth::check()) {
            $user = Auth::user()->id;
            $borrowedBooks = Borrow::where('user_id', $user)->get();
            $borrowedBookIds = $borrowedBooks->pluck('book_id')->toArray();
            $books = Book::query()
                ->join('borrows', 'books.id', '=', 'borrows.book_id')
                ->whereIn('books.id', $borrowedBookIds)
                ->where('borrows.user_id', $user)
                ->whereNotNull('date')
                ->get(['books.id', 'title', 'imgpath', 'date', 'penalty']);


            foreach ($borrowedBooks as $borrow) {
                $dueDate = $borrow->due_date;
                $now = Carbon::now();
                if ($now->gt(Carbon::parse($dueDate))) {
                    $daysLate = $now->diffInDays(Carbon::parse($dueDate));
                    $penalty = $daysLate * 5;
                    if ($borrow->penalty == 0) { 
                        $borrow->penalty = $penalty;
                        $borrow->save();
                    }
                }
            }
            return view('return.index', compact('books'));
        } else {
            return redirect()->route('login');
        }
    }
    public function reduceQuantity($id)
    {
        $checkout = session()->get('checkout', []);

        if (isset($checkout[$id])) {
            $quantity = $checkout[$id]['quantity'];
            if ($quantity > 1) {
                $checkout[$id]['quantity'] -= 1;
                session()->put('checkout', $checkout);
                return redirect()->back()->with('success', 'Quantity reduced successfully!');
            } else {
                return redirect()->back()->with('error', 'Quantity cannot be less than 1!');
            }
        } else {
            return redirect()->back()->with('error', 'Book not found in checkout!');
        }
    }

}
