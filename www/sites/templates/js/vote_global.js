function vote(data)
{
    $.ajax({
        type: "POST",
        url: "/api_v1/vote",
        data: data,
        timeout: 600000,
        success: function (data) {
            console.log("SUCCESS : ", data);
        },
        error: function (e) {

            console.log("ERROR : ", e);
        }
    });
}