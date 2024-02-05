<form method="POST" action='{{ env('APP_ULR') . '/update-worktimes' }}'>
	@csrf
	<label for='time_start'>начало: </label>
	<input disabled name='time_start' value='{{ $worktime_start }}'></br>
	<label for='time_end'>окончание: </label>
	<input disabled name='time_end' value='{{ $worktime_end }}'></br>	
	<button>Редактировать</button>
	<input hidden type='submit' value='Обновить'>
</form>