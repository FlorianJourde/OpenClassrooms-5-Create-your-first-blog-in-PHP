export default function loading() {
  let loader = document.querySelector("#loader");
  let delay = 400;

  document.onreadystatechange = function() {
    if (document.readyState === "complete") {
      loader.classList.add('hide-left');

      setTimeout(function() {
        loader.classList.remove('transition');
        loader.classList.remove('hide-left');
        loader.classList.add('hide-right');
      }, delay);

      setTimeout(function() {
        loader.classList.add('transition');
      }, delay * 2);
    }
  };

  window.onbeforeunload = function(){
    loader.classList.remove('hide-right');
  };
}