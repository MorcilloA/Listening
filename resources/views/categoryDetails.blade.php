@extends('layouts.base')

@section('content')
    <div class="card">
        {{-- <img class="card-img-top" src="http://placehold.it/150x100" alt="Card image cap"> --}}
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-4 text-right">
                    Category's name :
                </div>
                <div class="col-8">
                    {{ $category->name }}
                </div>
            </div>
            {{-- <div class="row align-items-center">
                <div class="col-4 text-right">
                    Email :
                </div>
                <div class="col-8">
                    {{ $user->email }}
                </div>
            </div> --}}
            {{-- <div class="row align-items-center">
                <div class="col-4 text-right">
                    Role :
                </div>
                <div class="col-8">
                    @switch($user->role)
                        @case(1)
                            User
                            @break

                        @case(2)
                            Artist
                            @break

                        @case(3)
                            Administrator
                            @break
                        
                        @default
                            
                    @endswitch
                </div>
            </div> --}}
        </div>
        @if (Auth::user() && Auth::user()->role === 3)
            {{-- <div class="card-footer text-right">
                <a href=" {{ route('user-edit-form', $user->id) }} " class="btn btn-primary">Edit</a>
            </div> --}}
        @endif
    </div>
@endsection