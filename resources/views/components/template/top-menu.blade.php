<div class="menu_nav">
    <ul>
        <li class="{{{ route('try-test') === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('try-test') }}">try test</a>
        </li>

        <li class="{{{ route('info-page', ['id' => $id]) === env('APP_URL') . $uri ? 'active' : '' }}}">
            <a href="{{ route('info-page', ['id' => $id]) }}">Расписание</a>
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
    </ul>
</div>