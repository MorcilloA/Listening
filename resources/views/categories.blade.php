@extends('layouts.base')

@section('content')
    <table 
    data-toggle="table"
    data-search="true"
    data-classes="table table-bordered table-hover table-striped"
    id="categories-table"
    >
        <thead>
            <th data-sortable="true" data-width="50" data-align="center">#</th>
            <th data-sortable="true">Name</th>
            <th data-align="center" data-searchable="false" data-width="150">Actions</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td>
                        <a href=" {{ route('category-details', $category->slug) }} " class="btn btn-primary" title="Show {{ $category->name }} details"><i class="fas fa-eye"></i></a>
                        <a href=" {{ route('category-edit-form', $category->slug) }} " class="btn btn-warning" title="Edit {{ $category->name }} category"><i class="fas fa-edit"></i></a>
                        {{-- <a href=" {{ route('category-remove', $category->id) }} " class="btn btn-danger">Delete user</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection