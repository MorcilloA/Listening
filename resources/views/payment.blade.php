@extends('layouts.base')

@section('content')
    
    <h3>You're about to buy a ticket for {{$concert->name}} concert</h3>

    <form action="{{route('concert-payment', $concert->slug)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="cardNumber">Card number</label>
            <input class="form-control" type="number" value=" {{ old('cardNumber') }} " name="cardNumber" id="cardNumber">
        </div>
        <div class="form-group">
            <label for="exp">Expiration date</label>
            <input class="form-control" type="date" value=" {{ old('exp') }} " name="exp" id="cardNumber">
        </div>
        <div class="form-group">
            <label for="crypto">Cryptogram</label>
            <input class="form-control" type="number" value=" {{ old('crypto') }} " name="crypto" id="crypto">
        </div>
        <button class="btn btn-success">Enregistrer</button>
    </form>

    @include('components.errors')

@endsection