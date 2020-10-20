<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //

    public function index()
    {

        if (Auth::user()->role != 3) {
            return view('home');
        }

        $users = User::all();

        return view('users')->with('users', $users);
    }

    public function artistIndex(Request $request)
    {

        $artists = User::where('role', 2);
        $categories = Category::orderBy('name', 'ASC')->get();

        $filters = [
            "categories" => [],
            "search" => ""
        ];
        // dump($request->method());
        if ($request->method() == "POST") {

            $search = $request->input('search');
            $categoriesFilter = $request->input('categoriesFilter');

            if (is_array($categoriesFilter) && count($categoriesFilter) > 0) {
                $artists = $artists
                    ->leftJoin('categories_users', 'users.id', '=', 'categories_users.user_id')
                    ->whereIn("categories_users.category_id", $categoriesFilter);
            }
            // dump($search);
            if ($search != null) {
                $artists = $artists->where("users.name", "like", "%" . $search . "%");
            }

            $filters = [
                "categories" => $categoriesFilter,
                "search" => $search
            ];
        }

        // dump(count($artists));
        $artists = $artists->get();
        
        $ids = [];
        foreach ($artists as $key => $artist) {
            if (in_array($artist->id, $ids)) {
                unset($artists[$key]);
                // array_values();
            }
            $ids[] = $artist->id;
        }

        return view('artists')->with([
            "artists" => $artists,
            "categories" => $categories,
            "filters" => $filters
        ]);
    }

    public function details($id)
    {

        if (Auth::user()->role != 3 && Auth::user()->id != $id) {
            return view('home');
        }

        $user = User::findOrFail($id);

        // dd($user);

        return view('profile')->with('user', $user);
    }

    public function artistDetails($id)
    {
        $artist = User::findOrFail($id);

        return view("artistDetails")->with("artist", $artist);
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $params = $request->validated();
        dd($params);

        $params["image"] = isset($params["image"]) ? $params["image"] : null;

        $user = User::findOrFail($id);

        $isImage = $params["image"];
        $params["image"] = $user->image;

        if ($isImage !== null) {
            Storage::delete('public/' . $user->image);
            Storage::put('public/profilePic', $isImage);

            $params['image'] = 'profilePic/' . $isImage->hashName();
        }
        $user->update($params);

        return redirect()->route('user-profile', ['id' => $user->id]);
    }
}
