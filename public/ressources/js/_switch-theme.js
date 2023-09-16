export default function switchTheme() {
  // const themeToggleButtons = document.getElementById('theme-toggle-button');
  const themeToggleButtons = document.querySelectorAll('.theme-toggle-button');
  const body = document.body;

  const savedTheme = localStorage.getItem('theme');

  if (savedTheme === 'dark') {
    body.classList.add('dark');
    // themeToggleButtons.classList.add('dark')
    themeToggleButtons.forEach((element) => element.classList.add('dark'))
  }

  themeToggleButtons.forEach(function(element) {
      element.addEventListener('click', function () {
      if (body.classList.contains('dark')) {
        body.classList.remove('dark');
        // themeToggleButtons.classList.remove('dark')
        // themeToggleButtons.forEach((element) => element.classList.remove('dark'));
        this.classList.remove('dark');
        localStorage.setItem('theme', '');
      } else {
        body.classList.add('dark');
        // themeToggleButtons.classList.add('dark');
        // themeToggleButtons.forEach((element) => element.classList.add('dark'));
        this.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      }
    });
  })
}