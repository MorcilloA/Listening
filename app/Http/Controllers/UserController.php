<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    //

    public function index(){

        if (Auth::user()->role != 3) {
            return view('home');
        }

        $users = User::all();
        
        return view('users')->with('users', $users);
    }

    /**
     * Show the profile page of a user
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details($id){

        if (Auth::user()->role != 3 && Auth::user()->id != $id) {
            return view('home');
        }

        $user = User::findOrFail($id);

        // dd($user);

        return view('profile')->with('user', $user);
    }

    /**
     * Display the edit form for a user
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function displayEdit($id){
        $user = User::findOrFail($id);

        // dd($user);

        return view('userEdit')->with('user', $user);
    }

    /**
     * Update the user from the form data
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UpdateUserRequest $request, $id){

        $params = $request->validated();

        $user = User::findOrFail($id);

        $user->update($params);

        return redirect()->route('user-profile', ['id'=>$user->id]);
    }
}
