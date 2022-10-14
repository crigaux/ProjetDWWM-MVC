let editBtn = document.querySelectorAll('.edit svg:nth-child(1)');
let container = document.querySelector('.content');

editBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        container.innerHTML = 
        `
        <form method="POST">
            <input type="hidden" name="id" value="${btn.parentElement.parentElement.id}">
            <input type="text" name="name" value="${btn.parentElement.parentElement.children[0].textContent}">
            <input type="text" name="price" value="${btn.parentElement.parentElement.children[1].textContent}">
            <input type="text" name="desc" value="${btn.parentElement.parentElement.children[2].textContent}">
            <input type="text" name="img" value="${btn.parentElement.parentElement.children[3].textContent}">
            <button type="submit">Modifier</button>
        </form>
        `
    })
});