function menuChange(x) {
  x.classList.toggle("change");
}

const menuburger = document.querySelector(".menuburger");
const navlinks = document.querySelector(".links");
const main = document.querySelector("main");
const logo = document.querySelector(".logo");

menuburger.addEventListener("click", () => {
  navlinks.classList.toggle("mobile-menu");
  main.classList.toggle("blur");
  logo.classList.toggle("blur");
});
