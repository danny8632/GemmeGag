$(document).ready(function () {

    function bindEventHandlers() {
        $('.content').find('.newButtonCon').on('click', (e) => {
            $('.content').find('#posts').empty();
            getPosts();
            changeHeadlineTxt('New posts');
        });

        $('.content').find('.trendingButtonCon').on('click', (e) => {
            $('.content').find('#posts').empty();
            getTrending();
            changeHeadlineTxt('Trending posts');
        });

        $('.content').find('.topButtonCon').on('click', (e) => {
            $('.content').find('#posts').empty();
            getTop();
            changeHeadlineTxt('Top posts');
        });



        $('#posts').find('.votebtn').on('click', (e) => {

            vote($(e.target).data(), (req_data) => {

                $(e.target).parent().children(":not(.votebtn)").html(req_data[0].TotalVotes == null ? '0' : req_data[0].TotalVotes)

                $(e.target).removeClass('upduttet downduttet').siblings('.votebtn').removeClass('upduttet downduttet');

                if (req_data[0].your_vote == "Downvote") {
                    $(e.target).parent().children(".downvote").toggleClass("downduttet", true)
                }
                else if (req_data[0].your_vote == "Upvote") {
                    $(e.target).parent().children(".upvote").toggleClass("upduttet", true)
                }
            });
        });
    }

    function changeHeadlineTxt(text) {
        $('.content').find('.headlineTxt').text(`${text}`);
    }

    function getPosts() {
        $.ajax({
            type: "GET",
            url: "/api_v1/post",
            timeout: 600000,
            success: function (data) {

                var response = JSON.parse(data)

                console.log(response)

                for (var i = 0; i < response.length; ++i) {
                    var post = response[i];
                    var timeSincePost = getTimeSince(post.created);

                    var fileHtml = getPostType(post.file);
                    var imgConId = `postMedia${i + 1}`

                    var html = `
                        <div class="postCon">
                            <div class="titleCon">
                                <div class="titleTextCon">
                                    <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                                </div>
            
                                <div class="opCon">
                                    <p class="opText">Posted by: <a href="/user?id=${post.userID}">${post.username}</a></p>
                                    <p class="timePosted">${timeSincePost}</p>
                                </div>
                            </div>
            
                            <div class="imgCon" id="${imgConId}">
                                
                            </div>
            
                            <div class="descriptionCon">
                                <p class="description">${post.description}</p>
                            </div>
            
                            <div class="toolbarCon">
                                <div class="voteCon">   
                                    <div class="voteCon2">
                                    <div class="upvote votebtn ${(post.your_vote != null && post.your_vote == "Upvote") ? "upduttet" : ''}" data-post_id="${post.id}" data-vote="Upvote">▲</div>
                                    <div class="totalVotes">${post.TotalVotes == null ? '0' : post.TotalVotes}</div>
                                    <div class="downvote votebtn ${(post.your_vote != null && post.your_vote == "Downvote") ? "downduttet" : ''}" data-post_id="${post.id}" data-vote="Downvote">▼</div>
                                    </div>
                                </div>
            
                                <div class="commentButtonCon">
                                    <a class="commentButton" href="/post?id=${post.id}">Comments</a>
                                </div>
            
                                <div class="shareButtonCon">
                                    <a class="shareButton" href="/post?id=${post.id}">Share</a>
                                </div>
                            </div>
                        </div>
                    `

                    $("#posts").append(html);

                    $(".imgCon#" + imgConId).append(fileHtml);
                }

                //$('#posts').find('.votebtn').on('click', (e) => vote($(e.target).data()))

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });

    }

    function getTop() {
        data = {
            "method": "getTop"
        };

        $.ajax({
            type: "GET",
            url: "/api_v1/post",
            data: data,
            timeout: 600000,
            success: function (data) {
                console.log(data)
                var response = JSON.parse(data)

                console.log(response)

                for (var i = 0; i < response.length; ++i) {
                    var post = response[i];
                    var timeSincePost = getTimeSince(post.created);

                    var fileHtml = getPostType(post.file);
                    var imgConId = `postMedia${i + 1}`

                    var html = `
                         <div class="postCon">
                             <div class="titleCon">
                                 <div class="titleTextCon">
                                     <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                                 </div>
             
                                 <div class="opCon">
                                     <p class="opText">Posted by: <a href="/user?id=${post.userID}">${post.username}</a></p>
                                     <p class="timePosted">${timeSincePost}</p>
                                 </div>
                             </div>
             
                             <div class="imgCon" id="${imgConId}">
                                 
                             </div>
             
                             <div class="descriptionCon">
                                 <p class="description">${post.description}</p>
                             </div>
             
                             <div class="toolbarCon">
                                 <div class="voteCon">   
                                     <div class="voteCon2">
                                         <div class="upvote votebtn" data-post_id="${post.id}" data-vote="Upvote">▲</div>
                                         <div class="totalVotes">${post.TotalVotes == null ? '0' : post.TotalVotes}</div>
                                         <div class="downvote votebtn" data-post_id="${post.id}" data-vote="Downvote">▼</div>
                                     </div>
                                 </div>
             
                                 <div class="commentButtonCon">
                                     <a class="commentButton" href="/post?id=${post.id}">Comments</a>
                                 </div>
             
                                 <div class="shareButtonCon">
                                     <a class="shareButton" href="/post?id=${post.id}">Share</a>
                                 </div>
                             </div>
                         </div>
                     `

                    $("#posts").append(html);

                    $(".imgCon#" + imgConId).append(fileHtml);
                }

                //$('#posts').find('.votebtn').on('click', (e) => vote($(e.target).data()))

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });
    }

    function getTrending() {
        data = {
            "method": "getTrending"
        };

        $.ajax({
            type: "GET",
            url: "/api_v1/post",
            data: data,
            timeout: 600000,
            success: function (data) {
                console.log(data)
                var response = JSON.parse(data)

                console.log(response)

                for (var i = 0; i < response.length; ++i) {
                    var post = response[i];
                    var timeSincePost = getTimeSince(post.created);

                    var fileHtml = getPostType(post.file);
                    var imgConId = `postMedia${i + 1}`

                    var html = `
                        <div class="postCon">
                            <div class="titleCon">
                                <div class="titleTextCon">
                                    <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                                </div>
            
                                <div class="opCon">
                                    <p class="opText">Posted by: <a href="/user?id=${post.userID}">${post.username}</a></p>
                                    <p class="timePosted">${timeSincePost}</p>
                                </div>
                            </div>
            
                            <div class="imgCon" id="${imgConId}">
                                
                            </div>
            
                            <div class="descriptionCon">
                                <p class="description">${post.description}</p>
                            </div>
            
                            <div class="toolbarCon">
                                <div class="voteCon">   
                                    <div class="voteCon2">
                                        <div class="upvote votebtn" data-post_id="${post.id}" data-vote="Upvote">▲</div>
                                        <div class="totalVotes">${post.TotalVotes == null ? '0' : post.TotalVotes}</div>
                                        <div class="downvote votebtn" data-post_id="${post.id}" data-vote="Downvote">▼</div>
                                    </div>
                                </div>
            
                                <div class="commentButtonCon">
                                    <a class="commentButton" href="/post?id=${post.id}">Comments</a>
                                </div>
            
                                <div class="shareButtonCon">
                                    <a class="shareButton" href="/post?id=${post.id}">Share</a>
                                </div>
                            </div>
                        </div>
                    `

                    $("#posts").append(html);

                    $(".imgCon#" + imgConId).append(fileHtml);
                }

                //$('#posts').find('.votebtn').on('click', (e) => vote($(e.target).data()))

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });
    }

    bindEventHandlers();

});