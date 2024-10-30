<?php 
global $wpdb;
$tags_master = $wpdb->prefix.'call_sheet_tags_master';

if(isset($_POST['save'])){
    if ( ! isset( $_POST['all_values_nonce'] ) || ! wp_verify_nonce( $_POST['all_values_nonce'], 'all_values_action_nonce') ) {
        exit('The form is not valid');
  }
  else{
    if(current_user_can('manage_options')) {
        unset($_POST['save']);
         foreach($_POST as $key=>$value)
            {
      
            $wpdb->update($tags_master,array("tags_value" => $value),array( 'tags_name' =>$key),'',''); 
            }
        }
        else {
            echo 'You are not allowed to change';
        }
        
    }
}

 $sql= "SELECT * FROM $tags_master";
 $results = $wpdb->get_results($sql) or die(mysql_error());
?>

<div class="inner-wrap">
    <h3 class="title-h3"><?php _e('Values', 'callsheet'); ?></h3>

    <div class="api-wrap">
        <div class="row">

            <form method="POST" action="">
              
                     <?php
            foreach ($results as $result) {
                $array = array_filter(array_map('trim', explode(',', $result->tags_value)));
                asort($array);
$array = implode(', ', $array);

            
switch ($result->tags_display_name) {
    case "Place Of Birth":
        $result->tags_display_name='Geburtsort';
        break;
    case "Nationality":
        $result->tags_display_name='Staatsangehörigkeit';
        break;
    case "State":
        $result->tags_display_name='1. Wohnsitz in';
        break;
    case "1st Residence":
        $result->tags_display_name='Wohnort';
        break;
    case "Place Of Action":
        $result->tags_display_name='Wohnmögl.';
        break;
    case "Ethnic Appearance":
        $result->tags_display_name='ethn. Erscheinung';
        break;
    case "Hair Colour":
        $result->tags_display_name='Haarfarbe';
        break;
    case "Hair Length":
        $result->tags_display_name='Haarlänge';
        break;
    case "Eye Colour":
        $result->tags_display_name='Augenfarbe';
        break;
    case "Stature":
        $result->tags_display_name='Statur';
        break;
    case "Confection Size":
        $result->tags_display_name='Konfektion';
        break;
    case "Language":
        $result->tags_display_name='Sprache(n)';
        break;
    case "Accents":
        $result->tags_display_name='Akzente';
        break;
    case "Singing":
        $result->tags_display_name='Gesang';
        break;
    case "Voice Range":
        $result->tags_display_name='Stimmlage';
        break;
    case "Musical Instrument":
        $result->tags_display_name='Musikinstrument';
        break;
    case "Sports":
        $result->tags_display_name='Sport';
        break;
    
    case "Dancing":
        $result->tags_display_name='Tanz';
        break;
    
    case "License":
        $result->tags_display_name='Lizenz';
        break;
    
    case "Professional Union":
        $result->tags_display_name='Berufsverband';
        break;
    
    case "Genre":
        $result->tags_display_name='Genre';
        break;
    
    case "Agencies":
        $result->tags_display_name='Agenturen';
        break;
    
    default:
        echo "";
}

             ?>
                <div class="col-md-6">
                <div class="input-group form-group">
                    <input type="text" class="form-control" data-role="tagsinput" name="<?php echo $result->tags_name; ?>" value="<?php echo $array; ?>">
                    <span class="input-group-addon"><?php echo $result->tags_display_name; ?></span>
                </div>
                </div>
            <?php } ?>
               
                </div>
                 <div class="form-group pull-left">
                    <input type="hidden" name="action" value="all_values_action">
                            <?php wp_nonce_field( 'all_values_action_nonce', 'all_values_nonce' ); ?>
                    <button type="submit" name="save" class="btn btn-primary pull-right"><?php _e('Submit', 'callsheet'); ?></button>
                  </div>
            </form>
        </div>
    </div>

</div>