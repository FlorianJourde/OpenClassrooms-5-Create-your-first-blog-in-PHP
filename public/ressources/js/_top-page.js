let windowHeight;
let topPageButton = document.querySelector('#top-page-button');
let beep = new Audio('/public/ressources/media/button-click-1.wav');

export default function toggleMenu() {
    if (topPageButton.length === 0) {
        return false;
    }

    windowHeight = window.innerHeight / 2;

    window.onscroll = function() {
        topPageAppear()
    };

    topPageButton.addEventListener('click', function() {
        beep.currentTime = 0;
        beep.volume = 0.25;
        beep.play();
        topPageScroll();
    })
}

function topPageAppear() {
    if (document.body.scrollTop > windowHeight || document.documentElement.scrollTop > windowHeight) {
        topPageButton.classList.add('appear');
    } else {
        topPageButton.classList.remove('appear');
    }
}

function topPageScroll() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
