export default function switchTheme() {
  const themeToggleBtn = document.getElementById("theme-toggle-button");
  const body = document.body;

  const savedTheme = localStorage.getItem("theme");

  if (savedTheme === "dark") {
    body.classList.add("dark");
  }

  themeToggleBtn.addEventListener("click", function () {
    if (body.classList.contains("dark")) {
      body.classList.remove("dark");
      localStorage.setItem("theme", "");
    } else {
      body.classList.add("dark");
      localStorage.setItem("theme", "dark");
    }
  });
}