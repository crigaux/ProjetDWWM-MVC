let deleteBtn = document.querySelectorAll('.edit .btnDeleteConf > svg');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', () => {
		modale.classList.add('active');
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})