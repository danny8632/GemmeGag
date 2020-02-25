function myFunction() {
    var x = document.getElementById("navbar");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

$(document).ready(function () {
    

    $("#navbar").find('.dropbtn').on('click', (e) => {

        console.log($(e.target)[0])

        $(e.target).parents('.dropdown').children('.dropdown-content').toggleClass("shownen");
    })


});