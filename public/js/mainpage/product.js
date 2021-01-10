function Quantity(value) {
    const quantity = document.querySelector('.quantity')
    const quantityError = document.querySelector('#quantity-error')

    if (value <= 0) {
        quantityError.innerHTML = "minimum quantity is 1"

        quantity.value = 1
    } else {
        quantityError.innerHTML = "";
    }
}

// change image on click
function proImg(src) {
    const indeximg = document.getElementById('index-image')

    indeximg.src = src
}
