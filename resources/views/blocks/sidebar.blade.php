{{-- sidebar полный экран --}}
<div class="relative max-w-md mx-auto bg-white dark:bg-slate-800 shadow-lg h-80 overflow-hidden ring-1 ring-slate-900/5 lg:block hidden">
  <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary">
      <form method="get" action="{{ route('home') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k">Профиль</button>
      </form>

      <form method="get" action="{{ route('subscriptions') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k"> Мои подписки </button>
      </form>

      <form method="get" action="{{ route('user_search') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k"> Поиск пользователей </button>
      </form>

      <form method="get" action="{{ route('my_posts') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k"> Мои посты </button>
      </form>

      <form method="get" action="{{ route('all_posts') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k"> Все посты </button>
      </form>

      <form method="get" action="{{ route('faqs') }}">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-3k"> Поддержка </button>
      </form>

    <form method="post" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-light rounded-pill px-3k">Выйти из аккаунта</button>
    </form>
  </div>
</div>