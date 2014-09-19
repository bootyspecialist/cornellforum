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

	//formatting buttons click handler
	for(var i = 0, formattingbuttons = document.querySelectorAll('div.formatting-buttons ul > li.formatting-button'); i < formattingbuttons.length; i++){
    	formattingbuttons[i].addEventListener('click', function() {
    		var action = this.getAttribute('data-action');
    		var textarea = document.querySelector('textarea.with-formatting-buttons');
    		switch (action) {
	            case "bold":
	                insertTextAtCursor(textarea, '[b]bolded text[/b]');
	                break;
	            case "italic":
	                insertTextAtCursor(textarea, '[i]italicized text[/i]');
	                break;
	            case 'image':
	                insertTextAtCursor(textarea, '[img]catpicture.jpg[/img]');
	                break;
	            case 'youtube':
	                insertTextAtCursor(textarea, '[youtube]fI_xuFA18m4[/youtube]');
	                break;
	            case 'quote':
	                insertTextAtCursor(textarea, '[quote]quoted text[/quote]');
	                break;
	        }
    	}, false);
    }

}, false);
