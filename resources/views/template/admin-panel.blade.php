<x-template.layout>
	<x-slot:title>
		Панель Администратора
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>
	
	<div class="content">
		<div class="content_resize">
			<div class="mainbar">

				<div class='article'>
					<h2>Управление Пользователями</h2>
					<div class="clr"></div> 
					<x-template.admin.new_client>
						<x-slot:id>{{ $id }}</x-slot>
					</x-template.admin.new_client>
				</div>
				
				<div class='article'>
					<h2>Установка рабочих часов</h2>
					<div class="clr"></div> 
					<x-template.admin.worktime>
						<x-slot:worktime_start>{{ $worktime->start }}</x-slot:time_start>
						<x-slot:worktime_end>{{ $worktime->end }}</x-slot:time_end>
					</x-template.admin.worktime>
				</div>
				
				<x-template.admin.infopage>
					<x-slot:id>{{ $infopage->id }}</x-slot>
					<x-slot:title>{{ $infopage->title }}</x-slot>
					<x-slot:seo_description>{{ $infopage->seo_description }}</x-slot>
					<x-slot:header>{{ $infopage->header }}</x-slot>
					<x-slot:activity_kind>{{ $infopage->activity_kind }}</x-slot>
					<x-slot:path_image>{{ $infopage->path_image }}</x-slot>
					<x-slot:description>{{ $infopage->description }}</x-slot>
				</x-template.admin.infopage>

			</div>
			<div class="clr"></div> 
			<div class="sidebar"></div>
			<div class="clr"></div>
			<div class="fbg"><div class="clr"></div></div>
		</div>
	</div>

</x-template.layout>