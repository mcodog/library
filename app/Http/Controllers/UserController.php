<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use View;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 0) {
            $users = User::where('id',Auth::id())->get();
            return view::make('user.index', compact('users'));
        }else
        {
            $users = User::all();
            return view::make('admin.index', compact('users'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->role == 1) {
        return View::make('admin.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( Auth::check() && Auth::user()->role == 1) {
        $users= new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->role = $request->role;
        $users->save();
        return redirect()->route('user.index');
    }
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
        if(Auth::check() && Auth::user()->role == 1){
        $users = User::find($id);
        return view('admin.edit', compact('users'));
        }else{
        $users = User::find($id);
        return view('user.edit', compact('users'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Auth::check() && Auth::user()->role == 1){
            $users = User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->role = $request->role;
            $users->password = $request->password;
            $users->save();
        return redirect()->route('user.index');
            }else{
                $users = User::find($id);
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = $request->password;
                $users->save();
                return redirect()->route('user.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::check() && Auth::user()->role == 1){
        User::destroy($id);
        return back();
        }
    }
}
