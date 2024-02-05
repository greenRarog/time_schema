<div class="menu_nav">
    <ul>
        <li class="{{{ route('login') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('login') }}">Войти</a>
        </li>

        <li class="{{{ route('register') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('register') }}">Регистрация</a>
        </li>

        <li class="{{{ route('main-page') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('main-page') }}">О проекте</a>
        </li>        
    </ul>
</div>

