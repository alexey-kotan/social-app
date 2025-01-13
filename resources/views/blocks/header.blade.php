<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4 mb-5 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="logo.png" width="40" height="40"> <h3>PurrFect</h3>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('home')])>Главная</a></li>
        <li><a href="{{ route('faqs') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('faqs')])>FAQs</a></li>
        <li><a href="{{ route('about') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('about')])>О нас</a></li>
      </ul>

      <div class="btn-group text-end">
        @if(!request()->routeIs('home') && !Auth::check())
          <form action="{{ route('home') }}">
              <button type="submit" class="btn btn-light rounded-pill px-3">Войти</button>
          </form>
        @elseif(!request()->routeIs('reg') && !Auth::check())
          <form action="{{ route('reg') }}">
            <button type="submit" class="btn btn-light rounded-pill px-3">Регистрация</button>
          </form>
        @endif
      </div>

    </header>
  </div>