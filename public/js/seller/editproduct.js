$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            if ($(this)[0].files.length > 4) {
                Swal.fire({
                    icon: "warning",
                    text: "You can only upload 6 images"
                });
            } else {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = function(e) {
                        var file = e.target;
                        $(
                            '<span class="container__multiple">' +
                                '<img class="imageThumb" src="' +
                                e.target.result +
                                '" title="' +
                                file.name +
                                '"/>' +
                                '<br/><span class="remove"><i class="fa fa-times"></i></span>' +
                                "</span>"
                        ).insertAfter("#files");
                        $(".remove").click(function() {
                            alert("awdawd");
                            $(this)
                                .parent(".container__multiple")
                                .remove();
                        });
                    };
                    fileReader.readAsDataURL(f);
                }
            }
        });
    } else {
        alert("Your browser doesn't support to File API");
    }

    // select product type
    $("#select__product__type").select2();
});

// delete input and image view
function del(del) {
    const inputVal = $(".img" + del.id);
    const parentSpan = document.querySelector(".container__multiple")

    inputVal.remove();
    $(del).parent(parentSpan).remove()
}

//change product type to

function changeProductType(type) {
    const attribute = document.querySelector("#attribute");

    if (type.value == "Clothes" || type.value == "Foot wears") {
        attribute.innerHTML =
            '<div class="d-flex"><div class="col-lg-3"><div class="form-group mt-3"><div class="md-form md-outline input-with-post-icon"><i class="fas fa-arrows-alt-h input-prefix"></i> <input type="text" name="product__size[]" id="product__size" class="form-control" ><label for="product__size">Add Size</label></div></div></div><div class="col-lg-3"><div class="form-group mt-3"><div class="md-form md-outline input-with-post-icon"><i class="fas fa-palette input-prefix"></i><input type="text" name="product__color[]" id="product__color" class="form-control" ><label for="product__color">Add Color</label></div></div></div><div class="form-group"><a href="javascript:void(0);" class="form-control bg-dark mt-3" onclick="addMore()"><i class="fa fa-plus"></i></a></div></div>';
    } else {
        attribute.innerHTML = "";
    }
}

function addMore() {
    const attribute = document.querySelector("#attribute");
    let child = document.createElement("DIV");
    child.classList.add("childAttr");
    let x = 1;
    let maxAttr = 10;

    if (x < maxAttr) {
        x++;
        child.innerHTML +=
            '<div class="d-flex"><div class="col-lg-3"><div class="form-group mt-3"><div class="md-form md-outline input-with-post-icon"><i class="fas fa-arrows-alt-h input-prefix"></i> <input type="text" name="product__size[]" id="product__size" class="form-control" ><label for="product__size">Add Size</label></div></div></div><div class="col-lg-3"><div class="form-group mt-3"><div class="md-form md-outline input-with-post-icon"><i class="fas fa-palette input-prefix"></i><input type="text" name="product__color[]" id="product__color" class="form-control" ><label for="product__color">Add Color</label></div></div></div><div class="form-group"><a href="javascript:void(0);" class="form-control bg-danger mt-3" onclick="removeAttr(this)"><i class="fa fa-trash"></i></a></div></div>';

        attribute.appendChild(child);
    }
}

//remove child attributes
function removeAttr(e) {

    e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
}

//check if product stock and discount and price is number
function isNumber(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
