String.prototype.trimCardPname = function (length) {
    return this.length > length ? this.substring(0, length) + "..." : this;
}

var p_name, i;
p_name = document.querySelectorAll('.p-name')
for (i = 0; i < p_name.length; i++) {
    if (p_name[i].innerText.length > 6) {
        p_name[i].innerText = p_name[i].innerText.trimCardPname(11)
    }
}
