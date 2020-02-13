$( document ).ready(function() {
    data = {
        "post_id": 6 
    };
    
    $.ajax({
        type: "GET",
        url: "/api_v1/post",
        data: data,
        timeout: 600000,
        success: function (data) {

            var post = JSON.parse(data)[0]
            
            console.log(post)


            //var timeSincePost = getHoursSince(post.created);
            var html = `
                <div class="postCon">
                    <div class="titleCon">
                        <div class="titleTextCon">
                            <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                        </div>
    
                        <div class="opCon">
                            <p class="opText">Posted by: <a href="/user?id=${post.userID}">${post.username}</a></p>
                            <p class="timePosted">${/*timeSincePost*/ post.created} hours ago</p>
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
                                <div class="upvote">▲</div>
                                <div class="totalVotes">${post.totalvotes}</div>
                                <div class="downvote">▼</div>
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
            `;


            $.ajax({
                type: "GET",
                url: "/api_v1/comment",
                data: {post_id: 6},
                timeout: 600000,
                success: function (data) {
                    var post = JSON.parse(data)
                    console.log(post)
                    for 
                    var html3 = `
                    <div class="commentsCon">

                    <!--Comment Structure-->
                    <div class="comment">
                        <div class="commentHead">
                            <a class="commentHeadText" href="#">Felix</a>
                            <div class="commentTimePosted">3h</div>
                        </div>
                        <div class="commentBody">
                            <p class="commentText">Det var et mega fedt post</p>
                        </div>
                        <div class="commentFoot">
                            <div class="commentVotes">
                                <div class="commentUpvote">▲</div>
                                <div class="commentTotalVotes">5k</div>
                                <div class="commentDownvote">▼</div>
                            </div>
                        </div>
                    </div>
        
                    <div class="comment">
                        <div class="commentHead">
                            <a class="commentHeadText" href="#">Felix</a>
                            <div class="commentTimePosted">3h</div>
                        </div>
                        <div class="commentBody">
                            <p class="commentText">Det var et mega fedt post</p>
                        </div>
                        <div class="commentFoot">
                            <div class="commentVotes">
                                <div class="commentUpvote">▲</div>
                                <div class="commentTotalVotes">5k</div>
                                <div class="commentDownvote">▼</div>
                            </div>
                        </div>
                    </div>
                </div> `
                },
                error: function (e) {

                    console.log("ERROR : ", e);
        
                }
            });
                $(".wrapper").append(html);
        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });
});