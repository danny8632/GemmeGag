$( document ).ready(function() {
    
    var form = $(".content").find(`form.signupForm`);

    form.on( "submit", function( event ) {
        event.preventDefault();
        var data = $( this ).serializeArray();

        if(data[2]['value'] != data[3]['value']) return alert("password dosn't match");

        var data = {
            "method": "signUp",
            "name": data[0]['value'], 
            "username": data[1]['value'], 
            "password": data[2]['value'] 
        }


        $.ajax({
            type: "POST",
            url: "/api_v1/user",
            data: data,
            success: (resp) => {
                console.log(resp);

                var resp = JSON.parse(resp);

                if(resp['success'] == false)
                {
                    alert("Signup failed " + resp['msg'])
                }
                else
                {
                    window.location.replace("./");
                }
            },
            error: () => {
                alert("signup failed")
            }
        });
    });

});