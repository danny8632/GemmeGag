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
         url: "/api_v1/comment",
         timeout: 600000,
         success: function (data) {
            console.log(data)
            var response = JSON.parse(data)
            console.log(response)

            response.forEach(comment => {
               var timeSincePost = getTimeSince(comment.created);
               comment_html = `
                   <div class="comment">
                       <div class="commentHead">
                           <a class="commentHeadText" href="#">${comment.username}</a>
                           <div class="commentTimePosted">${timeSincePost}</div>
                       </div>
                       <div class="commentBody">
                           <p class="commentText">${comment.text}</p>
                       </div>
                       <div class="commentFoot">
                           <div class="commentVotes">
                               <div class="upvote votebtn ${(comment.your_vote != null && comment.your_vote == "Upvote") ? "upduttet" : ''}" data-comment_id="${comment.id}" data-vote="Upvote">▲</div>
                               <div class="commentTotalVotes">${comment.TotalVotes == null ? '0' : comment.TotalVotes}</div>
                               <div class="downvote votebtn ${(comment.your_vote != null && comment.your_vote == "Downvote") ? "downduttet" : ''}" data-comment_id="${comment.id}" data-vote="Downvote">▼</div>
                           </div>
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
         url: "/api_v1/post",
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