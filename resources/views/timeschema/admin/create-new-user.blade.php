<x-timeschema.layout>
	<x-slot name='title'>
		Создание нового пользователя
	</x-slot>
	
	<form method="POST" action='{{ env('APP_ULR') . '/create-new-time-schema-user' }}'>
		<input hidden name='admin_id' value='1'>
		<div>
  			<label for="name">Имя пользователя</label>
  			<input type="text" name="name">
  		</div>
  		<div>
  			<label for="pass">Пароль пользователя</label>
  			<input type="text" name="pass">
  		</div>

  		<input type='submit'>
	</form>

</x-timeschema.layout>