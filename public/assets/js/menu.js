// ##############################################################
// ###########             Aperçu du menu             ###########
// ##############################################################

let starter = document.querySelector('#starterPreview');
let mainDishes = document.querySelector('#mainDishesPreview');
let dessert = document.querySelector('#dessertPreview');
let drinks = document.querySelector('#drinksPreview');
let container = document.querySelector('.catDishesContainer')

starter.addEventListener('click', () => {
    container.innerHTML =   `<div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Entrée 1</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Entrée 2</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Entrée 3</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Entrée 4</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>`
})
mainDishes.addEventListener('click', () => {
    container.innerHTML = `<div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Plat 1</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Plat 2</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Plat 3</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Plat 4</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>`
})
dessert.addEventListener('click', () => {
    container.innerHTML = `<div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Dessert 1</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Dessert 2</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Dessert 3</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                            <div class="catDishiesItem">
                            <div class="catDishiesItemTitle">
                                <h4>Dessert 4</h4>
                                <span>25€</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                            </div>`
})