$(function() {

    //inserts text to an element at cursor position
    function insertTextAtCursor(el, text) {
        var cursorPos = el.prop('selectionStart');
        var v = el.val();
        var textBefore = v.substring(0, cursorPos);
        var textAfter = v.substring(cursorPos, v.length);
        el.val( textBefore + text + textAfter);
    }

    //function to scroll to an element
    function scrollToElement(el) {
    	$('html, body').animate({
            scrollTop: el.offset().top
        }, 600);
    }

    //formatting buttons click handler
    $(document).on('click', 'form div.formatting-buttons ul > li.formatting-button', function() {
    	var action = this.getAttribute('data-action');
    	var textarea = $('textarea.with-formatting-buttons');
    	var tag, prompt_action;
    	switch (action) {
          case "bold":
          	  tag = 'b';
          	  prompt_action = 'text you want to bold';
              break;
          case "italic":
          	  tag = 'i';
          	  prompt_action = 'text you want to italicize';
              break;
          case 'image':
          	  tag = 'img';
              prompt_action = 'source of the image file you want to embed';
              break;
          case 'youtube':
              tag = 'youtube';
          	  prompt_action = 'unique video ID (i.e. "fI_xuFA18m4") of the YouTube video you want to embed';
              break;
          case 'quote':
              tag = 'quote';
          	  prompt_action = 'text you want to quote';
              break;
        }
        bootbox.prompt('Enter the ' + prompt_action + ':', function(result) {
            if (!result) {
          	    return; //user pressed the cancel button
            } else {
                insertTextAtCursor(textarea, '[' + tag + ']' + result + '[/' + tag + ']');
            }
        });
    });

      //are you sure? click handler
      $(document).on('click', '.needs-confirmation', function(e) {
      	  e.preventDefault();
          var currentAction = this.href; //have to do this weird hack because bootbox.js is async
    	    bootbox.confirm('Are you sure you want to do this?', function(result) {
    		      if (result) {
    			        window.location = currentAction; //have to do this weird hack because bootbox.js is async
    		      }
    	    });
      });

      //logout confirmation
      $(document).on('click', '.log-out-button', function(e) {
          e.preventDefault();
      	  var currentAction = this.href; //have to do this weird hack because bootbox.js is async
      		bootbox.confirm('Are you sure you want to log out? You won\'t be able to post anything, won\'t see notifications when there is new content and won\'t be able to vote on threads. You\'ll also have to remember your email/password to log back in. For best results, we don\'t recommend ever logging out. If you really want to log out, just click "OK" to continue.', function(result) {
      			  if (result) {
      			      window.location = currentAction; //have to do this weird hack because bootbox.js is async
      			  }
      		});
      });

      //click handler to quote threads
      $(document).on('click', '.quote-this-thread', function() {
    	var textarea = $('textarea.with-formatting-buttons');
    	$.ajax({
    			type: 'GET',
    			url: '/quote/thread/' + this.getAttribute('data-thread-id'),
    			success: function(resp) {
    			    insertTextAtCursor(textarea, resp.quote);
      			  scrollToElement(textarea);
    			}
    	});
      });

      //click handler to edit threads
      $(document).on('click', '.edit-this-thread', function() {
    	var thread_id = this.getAttribute('data-thread-id');
      	var thread = $('#thread-' + thread_id);
    	//replace with editing dialogue
    	$.ajax({
    			type: 'GET',
    			url: '/edit/thread/' + thread_id,
    			success: function(resp) {
    			    thread.replaceWith(resp);
    			}
    	});
      });

      //click handler to stop editing a thread
      $(document).on('click', 'span.dont-edit-this-thread', function() {
          location.reload();
      });

      //click handler to quote comments
      $(document).on('click', '.quote-this-comment', function() {
    	var textarea = $('textarea.with-formatting-buttons');
    	$.ajax({
    			type: 'GET',
    			url: '/quote/comment/' + this.getAttribute('data-comment-id'),
    			success: function(resp) {
    			    insertTextAtCursor(textarea, resp.quote);
      			  scrollToElement(textarea);
    			}
    	});
      });

      //click handler to edit comments
      $(document).on('click', '.edit-this-comment', function() {
    	var comment_id = this.getAttribute('data-comment-id');
      	var comment = $('#comment-' + comment_id);
    	//replace with editing dialogue
    	$.ajax({
    			type: 'GET',
    			url: '/edit/comment/' + comment_id,
    			success: function(resp) {
    			    comment.children().hide();
    				  comment.append(resp);
    			}
    	});
      });

      //click handler to stop editing a comment
      $(document).on('click', 'span.dont-edit-this-comment', function() {
    	var comment_id = this.getAttribute('data-comment-id');
          var comment = $('#comment-' + comment_id);
    	//remove editing dialogue and bring everything back to normal
    	comment.children('#edit-comment-form').remove();
    	comment.children().show();
      });

});
