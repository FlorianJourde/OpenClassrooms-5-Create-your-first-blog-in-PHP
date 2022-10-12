let windowHeight;
let topPageButton = document.querySelector('#top-page-button');

export default function toggleMenu() {
    console.log(document.querySelector('#top-page-button'));

    if (topPageButton.length === 0) {
        return false;
    }

    windowHeight = window.innerHeight / 2;

    window.onscroll = function() {
        topPageAppear()
    };

    topPageButton.addEventListener('click', function() {
        topPageScroll();
    })

    // $('#top-page-button').click(function() {
    // })
}

function topPageAppear() {
    if (document.body.scrollTop > windowHeight || document.documentElement.scrollTop > windowHeight) {
        topPageButton.classList.add('appear');
        // topPageButton.css({right: 20 + 'px'});
    } else {
        topPageButton.classList.remove('appear');
        // topPageButton.css({right: -100 + 'px'});
    }
}

function topPageScroll() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
