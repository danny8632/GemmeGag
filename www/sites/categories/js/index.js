$(document).ready(function () {

    class Category {

        category = '';

        constructor() {

            if (typeof global_var !== 'undefined' && typeof global_var.extra_var !== 'undefined') {
                this.category = global_var.extra_var.categori;
            }

        }

        getCategories() {

            $.ajax({
                type: "GET",
                url: "/api_v1/categories",
                timeout: 600000,
                success: function (data) {
        
                    var response = JSON.parse(data)
        
                    response.forEach(category => {
                        $("#categories").find('.categoriesList').append(
                            $('<li>', {
                                class: category.id,
                                html: [
                                    $('<a>', {
                                        class: "label",
                                        href: "/c/"+category.category,
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
        
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                }
            });
        }

        getPosts() {

        }

    }
    new Category();
});