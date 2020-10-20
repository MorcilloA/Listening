<?php

namespace App\Http\Controllers;

use App\User;
use App\Concert;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreConcertRequest;
use App\Http\Requests\StoreOrderRequest;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ConcertController extends Controller
{
    public function index(Request $request)
    {
        $concerts = Concert::where("date", ">=", date("Y-m-d"));
        $artists = User::where("role", 2)->get();
        // $concerts = Concert::select("*");
        $categories = Category::orderBy("name", "ASC")->get();

        $filters = [
            "categories" => [],
            "search" => "",
            "playedAfter" => ""
        ];
        // dump($request->method());
        if ($request->method() == "POST") {

            $search = $request->input('search');
            $categoriesFilter = $request->input('categoriesFilter');
            $playedAfter = $request->input("playedAfter");

            if (is_array($categoriesFilter) && count($categoriesFilter) > 0) {
                $concerts = $concerts
                    ->leftJoin('concerts_categories', 'concerts.id', '=', 'concerts_categories.concert_id')
                    ->whereIn("concerts_categories.category_id", $categoriesFilter);
            }
            // dump($search);
            if ($search != null) {
                $concerts = $concerts->where("concerts.name", "like", "%" . $search . "%");
            }

            if ($playedAfter) {
                $concerts = $concerts
                        ->where("concerts.date", ">=", $playedAfter);
            }

            $filters = [
                "categories" => $categoriesFilter,
                "search" => $search,
                "playedAfter" => $playedAfter
            ];
        }

        // dump($categories);
        $concerts = $concerts->orderBy("concerts.date", "ASC")->get();
        
        // dd($concerts);

        $ids = [];
        foreach ($concerts as $key => $concert) {
            if (in_array($concert->id, $ids)) {
                unset($concerts[$key]);
                // array_values();
            }
            $ids[] = $concert->id;
        }

        // dump($concerts);

        return view("concerts")->with([
            "concerts" => $concerts,
            "categories" => $categories,
            "artists" => $artists,
            "filters" => $filters
        ]);
    }

    public function favorites(Request $request, $slug){
        // dd($request->input("addFavorites"));
        $action = $request->input("addFavorites");
        // dd($action);

        $concert = Concert::where("slug", $slug)->firstOrFail();

        if ($action != null) {
            Auth::user()->favorites()->attach($concert->id);
        }else{
            Auth::user()->favorites()->detach($concert->id);
        }

        return redirect()->route('concerts');

    }

    public function details($slug)
    {
        $concert = Concert::where("slug", $slug)->firstOrFail();

        return view("concertDetails")->with("concert", $concert);
    }

    public function new(StoreConcertRequest $request)
    {
        $slugger = new AsciiSlugger();

        $params = $request->validated();
        // dd($params);

        $params["slug"] = $slugger->slug($params["name"]);
        $params["ticket_left"] = $params["ticket_total"];

        $concert = Concert::create($params);

        $concert = $concert->fresh();

        foreach ($request->input("categories") as $category) {
            $concert->categories()->attach($category);
        }

        foreach ($request->input("artists") as $artist) {
            $concert->artists()->attach($artist);
        }

        return redirect()->route('concerts');
    }

    public function displayPayment($slug){
        $concert = Concert::where('slug', $slug)->firstOrFail();

        $categories = Category::all();

        return view('payment')->with('concert', $concert);
    }

    public function payment(StoreOrderRequest $request, $slug)
    {

        $slugger = new AsciiSlugger();
        
        $params = $request->validated();

        $params['image'] = isset($params['image']) ? $params['image'] : null;

        $post = Post::where('slug', $slug)->firstOrFail();
        $params['slug'] = $slugger->slug($params["name"]);

        // dd($params);
        $isImage = $params['image'];
        $params['image'] = $post->image;


        if ($isImage !== null) {
            Storage::delete('public/'.$post->image);
            Storage::put('public/posts', $isImage);

            $params['image'] = 'posts/'.$isImage->hashName();
        }
        // dd($params);
        $post->update($params);
        
        return redirect()->route('posts-index');
        // return route('categories-index');
        // dd($request->all());
    }
}
