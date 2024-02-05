<div class="menu_nav">
    <ul>
        <li class="{{{ route('info-page', ['admin_name' => $name]) === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('info-page', ['admin_name' => $name]) }}">Информационная страница администратора</a>
        </li>

        <li class="{{{ route('timetable', ['id' => $id]) === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('timetable', ['id' => $id]) }}">Расписание</a>
        </li>

        <li class="{{{ route('adminPanel') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('adminPanel') }}">Админка</a>
        </li>

        <li class="{{{ route('main-page') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('main-page') }}">О проекте</a>
        </li>
        <li>            
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <input type='submit' value='Выйти'>
            </form>
        </li>
    </ul>
</div>