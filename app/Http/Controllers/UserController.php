<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use RealRashid\SweetAlert\Facades\Alert;

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

    // public function displayEdit($id){
        
    //     $user = User::findOrFail($id);

    //     Alert::html("Let's edit this profile !", '
    //         <form action="'. route("user-update", $user->id) .'" method="post">
    //             @csrf
    //             <div class="form-group">
    //                 <label for="name">Name</label>
    //                 <input class="form-control" type="text" name="name" id="name" value="'.$user->name.'" required>
    //             </div>
    //             <div class="form-group">
    //                 <label for="name">Email</label>
    //                 <input class="form-control" type="email" name="email" id="email" value="'.$user->email.'" required>
    //             </div>
    //             <button type="submit" class="btn btn-primary">Enregistrer</button>
    //         </form> 
    //     ', 'alert');


    //     // // dd($user);

    //     return redirect()->route('users');
    // }

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
