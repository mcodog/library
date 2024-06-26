<?php

namespace App\Http\Controllers;

use App\DataTables\BookDataTable;
use App\DataTables\BooksDataTable;
use App\DataTables\StocksDataTable;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Auth;
use Redirect;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dump(Auth::user()->role);
        $books = DB::table('authors')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('genres', 'books.genre_id', '=', 'genres.id')
            ->get();

        return View::make('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return View::make('book.create', compact('authors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:20',
            'author_id' => 'required',
            'genre_id' => 'required',
            'date_released' => 'required',
            'imgpath' => 'required|image|mimes:jpeg,jpg,png,gif',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.max' => 'The title may not be greater than :max characters.',
            'author_id.required' => 'Please select an author.',
            'genre_id.required' => 'Please select a genre.',
            'date_released.required' => 'Please provide the release date.',
            'imgpath.required' => 'Please upload an image.',
            'imgpath.image' => 'The uploaded file must be an image.',
            'imgpath.mimes' => 'The image must be a file of type: :values.',
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $book = new Book;

        if(request()->has('imgpath')){
            // $imagePath = request()->file('image')->store('category', 'public');
            $book->imgpath = request()->file('imgpath')->store('book', 'public');;
        }

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->date_released = $request->date_released;
        $book->nums = "0";
        $book->save();

        return redirect()->route('books.table');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = DB::table('authors as a')
            ->join('books as b', 'a.id', '=', 'b.author_id')
            ->join('genres as g', 'b.genre_id', '=', 'g.id')
            ->where('b.id', $id)
            ->first();

        $authors = Author::where('id', '<>', $book->author_id)->get(['name', 'id']);
        $genres = Genre::where('id', '<>', $book->genre_id)->get(['genre_name', 'id']);

        return View::make('book.edit', compact('book', 'authors', 'genres', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->date_released = $request->date_released;
        // dump($book);
        $book->save();

        return Redirect::to('booktable');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return Redirect::to('booktable');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::select('books.*', 'authors.name as author_name', 'genres.genre_name')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('genres', 'books.genre_id', '=', 'genres.id')
            ->where('books.title', 'like', '%' . $query . '%')
            ->orWhere('authors.name', 'like', '%' . $query . '%')
            ->orWhere('genres.genre_name', 'like', '%' . $query . '%')
            ->orWhere('date_released', 'like', '%' . $query . '%')
            ->get();

        return view('book.search', ['books' => $books, 'query' => $query]);
    }

    public function booktable(BooksDataTable $dataTable)
    {   
        return $dataTable->render("admin.book");
    }

    public function stocktable(StocksDataTable $dataTable)
    {
        return $dataTable->render("admin.stock");
    }
}
