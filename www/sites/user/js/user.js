$(document).ready(function () {

   function run() {
      bindEventHandlers();

      getUserData(() => {

         bindEventHandlers();

      });
   }

   function bindEventHandlers() {
      $('.content').find('.postsButtonCon').on('click', (e) => {
         $('#userContent').empty();
         getPosts();
      })

      $('.content').find('.commentButtonCon').on('click', (e) => {
         $('#userContent').empty();
         getComments();
      })

      $('.content').find('.upvotedButtonCon').on('click', (e) => {
         $('#userContent').empty();
         getVotes();
      })
   }

   function getUserData() {
      var data = {
         "method": "getUserInfo"
      };

      $.ajax({
         type: "GET",
         url: "/api_v1/user?user_id=" + global_var.extra_var.id,
         data: data,
         timeout: 600000,
         success: function (data) {
            console.log(data);
            var response = JSON.parse(data);
            console.log(response);

            $(".content").find('.userCreated').text(getTimeSince(response[0].created));
            $(".content").find('.username').text(response[0].username);
         },
         error: function (e) {

            console.log("ERROR : ", e);

         }
      });
   }


   function getComments() {
      $.ajax({
         type: "GET",
         url: "/api_v1/comment?user_id=" + global_var.extra_var.id,
         timeout: 600000,
         success: function (data) {
            console.log(data)

            var response = JSON.parse(data)

            response.forEach(result => {
               console.log(result.postID);
               var timeSincePost = getTimeSince(result.created);
               html = `
                   <div class="postCon">
                     <div class="titleCon">
                     <div class="titleTextCon">
                        <a class="titleText" href="/post?id=${result.postID}"> ${result.post_title} </p>
                     </div>

                      <div class="opCon">
                        <p class="opText">Posted: ${timeSincePost}</a></p>
                      </div>
                   </div>
                       <div class="commentBody">
                           <p class="commentText">${result.text}</p>
                       </div>
                   </div>`
               $(".content").find('#userContent').append(html);
            });


         },
         error: function (e) {

            console.log("ERROR : ", e);

         }
      });
   }

   function getVotes() {

   }

   function getPosts() {
      $.ajax({
         type: "GET",
         url: "/api_v1/post?user_id=" + global_var.extra_var.id,
         timeout: 600000,
         success: function (data) {
            console.log(data)
            var response = JSON.parse(data)

            console.log(response)

            response.forEach(result => {
               var timeSincePost = getTimeSince(result.created);

               var html = `
                      <div class="postCon">
                          <div class="titleCon">
                              <div class="titleTextCon">
                                  <a class="titleText" href="/post?id=${result.id}">${result.title}</p>
                              </div>
          
                              <div class="opCon">
                                  <p class="opText">Posted: ${timeSincePost}</a></p>
                              </div>
                          </div>
   
                          <div class="voteCon">
                              <div class="voteCon2">
                                 <div class="upvote votebtn ${(result.your_vote != null && result.your_vote == "Upvote") ? "upduttet" : ''}"></div>
                                 <div class="totalVotes">${result.TotalVotes == null ? '0' : result.TotalVotes}</div>
                                 <div class="downvote votebtn ${(result.your_vote != null && result.your_vote == "Downvote") ? "downduttet" : ''}"></div>
                              </div>
                          </div>
                      </div>
                  `
               $(".content").find('#userContent').append(html);
            });

         },
         error: function (e) {

            console.log("ERROR : ", e);

         }
      });
   }

   run();

});