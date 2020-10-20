@extends('layouts.base')

@section('content')

<table 
data-toggle="table"
data-search="true"
data-classes="table table-bordered table-hover table-striped"
data-pagination="true"
id="users-table"
>
    <thead>
        <th data-field="roleId" data-visible="false"></th>
        <th data-field="id" data-sortable="true" data-width="50" data-align="center">#</th>
        <th data-field="name" data-sortable="true">Name</th>
        <th data-field="email" data-sortable="true">Email</th>
        <th data-field="role" data-sortable="true">Role</th>
        <th data-align="center" data-width="150" data-events="actionEvents">Actions</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td> {{ $user->role }} </td>
                <td> {{ $user->id }} </td>
                <td> {{ $user->name }} </td>    
                <td> {{ $user->email }} </td>
                <td> @switch($user->role)
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
                            
                    @endswitch </td>
                <td>
                    <a href=" {{ route('user-profile', $user->id) }} " class="btn btn-primary" title="Show {{ $user->name }} profile"><i class="fas fa-eye"></i></a>
                    {{-- <a href=" {{ route('user-edit-form', $user->id) }} " class="btn btn-warning" title="Edit {{ $user->name }} profile"><i class="fas fa-edit"></i></a> --}}
                    <a href="#" class="btn btn-warning editUser" title="Edit {{ $user->name }} profile"><i class="fas fa-edit"></i></a>
                    {{-- <a href=" {{ route('categories-remove', $category->id) }} " class="btn btn-danger">Delete user</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
@endsection

<script>
@section('script')
    window.actionEvents = {
        'click .editUser': function(e, value, row, index){
            editUser(row);
        }
    }

    function editUser(row){
        
        rolePart =  '   <div class="form-group">'+
                    '       <label for="role">Role</label>'+
                    '       <div class="form-check">'+
                    '           <input class="form-check-input" type="radio" name="role" id="user" value="1"';
        if (row["roleId"] == 1) {
            rolePart += 'checked';
        }
        
        rolePart +=  ' >'+
                    '           <label class="form-check-label" for="user">'+
                    '           User'+
                    '           </label>'+
                    '       </div>'+
                    '       <div class="form-check">'+
                    '           <input class="form-check-input" type="radio" name="role" id="artist" value="2"';
        if (row["roleId"] == 2) {
            rolePart += 'checked';
        }
        
        rolePart +=  '>'+
                    '           <label class="form-check-label" for="artist">'+
                    '           Artist'+
                    '           </label>'+
                    '       </div>'+
                    '       <div class="form-check">'+
                    '           <input class="form-check-input" type="radio" name="role" id="administrator" value="3"';
        if (row["roleId"] == 3) {
            rolePart += 'checked';
        }
        
        rolePart +=  '>'+
                    '           <label class="form-check-label" for="administrator">'+
                    '           Administrator'+
                    '           </label>'+
                    '       </div>'+
                    '   </div>';
        
        Swal.fire({
            title: "Let's edit this profile !",
            // html:   '<form action=" {{ route("user-update", '+id+') }} " method="post">'+
            html:   '<form action="/user/'+row['id']+'/update" method="post">'+
                    '   @csrf'+
                    '   <div class="form-group">'+
                    '       <label for="name">Name</label>'+
                    '       <input class="form-control" type="text" name="name" id="name" value="'+row["name"]+'" required>'+
                    '   </div>'+
                    '   <div class="form-group">'+
                    '       <label for="name">Email</label>'+
                    '       <input class="form-control" type="email" name="email" id="email" value="'+row["email"]+'" required>'+
                    '   </div>'+
                    rolePart+
                    '   <button type="submit" class="btn btn-primary">Enregistrer</button>'+
                    '   @include("components.errors")'+
                    '</form> ',
            showConfirmButton: false
        });
    }
@endsection
</script>