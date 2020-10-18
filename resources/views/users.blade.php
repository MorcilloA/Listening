@extends('layouts.base')

@section('content')

<table 
data-toggle="table"
data-search="true"
data-classes="table table-bordered table-hover table-striped"
>
{{-- <table id="users-table"> --}}
    <thead>
        <th data-sortable="true" data-width="50" data-align="center">#</th>
        <th data-sortable="true">Name</th>
        <th data-sortable="true">Email</th>
        <th data-align="center" data-width="150">Actions</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td> {{ $user->id }} </td>
                <td> {{ $user->name }} </td>    
                <td> {{ $user->email }} </td>
                <td>
                    <a href=" {{ route('user-profile', $user->id) }} " class="btn btn-primary" title="Show {{ $user->name }} profile"><i class="fas fa-eye"></i></a>
                    <a href=" {{ route('user-edit-form', $user->id) }} " class="btn btn-warning" title="Edit {{ $user->name }} profile"><i class="fas fa-edit"></i></a>
                    {{-- <a href=" {{ route('categories-remove', $category->id) }} " class="btn btn-danger">Delete user</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    
@endsection