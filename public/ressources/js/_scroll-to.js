let windowHeight;
let scrollToTopButton = document.querySelector('#top-page-button');
let scrollToPartnersButton = document.querySelector('#scroll-to-partners');
let partnersSection = document.querySelector('#partners');
let beep = new Audio('/ressources/media/button-click-1.wav');

export default function scrollTo() {
    windowHeight = window.innerHeight / 2;

    if (scrollToPartnersButton !== null) {
        scrollToPartnersButton.addEventListener('click', function () {
            playBeep();
            scrollToPartners();
        })
    }

    if (scrollToTopButton !== null) {
        window.onscroll = function() {
            topPageAppear();
        };

        scrollToTopButton.addEventListener('click', function () {
            playBeep();
            scrollToTop();
        })
    }
}

function playBeep() {
    beep.currentTime = 0;
    beep.volume = 0.25;
    beep.play();
}

function topPageAppear() {
    if (document.body.scrollTop > windowHeight || document.documentElement.scrollTop > windowHeight) {
        scrollToTopButton.classList.add('appear');
    } else {
        scrollToTopButton.classList.remove('appear');
    }
}

function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function scrollToPartners() {
    document.body.scrollTop = partnersSection.offsetTop;
    document.documentElement.scrollTop = partnersSection.offsetTop;
}