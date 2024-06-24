export default function switchTheme() {
  const themeToggleButtons = document.querySelectorAll('.theme-toggle-button');
  const body = document.body;
  const html = document.querySelector('html');
  const savedTheme = localStorage.getItem('theme');
let woosh = new Audio('/ressources/media/woosh-2.wav');
  
  
// let toggleThemeButton = document.querySelector('.theme-toggle-button');
//   if (toggleThemeButton !== null) {
//     toggleThemeButton.addEventListener('click', function () {
//         console.log(toggleThemeButton)
//       playWoosh();
//     })
//   }
  
function playWoosh() {
  woosh.currentTime = 0;
  woosh.volume = 1;
  woosh.play();
}

  if (savedTheme === 'dark') {
    html.classList.add('dark');
    themeToggleButtons.forEach((element) => element.classList.add('dark'))
  }

  themeToggleButtons.forEach(function(element) {
      element.addEventListener('click', function () {
      playWoosh();
          
      if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        themeToggleButtons.forEach((element) => element.classList.remove('dark'))
        localStorage.setItem('theme', '');
      } else {
        html.classList.add('dark');
        themeToggleButtons.forEach((element) => element.classList.add('dark'))
        localStorage.setItem('theme', 'dark');
      }
    });
  })
}