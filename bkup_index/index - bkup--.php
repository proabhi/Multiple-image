<?php
/*
Plugin Name: Multiple images
Description:This plugin is used for multiple image upload on posts single page
*/
/**********************************Enqueue js and style form this function hook *************************/
function Zumper_widget_enqueue_script() {   
    wp_enqueue_script( 'jqueryfiled', plugin_dir_url( __FILE__ ) . 'js/juqeyscriptfile.js' );
	wp_enqueue_style( 'stylefile', plugin_dir_url( __FILE__ ) . 'css/stylefile.css' );
	wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'Zumper_widget_enqueue_script');

/*****************************End*********************************/

/*******************************This code add the custom field to psot type**************************/
function add_meta_box_to_post_type()
{
    add_meta_box("demo-meta-box", "Multiple Image Upload", "add_images_form_here", "post", "side", "high", null);
}

add_action("add_meta_boxes", "add_meta_box_to_post_type");

/*****************************End*********************************/

function add_images_form_here($post_id)
{
//print_r($post_id);
$ii = get_post_meta($post_id->ID,'filedimage', true );
if(empty($ii)){
	echo"<h3>Please select images<h3>";
}
else{
?>
<div class="show_multiple_image deafultshowing">
<?php
foreach($ii as $getimage){
	$getimage_url = wp_get_attachment_url( $getimage );
?>

<div class='img-sec'>
<img src="<?php echo $getimage_url;?>">
<button type='button'>x</button><input type='hidden' name='hidenimageupload[]' class='all_images' value='<?php echo $getimage;?>'>
</div>
<?php 	
}}?>
</div>
	<input type="file" name="multiplefile[]" id="multiplefile" multiple>
	<div class="show_multiple_image"></div>
	<?php	
	
}

function kvkoolitus_dates_save_meta( $post_id ) {
      //$filesstore = $_FILES['multiplefile'];
	       
		   $imageupload = $_POST['hidenimageupload'];
		   update_post_meta( $post_id, 'filedimage', $imageupload );

		   
}
add_action( 'save_post', 'kvkoolitus_dates_save_meta' );
