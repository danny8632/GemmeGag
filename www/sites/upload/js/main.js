$( document ).ready(function() {
    
    var form = $(`form.uploadPost`);

    form.on( "submit", function( event ) {
        event.preventDefault();

        var form = $(`form.uploadPost`)[0];

		// Create an FormData object 
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "/api_v1/post",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {

                data = JSON.parse(data);

                console.log("SUCCESS : ", data);



                data = data.trim();

                console.log(data)

                $('#myModal').find('.buttonsCon').append(`<a id="postMake" class="postmake" href="/post?id=${data}">go to post</a>`)

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });

    });

    

    $('#fileToUpload').on('change', (evt) => {
        console.log("event")

        $.extend(new FileReader(), {
            onload: function(e) {
                $("#img").attr("src", URL.createObjectURL(new Blob([e.target.result]))).css("display", "block")
            }
        }).readAsArrayBuffer(evt.target.files[0])
    });


    $("[type=file]").change(function() {

        $.extend(new FileReader(), {
            onload: function(e) {
                img.attr("src", URL.createObjectURL(new Blob([e.target.result])))
            }
        }).readAsArrayBuffer(this.files[0])
    })
    
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("openModal");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
            var title = document.forms["uploadPost"]["title"].value;
            var desc = document.forms["uploadPost"]["description"].value;
            var img = document.forms["uploadPost"]["fileToUpload"].value;
            if (title == "" || desc == "" || img == "") {
                
            }
            else {
                modal.style.display = "block"
            }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});