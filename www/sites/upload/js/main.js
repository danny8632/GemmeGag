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
                console.log("SUCCESS : ", data);

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
    

});