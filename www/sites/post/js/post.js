$( document ).ready(function() {

    var post_id = $('.wrapper').data('post-id')

    var html = "";

    var filePath;

    data = {
        "post_id": post_id
    };

    function run() {
        getPost(() => {

            $(".wrapper").html('').append(html);

            $(".wrapper").find(".imgCon").append(getPostType(filePath))

            getComment(() => {

                bindEventHandlers();

            })

        })
    }

    function bindEventHandlers() {

        $('.commentButtonCon').find('.commentButton').on('click', (e) => {
            $('#comments').toggle();
        })

        $('#comments').find('.newCommentForm').on('submit', (e) => uploadComment(e));

        $('.wrapper').find('.votebtn').on('click', (e) => vote($(e.target).data()))

    }

    function getPost(callback) {
        
        $.ajax({
            type: "GET",
            url: "/api_v1/post",
            data: data,
            timeout: 600000,
            success: function (post_data) {
    
                var post = JSON.parse(post_data)[0]

                filePath = post.file;
    
                console.log(post)
                var timeSincePost = getHoursSince(post.created);
    
                html = `
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
                            
                        </div>
        
                        <div class="descriptionCon">
                            <p class="description">${post.description}</p>
                        </div>
        
                        <div class="toolbarCon">
                            <div class="voteCon">
                                <div class="voteCon2">
                                    <div class="upvote votebtn" data-post_id="${post.id}" data-vote="Upvote">▲</div>
                                    <div class="totalVotes">${post.totalvotes == null ? '0' : post.totalvotes}</div>
                                    <div class="downvote votebtn" data-post_id="${post.id}" data-vote="Downvote">▼</div>
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
                    <div id="comments" class="commentsCon">

                        <div class="newCommentCon">
                            <form method="POST" enctype="multipart/form-data" class="newCommentForm">
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

                    </div>
                `;
                
                callback();
                
            },
            error: function (e) {
    
                console.log("ERROR : ", e);
    
            }
        });
    }
    
    function getComment(callback) {
    
        $.ajax({
            type: "GET",
            url: "/api_v1/comment",
            data: data,
            timeout: 600000,
            success: function (data) {
                var comments = JSON.parse(data)

                var comment_html = '';
                
                comments.forEach(comment => {
                    var timeSincePost = getHoursSince(comment.created);
                    comment_html += `
                        <div class="comment">
                            <div class="commentHead">
                                <a class="commentHeadText" href="#">${comment.username}</a>
                                <div class="commentTimePosted">${timeSincePost}h</div>
                            </div>
                            <div class="commentBody">
                                <p class="commentText">${comment.text}</p>
                            </div>
                            <div class="commentFoot">
                                <div class="commentVotes">
                                    <div class="commentUpvote votebtn" data-comment_id="${comment.id}" data-vote="Upvote">▲</div>
                                    <div class="commentTotalVotes">${comment.TotalVotes == null ? '0' : comment.TotalVotes}</div>
                                    <div class="commentDownvote votebtn" data-comment_id="${comment.id}" data-vote="Downvote">▼</div>
                                </div>
                            </div>
                        </div>`
                });
                
                $("#comments").find('.comment').remove();

                $("#comments").append(comment_html)
                
                callback();


            },
            error: function (e) {

                console.log("ERROR : ", e);
    
            }
        });
    }

    function uploadComment(e) {

        e.preventDefault();
            
        var data = $('#comments').find('.newCommentForm').serializeArray()[0];

        if(data.value == "")
            return true;

        var data = {
            'post_id' : post_id,
            'text' : data.value
        }

        $.ajax({
            type: "POST",
            url: "/api_v1/comment",
            data: data,
            timeout: 600000,
            success: function (resp_data) {

                //console.log(resp_data)
                getComment(() => {
                    $('#comments').find('.newCommentForm').find('textarea.newCommentText').val('');
                });
            
            },
            error: function (e) {

                console.log("ERROR : ", e);
    
            }
        });
        
    }

    function getPostType(filePath)
    {
        var file_html = ``
        fileExtension = filePath.substr(filePath.lastIndexOf('.') + 1)

        switch (fileExtension)
        {
            case 'mp4':
                file_html = `
                <div class="imgCon">
                    <video class="postImage" controls>
                        <source src="${filePath}" type="video/mp4">
                    </video>
                </div>
                `
                break
            case 'mp3':

                file_html = `
                <div class="imgCon">
                    <video class="postImage" controls>
                        <source src="${filePath}" type="video/mp4">
                    </video>
                </div>
                `
                break
            default:
                file_html = `<img class="postImage" src="${filePath}">`
                break
        }
        
        return file_html
    }

    run();
});