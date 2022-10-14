// ##############################################################
// ##########             Anim Menu Burger             ##########
// ##############################################################

let menuBtnOpen = document.querySelector('.menu');
let menuBtnClose = document.querySelector('.close');
let overlayMenu = document.querySelector('.overlayMenuBurger');

menuBtnOpen.addEventListener('click', () => {
    overlayMenu.classList.add('open');
    overlayMenu.classList.remove('close');
})

menuBtnClose.addEventListener('click', () => {
    overlayMenu.classList.add('close');
    overlayMenu.classList.remove('open');
})