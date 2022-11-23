let openBtn = document.querySelector('.openBurger');
let closeBtn = document.querySelector('.closeBurger');

let sidebar = document.querySelector('.sidebar');

openBtn.addEventListener('click', function() {
	sidebar.classList.add('open');
});

closeBtn.addEventListener('click', function() {
	sidebar.classList.remove('open');
});