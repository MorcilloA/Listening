@extends('layouts.base')

@section('content')
    <div class="profile-container">
        <div class="card">
            <img class="card-img-top" src="http://placehold.it/150x100" alt="Card image cap">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4 text-right">
                        Name :
                    </div>
                    <div class="col-8">
                        {{ $user->name }}
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-4 text-right">
                        Email :
                    </div>
                    <div class="col-8">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="row align-items-center">
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
                </div>
            </div>
            @if ($user->id == Auth::user()->id || Auth::user()->role === 3)
                <div class="card-footer text-right">
                    {{-- <a href=" {{ route('user-edit-form', $user->id) }} " class="btn btn-primary">Edit</a> --}}
                    <button id="editUser" class="btn btn-primary">Edit</button>
                </div>
            @endif
          </div>
    </div>
@endsection

{{-- <script> --}}
    @section('script')
        $('#editUser').click(function (e) {
            Swal.fire({
                title: "Let's edit this profile !",
                html:   '<form action=\' {{ route("user-update", $user->id) }} \' method="post">'+
                        '   @csrf'+
                        '   <div class="form-group">'+
                        '       <label for="name">Name</label>'+
                        '       <input class="form-control" type="text" name="name" id="name" value=" {{ $user->name }} " required>'+
                        '   </div>'+
                        '   <div class="form-group">'+
                        '       <label for="name">Email</label>'+
                        '       <input class="form-control" type="email" name="email" id="email" value=" {{ $user->email }} " required>'+
                        '   </div>'+
                        '   <div class="form-group">'+
                        '       <label for="role">Role</label>'+
                        '       <div class="form-check">'+
                        '           <input class="form-check-input" type="radio" name="role" id="user" value="1"'+
                        @if ($user->role === 1) 
                            'checked'+
                        @endif
                        ' >'+
                        '           <label class="form-check-label" for="user">'+
                        '           User'+
                        '           </label>'+
                        '       </div>'+
                        '       <div class="form-check">'+
                        '           <input class="form-check-input" type="radio" name="role" id="artist" value="2"'+
                        @if ($user->role === 2) 
                            'checked'+
                        @endif
                        '>'+
                        '           <label class="form-check-label" for="artist">'+
                        '           Artist'+
                        '           </label>'+
                        '       </div>'+
                        '       <div class="form-check">'+
                        '           <input class="form-check-input" type="radio" name="role" id="administrator" value="3"'+
                        @if ($user->role === 3) 
                            'checked'+
                        @endif
                        '>'+
                        '           <label class="form-check-label" for="administrator">'+
                        '           Administrator'+
                        '           </label>'+
                        '       </div>'+
                        '   </div>'+
                        '   <button type="submit" class="btn btn-primary">Enregistrer</button>'+
                        '   @include("components.errors")'+
                        '</form> ',
                showConfirmButton: false
            });
        });
    @endsection
{{-- </script> --}}