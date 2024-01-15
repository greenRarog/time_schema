<x-timeschema.layout>
	<x-slot:seo_description>		
		{{{ isset($mainPage->seo_description) ? $mainPage->seo_description : '' }}}		
	</x-slot>
	<x-slot:title>
		{{{ isset($mainPage->title) ? $mainPage->title : "Информационная страница пользователя" }}}
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>	
	<span class='h1'>
		{{{ isset($mainPage->header) ? $mainPage->header : 'Заголовок'}}}
	</span>
	<div class='article'>
		{{{ isset($mainPage->description) ? $mainPage->description : 'Авторское описание страницы'}}}
	</div>
	
</x-timeschema.layout>