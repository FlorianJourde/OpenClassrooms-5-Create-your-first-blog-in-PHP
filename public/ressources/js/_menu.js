export default function toggleMenu() {
    let openMenu = document.querySelector('.open-menu');
    let closeMenu = document.querySelector('.close-menu');
    let mobileMenu = document.querySelector('#mobile-menu');
    let frame = document.querySelector('#frame');
    let buttons = [openMenu, closeMenu];
    let beep = new Audio('/public/ressources/media/button-click-1.wav');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            frame.classList.toggle('menu-open')
            mobileMenu.classList.toggle('menu-open');
            beep.currentTime = 0;
            beep.volume = 0.25;
            beep.play();
        })
    })
}
