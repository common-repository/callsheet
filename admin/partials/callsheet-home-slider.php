<?php 
settings_errors();

$options = get_option( 'slug_option' );

// Get the value of this option.


// The value to compare with (the value of the checkbox below).


//$actor_url = 'nisl_actor_url' ;


$option_slider = 'nisl_checked_slider';
$option_slider_text = 'nisl_slider_text';
$option_slider_img = 'nisl_slider_img';
$option_slider_mobile_img = 'nisl_slider_mobile_img';

$options = get_option($option_slider);
$slider_text = get_option($option_slider_text);
$slider_img = get_option($option_slider_img);
$slider_mobile_img = get_option($option_slider_mobile_img);

if(isset($_POST['add_slider'])) {

    if ( ! isset( $_POST['slider_nonce'] ) || ! wp_verify_nonce( $_POST['slider_nonce'], 'slider_action_nonce') ) {
        exit('The form is not valid');
  }
  else {
        if(current_user_can('manage_options')) {
    	//$actor_value = $_POST['actor_page'] ;
    	$checked = esc_html($_POST['display_slider']);
    	$text_value = sanitize_text_field(htmlentities($_POST['slider_text']));
        $img_value = sanitize_file_name($_POST['slider_img']);
    	$mobile_value = sanitize_file_name($_POST['mobile_img']);
    	

    	if ( get_option( $option_slider ) !== false ) {

    	    // The option already exists, so we just update it.
    	    
    	    update_option( $option_slider, $checked );

    	} else {

    	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
    	    $deprecated = null;
    	    $autoload = 'no';
    	    add_option( $option_slider, $checked, $deprecated, $autoload );
    	}

    	if ( get_option( $option_slider_text ) !== false ) {

    	    // The option already exists, so we just update it.
    	    
    	    update_option( $option_slider_text, $text_value );

    	} else {

    	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
    	    $deprecated = null;
    	    $autoload = 'no';
    	    add_option( $option_slider_text, $text_value, $deprecated, $autoload );
    	}

        if ( get_option( $option_slider_img ) !== false ) {

            // The option already exists, so we just update it.
            
            update_option( $option_slider_img, $img_value );

        } else {

            // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
            $deprecated = null;
            $autoload = 'no';
            add_option( $option_slider_img, $img_value, $deprecated, $autoload );
        }
    	if ( get_option( $option_slider_mobile_img ) !== false ) {

    	    // The option already exists, so we just update it.
    	    
    	    update_option( $option_slider_mobile_img, $mobile_value );

    	} else {

    	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
    	    $deprecated = null;
    	    $autoload = 'no';
    	    add_option( $option_slider_mobile_img, $mobile_value, $deprecated, $autoload );
    	}

    	

    	 wp_cache_delete ( 'alloptions', 'options' );
    	 $url = "admin.php?page=callsheet-home-slider";
    	?>
    	<script>window.location="<?php echo $url; ?>"; </script>
    	<?php exit();
        }
        else{
            echo 'You are not allowed to change';
        }
    }
}
?>
<div class="container">
    <div class="add-slider-form">
    
        <h2><?php _e('Set Slider', 'callsheet'); ?></h2>
        <p><?php _e('You can check the checkbox and display this slider on frontend home page', 'callsheet'); ?></p>

        <form class="form-horizontal col-sm-offset-2 col-sm-10" action="" method="post">

            <div class="form-group col-md-12">
                <label class="control-label col-sm-4" for="display_slider"><?php _e('Check to show/hide slider on frontend', 'callsheet'); ?> :</label>
                <div class="col-sm-6">

                    <input type="checkbox" id="display_slider" name="display_slider" value="1" <?php if($options == 1) : echo "checked"; endif; ?> />

                </div>
            </div>
            
            <div class="wrap-options">
            <div class="form-group col-md-12 text-class">
                <label class="control-label col-sm-4" for="slider_text"><?php _e('Add text for slider', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                	<?php 
                	$settings = array( 'media_buttons' => false, 'textarea_name' => 'slider_text' ,'textarea_rows' => 5, 'tinymce' => true );

					wp_editor( html_entity_decode(stripslashes($slider_text)), 'slider_text', $settings );
                	?>
                    <!-- <input type="text" name="slider_text" id="slider_text" value="<?php echo $slider_text; ?>" /> -->

                </div>
            </div>
            <div class="form-group col-md-12 img-class">
                <label class="control-label col-sm-4" for="slider_img"><?php _e('Upload image', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                	<div class="upload-img">
                        <a href="#" class="btn btn-default slider_upload_image_button button">

                        	 <?php if($slider_img != '') { 
                                    $display = 'block';
                                    $link = wp_get_attachment_image_src( $slider_img ); ?>
                                    <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                <?php } else {
                                    $display = 'none'; ?>
                                <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                            <?php } ?>
                        </a>
                            <input type="hidden" id="slider_img" name="slider_img" value="<?php echo $slider_img; ?>" >
                            <a href="#" class="slider_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                    </div>
                    <!-- <input type="file" name="slider_img" value="<?php echo $slider_img ?>" /> -->

                </div>
            </div>

            <div class="form-group col-md-12 img-class">
                <label class="control-label col-sm-4" for="mobile_img"><?php _e('Upload mobile image', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <div class="upload-img">
                        <a href="#" class="btn btn-default slider_upload_mobile_image_button button">

                             <?php if($slider_mobile_img != '') { 
                                    $display = 'block';
                                    $link = wp_get_attachment_image_src( $slider_mobile_img ); ?>
                                    <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                <?php } else {
                                    $display = 'none'; ?>
                                <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                            <?php } ?>
                        </a>
                            <input type="hidden" id="mobile_img" name="mobile_img" value="<?php echo $slider_mobile_img; ?>" >
                            <a href="#" class="slider_mobile_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                    </div>
                    <!-- <input type="file" name="slider_img" value="<?php echo $slider_img ?>" /> -->

                </div>
            </div>

            </div>  
             
            <div class="form-group">        
                <div class="col-sm-10">
                    <input type="hidden" name="action" value="slider_action">
                    <?php wp_nonce_field( 'slider_action_nonce', 'slider_nonce' ); ?>
                    <button type="submit" name="add_slider" class="slider_button btn btn-default"><?php _e('Submit', 'callsheet'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
        if(jQuery('#display_slider').is(":checked")) {
                jQuery('.wrap-options').css('display','block');
                //jQuery('.img-class').css('display','block');
            }
            else {
                jQuery('.wrap-options').css('display','none');
                //jQuery('.img-class').css('display','none');
            }
		jQuery('#display_slider').change(function() {
		    if(jQuery(this).is(":checked")) {
		        jQuery('.wrap-options').css('display','block');
		        //jQuery('.img-class').css('display','block');
		    }
		    else {
		    	jQuery('.wrap-options').css('display','none');
		        //jQuery('.img-class').css('display','none');
		    }
		});

		jQuery('body').on('click', '.slider_upload_image_button', function(e){
            e.preventDefault();
            //var serviceid = jQuery(this).attr('data-serid');
            //var stored_id = $('#featured_img_'+serviceid).val();
            var button = jQuery(this),
                custom_uploader = wp.media({
            title: 'Insert image',
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
            }).on('select', function() { // it also has "open" and "close" events 
            var attachments = custom_uploader.state().get('selection').first().toJSON();
            
            jQuery('#slider_img').val(attachments.id);
            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();
            jQuery('.on_tv_remove_image_button').css('display','inline-block');
            
            })
            .open();
        });
         jQuery('body').on('click', '.slider_remove_image_button', function(){
            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');
            return false;
        });

         jQuery('body').on('click', '.slider_upload_mobile_image_button', function(e){
            e.preventDefault();
            //var serviceid = jQuery(this).attr('data-serid');
            //var stored_id = $('#featured_img_'+serviceid).val();
            var button = jQuery(this),
                custom_uploader = wp.media({
            title: 'Insert image',
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
            }).on('select', function() { // it also has "open" and "close" events 
            var attachments = custom_uploader.state().get('selection').first().toJSON();
            
            jQuery('#mobile_img').val(attachments.id);
            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();
            jQuery('.on_tv_remove_image_button').css('display','inline-block');
            
            })
            .open();
        });
         jQuery('body').on('click', '.slider_mobile_remove_image_button', function(){
            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');
            return false;
        });
	});
</script>