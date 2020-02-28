$( document ).ready(function() {


//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})





    
    var form = $(`form.uploadPost`);

    form.on( "submit", function( event ) {
        event.preventDefault();

        var form = $(`form.uploadPost`)[0];

		// Create an FormData object 
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "/api_v1/post",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {

                data = JSON.parse(data);

                console.log("SUCCESS : ", data);



                data = data.trim();

                console.log(data)

                $('#myModal').find('.buttonsCon').append(`<a id="postMake" class="postmake" href="/post?id=${data}">go to post</a>`)

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });

    });

    

    $('#fileToUpload').on('change', (evt) => {
        console.log("event")

        $.extend(new FileReader(), {
            onload: function(e) {
                $("#img").attr("src", URL.createObjectURL(new Blob([e.target.result]))).css("display", "block")
            }
        }).readAsArrayBuffer(evt.target.files[0])
    });


    $("[type=file]").change(function() {

        $.extend(new FileReader(), {
            onload: function(e) {
                img.attr("src", URL.createObjectURL(new Blob([e.target.result])))
            }
        }).readAsArrayBuffer(this.files[0])
    })
    
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("openModal");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
            var title = document.forms["uploadPost"]["title"].value;
            var desc = document.forms["uploadPost"]["description"].value;
            var img = document.forms["uploadPost"]["fileToUpload"].value;
            if (title == "" || desc == "" || img == "") {
                
            }
            else {
                modal.style.display = "block"
            }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});