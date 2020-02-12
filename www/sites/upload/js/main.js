$( document ).ready(function() {
    
    var form = $(`form.uploadPost`);

    form.on( "submit", function( event ) {
        event.preventDefault();
        //var data = $( this ).serialize();

        //console.log(data);

        var form = $(`form.uploadPost`)[0];

		// Create an FormData object 
        var data = new FormData(form);

		// If you want to add an extra field for the FormData


		// disabled the submit button
        //$("#btnSubmit").prop("disabled", true);

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

                //$("#result").text(data);
                console.log("SUCCESS : ", data);
                //$("#btnSubmit").prop("disabled", false);

            },
            error: function (e) {

                //$("#result").text(e.responseText);
                console.log("ERROR : ", e);
                //$("#btnSubmit").prop("disabled", false);

            }
        });



        /* var data = {
            "method": "login",
            "username": data[0]['value'], 
            "password": data[1]['value'] 
        } */

        /* $.ajax({
            type: "POST",
            url: "/api_v1/user",
            data: data,
            success: (resp) => {
                var resp = JSON.parse(resp);

                if(resp['success'] == false)
                {
                    alert("Login failed")
                }
                else
                {
                    window.location.replace("./");
                }
            },
            error: () => {
                alert("Login failed")
            }
        }); */
    });

});