<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="{{ asset('images/logo_listening.svg') }}" style="width: 150px; margin-left: -30px;" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" style="margin-left: -40px;" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href=" {{ route('home') }} ">Accueil</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route("concerts") }}">Concerts</a>
        </li>
        @if (Auth::user() && Auth::user()->role == 3)
          <li class="nav-item active">
            <a class="nav-link" href=" {{ route('categories') }} ">Categories</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href=" {{ route('users') }} ">Users</a>
          </li>  
        @endif
        <li class="nav-item active">
          <a class="nav-link" href=" {{ route('artists') }} ">Artists</a>
        </li>
        
        
        @if (Auth::check())
          <li class="nav-item active">
            <a class="nav-link" href=" {{ route('user-profile', Auth::user()->id) }} "> {{ Auth::user()->name }} </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href=" {{ url('/logout') }} "> Déconnexion </a>
          </li>
        @else
          <li class="nav-item active">
            <a class="nav-link" href=" {{ route('login') }} ">Connexion</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href=" {{ route('register') }} ">Inscription</a>
          </li>     
        @endif



        {{-- <li class="nav-item active">
          <a class="nav-link" href="#">Accueil</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Accueil</a>
        </li> --}}

      </ul>
    </div>
  </nav>