// convert to Uppercase every first letter typed in
function chkCase(elem) {
    var temp = elem.value;
    elem.value = temp.toLowerCase();
}

// check paymeent
function showPaymentInfo(payment) {
    if (payment == "paypal") {
        Swal.fire({
            text: "You will redirect to paypay for security transaction",
            icon: "warning"
        });
    } else {
        Swal.fire({
            title: "Read First",
            text: "After filling in the form, your account will be save within TWO days. To approve your account, schedule an appointment to meet our admins and pay the registration fee",
            icon: "warning"
        });
    }
}
