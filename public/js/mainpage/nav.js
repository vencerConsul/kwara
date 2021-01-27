// cart
let cartContainer = document.querySelector(".cart__container");
let cartOverlay = document.querySelector(".cart__overlay");
let close__cart = document.querySelector(".close__cart");

function cart() {
    cartContainer.classList.add("cart__open");
    cartOverlay.classList.add("cart__overlay__open");
}

cartOverlay.addEventListener("click", () => {
    cartContainer.classList.remove("cart__open");
    cartOverlay.classList.remove("cart__overlay__open");
});

close__cart.addEventListener("click", () => {
    cartContainer.classList.remove("cart__open");
    cartOverlay.classList.remove("cart__overlay__open");
});

let navbar__menu__humberger = document.querySelector(
    ".navbar__menu__humberger"
);
let sidebar__overlay = document.querySelector("#sidebar__overlay");
let sidebar__content = document.querySelector("#sidebar__content");

navbar__menu__humberger.addEventListener("click", function() {
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
