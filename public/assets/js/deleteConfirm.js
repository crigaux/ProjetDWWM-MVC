let deleteBtn = document.querySelectorAll('.edit .btnDeleteConf > svg');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteMenuLink = document.querySelector('.deleteMenuLink');
let deleteReservationLink = document.querySelector('.deleteReservationLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteMenuLink.href = '/admin/menu/delete/' + e.target.parentNode.parentNode.parentNode.parentNode.id
	})
})

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteReservationLink.href = '/admin/reservation/delete/' + e.target.parentNode.parentNode.parentNode.parentNode.id
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})