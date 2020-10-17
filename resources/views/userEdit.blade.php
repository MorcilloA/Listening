@extends('layouts.base')

@section('content')

    <h1>Modifier une catégorie</h1>

    <form action=" {{ route('user-update', $user->id) }} " method="post">

        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value=" {{ $user->name }} " required>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" type="email" name="email" id="email" value=" {{ $user->email }} " required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        @include('components.errors')

    </form>

@endsection