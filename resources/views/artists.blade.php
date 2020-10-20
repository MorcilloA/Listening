@extends('layouts.base')

@section('title')
    Artists
@endsection

@section('content')

    <div class="row" style='margin-left: 50px'>
        <div class="col-3 border" id="filterForm" style='margin-top: 2px'>
            <form action="{{ route('artists') }}" id="filter" method="post">
            {{-- <form action="#" id="filter" method="post"> --}}
                @csrf
                Name
                <div class="form-group mt-2">
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search..." value="{{ ($filters['search'] != null) ? $filters['search'] : "" }}">
                </div>
                Categories
                <div class="form-group mt-2">
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categoriesFilter[]" value="{{ $category->id }}" id="{{ $category->name }}" {{ (is_array($filters['categories']) && in_array($category->id, $filters['categories'])) ? "checked" : "" }}>
                            <label for="{{ $category->name }}" class="form-check-label"> {{ $category->name }} </label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary" type="submit">Apply filters</button>
            
            </form>
    
        </div>
        
        <div class="col-7 offset-1">
            {{-- <p>Artists</p> --}}
            @foreach ($artists as $artist)
                
            <div class="card col-12 mb-2">
                <div class="card-body">
                    <h4 class="card-title"> {{ $artist->name }} </h5>
                    <h5> 
                        @foreach ($artist->categories as $category)
                            <span class="badge badge-pill" style="background-color: #FFBCE5;">
                                {{ $category->name }}
                            </span>
                        @endforeach 
                    </h5>

                    @php
                        $concerts = $artist->concerts;
                        $toPlay = [];
                        $played = [];
                    @endphp

                    @foreach ($concerts as $concert)
                        @if ($concert->date >= Carbon\Carbon::now())
                            @php
                                $toPlay[] = $concert;
                            @endphp
                        @else
                            @php
                                $played[] = $concert;
                            @endphp
                        @endif
                    @endforeach

                    {{-- @dump($concerts) --}}
                    {{-- @dump($toPlay) --}}
                    {{-- @dump($played) --}}
                    
                    @if (count($concerts) == 0)
                        <h6 class="card-subtitle">
                            This artists hasn't played any concert yet !
                        </h6>
                    @else
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ (count($played)*100)/count($concerts) }}%; background-color: #31515D;" role="progressbar" aria-valuenow="{{ count($played) }}" aria-valuemin="0" aria-valuemax="{{ count($concerts) }}">
                                {{ count($played) }} concerts played
                            </div>
                            <div class="progress-bar" style="width: {{ (count($toPlay)*100)/count($concerts) }}%; background-color: #FFC98B;" role="progressbar" aria-valuenow="{{ count($toPlay) }}" aria-valuemin="0" aria-valuemax="{{ count($concerts) }}">
                                {{ count($toPlay) }} concerts left to play
                            </div>
                        </div>
                    @endif

                </div>

                <a href="{{ route('artist-details', $artist->id) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>See incomming concerts</a>
            </div>

            @endforeach
        </div>
    </div>
@endsection