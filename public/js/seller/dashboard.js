$(document).ready(function() {
    var table = $("#sellerTable").DataTable({
        lengthChange: false,
        pageLength: 5,
        responsive: true,
        buttons: ["copy", "excel", "pdf", "print"]
    });

    table
        .buttons()
        .container() 
        .appendTo(".table-buttons .col-md-6:eq(0)");

    let btnhtml5 = document.querySelectorAll(".buttons-html5");
    document.querySelectorAll(".buttons-print").remove("btn-secondary");
    for (i = 0; i < btnhtml5.length; i++) {
        btnhtml5[i].classList.add("btn-sm");
        btnhtml5[i].classList.remove("btn-secondary");
    }
});



function checkProductLength() {
    try {
        String.prototype.trimCardPname = function(length) {
            return this.length > length
                ? this.substring(0, length) + "..."
                : this;
        };

        var p_name, i;
        p_name = document.querySelectorAll(".p-name");

        for (i = 0; i < p_name.length; i++) {
            if (p_name[i].innerText.length > 6) {
                p_name[i].innerText = p_name[i].innerText.trimCardPname(11);
            }
        }
    } catch (err) {
        alert(err.message);
    }
}
checkProductLength();

function trash(id) {
    t__row = document.querySelector("#t__row" + id);

    Swal.fire({
        text: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.isConfirmed) {
            fetch("delete-product/" + id, {
                method: "GET"
            })
                .then(result => {
                    return result.json();
                })
                .then(res => {
                    console.log(res);
                    if (res.status === "ok") {
                        t__row.style.transition = "0.8s";
                        t__row.style.opacity = "0";
                        t__row.remove();

                        countProduct();

                        Swal.fire(
                            "Deleted!",
                            "Your product has been deleted.",
                            "success"
                        );
                    }
                });
        }
    });
}

// count products
async function countProduct() {
    const count__product = document.querySelector("#count__product");

    await fetch("count-product", {
        method: "GET"
    })
        .then(result => {
            return result.json();
        })
        .then(res => {
            count__product.innerHTML = res.count;
        });
}
document.addEventListener("DOMContentLoaded", function() {
    countProduct();
});
