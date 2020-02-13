$( document ).ready(function() {



    //var jsonObj;
    //var response = JSON.parse(jsonObj)

    function getHoursSince(date)
    {
        var newDate = new Date();
        var timestamp = new Date.parse(date);

        var currentTime = newDate.getTime();
        var newTime = timestamp.getTime();

        var diffInMilli = currentTime - newTime;
        var hoursSince = diffInMilli / 60 / 60 / 60;


        var roundedDown = Math.floor(hoursSince);

        return roundedDown;
    }



    $.ajax({
        type: "GET",
        url: "/api_v1/post",
        timeout: 600000,
        success: function (data) {

            var response = JSON.parse(data)
            
            console.log(response)

            for (var i = 0; i < response.length; ++i) {
                var post = response[i];

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
                `
                $("#posts").append(html);
            }
        

        },
        error: function (e) {

            console.log("ERROR : ", e);

        }
    });

});