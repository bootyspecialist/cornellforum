document.addEventListener('DOMContentLoaded', function() {

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
	for(var i = 0, formattingbuttons = document.querySelectorAll('form div.formatting-buttons ul > li.formatting-button'); i < formattingbuttons.length; i++){
    	formattingbuttons[i].addEventListener('click', function() {
    		var action = this.getAttribute('data-action');
    		var textarea = document.querySelector('textarea.with-formatting-buttons');
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
	        	insertTextAtCursor(textarea, '[' + tag + ']' + text_to_insert + '[' + tag + ']');
	        }

    	}, false);
    }

    //are you sure? click handler
	for(var i = 0, elems = document.querySelectorAll('.needs-confirmation'); i < elems.length; i++){
    	elems[i].addEventListener('click', function() {
			if (!confirm('Are you sure you want to do that?')) {
	        	this.preventDefault();
	        }
    	}, false);
    }

    //click handler to quote threads
	for(var i = 0, elems = document.querySelectorAll('.quote-this-thread'); i < elems.length; i++){
    	elems[i].addEventListener('click', function() {
	    	var textarea = document.querySelector('textarea.with-formatting-buttons');
	    	reqwest('/quote/thread/' + this.getAttribute('data-thread-id'), function(resp) {
	    		insertTextAtCursor(textarea, resp.quote);
	    		window.scroll(0, findPos(textarea));
			})
    	}, false);
    }

    //click handler to quote comments
	for(var i = 0, elems = document.querySelectorAll('.quote-this-comment'); i < elems.length; i++){
    	elems[i].addEventListener('click', function() {
	    	var textarea = document.querySelector('textarea.with-formatting-buttons');
	    	reqwest('/quote/comment/' + this.getAttribute('data-comment-id'), function(resp) {
	    		insertTextAtCursor(textarea, resp.quote);
	    		window.scroll(0, findPos(textarea));
			})
    	}, false);
    }

}, false);
