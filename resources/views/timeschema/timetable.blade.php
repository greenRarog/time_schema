<x-timeschema.layout>
	<x-slot:title>
		Расписание
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>
	<button class='get-table'>refresh table</button><br><br><br>
	<span class='h1'>Расписание</span>	
	{!! $weekTable !!}

<script>	
	let refreshButton = document.querySelector('button.get-table');
	refreshButton.addEventListener('click', function() {
		let adminId = document.querySelector('table.week-table').getAttribute('data-admin-id');
		let userId = document.querySelector('table.week-table').getAttribute('data-user-id');		
		let dateTable = document.querySelector('table.week-table').getAttribute('data-date');

		let route = '/api/get-table?adminId='  + adminId +
					'&userId=' + userId +
					'&date=' + dateTable;
		fetch(route).then(
		response => {
			return response.json();
		}).then(
			data => {
				console.log(data);
				if (data.status == 'ok') {
					document.querySelector('table.week-table').innerHTML = data.table;
					//навесить события!
				}
			});
	});
	
	let addUserButtons = document.querySelectorAll('button.add-user');	
	for (let button of addUserButtons)	{
		button.addEventListener('click', function() {			
			console.log('1112334');
			let adminId = document.querySelector('table.week-table').getAttribute('data-admin-id');
			let userId = document.querySelector('table.week-table').getAttribute('data-user-id');		
			let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');			
			let date = this.parentNode.getAttribute('data-date');
			let time = this.parentNode.getAttribute('data-time');
			let td = this.parentNode;
			console.log(td);

			let query = 'adminId=' + adminId + 
						'&userId=' + userId + 
						'&date=' + date + 
						'&time=' + time;

			fetch('/api/add-reservation', {
				method: 'POST',
				body: query,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'Accept': 'application/json',
					'X-CSRF-TOKEN': csrfToken,
				},
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
				)
		});
	}	

</script>
</x-timeschema.layout>