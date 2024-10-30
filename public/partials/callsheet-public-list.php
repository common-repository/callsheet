
<?php 
$string_url = explode("/", trim($_SERVER['REQUEST_URI'],"/"));
$type=$string_url[count($string_url)-1];
global $wpdb;
$client_master = $wpdb->prefix.'call_sheet_client_master';
$sql = $wpdb->prepare("SELECT client_id,first_name,last_name,slug,show_hide FROM $client_master where type=%s AND show_hide=%s ORDER BY last_name",$type,'1');
$results = $wpdb->get_results($sql);
$photo_master = $wpdb->prefix . 'call_sheet_photo';
$default_url;
if($type=="actor"){$type_new="Actor";$default_url="https://www.w3schools.com/bootstrap/img_avatar1.png";}
if($type=="actress"){$type_new="Actress";$default_url="https://www.w3schools.com/bootstrap/img_avatar4.png";}
if($type=="director"){$type_new="Director";$default_url="https://www.w3schools.com/bootstrap/img_avatar3.png";}
?>
    <script>jQuery(document).attr("title", "<?php echo $type_new; ?> | Agentur Adam");</script>
    <div class="listing">
     
    <div class="row">
    <?php
foreach ($results as $result) {
    
   
    
            ?>
        <a href="<?php echo "/".$type.'/'.$result->slug; ?>">
               <div class="col-md-2 col-sm-2 col-xs-4">
            <div class="listing-detail">
                <div class="bxslider">
                <?php 
                 $sql_image           = $wpdb->prepare("SELECT * FROM $photo_master where client_id=%s AND overview=%s",$result->client_id,'1');
    $results_image       = $wpdb->get_results($sql_image);
                foreach ($results_image as $result_image) {
                    $image_attributes=wp_get_attachment_image_src( $result_image->attachment_id,'full');
    if($image_attributes[0]==''){$image_attributes[0]=$default_url;}
                    ?><img src="<?php echo $image_attributes[0]; ?>" alt="img"><?php
                }?>
                </div>
                <div class="mask">
                        <h2><?php echo $result->first_name.' '.$result->last_name; ?></h2>
                 </div>
            </div>
               </div>  </a>
                <?php                    
 
}
?>

       
        
        
    </div>
</div>

<script>
    jQuery(document).ready(function(){
      jQuery('.bxslider').bxSlider({
          pager:false,
          controls:false,
          responsive:true,
          auto:true
      });
    });
  </script>
