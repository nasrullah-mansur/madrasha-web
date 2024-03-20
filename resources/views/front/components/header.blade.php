<header class="header">
        <nav class="navbar navbar-expand-lg p-0">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
    <img class="logo" src="{{ asset(logo()) }}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @foreach (main_menu() as $menu)
        <li class="nav-item">
          <a class="nav-link" href="{{ $menu->slug }}">{{ $menu->label }}</a>
        </li>
        @endforeach
            
      </ul>
      
    </div>
  </div>
</nav>
    </header>