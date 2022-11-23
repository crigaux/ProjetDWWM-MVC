let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteMenuLink = document.querySelector('.deleteMenuLink');
let deleteReservationLink = document.querySelector('.deleteReservationLink');
let deleteOrderLink = document.querySelector('.deleteOrderLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteMenuLink.href = '/admin/menu/delete/' + e.target.id
	})
})

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteReservationLink.href = '/admin/reservation/delete/' + e.target.parentNode.parentNode.parentNode.parentNode.id
	})
})

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteOrderLink.href = '/admin/commande/delete/' + e.target.parentNode.parentNode.parentNode.parentNode.id
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})