$( document ).ready(function() {

    $.ajax({
        type: "GET",
        url: "/api_v1/post",
        timeout: 600000,
        success: function (data) {

            var response = JSON.parse(data)
            
            console.log(response)

            for (var i = 0; i < response.length; ++i) {
                var post = response[i];
                var timeSincePost = getHoursSince(post.created);

                var fileHtml = getPostType(post.file);
                var imgConId = `postMedia${i+1}`

                var html = `
                    <div class="postCon">
                        <div class="titleCon">
                            <div class="titleTextCon">
                                <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                            </div>
        
                            <div class="opCon">
                                <p class="opText">Posted by: <a href="/user?id=${post.userID}">${post.username}</a></p>
                                <p class="timePosted">${timeSincePost} hour(s) ago</p>
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
            
            $('#posts').find('.votebtn').on('click', (e) => vote($(e.target).data()))

        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });

});