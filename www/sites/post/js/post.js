$( document ).ready(function() {

    var post_id = $('.wrapper').data('post-id')

    data = {
        "post_id": post_id
    };
    
    $.ajax({
        type: "GET",
        url: "/api_v1/post",
        data: data,
        timeout: 600000,
        success: function (post_data) {

            var post = JSON.parse(post_data)[0]

            console.log(post)

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
                            <a class="commentButton">Comments</a>
                        </div>
    
                        <div class="shareButtonCon">
                            <a class="shareButton" onclick="">Share</a>
                        </div>
                    </div>
                </div>
            `;


            $.ajax({
                type: "GET",
                url: "/api_v1/comment",
                data: data,
                timeout: 600000,
                success: function (data) {
                    var comments = JSON.parse(data)

                    var comment_html = `<div id="comments" class="commentsCon">
                        <div class="newCommentCon">
                            <form class="newCommentForm">
                                <div class="newCommentHead">
                                    <p class="newCommentHeadText">Post a comment:</p>
                                </div>
                                <div class="newCommentTextCon">
                                    <textarea class="newCommentText" name="commentText" type="text" placeholder="Comment..."></textarea>
                                </div>
                                <div class="newCommentButton">
                                    <input type="submit" value="Post Comment">
                                </div>
                            </form>
                        </div>
                        `;
                    
                    
                    comments.forEach(comment => {
                        comment_html += `
                            <div class="comment">
                                <div class="commentHead">
                                    <a class="commentHeadText" href="#">${comment.username}</a>
                                    <div class="commentTimePosted">${comment.created}</div>
                                </div>
                                <div class="commentBody">
                                    <p class="commentText">${comment.text}</p>
                                </div>
                                <div class="commentFoot">
                                    <div class="commentVotes">
                                        <div class="commentUpvote">▲</div>
                                        <div class="commentTotalVotes">${comment.UpVotes - comment.DownVotes}</div>
                                        <div class="commentDownvote">▼</div>
                                    </div>
                                </div>
                            </div>`
                    });
                    


                    comment_html += `</div>`

                    html += comment_html

                    $(".wrapper").append(html);



                    $('.commentButtonCon').find('.commentButton').on('click', (e) => {
                        $('#comments').toggle();
                    })
                },
                error: function (e) {

                    console.log("ERROR : ", e);
        
                }
            });
                
            
        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });
});