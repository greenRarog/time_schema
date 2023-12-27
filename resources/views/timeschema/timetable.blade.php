<x-timeschema.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>
	<span class='h1'>Расписание</span>	
	<button data-table='week' class='get-table'>refresh table</button><br>
	{!! $weekTable !!}
	<br><br><br><br><br>
	<button data-table='day' class='get-table'>refresh table</button><br>
	{!! $dayTable !!}
	<br>
	<button class='test'>test</button>


<script>	
	let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	addEventsTable();

	let refreshTableButtons = document.querySelectorAll('button.get-table');	
	for (let refreshButton of refreshTableButtons) {
		refreshButton.addEventListener('click', () => refreshTable(refreshButton.getAttribute('data-table')));
	}
	


	let test = document.querySelector('button.test');


function refreshTable(typeTable) {
	console.log(typeTable);
	let adminId = document.querySelector('table.week-table').getAttribute('data-admin-id');
	let userId = document.querySelector('table.week-table').getAttribute('data-user-id');		
	let dateTable = document.querySelector('table.week-table').getAttribute('data-date');

	let route = '/api/get-table?adminId='  + adminId +
				'&userId=' + userId +
				'&date=' + dateTable +
				'&typeTable=' + typeTable;
	fetch(route).then(
	response => {
		return response.json();
	}).then(
		data => {
			console.log(data);
			if (data.status == 'ok') {
				seachTable = 'table.' + typeTable + '-table';
				document.querySelector(seachTable).innerHTML = '';
				document.querySelector(seachTable).innerHTML = data.table;
				addEventsTable();
			}
		});	
}	

function addEventsTable() {
	let addUserButtons = document.querySelectorAll('button.week-add-user');
	for (let addReservationButton of addUserButtons) {
		addReservationButton.addEventListener('click', () => addReservation.call(addReservationButton) );
	}
}

function addReservation() {
	let adminId = document.querySelector('table.week-table').getAttribute('data-admin-id');
	let userId = document.querySelector('table.week-table').getAttribute('data-user-id');					
	let date = this.parentNode.getAttribute('data-date');
	let time = this.parentNode.getAttribute('data-time');
	let td = this.parentNode;
	let formData = new FormData();
	formData.set('adminId', adminId);
	formData.set('userId', userId);
	formData.set('date', date);
	formData.set('time', time);
	fetch('/api/add-reservation', {
		method: 'POST',
		body: formData,
		headers: {
			'Accept': 'application/json',
			'X-CSRF-TOKEN': csrfToken,
		}
	}).then(
		response => {
			return response.json();
		}).then(
			data => {
				console.log(data);
				if (data.status == 'ok') {
 					td.innerHTML = "<span class='border'>" + data.name + '</span>';
 				}
			}
	);
}
</script>
</x-timeschema.layout>