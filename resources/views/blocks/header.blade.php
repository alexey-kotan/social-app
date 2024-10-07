<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4 mb-5 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
            width="30.000000pt" height="30.000000pt" viewBox="0 0 227.000000 227.000000"
            preserveAspectRatio="xMidYMid meet">
           
           <g transform="translate(0.000000,227.000000) scale(0.100000,-0.100000)"
           fill="#000000" stroke="none">
           <path d="M326 1913 c-20 -15 -39 -36 -41 -47 -9 -36 -105 -718 -105 -743 0
           -14 6 -23 15 -23 22 0 18 -17 -5 -23 -11 -3 -20 -11 -20 -19 -1 -7 -25 -179
           -54 -383 l-53 -370 25 -45 c31 -55 61 -90 78 -90 24 0 73 51 90 95 9 24 26 51
           38 59 12 7 87 113 165 234 148 228 171 258 193 249 8 -2 45 -90 83 -193 37
           -104 79 -207 92 -230 13 -22 23 -48 23 -58 0 -22 55 -118 81 -142 18 -17 23
           -17 46 -4 14 8 35 27 46 42 21 28 20 22 182 1174 l58 412 -28 43 c-16 24 -41
           54 -55 66 l-27 22 -37 -26 c-20 -15 -39 -36 -41 -47 -3 -12 -26 -169 -51 -350
           l-47 -329 29 -53 29 -53 -41 -43 -42 -43 -22 -155 c-12 -85 -23 -157 -25 -158
           -6 -6 -23 32 -74 172 -33 88 -61 148 -76 162 -14 13 -25 30 -25 38 0 19 -48
           32 -69 19 -9 -6 -17 -20 -19 -32 -5 -30 -20 -26 -24 7 -2 20 -9 28 -28 30 -14
           1 -30 -1 -35 -5 -6 -5 -59 -82 -119 -171 -59 -90 -109 -162 -111 -160 -2 1 1
           28 6 58 16 99 14 145 -11 180 -25 36 -21 73 10 90 11 6 26 23 34 38 7 15 35
           178 61 363 l48 337 -28 43 c-16 24 -41 54 -55 66 l-27 22 -37 -26z"/>
           <path d="M1370 1930 c0 -6 7 -22 16 -35 20 -31 8 -32 -23 -3 -13 12 -26 19
           -29 16 -7 -8 -114 -732 -114 -775 0 -23 5 -33 15 -33 22 0 18 -14 -7 -25 -22
           -9 -26 -30 -76 -390 -49 -347 -52 -382 -38 -405 8 -14 22 -39 30 -55 25 -47
           50 -59 86 -40 16 8 37 29 45 45 9 18 36 170 62 357 37 259 51 331 65 345 17
           17 42 18 309 18 201 0 297 4 312 12 12 6 55 41 95 76 51 47 75 76 82 101 18
           67 70 463 70 538 0 82 -6 94 -115 211 l-48 52 -369 0 c-247 0 -368 -3 -368
           -10z m717 -232 c-3 -18 -21 -142 -39 -276 -26 -196 -30 -246 -20 -262 20 -32
           14 -45 -11 -22 -23 22 -29 22 -310 22 -236 0 -287 2 -287 14 0 7 16 122 35
           256 19 134 35 247 35 251 0 5 9 18 20 29 19 19 33 20 301 20 l281 0 -5 -32z"/>
           </g>
           </svg>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('home')])>Главная</a></li>
        <li><a href="{{ route('faqs') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('faqs')])>FAQs</a></li>
        <li><a href="{{ route('about') }}" @class([ 'nav-link px-2', 'link-secondary' => request()->routeIs('about')])>О wp</a></li>
      </ul>

      <div class="btn-group text-end">
        @if(!request()->routeIs('auth'))
          <form action="{{ route('auth') }}">
              <button type="submit" class="btn btn-light rounded-pill px-3">Войти</button>
          </form>
        @endif
        
        @if(!request()->routeIs('reg'))
          <form action="{{ route('reg') }}">
              <button type="submit" class="btn btn-light rounded-pill px-3">Регистрация</button>
          </form>
        @endif
      </div>

    </header>
  </div>