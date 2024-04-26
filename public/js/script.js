const menuburger = document.querySelector(".menuburger");
const navlinks = document.querySelector(".links");
const main = document.querySelector("main");
const logo = document.querySelector(".logo");

function menuChange(x) {
  x.classList.toggle("change");
  navlinks.classList.toggle("mobile-menu");
  main.classList.toggle("blur");
  logo.classList.toggle("blur");
}

// menuburger.addEventListener("click", () => {
//   navlinks.classList.toggle("mobile-menu");
//   main.classList.toggle("blur");
//   logo.classList.toggle("blur");
// });

const moduleToggle = document.querySelector("#toggle-module");
const moduleForm = document.querySelector("#module-form");

moduleToggle.addEventListener("click", () => {
  moduleForm.classList.toggle("form-toggle");
});
