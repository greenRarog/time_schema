<h1>hello world</h1>

<form class='create-time-schema' method='POST' action='{{ env('APP_URL') . '/api/create-time-schema' }}'> 
	@csrf
	admin id: <input name='admin_id'> </br>
	user id: <input name='user_id'> </br>
	time schema params: <input name='params'> </br>
	<input type='submit'>
</form>