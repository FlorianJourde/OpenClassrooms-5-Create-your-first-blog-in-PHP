let windowHeight;
let scrollToTopButton = document.querySelector('#top-page-button');
let scrollToPartnersButton = document.querySelector('#scroll-to-partners');
let swiperNextButtons = document.querySelectorAll('.swiper-button-next');
// let toggleThemeButton = document.querySelector('.theme-toggle-button');
let partnersSection = document.querySelector('#partners');
// let woosh = new Audio('/ressources/media/woosh-2.wav');
let beep = new Audio('/ressources/media/button-click-3.wav');

export default function scrollTo() {
  windowHeight = window.innerHeight / 2;

  if (scrollToPartnersButton !== null) {
    scrollToPartnersButton.addEventListener('click', function () {
      playBeep();
      scrollToPartners();
    })
  }
  
  if (swiperNextButtons !== null) {
      
    swiperNextButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          playBeep();
        })
    })
  }
  
//   if (toggleThemeButton !== null) {
//     toggleThemeButton.addEventListener('click', function () {
//         console.log(toggleThemeButton)
//       playWoosh();
//     })
//   }

  if (scrollToTopButton !== null) {
    window.onscroll = function () {
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
  beep.volume = 1;
  beep.play();
}

// function playWoosh() {
//   woosh.currentTime = 0;
//   woosh.volume = 1;
//   woosh.play();
// }

function topPageAppear() {
  if (document.body.scrollTop > windowHeight || document.documentElement.scrollTop > windowHeight) {
    scrollToTopButton.classList.add('appear');
  } else {
    scrollToTopButton.classList.remove('appear');
  }
}

function scrollToTop() {
  // document.body.scrollTop = 0;
  // document.documentElement.scrollTop = 0;
  window.scrollTo({top: 0, behavior: 'smooth'});
}

function scrollToPartners() {
  // document.body.scrollTop = partnersSection.offsetTop;
  // document.documentElement.scrollTop = partnersSection.offsetTop;
  window.scrollTo({top: partnersSection.offsetTop, behavior: 'smooth'});
}
