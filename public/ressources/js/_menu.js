export default function toggleMenu() {
    let openMenu = document.querySelector('.open-menu');
    let closeMenu = document.querySelector('.close-menu');
    let body = document.querySelector('body');
    let layout = document.querySelector('.layout');
    let mobileMenu = document.querySelector('#mobile-menu');
    let menu = document.querySelector('.menu');
    let sections = document.querySelectorAll('section');
    let nav = document.querySelector('nav');
    let footer = document.querySelector('footer');
    let main = document.querySelector('main');

    console.log(menu);

    openMenu.addEventListener('click', function() {
        console.log(this);
        // body.classList.add('menu-open');
        sections.forEach(section => section.classList.add('menu-open'));
        menu.classList.add('menu-open');
        mobileMenu.classList.add('menu-open');
        nav.classList.add('menu-open');
        footer.classList.add('menu-open');
        main.classList.add('menu-open');
    })

    closeMenu.addEventListener('click', function() {
        console.log(this);
        // body.classList.remove('menu-open');
        sections.forEach(section => section.classList.remove('menu-open'));
        menu.classList.remove('menu-open');
        mobileMenu.classList.remove('menu-open');
        nav.classList.remove('menu-open');
        footer.classList.remove('menu-open');
        main.classList.remove('menu-open');
    })
}