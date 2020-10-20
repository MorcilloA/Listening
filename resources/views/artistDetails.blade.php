@extends('layouts.base')

@section('content')
    <h1>{{ $artist->name }} Concerts :</h1>
    <div class="row justify-content-center">
        {{-- <div class="card-deck"> --}}
        {{-- @foreach ($artist->concerts as $concert)
            @if ($concert->date >= Carbon\Carbon::now())
                <div class="card col-3" style="margin:5px;">
                    <div class="card-body" style="padding: 5px;">
                        <h5 class="card-title">{{ $concert->name }}</h5>
                        <p>{{ $concert->date }}</p>
                        <a href="{{ route('concert-details', $concert->slug) }}" class="btn btn-primary">Show details</a>
                    </div>
                </div>
            @endif
        @endforeach --}}
    {{-- </div> --}}
        {{-- <div class="col-5 offset-1"> --}}
            {{-- <p>Artists</p> --}}
            @foreach ($artist->concerts as $concert)
                @if ($concert->date >= Carbon\Carbon::now())
                    <div class="card col-5 mt-2 mr-2">
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

                        <a href="{{ route('concert-details', $concert->slug) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>Buy ticket ( {{ $concert->ticket_left }} left )</a>
                        <a href="{{ route('concert-details', $concert->slug) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>Show details</a>
                    </div>
                @endif

            @endforeach
        {{-- </div> --}}
    </div>

@endsection