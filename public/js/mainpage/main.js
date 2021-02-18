// show all products
async function showAllProducts() {
    let products = document.querySelector(".products");
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    await fetch("all-products", {
        method: "post",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
    })
        .then(response => response.text())
        .then(result => {
            products.innerHTML = result;
            checkProductLength();
            observee();
        });
}
document.addEventListener("DOMContentLoaded", function() {
    showAllProducts();
});

// setInterval(showAllProducts, 8000);

$(document).ready(function() {
    let count = 0;
    let counter = setInterval(function() {
        if (count < 101) {
            $(".count").text(count + "%");
            $(".loader").css("width", count + "%");
            count++;
        } else {
            clearInterval(counter);
        }
    });
});
