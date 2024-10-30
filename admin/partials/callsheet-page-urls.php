<?php 
settings_errors();

$actor_url = 'nisl_actor_url' ;
$actress_url = 'nisl_actress_url' ;
$director_url = 'nisl_director_url' ;
$cinemato_url = 'nisl_cinematographer_url' ;
$writer_url = 'nisl_writer_url' ;

$old_actor_value = get_option($actor_url);
$old_actress_value = get_option($actress_url);
$old_director_value = get_option($director_url);
$old_cinemato_value = get_option($cinemato_url);
$old_writer_value = get_option($writer_url);

if(isset($_POST['add_page'])) {
	if ( ! isset( $_POST['pages_nonce'] ) || ! wp_verify_nonce( $_POST['pages_nonce'], 'pages_action_nonce') ) {
        exit('The form is not valid');
  }else {
  	if(current_user_can('manage_options')) {
		$actor_value = sanitize_text_field($_POST['actor_page']);
		$actress_value = sanitize_text_field($_POST['actress_page']);
		$director_value = sanitize_text_field($_POST['director_page']);
		$cinemato_value = sanitize_text_field($_POST['cinematographer_page']);
		$writer_value = sanitize_text_field($_POST['writer_page']);


		if ( get_option( $actor_url ) !== false ) {

		    // The option already exists, so we just update it.
		    
		    update_option( $actor_url, $actor_value );

		} else {

		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $actor_url, $actor_value, $deprecated, $autoload );
		}

		if ( get_option( $actress_url ) !== false ) {

		    // The option already exists, so we just update it.
		    
		    update_option( $actress_url, $actress_value );

		} else {

		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $actress_url, $actress_value, $deprecated, $autoload );
		}

		if ( get_option( $director_url ) !== false ) {

		    // The option already exists, so we just update it.
		   
		    update_option( $director_url, $director_value );

		} else {

		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $director_url, $director_value, $deprecated, $autoload );
		}

		if ( get_option( $cinemato_url ) !== false ) {

		    // The option already exists, so we just update it.
		    
		    update_option( $cinemato_url, $cinemato_value );

		} else {

		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $cinemato_url, $cinemato_value, $deprecated, $autoload );
		}

		if ( get_option( $writer_url ) !== false ) {

		    // The option already exists, so we just update it.
		    
		    update_option( $writer_url, $writer_value );

		} else {

		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $writer_url, $writer_valuer, $deprecated, $autoload );
		}

		 wp_cache_delete ( 'alloptions', 'options' );
		 $url = "admin.php?page=callsheet-page-url";
		?>
		<script>window.location="<?php echo $url; ?>"; </script>
		<?php exit();
		}
		else {
			echo 'You are not allowed to change';
		}
	}
}
?>
<div class="container">
    <div class="add-url-form">
    
        <h2><?php _e('Set page urls', 'callsheet'); ?></h2>
        <p><?php _e('Set page url for redirecting to front end, it will be used in edit client page', 'callsheet'); ?></p>

        <form class="form-horizontal col-sm-offset-2 col-sm-10" action="" method="post">

            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="actor_page"><?php _e('Actor', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <?php wp_dropdown_pages( array('name' => 'actor_page','show_option_none'=> '--Select page--','selected'=>$old_actor_value )); ?>

                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="actress_page"><?php _e('Actress', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <?php wp_dropdown_pages( array('name' => 'actress_page','show_option_none'=> '--Select page--','selected'=>$old_actress_value )); ?>

                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="director_page"><?php _e('Director', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <?php wp_dropdown_pages( array('name' => 'director_page','show_option_none'=> '--Select page--','selected'=>$old_director_value )); ?>

                </div>
            </div>

            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="cinematographer_page"><?php _e('Cinematographer', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <?php wp_dropdown_pages( array('name' => 'cinematographer_page','show_option_none'=> '--Select page--','selected'=>$old_cinemato_value )); ?>

                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="writer_page"><?php _e('Writer', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <?php wp_dropdown_pages( array('name' => 'writer_page','show_option_none'=> '--Select page--','selected'=>$old_writer_value )); ?>

                </div>
            </div>
                
            <div class="form-group">        
                <div class="col-sm-10">
                	<input type="hidden" name="action" value="pages_action">
                    <?php wp_nonce_field( 'pages_action_nonce', 'pages_nonce' ); ?>
                    <button type="submit" name="add_page" class="btn btn-default"><?php _e('Submit', 'callsheet'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>