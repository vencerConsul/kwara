function selected(method) {
    let cod = document.querySelector("#cashOnDelivery");

    if (method == "cod") {
        cod.innerHTML =
            '<div class="col-lg-12"><div class="card text-left mt-3"><div class="card-body"><h4 class="card-title">SPA (<small>Selfie Pay Authentication</small>)</h4><p class="card-text">We use SPA to confirm and verify the identity of the buyer and to get rid of returning the product to the seller due to delivery failure and to faught fraud and protect the seller and buyers account.</p><div class="card-content mt-3"><input type="file" access="image/" name="photo" id="photo" style="display:none;" onchange="loadPhoto(event)"><button type="button" class="btn ml-0 btn-sm mb-3" onclick="takeSelfie()">Take a selfie</button><input type="file" style="display:none;" name="identity" id="identity" onchange="loadID(event)"><button type="button" class="btn ml-0 btn-sm mb-3" onclick="validId()">Add Valid ID</button></div></div></div></div><div class="col-lg-6 col-6 pr-1 selfie" style="display:none;"><div class="card mt-3"><div class="card-header">Selfie</div><div class="card-body"><img id="selfie" alt="" class="img-fluid"></div></div></div><div class="col-lg-6 col-6 pl-1 identitication" style="display:none;"><div class="card mt-3"><div class="card-header">Valid ID/student ID</div><div class="card-body"><img id="validIs" alt="" class="img-fluid"></div></div></div>';
    } else {
        cod.innerHTML = "";
    }
}

function takeSelfie() {
    document.getElementById("photo").click();
}
function validId() {
    document.getElementById("identity").click();
}

var loadPhoto = function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var prev = document.getElementById("selfie");
        prev.src = reader.result;
        document.querySelector('.selfie').style.display = "block"
    };
    reader.readAsDataURL(event.target.files[0]);
};

var loadID = function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var prev = document.getElementById("validIs");
        prev.src = reader.result;
        document.querySelector(".identitication").style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
};
