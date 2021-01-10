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
});

function trash(id){
    t__row = document.querySelector('#t__row'+id)


    Swal.fire({
        text: "Are you sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-product/"+id, {
                method: "GET",
            })
            .then(result => {
                return result.json()
            }).then(res =>{
                console.log(res)
                if(res.status === "ok"){
                    t__row.style.transition = '0.8s';
                    t__row.style.opacity = '0';
                    t__row.remove();

                    countProduct()

                    Swal.fire(
                    'Deleted!',
                    'Your product has been deleted.',
                    'success'
                    )
                }
            })
        }
    })
}

// count products
async function countProduct(){
    const count__product = document.querySelector('#count__product')

    await fetch("count-product", {
        method: "GET",
    })
    .then(result => {
        return result.json()
    }).then(res =>{
        count__product.innerHTML = res.count
    })
}
document.addEventListener("DOMContentLoaded", function() {
    countProduct()
});

