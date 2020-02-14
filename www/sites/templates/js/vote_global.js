function vote(data, cb)
{
    $.ajax({
        type: "POST",
        url: "/api_v1/vote",
        data: data,
        timeout: 600000,
        success: function (data) {
            //console.log("SUCCESS : ", data);
            var req_data = JSON.parse(data)

            cb(req_data);
        },
        error: function (e) {

            console.log("ERROR : ", e);
        }
    });
}