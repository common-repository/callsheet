<?php 
if(isset($_POST["import"])){
   if ( ! isset( $_POST['import_btn_nonce'] ) || ! wp_verify_nonce( $_POST['import_btn_nonce'], 'import_btn_action_nonce') ) {
        exit('The form is not valid');
  }
  else{
    if(current_user_can('manage_options')) {
      global $wpdb;
      $client_master = $wpdb->prefix . 'call_sheet_client_master';		
  		$filename=$_FILES["file1"]["tmp_name"];		
   
   
  		 if($_FILES["file1"]["size"] > 0)
  		 {
  		  	$file = fopen($filename, "r");
                           $count=0;
  	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
  	         {
                      if($count>0){
                    $wpdb->insert($client_master, array("first_name" => $getData[1],"last_name" => $getData[2],"type" => $getData[3]));
                      }
                      $count++;
                    
                  }
  		fclose($file);	
  		 }
    }
    else{
      echo 'You are not allowed to change';
    }
  }
}	 
?>
<div class="setting-wrap inner-wrap">
    <h3 class="title-h3"><?php _e('Setting', 'callsheet'); ?></h3>
            <div role="tabpanel" id="custom-tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs custom-nav" role="tablist">
                      <li role="presentation" class="active col-md-4 custom-tab">
                        <a href="#mapa1" aria-controls="home" role="tab" data-toggle="tab">
                          <div class="text-center">
                            <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                            <h3><?php _e('Import', 'callsheet'); ?></h3>
                          </div>
                        </a>
                      </li>
                      <li role="presentation" class="col-md-4 custom-tab">
                        <a href="#mapa2" aria-controls="profile" role="tab" data-toggle="tab">
                          <div class="text-center">
                            <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                            <h3><?php _e('Export', 'callsheet'); ?></h3>
                          </div>
                        </a>
                      </li>
                      <li role="presentation" class="col-md-4 custom-tab">
                        <a href="#mapa3" aria-controls="profile" role="tab" data-toggle="tab">
                          <div class="text-center">
                            <i class="fa fa-cubes fa-2x" aria-hidden="true"></i>
                            <h3><?php _e('API Detail', 'callsheet'); ?></h3>
                          </div>
                        </a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="custom-tab-pane tab-pane active" id="mapa1">
                                    <div class="import-content">
                                            <div class="col-md-8 col-md-offset-2">
                                                
                                            <form method="POST" action="#" enctype="multipart/form-data">
                                                    <!-- COMPONENT START -->
                                                    <div class="form-group">
                                                            <div class="input-group input-file" name="Fichier1">
                                                                <input type="file" class="form-control" name="file1" placeholder='Choose a file...' />			
                                                        <span class="input-group-btn">
                                                                    <button class="btn btn-default btn-choose" type="button"><?php _e('Choose for Import', 'callsheet'); ?></button>
                                                            </span>


                                                            </div>
                                                    </div>
                                                    <!-- COMPONENT END -->
                                                    <div class="form-group">
                                                      <input type="hidden" name="action" value="import_btn_action">
                                                      <?php wp_nonce_field( 'import_btn_action_nonce', 'import_btn_nonce' ); ?>
                                                        <button type="submit" name="import" class="btn btn-primary pull-right"><?php _e('Submit', 'callsheet'); ?></button>
                                                            <button type="reset" class="btn btn-danger"><?php _e('Reset', 'callsheet'); ?></button>
                                                    </div>
                                            </form>
                                                <p><?php if($count>0){$count=$count-1; echo $count.' Records Imported';} ?></p>
                                            </div>
                                    </div>
                      </div>
                      <div role="tabpanel" class="custom-tab-pane  tab-pane" id="mapa2">
                                    <div class="export-content">
                                            <div class="text-center">
                                                
                                            
                                                <form method="post">
                                                    <div class="form-group">

                                                        <button type="button" name="export" class="btn btn-primary export_btn" ><?php _e('Export your data', 'callsheet'); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                      </div>
                      <div role="tabpanel" class="custom-tab-pane  tab-pane" id="mapa3">
                          <div class="col-md-8 col-md-offset-2">
                                                
                                            <form method="POST" action="#" enctype="multipart/form-data">
                            <div class="input-group form-group">
                                    <input id="msg" type="text" class="form-control" name="msg" placeholder="API Key">
                                    <span class="input-group-addon"><?php _e('API Password', 'callsheet'); ?></span>
                            </div>
                           <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right" ><?php _e('Submit', 'callsheet'); ?></button>
                                    <button type="reset" class="btn btn-danger"><?php _e('Reset', 'callsheet'); ?></button>
                            </div>
                                            </form>
                          </div>
                      </div>
                    </div>

            </div>
    </div>
<script>
    //export function call
        jQuery('body').on('click', '.export_btn', function (e) {
            
            jQuery.ajax({
                data: 'action=export_data',
                type: 'post',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                success: function (data) {
                    var blob=new Blob([data]);
                    var link=document.createElement('a');
                    link.href=window.URL.createObjectURL(blob);
                    link.download="clients.csv";
                    link.click();
                 }
            });
        });
     
</script>
