<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){

    }

    /**
     * Show the profile page of a user
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details($id){
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
