<div class='article'>
	<h2>Редактирование информационной страницы</h2>	
	<div class="clr"></div> 
	<form method="POST" enctype="multipart/form-data" action='{{ env('APP_ULR') . '/update-mainpage' }}'>
		@csrf		
		<input hidden name='infopage_id' value="{{ $id }}">
		<h2>seo</h2>
		<div>
			<label>title: </label>
			<input class='infopage-input' disabled name='infopage_title' placeholder="{{ ($title != '') ? $title : 'Не задан' }}">	
		</div>
		<div>
			<label>description: </label>
			<input class='infopage-input' disabled name='infopage_seo_description' placeholder="{{ ($seo_description != '') ? $seo_description : 'Не задан' }}">
		</div>			

		<h2>содержание</h2>
		<div>
			<label>Заголовок: </label>
			<input class='infopage-input' disabled name='infopage_header' placeholder="{{
				($header != '') ? $header : 'Не задан'
			}}">
		</div>
		<div>
			<label>Вид деятельности: </label>
			<input class='infopage-input' disabled name='infopage_activity_kind' placeholder="{{
				($activity_kind) ? $activity_kind : 'Не задан'
			}}">
		</div>
		<div>
			<label>Фотография: </label>
			@if ($path_image != '')
				<img src="{{ $path_image }}" alt='admin photo'>
			@endif
			<input class='infopage-input' disabled type='file' name='infopage_path_image'>
		</div>
		<div>			
			<label>Описание: </label>
			<input class='infopage-input' disabled name='infopage_description' placeholder="{{
				($description != '') ? $description : 'Не задан'
			}}">
		</div>			
		<button class='infopage-button-for-change'>Редактировать</button>
		<input hidden class='infopage-input-submit' type="submit" value='Обновить'>
	</form>
</div>

<script>
	let InfopageInputs = document.querySelectorAll('.infopage-input');
	let InfopageSubmit = document.querySelector('.infopage-input-submit');
	let InfopageButtonForChange = document.querySelector('.infopage-button-for-change');

	InfopageButtonForChange.addEventListener('click', function() {
		event.preventDefault();
		InfopageSubmit.removeAttribute('hidden');
		this.setAttribute('hidden', true);
		for (let InfopageInput of InfopageInputs) {
			InfopageInput.removeAttribute('disabled');
		}
	});
</script>