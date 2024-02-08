<x-template.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>
<div class="content">
    <div class="content_resize">	
    	<div class="mainbar">   
			<div class='article'>
				<h2>Расписание на неделю</h2>	
				<div class="clr"></div>      
				<button data-table='week' class='get-table'>refresh table</button><br>
				{!! $weekTable !!}
			</div>

			<div class='article'>
				<h2>Расписание на день</h2>	
				<div class="clr"></div>      
				<button data-table='day' class='get-table'>refresh table</button><br>
				{!! $dayTable !!}
			</div>
			<div class='article'>
				

<div id="popup-overlay">	
	<div id="popup">    
		<form class='popup_form_add_reservation' action="POST" action='{{ env('APP_ULR') . '/api/add-reservation' }}'>
			@csrf
			<input hidden name='admin_id'>
			<div>
				<label>Клиент: </label>
				<select class='users' name='user_id'>
					@foreach($users as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>					
					@endforeach
				</select>
			</div>

			<div>
				<label>Дата: </label>
				<input disabled name='date'>
			</div>

			<div>
				<label>Время: </label>
				<input disabled name='time'>
			</div>
						
			<input type='submit' value='Добавить'>
			<button type="button" onclick="hidePopup()">Закрыть окно</button>
		</form>				
	</div>
</div>

				<button class='test'>test</button>
			</div>
		</div>
		<div class="clr"></div>
		<div class="sidebar"></div>
		<div class="clr"></div>	
		<div class="fbg"><div class="clr"></div></div>
	</div>
</div>

<script>
addEventsTable();
function addEventsTable() {
	let addUserButtons = document.querySelectorAll('button.week-add-user');
	for (let addReservationButton of addUserButtons) {
		addReservationButton.addEventListener('click', () => addReservation.call(addReservationButton) );
	}
}

let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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

	let route = '/api/get-table?admin_id='  + adminId +
				'&user_id=' + userId +
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

let popupOverlay = document.getElementById("popup-overlay");
let popup = document.getElementById("popup");
function addReservation() {
	let adminId = document.querySelector('table.week-table').getAttribute('data-admin-id');
	let userId = document.querySelector('table.week-table').getAttribute('data-user-id');
	let date = this.parentNode.getAttribute('data-date');
	let time = this.parentNode.getAttribute('data-time');
	let td = this.parentNode;

	if (adminId == userId) {				
		let popupForm = document.querySelector('form.popup_form_add_reservation');
		let popupFormInputs = popupForm.elements;

		let popupFormInputDate = popupFormInputs['date'];
		popupFormInputDate.value = date;
		let popupFormInputTime = popupFormInputs['time'];
		popupFormInputTime.value = time;
		let popupFormInputAdminId = popupFormInputs['admin_id'];
		popupFormInputAdminId.value = adminId;

		showPopup();
	} else {		
		let formData = new FormData();
		formData.set('admin_id', adminId);
		formData.set('user_id', userId);
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
}

function showPopup() {
	popupOverlay.style.display = "block";
}
function hidePopup(event) {
	popupOverlay.style.display = "none";
	event.preventDefault();
}
</script>

</x-template.layout>