$( document ).ready(function() {
    
    var form = $(".content").find(`form.loginForm`);

    form.on( "submit", function( event ) {
        event.preventDefault();
        var data = $( this ).serializeArray();

        var data = {
            "method": "login",
            "username": data[0]['value'], 
            "password": data[1]['value'] 
        }

        $.ajax({
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
        });
    });

});