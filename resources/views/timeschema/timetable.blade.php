<x-timeschema.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>

	<span class='h1'>Расписание</span>
	<table hidden>
		<thead>
			<tr>
				<td><span class='border'>Время</span></td>
				<td><span class='border'>Понедельник</span></td>
				<td><span class='border'>Вторник</span></td>
				<td><span class='border'>Среда</span></td>
				<td><span class='border'>Четверг</span></td>
				<td><span class='border'>Пятница</span></td>
				<td><span class='border'>Суббота</span></td>
				<td><span class='border'>Воскресенье</span></td>
			</tr>
		</thead>
		<tbody>
			@for ($k = 0; $k < 10; $k++)
			<tr>
				<td><span class='border'>Time:0{{ $k }}</td>
				@for ($i = 0; $i < 7; $i++)
					<td> {{ $i }} </td>
				@endfor
			</tr>
			@endfor
		</tbody>
	</table>
	{!! $table !!}
	<!-- @forelse($events as $event)
		<div>
			date: {{ $event->date }}<br>
			time: {{ $event->time_start }}<br>
			paid: {{ $event->paid }}<br>
			complite: {{ $event->complite }}
		</div>
	@empty
		<p>no events!</p>
	@endforelse -->


</x-timeschema.layout>