export default function switchTheme() {
  const themeToggleButtons = document.querySelectorAll('.theme-toggle-button');
  const body = document.body;
  const html = document.querySelector('html');
  const savedTheme = localStorage.getItem('theme');

  if (savedTheme === 'dark') {
    html.classList.add('dark');
    themeToggleButtons.forEach((element) => element.classList.add('dark'))
  }

  themeToggleButtons.forEach(function(element) {
      element.addEventListener('click', function () {
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