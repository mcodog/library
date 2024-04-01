<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Barryvdh\Debugbar\Facades\Debugbar;
use View;
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
        $genre = new Genre;
        $genre->genre_name = $request->genre_name;
        $genre->save();
        return redirect()->route('genre.index');
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
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::destroy($id);
        return back();
    }
}
