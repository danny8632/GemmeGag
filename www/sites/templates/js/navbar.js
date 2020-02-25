function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

$(document).ready(function () {
    

    $("#myTopnav").find('.dropbtn').on('click', (e) => {

        console.log($(e.target)[0])

        $(e.target).parents('.dropdown').children('.dropdown-content').toggleClass("shownen");
    })


});