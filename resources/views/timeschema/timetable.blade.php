<x-timeschema.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>

	<span class='h1'>Расписание</span>
	{!! $table !!}


	<br><br>
	{{ $table }}
</x-timeschema.layout>