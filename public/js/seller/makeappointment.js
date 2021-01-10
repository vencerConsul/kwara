$(document).ready(function () {

    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    };

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();

    var maxDay = today.addDays(2);
    var max_dd = String(maxDay.getDate()).padStart(2, "0");
    var max_mm = String(maxDay.getMonth() + 1).padStart(2, "0");
    var max_yyyy = maxDay.getFullYear();


    today = mm + "/" + dd + "/" + yyyy;
    maxDay = max_mm + "/" + max_dd + "/" + max_yyyy;

    $("#date-input").attr("value", today);

    $("#date-input").on("click", function() {
        $(this).attr("data-dd-min-date", today);
        $(this).attr("data-dd-max-date", maxDay);
        $(this).attr("data-dd-min-year", yyyy);
    });
    $("#date-input").dateDropper({
        large: true,
        theme: "datedropdown",
        minDate: today,
        maxDate: maxDay,
        minYear: yyyy,
        maxYear: yyyy,
        modal: true
    });

    $("#alarm").timeDropper({
        backgroundColor: "#333333",
        textColor: "#ffffff",
        borderColor: "#797979",
        primaryColor: "#000000",
        init_animation: "dropdown",
        meridians: true,
        mousewheel: true
    });
});
