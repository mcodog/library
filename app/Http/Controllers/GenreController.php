<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Validator;
use View;
use App\DataTables\GenreDataTable;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        
        return View::make('genre.index', compact('genres'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genre_name' => 'required|min:2|max:20',

        ], [
            'genre_name.required' => 'The name field is required.',
            'genre_name.min' => 'The name must be at least 5 characters.',
            'genre_name.max' => 'The name may not be greater than 20 characters.',

        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $genre = new Genre;
        $genre->genre_name = $request->genre_name;
        $genre->save();
        return redirect()->route('genre.table');
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
        $genre = Genre::find($id);
        return view('genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::find($id);
        $genre->genre_name = $request->genre_name;
        $genre->save();
        return redirect()->route('genre.table');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::destroy($id);
        return back();
    }

    public function getData(GenreDataTable $dataTable) {
        return $dataTable->render("admin.genre");
    }
}
