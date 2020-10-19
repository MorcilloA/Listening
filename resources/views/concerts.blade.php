@extends('layouts.base')
@section('content')
  <div class="row" style='margin-left: 50px'>
    <div class="col-4 border border-primary"  style='margin-top: 2px'>
        Recherche de concerts
        <div class=form-group>
            <input class="form-control" type="text" id="search-concert" value="" placeholder="Recherche">
                
            @php

               for($p = 0; $p <= 5; $p++)
               {
                    print('<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked1">
                    <label class="custom-control-label" for="defaultUnchecked1">Default unchecked</label>
                    </div>');
                }

            @endphp
            <input type="date" id="start" name="trip-start"
            value="2021-01-01"
            min="2020-01-01" max="2030-12-31">
        </div>


    </div>
    
    <div class="col-7 border border-warning">
        <p>Concerts</p>
        <div class="col-12 border border-warning" style='margin-bottom : 5px'>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p> concert Admin
            </div>
            <label for="id-of-input" class="custom-checkbox" style='align-left'>
            <input type="checkbox" id="id-of-input"/>
            <span>Favorite</span>
            </label>
            </p>
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p>artiste :</p>
            <button class='btn btn-primary btn-sm' style='margin-bottom : 10px'>En savoir plus</button>
            </div>
            <button class="btn btn-primary btn-lg float-rigth" style='margin-bottom : 10px; margin-top : 10px'>Acheter</button>
            <button class="btn btn-primary btn-lg float-rigth" style='margin-bottom : 10px; margin-top :10px'>Modifier</button>
            
        </div>
        <div class="col-12 border border-warning" style='margin-bottom : 5px'>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p> concert user
            </div>
            <label for="id-of-input" class="custom-checkbox" style='align-left'>
            <input type="checkbox" id="id-of-input"/>
            <span>Favorite</span>
            </label>
            </p>
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p>artiste :</p>
            <button class='btn btn-primary btn-sm' style='margin-bottom:10px'>En savoir plus</button>
            </div>
            <button class="btn btn-primary btn-lg float-rigth" style='margin-bottom : 10px; margin-top : 10px'>Acheter</button>            
        </div>

        <div class="col-12 border border-warning" style='margin-bottom : 5px'>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p> concert visiteur 
            
            </div>
            </p>
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p>artiste :</p>
            <button class='btn btn-primary btn-sm' style='margin-bottom : 10px'>En savoir plus</button>
            </div>
            <button class="btn btn-primary btn-lg float-rigth" style='margin-bottom : 10px; margin-top : 10px   '>Acheter</button>
        </div>
        <div class="col-12 border border-warning" style='margin-bottom : 5px'>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p> concerts artiste
            
            <label for="id-of-input" class="custom-checkbox" style='align-left'>
            <input type="checkbox" id="id-of-input"/>
            <span>Favorite</span>
            </label>
        </div>
            </p>
            <div class="col-8 border border-warning" style='margin-top : 10px'>
            <p>artiste :</p>
            <button class='btn btn-primary btn-sm   '>En savoir plus</button>
            </div>
            <button class="btn btn-primary btn-lg float-rigth" style='margin-bottom : 10px; margin-top : 10px'>Acheter</button>            
        </div>
    </div>
</div>
  
@endsection
