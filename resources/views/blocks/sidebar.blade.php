<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
  <div class="dropdown">
    <form action="{{ route('userpage') }}">
      <center><button type="submit" class="badge d-flex align-items-center p-2 pe-2 text-dark-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
        <img class="rounded-circle me-1" width="24" height="24" src="cat1.png" alt="">&nbsp;&nbsp;Username
      </button></center>
    </form>
  </div>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="#" class="nav-link active" aria-current="page"> Все мурчания </a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis"> Ваши мурчания </a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis"> Редактировать профиль </a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis"> ### </a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis"> ### </a>
    </li>
  </ul>

  <form method="post" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-light rounded-pill px-3k">Выйти из аккаунта</button>
  </form>
  
</div>