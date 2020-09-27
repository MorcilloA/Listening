<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href=" {{ route('home') }} ">Accueil</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="  ">Articles</a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="">Catégories</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Auteurs</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href=" ">Contact</a>
        </li>
        
        
        @if (Auth::check())
          <li class="nav-item active">
            <a class="nav-link" href="#"> {{ Auth::user()->name }} </a>
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