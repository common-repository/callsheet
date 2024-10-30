<?php 
if(isset($_POST["import"])){
/* echo "<pre>";
	print_r($_POST);
echo "</pre>";
echo "<pre>";
	print_r($_FILES);
echo "</pre>"; */
if ( ! isset( $_POST['import_nonce'] ) || ! wp_verify_nonce( $_POST['import_nonce'], 'import_action_nonce') ) {
        exit('The form is not valid');
  }
  else {
    if(current_user_can('manage_options')) {
global $wpdb;
		$filename=$_FILES["file1"]["tmp_name"];
		$CSVfp = fopen($filename, "r");
		$row = 1;
		$import_table = filter_var($_POST['import_table_name'], FILTER_SANITIZE_STRING);
		$import_table = $wpdb->prefix.'call_sheet_'.$import_table;
		$sql_column_name = $wpdb->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = %s",$import_table);
		$arr = $wpdb->get_results($sql_column_name);// or die(mysql_error());
		$arr = (array)$arr;
		$cols = array();
		$import_count = -1;
		foreach($arr as $col){
			 $cols[] = $col->COLUMN_NAME;
		}
		//unset($arr[0]);
		
		if($CSVfp !== FALSE) {
			while(! feof($CSVfp)) {		
				$data = fgetcsv($CSVfp, 1000,'\t');
				if( $row == 1 ){
					$row++;
					continue;
				}
					$data = array_map('trim',explode(',',$data[0]));
					$counter = 0;
					$insert_values = array();
					foreach($data as $rec){
						if( $counter == 0 ){
							$counter++;
							continue;
						}
						
						$insert_values[$cols[$counter]] = trim($rec, '"');
						$counter++;
					}
					$wpdb->insert($import_table, $insert_values);
						$import_count++;
				$row++;
			}
		}
		
		fclose($CSVfp);
    }
    else{
        echo 'You are not allowed to change';
    }
}
}
?>
<div class="inner-wrap">


    <div class="import-export-wrap">

        <div class="import-content">
            <h3 class="title-h3"><i class="fa fa-upload" aria-hidden="true"></i><?php _e('Import', 'callsheet'); ?> </h3>
            <div class="col-md-12">

                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <input type="file" name="file1" id="file" class="inputfile"  />
                        <label for="file"><span><?php _e('Upload File', 'callsheet'); ?></span></label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="select_1" name="import_table_name">
                                <option value="education"><?php _e('Education', 'callsheet'); ?></option>
                                <option value="awards"><?php _e('Awards', 'callsheet'); ?></option>
                                <option value="film"><?php _e('Movie', 'callsheet'); ?></option>
                                <option value="tv"><?php _e('TV', 'callsheet'); ?></option>
                                <option value="theater"><?php _e('Theater', 'callsheet'); ?></option>
                                <option value="commercial"><?php _e('Commercial', 'callsheet'); ?></option>
                                <option value="audio"><?php _e('Audio', 'callsheet'); ?></option>
                                <option value="internet"><?php _e('Internet', 'callsheet'); ?></option>
                                <option value="on_air"><?php _e('On air', 'callsheet'); ?></option>
                                <option value="on_stage"><?php _e('On stage', 'callsheet'); ?></option>
                                <option value="at_festival"><?php _e('On festival', 'callsheet'); ?></option>
                                <option value="on_tv"><?php _e('On TV', 'callsheet'); ?></option>
                                <option value="other"><?php _e('Other', 'callsheet'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" name="action" value="import_action">
                            <?php wp_nonce_field( 'import_action_nonce', 'import_nonce' ); ?>
                            <button type="submit" name="import" class="btn btn-primary"><?php _e('Submit', 'callsheet'); ?></button>
                        </div>
                    </div>
                </form>
                <p><?php 
					if(isset($import_count))
					echo $import_count.' Records Imported'; ?>
				</p>
            </div>
        </div>
        <div class="export-content">

            <h3 class="title-h3"><i class="fa fa-download" aria-hidden="true"></i><?php _e('Export', 'callsheet'); ?>  </h3>
              <div class="col-md-3">
			  <select class="form-control" id="select_2">
                                <option value="education"><?php _e('Education', 'callsheet'); ?></option>
                                <option value="awards"><?php _e('Awards', 'callsheet'); ?></option>
                                <option value="film"><?php _e('Movie', 'callsheet'); ?></option>
                                <option value="tv"><?php _e('TV', 'callsheet'); ?></option>
				<option value="theater"><?php _e('Theater', 'callsheet'); ?></option>
                                <option value="commercial"><?php _e('Commercial', 'callsheet'); ?></option>
                                <option value="audio"><?php _e('Audio', 'callsheet'); ?></option>
                                <option value="internet"><?php _e('Internet', 'callsheet'); ?></option>
                                <option value="on_air"><?php _e('On air', 'callsheet'); ?></option>
                                <option value="on_stage"><?php _e('On stage', 'callsheet'); ?></option>
                                <option value="at_festival"><?php _e('On festival', 'callsheet'); ?></option>
                                <option value="on_tv"><?php _e('On TV', 'callsheet'); ?></option>
                                <option value="other"><?php _e('Other', 'callsheet'); ?></option>
                            </select>
			 </div>				
            <div class="col-md-3">
               
                    <div class="form-group">
                        <button type="button" name="export" class="btn btn-primary export_btn"><?php _e('Export your data', 'callsheet'); ?></button>
                    </div>
                
            </div>
        </div>
    </div>

</div>

<script>  
	jQuery(document).ready(function(){
        jQuery('body').on('click', '.export_btn', function (e) {
			var rty = jQuery( "#select_2 option:selected" ).val();
             jQuery.ajax({
                data: {
					action:'export_data',
					tablename:rty,
				},
                type: 'post',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                success: function (data) {
                    var blob=new Blob([data]);
                    var link=document.createElement('a');
                    link.href=window.URL.createObjectURL(blob);                 
					document.body.appendChild(link);
                    link.download=rty+".csv";
                    link.click();
                    document.body.removeChild(link);
                 }
            }); 
          });
	    });
		
	var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function (input)
    {
        var label = input.nextElementSibling,
                labelVal = label.innerHTML;

        input.addEventListener('change', function (e)
        {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });
    });

</script>