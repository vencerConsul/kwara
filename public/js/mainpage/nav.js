// cart
let shoppingCart = document.querySelector('.shopping-cart')
function cart() {
    if (shoppingCart.classList.contains("open__cart")) {
        shoppingCart.classList.remove("open__cart");
        document.querySelector(".container__cart").style.zIndex = 0;
    } else {
        shoppingCart.classList.add("open__cart");
        document.querySelector(".container__cart").style.zIndex = 1020;
        document.querySelector(".container__cart").style.background =
            "#00000069";
        document.querySelector(".container__cart").style.height =
            "100vh";
        document.querySelector(".container__cart").style.width = "100%";
    }
}
function containerCart(container_cart) {
    shoppingCart.classList.remove("open__cart");
    container_cart.style.zIndex = -1;
    container_cart.style.background = 'none';
}

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
