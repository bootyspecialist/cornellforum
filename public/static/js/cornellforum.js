$(function() {

	//inserts text to an element at cursor position
	function insertTextAtCursor(el, text) {
	    var val = el.value, endIndex, range, doc = el.ownerDocument;
	    if (typeof el.selectionStart == "number"
	            && typeof el.selectionEnd == "number") {
	        endIndex = el.selectionEnd;
	        el.value = val.slice(0, endIndex) + text + val.slice(endIndex);
	        el.selectionStart = el.selectionEnd = endIndex + text.length;
	    } else if (doc.selection != "undefined" && doc.selection.createRange) {
	        el.focus();
	        range = doc.selection.createRange();
	        range.collapse(false);
	        range.text = text;
	        range.select();
	    }
	}

	//finds y value of given element
	function findPos(elem) {
	    var curtop = 0;
	    if (elem.offsetParent) {
	        do {
	            curtop += elem.offsetTop;
	        } while (elem = elem.offsetParent);
	    return [curtop];
	    }
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
		return window.confirm('Are you sure you want to do this?');
    });

    //click handler to quote threads
    $(document).on('click', '.quote-this-thread', function() {
		var textarea = $('textarea.with-formatting-buttons');
		$.ajax({
  			type: 'GET',
  			url: '/quote/thread/' + this.getAttribute('data-thread-id'),
  			success: function(resp) {
  				insertTextAtCursor(textarea, resp.quote);
    			window.scroll(0, findPos(textarea));
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
    			window.scroll(0, findPos(textarea));
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

});
