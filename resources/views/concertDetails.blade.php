@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-10 offset-1">
            <div class="card col-12 mt-2">
                <div class="card-body">
                    <h4 class="card-title"> {{ $concert->name }} </h5>
                    <h5> 
                        @foreach ($concert->categories as $category)
                            <span class="badge badge-pill" style="background-color: #FFBCE5;">
                                {{ $category->name }}
                            </span>
                        @endforeach 
                    </h5>
                    @if (Auth::user())
                        <div class="form-group">
                            <input class="form-check-input" name="addFavorites" id="addFavorites" type="checkbox">
                            <label class="form-check-label" for="addFavorites">Favorites</label>
                        </div>
                    @endif
                </div>

                Who's performing ?
                <div class="pannel p-1">
                    @foreach ($concert->artists as $artist)
                        <a class="btn mt-1" href="{{ route('artist-details', $artist->id) }}" style="background-color: #FFDF80;">{{ $artist->name }}</a>
                    @endforeach
                </div>

                <a href="{{ route('concert-details', $concert->slug) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>Buy ticket ( {{ $concert->ticket_left }} left )</a>
            </div>
        </div>
    </div>
    
@endsection