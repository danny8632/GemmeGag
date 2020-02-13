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
                var totalvotes = post.UpVotes - post.DownVotes
                console.log(post)

                var timeSincePost = getHoursSince(post.created);
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
        
                        <div class="imgCon">
                            <img class="postImage" src="${post.file}">
                        </div>
        
                        <div class="descriptionCon">
                            <p class="description">${post.description}</p>
                        </div>
        
                        <div class="toolbarCon">
                            <div class="voteCon">
                                <div class="voteCon2">
                                    <div class="upvote votebtn" data-post_id="${post.id}" data-vote="Upvote">▲</div>
                                    <div class="totalVotes">${totalvotes}</div>
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
            }


            $('#posts').find('.votebtn').on('click', (e) => vote($(e.target).data()))
        

        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });

});