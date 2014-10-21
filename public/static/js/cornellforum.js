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

        var text_to_insert = prompt('Enter the ' + prompt_action + ':');

        if (!text_to_insert) {
        	return; //user pressed the cancel button
        } else {
        	insertTextAtCursor(textarea, '[' + tag + ']' + text_to_insert + '[/' + tag + ']');
        }
	});

    //are you sure? click handler
    $(document).on('click', '.needs-confirmation', function() {
		bootbox.confirm('Are you sure you want to do this?', function(result) {
			return result;
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
