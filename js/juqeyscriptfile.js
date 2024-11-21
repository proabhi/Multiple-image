jQuery(document).ready(function($){


	 // Define a variable wkMedia
  var wkMedia;

  $('#multiplefile').click(function(e) {
	 
	 
    e.preventDefault();
    // If the upload object has already been created, reopen the dialog
      if (wkMedia) {
      wkMedia.open();
      return;
    }
    // Extend the wp.media object
    wkMedia = wp.media.frames.file_frame = wp.media({
      title: 'Select media',
      button: {
      text: 'Select media'
    }, multiple: true });

    // When a file is selected, grab the URL and set it as the text field's value
    wkMedia.on('select', function() {
      var attachment = wkMedia.state().get('selection').toJSON();
    for (var i = 0; i < attachment.length; i++) {	
    $(".show_multiple_image").append("<div class='img-sec'><img  src='"+attachment[i]['url']+"'><button class='remove_image' type='button'>x</button><input type='hidden' name='hidenimageupload[]' class='all_images' value='"+attachment[i]['id']+"'></div>");
	
	
	
}  
      //$('#wk-media-url').val(attachment.url);
    });
    // Open the upload dialog
    wkMedia.open();
  });
$(document).on("click","button.remove_image",function(){
$(this).parent().remove();

});

});