let links = document.querySelectorAll('.menuLinksDesktop a:nth-child(-n + 3)');

string = window.location.href;
let index = string.lastIndexOf('/');
let slug = string.substr(index + 1);

links.forEach(link => {
    if(link.textContent.toLowerCase() == slug) {
        link.classList.add('active');
    }
});