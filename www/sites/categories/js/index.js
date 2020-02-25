$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "/api_v1/categories",
        timeout: 600000,
        success: function (data) {

            var response = JSON.parse(data)


/* (2) […]
​
0: Object { id: "1", category: "Funny", description: "Dette er rigtig sjovt", … }
​
1: Object { id: "2", category: "Dankmark", description: "Fuck svensken", … }
​
 */




            response.forEach(category => {
                $("#categories").find('.personalSettings').append(
                    $('<li>', {
                        class: category.id,
                        html: [
                            $('<a>', {
                                class: "label",
                                href: "/categories?id="+category.id,
                                html: [
                                    $('<i>', {
                                        class: "thumbnail",
                                        html : $('<picture>', {
                                            html: $('<img>', {
                                                src: "../../sites/upload/images/index.jpeg"
                                            })
                                        })
                                    }),
                                    category.category
                                ] 
                            })
                        ]
                    })
                )
            });

            //console.log(response)

        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });

});