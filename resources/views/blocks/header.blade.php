<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis">
          <b>Speakcher</b>
        </a>
      </div>

      <div class="btn-group text-end">
        <ul class="nav mb-2 justify-content-center mb-md-0">
          <form action="{{ route('about') }}">
            @csrf
            <button type="submit" class="btn btn-light rounded-pill px-3">О проекте</button>
          </form>      
        </ul>
        
        @if(!request()->routeIs('home') && !Auth::check())
          <form action="{{ route('home') }}">
              @csrf
              <button type="submit" class="btn btn-light rounded-pill px-3">Войти</button>
          </form>
        @elseif(!request()->routeIs('reg') && !Auth::check())
          <form action="{{ route('reg') }}">
            @csrf
            <button type="submit" class="btn btn-light rounded-pill px-3">Регистрация</button>
          </form>
        @endif
      </div>

    </header>
  </div>