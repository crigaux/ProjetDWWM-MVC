let editBtn = document.querySelectorAll('.edit svg:nth-child(1)');
let container = document.querySelector('.content');

// Récupération du slug pour tester sur quelle page du dashboard se trouve l'admin

string = window.location.href;
let index = string.lastIndexOf('/');
let slug = string.substr(index + 1);

if(slug == 'dbMenuController.php') {
    // Page 1 : Menu
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            container.innerHTML = 
            `
            <form class="dbModif" method="POST">
                <input type="hidden" name="id" value="${btn.parentElement.parentElement.id}">
                <input type="text" name="menuName" value="${btn.parentElement.parentElement.children[1].textContent}">
                <input type="number" name="menuPrice" value="${btn.parentElement.parentElement.children[2].textContent}">
                <textarea name="menuDesc">${btn.parentElement.parentElement.children[3].textContent}</textarea>
                <input type="text" name="menuImg" value="${btn.parentElement.parentElement.children[4].textContent}">
                <div>
                    <button type="submit">Modifier</button>
                    <button>Retour</button>
                </div>
            </form>
            `
        })
    });
} else if(slug == 'dbReviewsController.php') {
    // Page 1 : Commentaires
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            container.innerHTML = 
            `
            <form class="dbModif" method="POST">
                <input type="hidden" name="id" value="${btn.parentElement.parentElement.id}">
                <input type="text" name="reviewName" value="${btn.parentElement.parentElement.children[1].textContent}">
                <textarea name="reviewComment">${btn.parentElement.parentElement.children[2].textContent}</textarea>
                <div>
                    <button type="submit">Modifier</button>
                    <button>Retour</button>
                </div>
            </form>
            `
        })
    });
} else if(slug == 'dbRegisterController.php') {
    // Page 1 : Membres
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            container.innerHTML = 
            `
            <form class="dbModif" method="POST">
                <input type="hidden" name="id" value="${btn.parentElement.parentElement.id}">
                <input type="text" name="customerFirstname" value="${btn.parentElement.parentElement.children[1].textContent}">
                <input type="text" name="customerLastname" value="${btn.parentElement.parentElement.children[2].textContent}">
                <input type="email" name="customerEmail" value="${btn.parentElement.parentElement.children[3].textContent}">
                <div>
                    <button type="submit">Modifier</button>
                    <button>Retour</button>
                </div>
            </form>
            `
        })
    });
} else if(slug == 'dbReservationsController.php') {
    // Page 1 : Réservations
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            container.innerHTML = 
            `
            <form class="dbModif" method="POST">
                <input type="hidden" name="id" value="${btn.parentElement.parentElement.id}">
                <input type="text" name="ReservationName" value="${btn.parentElement.parentElement.children[1].textContent}">
                <input type="text" name="ReservationPhone" value="${btn.parentElement.parentElement.children[2].textContent}">
                <input type="number" name="ReservationNb" value="${btn.parentElement.parentElement.children[3].textContent}">
                <input type="text" name="ReservationDate" value="${btn.parentElement.parentElement.children[4].textContent}">
                <input type="text" name="ReservationSlot" value="${btn.parentElement.parentElement.children[5].textContent}">
                <textarea name="ReservationComment">${btn.parentElement.parentElement.children[6].textContent}</textarea>
                <div>
                    <button type="submit">Modifier</button>
                    <button>Retour</button>
                </div>
            </form>
            `
        })
    });
}
