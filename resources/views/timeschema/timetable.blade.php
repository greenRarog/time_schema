<x-timeschema.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>

	<span class='h1'>Расписание</span>
	{!! $table !!}


<script>
	let buttons = document.querySelectorAll('button.add-user');

	for (let button of buttons)	{
		button.addEventListener('click', function() {
			console.log('111');
		});
	}	

</script>
</x-timeschema.layout>