@extends('layouts.base')

@section('title')
    Concerts
@endsection

@section('content')

    <div class="row" style='margin-left: 50px'>
        <div class="col-3 border" id="filterForm" style='margin-top: 2px'>
            <form action="{{ route('concerts') }}" id="filter" method="post">
            {{-- <form action="#" id="filter" method="post"> --}}
                @csrf
                Name
                <div class="form-group mt-2">
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search..."  value="{{ ($filters['search'] != null) ? $filters['search'] : "" }}">
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
                <div class="form-group">
                    Played after :
                    <input type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="yyyy/mm/dd" class="form-control" name="playedAfter" id="date" value="{{ ($filters['playedAfter'] != null) ? $filters['playedAfter'] : Carbon\Carbon::now()->format("Y-m-d") }}">
                </div>
                <button class="btn btn-primary" type="submit">Apply filters</button>
                <a  href="#" id="addConcert" class="btn btn-success">New concert</a>
            </form>

    
        </div>
        
        <div class="col-7 offset-1">
            {{-- <p>Artists</p> --}}
            @foreach ($concerts as $concert)
                @if ($concert->date >= Carbon\Carbon::now())
                    <div class="card col-12 mb-2">
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
                                <form action="{{ route("concert-favorites", $concert->slug) }}" id="concertForm{{$concert->id}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-check-input" name="addFavorites" id="{{$concert->id}}" type="checkbox" {{ (Auth::user()->favorites->contains($concert)) ? "checked" : "" }}>
                                        <label class="form-check-label" for="addFavorites">Favorites</label>
                                    </div>
                                </form>
                            @endif

                        </div>

                        @if (Auth::user())
                            <a href="{{ route('concert-display-payment', $concert->slug) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>Buy ticket ( {{ $concert->ticket_left }} left )</a>
                        @endif
                        <a href="{{ route('concert-details', $concert->slug) }}" class="btn btn-lg" style='margin-bottom : 10px; margin-top : 10px; background-color: #FFC98B; color: rgba(0,0,0,0.7);'>Show details</a>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
@endsection

<script>
@section('script')
    $("input[name='addFavorites']").on("click", function(e, $element){
        itemId = e["currentTarget"]["id"];
        $("#concertForm"+itemId).submit();
    })

    $("#addConcert").on("click", function(){
        addConcert();
    });

    function addConcert(){

        let categoriesPart = "";

        @foreach ($categories as $category)
            categoriesPart += '<div class="form-check text-left" style="font-size:12px;">'+
                '<input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="add{{ $category->name }}">'+
                '<label for="{{ $category->name }}" class="form-check-label"> {{ $category->name }} </label>'+
            '</div>';
        @endforeach


        let artistPart = "";

        {{-- @dump($artists) --}}
        @foreach ($artists as $artist)
            artistPart += '<div class="form-check text-left" style="font-size:12px;">'+
                '<input class="form-check-input" type="checkbox" name="artists[]" value="{{ $artist->id }}" id="add{{ $artist->name }}">'+
                '<label for="{{ $artist->name }}" class="form-check-label"> {{ $artist->name }} </label>'+
            '</div>';
        @endforeach
        
        Swal.fire({
            title: "Let's create a concert !",
            // html:   '<form action=" {{ route("user-update", '+id+') }} " method="post">'+
            html:   '<form action="{{ route("concert-new") }}" method="post">'+
                    '   @csrf'+
                    '<div class="row">'+
                    '   <div class="form-group col-12">'+
                    '       <label for="name">Name</label>'+
                    '       <input class="form-control" type="text" name="name" id="name" required>'+
                    '   </div>'+
                    '</div>'+
                    '<div class="row">'+
                    '   <div class="form-group col-6">'+
                    '       <label for="name">Date</label>'+
                    '       <input class="form-control" type="datetime-local" min="{{Carbon\Carbon::now()->format("Y-m-d")}}T{{Carbon\Carbon::now()->format("H:i")}}" name="date" required>'+
                    '   </div>'+
                    '   <div class="form-group col-6">'+
                    '       <label for="name">Price</label>'+
                    '       <input class="form-control" type="number" step="0.01" name="price" id="price" required>'+
                    '   </div>'+
                    '</div>'+
                    '<div class="row">'+
                    '   <div class="form-group col-12">'+
                    '       <label for="name">Place</label>'+
                    '       <input class="form-control" type="text" name="place" id="place" required>'+
                    '   </div>'+
                    '</div>'+
                    '<div class="row">'+
                    '   <div class="form-group col-12">'+
                    '       <label for="name">Number of tickets</label>'+
                    '       <input class="form-control" type="number" name="ticket_total" id="ticket_total" required>'+
                    '   </div>'+
                    '</div>'+
                    '<div class="row">'+
                    '   <div class="form-group col-6">'+
                    '       Categories'+
                                categoriesPart+
                    '   </div>'+
                    '   <div class="form-group col-6">'+
                    '       Artists'+
                                artistPart+
                    '   </div>'+
                    '</div>'+
                    '   <button type="submit" class="btn btn-primary">Enregistrer</button>'+
                    '   @include("components.errors")'+
                    '</form> ',
            showConfirmButton: false
        });
    }


@endsection
</script>