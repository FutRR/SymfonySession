document.addEventListener("DOMContentLoaded", function () {
  // BURGER MENU //
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

  // SESSION FORM TOGGLE //

  const moduleToggle = document.querySelector("#toggle-module");
  const moduleForm = document.querySelector("#module-form");

  if (moduleToggle) {
    moduleToggle.addEventListener("click", () => {
      moduleForm.classList.toggle("form-toggle");
    });
  }

  const stagiaireToggle = document.querySelector("#toggle-stagiaire");
  const stagiaireForm = document.querySelector("#stagiaire-form");

  if (stagiaireForm) {
    stagiaireToggle.addEventListener("click", () => {
      stagiaireForm.classList.toggle("form-toggle");
    });
  }

  // DARK/LIGHT MODE TOGGLE
  var themeToggle = document.getElementById("theme-toggle");
  var body = document.body;
  var currentTheme = localStorage.getItem("theme") || "light";
  console.log("test1");
  setTheme(currentTheme);

  function setTheme(theme) {
    // save to localStorage
    localStorage.setItem("theme", theme);
    body.setAttribute("data-theme", theme);
    themeToggle.innerHTML =
      theme === "light"
        ? "<i class='fa-regular fa-moon'></i>"
        : "<i class='fa-regular fa-sun'></i>";
    console.log("test2");
  }

  function toggleTheme() {
    var newTheme =
      body.getAttribute("data-theme") === "light" ? "dark" : "light";
    setTheme(newTheme);
    console.log("test3");
  }
  themeToggle.addEventListener("click", toggleTheme);
});
