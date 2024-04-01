<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\DataTables\AuthorDataTable;
use Illuminate\Support\Facades\Validator;
use View;
use Redirect;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return View::make('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'gender' => 'required',
            'age' => 'required|numeric',

        ], [
            'name.required' => 'The name field is required.',
            'gender.required' => 'The gender field is required.',
            'age.required' => 'The age field is required.',
            'age.numeric' => 'The age field should be numeric.',
            'name.min' => 'The name must be at least 5 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',

        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $author = new Author;
        
        $author->name = $request->name;
        $author->gender = $request->gender;
        $author->age = $request->age;
        $author->save();
        return redirect()->route('author.table');
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
        $author = Author::find($id);
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);
        $author->name = $request->name;
        $author->gender = $request->gender;
        $author->age = $request->age;
        $author->save();
        return Redirect::to('authortable');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Author::destroy($id);
        return Redirect::to('authortable');
    }

    public function authortable(AuthorDataTable $dataTable)
    {
        
        return $dataTable->render("admin.author");
    }
}
