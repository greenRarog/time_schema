<div class='article'>
	<h2>Редактирование информационной страницы</h2>
	<div class="clr"></div> 
	<form method="POST" action='{{ env('APP_ULR') . '/update-mainpage' }}'>
		@csrf

		<h2>seo</h2>
		<div>
			<label>title: </label>
			<input name='infopage-title' value="{{ isset($infopage->title) ? $infopage-title : 'Не задан' }}">
		</div>
		<div>
			<label>description: </label>
			<input name='infopage-seo-description' value="{{ isset($infopage->seoDescription) ? $infopage->seoDescription : 'Не задан' }}">
		</div>			

		<h2>содержание</h2>
		<div>
			<label>Заголовок: </label>
			<input name='infopage-header' value="{{
				isset($infopage->header) ? $infopage->header : 'Не задан'
			}}">
		</div>
		<div>
			<label>Вид деятельности: </label>
			<input name='infopage-activity-kind' value="{{
				isset($infopage->activityKind) ? $infopage->activityKind : 'Не задан'
			}}">
		</div>
		<div>
			<label>Фотография: </label>
			<img src="{{
				isset($infopage->pathImage) ? $infopage->pathImage : ''
			}}" alt='admin photo'>
		</div>
		<div>			
			<label>Описание: </label>
			<input name='infopage-description' value="{{
				isset($infopage->description) ? $infopage->description : 'Не задан'
			}}">
		</div>			
		<input type="submit">
	</form>
</div>