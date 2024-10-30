<?php

if(isset($_POST['add_new'])){
    if ( ! isset( $_POST['register_nonce'] ) || ! wp_verify_nonce( $_POST['register_nonce'], 'register_action_nonce') ) {
        exit('The form is not valid');
}
else {
    if(current_user_can('manage_options')) {
    global $wpdb;
    $client_master = $wpdb->prefix . 'call_sheet_client_master';
    
    $slug=$_POST['first_name']." ".$_POST['last_name'];
  // replace non letter or digits by -
  /*$slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

  // transliterate
  $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

  // remove unwanted characters
  $slug = preg_replace('~[^-\w]+~', '', $slug);

  // trim
  $slug = trim($slug, '-');

  // remove duplicate -
  $slug = preg_replace('~-+~', '-', $slug);*/
  $slug = sanitize_title($slug);

  // lowercase
  $slug = strtolower($slug);

  if (empty($slug)) {
    $slug= 'n-a';
  }
    
    $checkslug = $wpdb->get_results($wpdb->prepare("SELECT slug FROM $client_master WHERE slug LIKE '%s%'",$slug));
    $numhits=$wpdb->num_rows;
    if($numhits > 0){
        $slug = $slug.'-'.$numhits;
    }
    
    $fname = sanitize_text_field($_POST['first_name']);
    $lname = sanitize_text_field($_POST['last_name']);
    $client_type = sanitize_text_field($_POST['type']);
    $valid = true;
    if(empty($fname)) {
        $errMsg1 = "Please enter first name";
        $valid = false;
    }
    else {
        $fname = sanitize_text_field($fname);
    }

    if(empty($lname)) {
        $errMsg2 = "Please enter last name";
        $valid = false;
    }
    else {
        $lname = sanitize_text_field($lname);
    }

    if(empty($client_type)) {
        $errMsg3 = "Please select client type";
        $valid = false;
    }
    else {
        $client_type = $client_type;
    }
    
    if($valid == true) {


        $wpdb->insert($client_master, array(
            "first_name" => $fname,"last_name" => $lname,"type" => $client_type,"slug" => $slug,"show_hide" => 0));
        $last_inserted_id=$wpdb->insert_id;
        $url="admin.php?page=callsheet-edit&client_id=".$last_inserted_id;
        ?>
        <script>window.location = "<?php echo $url; ?>";</script>
        <?php exit();
    }
        
    }
    else{
        echo 'You are not allowd to change';
    }
}
}
?>
<div class="container">
    <div class="add-client-form">
    
        <h2><?php _e('Add New Client', 'callsheet'); ?></h2>
        <p><?php _e('Submit Below Forms For Adding New Client', 'callsheet'); ?></p>

        <form class="form-horizontal col-sm-offset-2 col-sm-10" action="" method="post">

            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="first_name"><?php _e('First Name', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php if (isset($fname)) echo $fname; ?>">
                    <span class="errormsg"><?php if(isset($errMsg1)) echo $errMsg1; ?></span>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-sm-2" for="last_name"><?php _e('Last Name', 'callsheet'); ?> :</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="<?php if (isset($lname)) echo $lname; ?>">
                    <span class="errormsg"><?php if (isset($errMsg2)) echo $errMsg2; ?></span>
                </div>
            </div>


                <div class="form-group col-md-12 nisl-type">
                    <label class="control-label col-sm-2" for="type"><?php _e('Type', 'callsheet'); ?> :</label>
                    <div class="col-sm-7 text-left">
                        <label class="radio-inline">
                            <input type="radio" name="type" value="Actor"><?php _e('Actor', 'callsheet'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="Actress"><?php _e('Actress', 'callsheet'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="Director"><?php _e('Director', 'callsheet'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="Cinematographer"><?php _e('Cinematographer', 'callsheet'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="Writer"><?php _e('Writer', 'callsheet'); ?>
                        </label>
                    </div>
                    <span class="errormsg"><?php if(isset($errMsg2)) echo $errMsg3; ?></span>
                </div>

            <div class="form-group">        
                <div class="col-sm-10">
                    <input type="hidden" name="action" value="register_action">
                    <?php wp_nonce_field( 'register_action_nonce', 'register_nonce' ); ?>
                    <button type="submit" name="add_new" class="btn btn-default"><?php _e('Add Client', 'callsheet'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
