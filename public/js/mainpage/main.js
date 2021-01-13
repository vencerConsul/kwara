String.prototype.trimCardPname = function(length) {
    return this.length > length ? this.substring(0, length) + "..." : this;
};

var p_name, i;
p_name = document.querySelectorAll(".p-name");
for (i = 0; i < p_name.length; i++) {
    if (p_name[i].innerText.length > 6) {
        p_name[i].innerText = p_name[i].innerText.trimCardPname(11);
    }
}

// show all products
async function showAllProducts() {
    let products = document.querySelector(".products");
    await fetch("all-products", {
        method: "GET"
    })
        .then(response => response.text())
        .then(result => {
            products.innerHTML = result;
        });
}
document.addEventListener("DOMContentLoaded", function() {
    showAllProducts();
});

setInterval(showAllProducts, 3000);
