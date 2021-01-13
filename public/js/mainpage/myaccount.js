// add shipping address
const shippingCard = document.querySelector("#shippingcard");
const addshippingaddress = document.querySelector("#addshippingaddress");

function addshippingform() {
    shippingCard.classList.remove('d-none')
    addshippingaddress.classList.add("d-none");
}

// check if number
function isNumber(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
