<x-timeschema.layout>
	<x-slot:title>
		Панель Администратора
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>
	
	<div>
		<span class='h1'>Добавление нового пользователя</span>
		<form method="POST" action='{{ env('APP_ULR') . '/create-new-time-schema-user' }}'>
			@csrf
			<input hidden name='admin_id' value='{{ $id }}'>
			<div>
	  			<label for="name">Имя пользователя</label>
	  			<input type="text" name="name">
	  		</div>
	  		<div>
	  			<label for="pass">Пароль пользователя</label>
	  			<input type="text" name="pass">
	  		</div>

	  		<div>
	  			<h3>Интервал</h3>

	  			<label for='period'>Каждый месяц: </label>
	  			<input class='checkbox_month' type='checkbox' name='period[]' value='month'>  			
	  			<div class='month-wrapper' hidden>
	  				<label for='date'>Дата: </label>
		  			<select name='month-date'>
		  				<option value='01'>01</option>
		  				<option value='02'>02</option>
		  			</select>  				
	  				<label for='month-time'>Время: </label>
		  			<select name='month-time'>
		  				<option value='00-00'>00-00</option>
		  				<option value='01-00'>01-00</option>
		  				<option value='02-00'>02-00</option>
		  				<option value='03-00'>03-00</option>
		  				<option value='04-00'>04-00</option>
		  			</select>
	  			</div>

				<label for='period'>Каждую неделю: </label>
	  			<input class='checkbox_week' type='checkbox' name='period[]' value='week'>  		
	  			<div class='week-wrapper' hidden>
	  				<label for='day'>День недели: </label>
		  			<select name='week-day'>
		  				<option value='1'>Понедельник</option>
		  				<option value='2'>Вторник</option>
		  				<option value='3'>Среда</option>
		  				<option value='4'>Четверг</option>
		  				<option value='5'>Пятница</option>
		  				<option value='6'>Суббота</option>
		  				<option value='0'>Воскресенье</option>
		  			</select>
	  				<label for='week-time'>Время: </label>
		  			<select name='week-time'>
		  				<option value='00-00'>00-00</option>
		  				<option value='01-00'>01-00</option>
		  				<option value='02-00'>02-00</option>
		  				<option value='03-00'>03-00</option>
		  				<option value='04-00'>04-00</option>
		  			</select>
		  		</div>
	  		</div>
	  		<input type='submit'>
		</form>
	</div>
	<br><br><br>
	<div>
		<span class='h1'>Установка рабочих часов</span>
		<form method="POST" action='{{ env('APP_ULR') . '/update-worktimes' }}'>
			@csrf
			<label for='time-start'>начало: </label>
			<input name='time-start' value='{{ $worktime->start }}'></br>
			<label for='time-end'>окончание: </label>
			<input name='time-end' value='{{ $worktime->end }}'></br>	
			<input type='submit'>
		</form>
	</div>
	<br><br><br>
	<div>
		<span class='h1'>Редактирование информационной страницы</span>
		<form method="POST" action='{{ env('APP_ULR') . '/update-mainpage' }}'>
			@csrf
			<span class='h2'>seo</span></br>
			<label>title: </label></br>
			<label>description: </label></br>
			<span class='h2'>содержание</span></br>
			<label>Заголовок: </label></br>
			<label>Вид деятельности: </label></br>
			<label>Фотография: </label></br>
			<label>Описание: </label></br>			
		</form>
	</div>


<script>
	let week = document.querySelector('.week-wrapper');
	let weekCheckbox = document.querySelector('.checkbox_week');
	let month = document.querySelector('.month-wrapper');
	let monthCheckbox = document.querySelector('.checkbox_month');

	weekCheckbox.addEventListener('change', function () {
		if (week.hasAttribute('hidden')) {
			week.removeAttribute('hidden');
		} else {
			week.setAttribute('hidden', true);
		}
	});
	monthCheckbox.addEventListener('change', function () {
		if (month.hasAttribute('hidden')) {
			month.removeAttribute('hidden');
		} else {
			month.setAttribute('hidden', true);
		}
	});

</script>
</x-timeschema.layout>