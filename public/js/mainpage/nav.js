let navbar__menu__humberger = document.querySelector(
    ".navbar__menu__humberger"
);
let sidebar__overlay = document.querySelector("#sidebar__overlay");
let sidebar__content = document.querySelector("#sidebar__content");

navbar__menu__humberger.addEventListener("click", function () {
    if (navbar__menu__humberger.classList.contains("open")) {
        navbar__menu__humberger.classList.remove("open");
        sidebar__content.classList.remove("sedebar__open");
        sidebar__overlay.classList.remove("sidebar__overlay__open");
    } else {
        navbar__menu__humberger.classList.add("open");
        sidebar__content.classList.add("sedebar__open");
        sidebar__overlay.classList.add("sidebar__overlay__open");
    }
});

sidebar__overlay.addEventListener("click", () => {
    navbar__menu__humberger.classList.remove("open");
    sidebar__content.classList.remove("sedebar__open");
    sidebar__overlay.classList.remove("sidebar__overlay__open");
});
