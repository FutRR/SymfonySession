function menuChange(x) {
  x.classList.toggle("change");
}

const menuburger = document.querySelector(".menuburger");
const navlinks = document.querySelectorAll("ul.nav-links");

menuburger.addEventListener("click", () => {
  console.log(navlinks);
  navlinks.forEach((navlink) => {
    navlink.classList.toggle("mobile-menu");
  });
});
