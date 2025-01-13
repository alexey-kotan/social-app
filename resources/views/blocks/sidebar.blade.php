<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link active" aria-current="page"> Мой профиль </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('subscriptions') }}" class="nav-link link-body-emphasis" aria-current="page"> Мои подписки </a>
    </li>
    <li>
      <a href="{{ route('my_posts') }}" class="nav-link link-body-emphasis"> Мои посты </a>
    </li>
    <li>
      <a href="{{ route('all_posts') }}" class="nav-link link-body-emphasis"> Все посты </a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis"> Поддержка </a>
    </li>
  </ul>

  <form method="post" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-light rounded-pill px-3k">Выйти из аккаунта</button>
  </form>
  
</div>