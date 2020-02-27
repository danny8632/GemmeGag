$(document).ready(function () {

   bindEventHandlers();

   function bindEventHandlers() {
      $('.content').find('.postsButtonCon').on('click', (e) => {
         $('#posted').toggleClass('hidden');
         getPosts();
      })

      $('.content').find('.commentButtonCon').on('click', (e) => {
         $('#commented').toggle();
         getComments();
      })

      $('.content').find('.upvotedButtonCon').on('click', (e) => {
         $('#voted').toggle();
         getVotes();
      })
   }

   function getComments() {
      $.ajax({
         type: "GET",
         url: "/api_v1/comment?user_id=" + global_var.extra_var.id,
         timeout: 600000,
         success: function (data) {
            console.log(data)
            var response = JSON.parse(data)
            console.log(response)

            response.forEach(result => {
               var timeSincePost = getTimeSince(result.created);
               html = `
                   <div class="postCon">
                     <div class="titleCon">
                     <div class="titleTextCon">
                        <a class="titleText" href="/post?id=${result.postID}"> ${result.title} </p>
                     </div>

                      <div class="opCon">
                        <p class="opText">Posted: ${timeSincePost}</a></p>
                      </div>
                   </div>
                       <div class="commentHead">
                           <a class="commentHeadText" href="#">${result.username}</a>
                           <div class="commentTimePosted">${timeSincePost}</div>
                       </div>
                       <div class="commentBody">
                           <p class="commentText">${result.text}</p>
                       </div>
                   </div>`
               $(".content").find('#commented').append(html);
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

            for (var i = 0; i < response.length; ++i) {
               var post = response[i];
               var timeSincePost = getTimeSince(post.created);

               var fileHtml = getPostType(post.file);
               var html = `
                      <div class="postCon">
                          <div class="titleCon">
                              <div class="titleTextCon">
                                  <a class="titleText" href="/post?id=${post.id}">${post.title}</p>
                              </div>
          
                              <div class="opCon">
                                  <p class="opText">Posted: ${timeSincePost}</a></p>
                              </div>
                          </div>
   
                          <div class="voteCon">
                              <div class="voteCon2">
                                 <div class="upvote votebtn ${(post.your_vote != null && post.your_vote == "Upvote") ? "upduttet" : ''}"></div>
                                 <div class="totalVotes">${post.TotalVotes == null ? '0' : post.TotalVotes}</div>
                                 <div class="downvote votebtn ${(post.your_vote != null && post.your_vote == "Downvote") ? "downduttet" : ''}" data-post_id="${post.id}"></div>
                              </div>
                          </div>
                      </div>
                  `
               $(".content").find('#posted').append(html);
            }


         },
         error: function (e) {

            console.log("ERROR : ", e);

         }
      });
   }

});