<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://callsheet.io
 * @since      1.0.0
 *
 * @package    Callsheet
 * @subpackage Callsheet/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
// get_header();
global $wpdb;
$pos = explode('/',trim($_SERVER['REQUEST_URI'], '/'));
$slug = $pos[count($pos)-1];
$type = $pos[count($pos)-2];
   $client_master = $wpdb->prefix.'call_sheet_client_master';
   $sql = $wpdb->prepare("SELECT client_id FROM $client_master WHERE slug =%s AND type = %s AND show_hide=%s limit 1",$slug,$type,'1');
   
   $result = $wpdb->get_row($sql);
   if(isset( $result ) && !empty( $result ))
   {
		$client_id = $result->client_id;
?>
<!---
<div class="collapse-menu">
		<div id="myNav" class="overlay">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <div class="overlay-content">
		    <a href="#">About</a>
		    <a href="#">Services</a>
		    <a href="#">Clients</a>
		    <a href="#">Contact</a>
		  </div>
		</div>
		<span class="open-btn"onclick="openNav()">&#9776;</span>
</div> -->
 <?php
  $client_master = $wpdb->prefix.'call_sheet_client_master';
  $bio_result = $wpdb->get_row( $wpdb->prepare('SELECT * FROM '.$client_master.' WHERE client_id = %d',$client_id ));
  //print_r($bio_result);
  ?>
 <script>jQuery(document).attr("title", "<?php  echo $bio_result->first_name.' '.$bio_result->last_name; ?> | Agentur Adam");</script>
  <meta name="description" content="<?php echo  $bio_result->short_text;?>">
<div class="main-title">
	<h2><?php echo $bio_result->first_name.' '.$bio_result->last_name ?></h2>
	<div class="menus">
            <?php
     $social_master = $wpdb->prefix . 'call_sheet_social';
    $sql_social           = $wpdb->prepare("SELECT * FROM $social_master where client_id=%d",$client_id);
    $social_results       = $wpdb->get_row($sql_social);
   
?>
		<ul>
                    <li class="vita_li"> <a href="#Vita" class="open-btn" onclick="openNav()"> Vita </a> </li>
                        <?php if($type!='director'){ ?><li> <a href="#Photo" onclick="openModal1();currentSlide_img(1)"> Photos </a> </li> <?php } ?>
			<li class="video_li"> <a href="#Video" onclick="openModal();currentSlide(1)"> Videos </a> </li>
                        <?php if(valset($social_results->facebook)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->facebook; ?>"> <i class="fa fa-facebook-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->instagram)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->instagram; ?>"> <i class="fa fa-instagram" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->youTube)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->youTube; ?>"> <i class="fa fa-youtube-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->snapchat)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->snapchat; ?>"> <i class="fa fa-snapchat-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->twitter)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->twitter; ?>"> <i class="fa fa-twitter-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->pinterest)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->pinterest; ?>"> <i class="fa fa-pinterest-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                        <?php if(valset($social_results->linkedIn)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->linkedIn; ?>"> <i class="fa fa-linkedin-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->google_plus)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->google_plus; ?>"> <i class="fa fa-google-plus-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->tumblr)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->tumblr; ?>"> <i class="fa fa-tumblr-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->reddit)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->reddit; ?>"> <i class="fa fa-reddit-square" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->flickr)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->flickr; ?>"> <i class="fa fa-flickr" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->medium)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->medium; ?>"> <i class="fa fa-medium" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->soundCloud)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->soundCloud; ?>"> <i class="fa fa-soundcloud" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
                         <?php if(valset($social_results->homepage)){ ?>
                        <li class="video_li"> <a target="_blank" href="<?php echo $social_results->homepage; ?>"> <i class="fa fa-home" aria-hidden="true"></i> </a> </li>
                        <?php } ?>
                        
		</ul>
	</div>
</div>
<?php
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $sql           = $wpdb->prepare("SELECT * FROM $photo_master where client_id=%d AND profile = %s ORDER BY position",$client_id,'1');
    $photo_results       = $wpdb->get_results($sql);
?>
		<ul class="rslides">
		<?php
                require_once 'Mobile_Detect.php';
            $detect = new Mobile_Detect;
                if( $detect->isMobile()){
                    $sql_mobile           = $wpdb->prepare("SELECT * FROM $photo_master where client_id=%d AND mobile = %s ORDER BY position",$client_id,'1');
    $photo_results_mobile       = $wpdb->get_results($sql_mobile);
     foreach ($photo_results_mobile as $result_mobile) {
			$image_attributes_full=wp_get_attachment_image_src( $result_mobile->attachment_id,'full');
			echo '<li><img src="'.$image_attributes_full[0].'" alt=""></li>';
		}  
                }else{
                     $sql_web          = $wpdb->prepare( "SELECT * FROM $photo_master where client_id=%d AND profile = %s ORDER BY position",$client_id,'1');
    $photo_results       = $wpdb->get_results($sql_web);
                  foreach ($photo_results as $result) {
			$image_attributes_full=wp_get_attachment_image_src( $result->attachment_id,'full');
			echo '<li><img src="'.$image_attributes_full[0].'" alt=""></li>';
		}  
                }
		
		?>
		</ul>



<div class="biodata">
	<div id="user-biodata" class="overlay" >
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <div class="overlay-content mCustomScrollbar"  data-mcs-theme="">
		 <?php
	$award_table = $wpdb->prefix . 'call_sheet_awards';
	$award_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $award_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
	if(count($award_data) != 0){
	?>
	<div>
		<button class="accordion <?php if(count($award_data)>5) echo "accordion_after"; ?>"> Awards</button>
<div class="first-five">
		<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($award_data as $awards){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
         <?php 
         if($last_from_year==$awards->from_year &&$last_to_year==$awards->to_year){}else{
         if(valset($awards->to_year)){echo $awards->to_year;}
         
         if(valset($awards->from_year)){ 
             if(valset($awards->to_year)){ 
                 echo '-'.substr($awards->from_year, -2); 
                 
             }else{ 
                 echo $awards->from_year; 
                 
             } 
             }
         }
         ?>
	</span>
            <?php if(valset($awards->awards)){ ?>
    <span class="name"><?php echo '  '.$awards->awards ?></span>
	<?php } ?>
</div>
	<?php
	$count++;
        $last_from_year= $awards->from_year;
        $last_to_year= $awards->to_year;
			}							
			?>
		</div>
	</div>
	<?php
	}
?>
                      <?php
	$film_table = $wpdb->prefix . 'call_sheet_film';
	$film_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $film_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
	if(count($film_data) != 0){
	?>
<div>
<button class="accordion <?php if(count($film_data)>5) echo "accordion_after"; ?>"> Movie selection</button>
<div class="first-five">
		<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($film_data as $film){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$film->from_year && $last_to_year==$film->to_year){}else{
         if(valset($film->to_year)){echo $film->to_year;}
         
         if(valset($film->from_year)){ 
             if(valset($film->to_year)){ 
                 echo '-'.substr($film->from_year, -2); 
                 
             }else{ 
                 echo $film->from_year; 
                 
             } 
             }
         }
         ?>
	</span>
	<?php
		$disp_str = '';
		if(valset($film->film)){ $disp_str.= ' | <b>'.$film->film.'</b> | '; }
		if(valset($film->description)){ $disp_str.= $film->description.' | '; }
		//if(valset($film->role)){ $disp_str.= $film->role.' | '; }
		if(valset($film->director)){ $disp_str.= $film->director.' | '; }
		if(valset($film->casting)){ $disp_str.= $film->casting.' | '; }
		if(valset($film->production)){ $disp_str.= $film->production.' '; }
		if(valset($film->channel)){ $disp_str.= $film->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php
		$count++;
                $last_from_year= $film->from_year;
                $last_to_year= $film->to_year;
			}							
			?>
		</div>
	</div>
	<?php
	}
?>
				
<?php
$tv_table = $wpdb->prefix . 'call_sheet_tv';
$tv_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $tv_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($tv_data) != 0){
?>
<div>
<button class="accordion <?php if(count($tv_data)>5) echo "accordion_after"; ?>"> TV selection</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($tv_data as $tv){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$tv->from_year && $last_to_year==$tv->to_year){}else{
         if(valset($tv->to_year)){echo $tv->to_year;}
         
         if(valset($tv->from_year)){ 
             if(valset($tv->to_year)){ 
                 echo '-'.substr($tv->from_year, -2); 
                 
             }else{ 
                 echo $tv->from_year; 
                 
             } 
             }
         }
         ?>
	</span>
	<?php
		$disp_str = '';
		if(valset($tv->tv)){ $disp_str.= ' | <b>'.$tv->tv.'</b> | '; }	
		if(valset($tv->description)){ $disp_str.= $tv->description.' | '; }	
		//if(valset($tv->role)){ $disp_str.= $tv->role.' | '; }
		if(valset($tv->director)){ $disp_str.= $tv->director.' | '; }
		if(valset($tv->casting)){ $disp_str.= $tv->casting.' | '; }
		if(valset($tv->production)){ $disp_str.= $tv->production.' '; }
		if(valset($tv->channel)){ $disp_str.= $tv->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php $count++;
        $last_from_year= $tv->from_year;
        $last_to_year= $tv->to_year;
			}
			?>
		</div>
	</div>
	<?php
	}
?>
                      <?php
$theater_table = $wpdb->prefix . 'call_sheet_theater';
$theater_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $theater_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($theater_data) != 0){
?>
<div>
<button class="accordion <?php if(count($theater_data)>5) echo "accordion_after"; ?>"> Theater selection</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($theater_data as $theat){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$theat->from_year && $last_to_year==$theat->to_year){}else{
         if(valset($theat->to_year)){echo $theat->to_year;}
         
         if(valset($theat->from_year)){ 
             if(valset($theat->to_year)){ 
                 echo '-'.substr($theat->from_year, -2); 
                 
             }else{ 
                 echo $theat->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
	<?php
		$disp_str = '';
		if(valset($theat->title)){ $disp_str.= ' | <b>'.$theat->title.'</b> | '; }	
		if(valset($theat->description)){ $disp_str.= $theat->description.' | '; }	
		//if(valset($theat->role)){ $disp_str.= $theat->role.' | '; }
		if(valset($theat->director)){ $disp_str.= $theat->director.' | '; }
		if(valset($theat->theater)){ $disp_str.= $theat->theater.' '; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php
	$count++;
        $last_from_year= $theat->from_year;
        $last_to_year= $theat->to_year;
			}							
			?>
		</div>
	</div>
	<?php
	}
?>
                      <?php
	$education_table = $wpdb->prefix . 'call_sheet_education';
	$education_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $education_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
	if(count($education_data) != 0){
	?>
<div>
		<button class="without_accordion"> Education</button>

	<?php
	
        $last_from_year='';
        $last_to_year='';
	foreach($education_data as $edu){
		
	?>
<div class="inner-block without_accordion-i-block-left">
    <span class="year">
        <?php 
         if($last_from_year==$edu->from_year && $last_to_year==$edu->to_year){}else{
         if(valset($edu->to_year)){echo $edu->to_year;}
         
         if(valset($edu->from_year)){ 
             if(valset($edu->to_year)){ 
                 echo '-'.substr($edu->from_year, -2); 
                 
             }else{ 
                 echo $edu->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
    </span>
	<?php if(valset($edu->education)){ ?><span class="name"><?php echo '  '.$edu->education?></span> <?php } ?>
</div>
	<?php
		
        $last_from_year= $edu->from_year;
        $last_to_year= $edu->to_year;
			}							
			?>
		
	</div>	
	<?php
	}
?>
		  	<div class="personal-info without_accordion-i-block">
                            <button class="without_accordion">personal</button>
				
					<?php 
					echo '<span class="left">';
					if( valset($bio_result->year_of_birth) ){
						echo date('Y',strtotime($bio_result->year_of_birth));
					}
					if( valset($bio_result->place_of_birth) ){ 
						echo ' '.$bio_result->place_of_birth; 
					} 
					echo '</span>';
					?>  

				<?php	
				$info_arr = array(
                                    'height' => 'height',
                                    'residence' => 'residence',
                                    'nationality' => 'nationality',
                                    'language' => 'languages',
                                    'hair_colour' => 'hair',
                                    'eye_colour' => 'eyes',
                                    'accents' => 'dialects / accents',
                                    'sports' => 'skills',
                                    'dancing' => 'skills',
                                    'license' => 'licence',
                                  //  'state' => 'federal state',
                                  //  'place_of_action' => 'place of action',
                                  //  'ethnic_appearance' => 'ethnic appearance',
                                  //  'hair_length' => 'hair length',
                                 //   'stature' => 'stature',
                                 //   'weight' => 'weight',
                                 //   'confection_size' => 'confection size',
                                 //   'singing' => 'singing',
                                 //   'voice_range' => 'voice range',
                                 //   'musical_instrument' => 'musical instrument',
                                 //   'professional_union' => 'professional union',
                                 //   'special_skills' => 'special skills',
                                 //   'short_text' => 'short text',
				);
				$class = 'right';
				
                                $last_val='';
				foreach( $info_arr as $key=>$val ){
                                    
					if(valset($bio_result->$key))
                                            if($val==$last_val){
						echo '<span class="extra_span_class">, '.rtrim($bio_result->$key,',').'</span></div>';
                                            }else if($val=="skills"){
                                                echo '<div class="skills-padding-set"><span class="'.$class.' extra_span_class_parent"> '.$val.' | '. str_replace(",",", ",trim($bio_result->$key,',')).'</span>';
                                            }else{
                                                 echo '<span class="'.$class.' ">'.$val.' | '.rtrim($bio_result->$key,',').'</span>';
                                            }
					$class = $class == 'left' ? 'right' : 'left';
					
					
                                        $last_val=$val;
				}
				?>
				
		  	</div>
<?php 
if($type=='director'){
    ?>
        <div>
		<button class="without_accordion"> Short Text</button>

<div class="inner-block without_accordion-i-block-left">
    
   
	<?php if(valset($bio_result->short_text)){ ?><span class="name"><?php echo $bio_result->short_text?></span> <?php } ?>
</div>

		
	</div>
        <?php
}

?>





<?php
$comm_table = $wpdb->prefix . 'call_sheet_commercial';
$comm_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $comm_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($comm_data) != 0){
?>
<div>
	<button class="accordion <?php if(count($comm_data)>5) echo "accordion_after"; ?>"> Commercials</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($comm_data as $comm){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$comm->from_year && $last_to_year==$comm->to_year){}else{
         if(valset($comm->to_year)){echo $comm->to_year;}
         
         if(valset($comm->from_year)){ 
             if(valset($comm->to_year)){ 
                 echo '-'.substr($comm->from_year, -2); 
                 
             }else{ 
                 echo $comm->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
	<?php
		$disp_str = '';
		if(valset($comm->commercial)){ $disp_str.= ' | '.$comm->commercial.' | '; }	
		if(valset($comm->description)){ $disp_str.= $comm->description.' | '; }	
		//if(valset($comm->role)){ $disp_str.= $comm->role.' | '; }
		if(valset($comm->director)){ $disp_str.= $comm->director.' | '; }
		if(valset($comm->casting)){ $disp_str.= $comm->casting.' | '; }
		if(valset($comm->production)){ $disp_str.= $comm->production.' '; }
		if(valset($comm->channel)){ $disp_str.= $comm->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php
		$count++;
        
        $last_from_year= $comm->from_year;
        $last_to_year= $comm->to_year;
			}							
			?>
		</div>
	</div>
	<?php
	}
?>

<?php
$audio_table = $wpdb->prefix . 'call_sheet_audio';
$audio_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $audio_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($audio_data) != 0){
?>
<div>
<button class="accordion <?php if(count($audio_data)>5) echo "accordion_after"; ?>"> AUDIO</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($audio_data as $aud){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$aud->from_year && $last_to_year==$aud->to_year){}else{
         if(valset($aud->to_year)){echo $aud->to_year;}
         
         if(valset($aud->from_year)){ 
             if(valset($aud->to_year)){ 
                 echo '-'.substr($aud->from_year, -2); 
                 
             }else{ 
                 echo $aud->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
	<?php
		$disp_str = '';
		if(valset($aud->audio)){ $disp_str.= ' | '.$aud->audio.' | '; }	
		if(valset($aud->description)){ $disp_str.= $aud->description.' | '; }	
		//if(valset($aud->role)){ $disp_str.= $aud->role.' | '; }
		if(valset($aud->director)){ $disp_str.= $aud->director.' | '; }
		if(valset($aud->casting)){ $disp_str.= $aud->casting.' | '; }
		if(valset($aud->production)){ $disp_str.= $aud->production.' '; }
		if(valset($aud->channel)){ $disp_str.= $aud->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php $count++;
        $last_from_year= $aud->from_year;
        $last_to_year= $aud->to_year;
			}
			?>
		</div>
	</div>
	<?php
	}
?>

<?php
$internet_table = $wpdb->prefix . 'call_sheet_internet';
$internet_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $internet_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($internet_data) != 0){
?>
<div>
<button class="accordion <?php if(count($internet_data)>5) echo "accordion_after"; ?>"> INTERNET</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($internet_data as $int){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$int->from_year && $last_to_year==$int->to_year){}else{
         if(valset($int->to_year)){echo $int->to_year;}
         
         if(valset($int->from_year)){ 
             if(valset($int->to_year)){ 
                 echo '-'.substr($int->from_year, -2); 
                 
             }else{ 
                 echo $int->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
	<?php
		$disp_str = '';
		if(valset($int->internet)){ $disp_str.= ' | '.$int->internet.' | '; }	
		if(valset($int->description)){ $disp_str.= $int->description.' | '; }	
		//if(valset($int->role)){ $disp_str.= $int->role.' | '; }
		if(valset($int->director)){ $disp_str.= $int->director.' | '; }
		if(valset($int->casting)){ $disp_str.= $int->casting.' | '; }
		if(valset($int->production)){ $disp_str.= $int->production.' '; }
		if(valset($int->channel)){ $disp_str.= $int->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php $count++;	
        $last_from_year= $int->from_year;
        $last_to_year= $int->to_year;
			}
			?>
		</div>
	</div>
	<?php
	}
?>

<?php
$other_table = $wpdb->prefix . 'call_sheet_other';
$other_data = $wpdb->get_results($wpdb->result("SELECT * FROM $other_table WHERE show_hide = %s AND client_id = %d ORDER BY position",'1',$client_id));
if(count($other_data) != 0){
?>
<div>
<button class="accordion <?php if(count($other_data)>5) echo "accordion_after"; ?>"> OTHER</button>
<div class="first-five">
	<?php
	$count = 0;
        $last_from_year='';
        $last_to_year='';
	foreach($other_data as $other){
		if($count == 5){ ?>
		</div><div class="panel">
		<?php }
	?>
<div class="inner-block">
	<span class="year">
	<?php 
         if($last_from_year==$other->from_year && $last_to_year==$other->to_year){}else{
         if(valset($other->to_year)){echo $other->to_year;}
         
         if(valset($other->from_year)){ 
             if(valset($other->to_year)){ 
                 echo '-'.substr($other->from_year, -2); 
                 
             }else{ 
                 echo $other->from_year; 
                 
             } 
             }
         }
         ?>
        </span>
	<?php
		$disp_str = '';
		if(valset($other->other)){ $disp_str.= ' | '.$other->other.' | '; }	
		if(valset($other->description)){ $disp_str.= $other->description.' | '; }	
		//if(valset($other->role)){ $disp_str.= $other->role.' | '; }
		if(valset($other->director)){ $disp_str.= $other->director.' | '; }
		if(valset($other->casting)){ $disp_str.= $other->casting.' | '; }
		if(valset($other->production)){ $disp_str.= $other->production.' '; }
		if(valset($other->channel)){ $disp_str.= $other->channel; }
		$disp_str = trim($disp_str, ' | ');
		if(valset($disp_str)){
	?>
		<span class="name"><?php echo $disp_str ?></span>
	<?php } ?>
</div>
	<?php $count++;
        $last_from_year= $other->from_year;
        $last_to_year= $other->to_year;
			}
			?>
		</div>
	</div>
	<?php
	}
?>

<?php
//$news_master = $wpdb->prefix . 'call_sheet_news';
//$news_data = $wpdb->get_row('SELECT * FROM '.$news_master.' WHERE client_id = '.$client_id);
//if(count($news_data) != 0){
?>
<!--
<div>
<button class="accordion"> NEWS </button>
<div class="panel">
	//<?php
//		for($i=1; $i<=6; $i++){
//			if(isset($news_data->{"news" . $i}) && !empty($news_data->{"news" . $i}))
//				echo "<span>".$news_data->{"news" . $i}."</span><br>";
//		}
//	?>
</div>
</div>-->
<?php	
//}
?>

								
		  </div>
	</div>
</div>


<!-- img-gallary -->

<div class="l-box">


<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal1()">&times;</span>
  <div class="modal-content">
	<?php
		// echo "image URL : <pre>";
		// print_r(wp_get_attachment_image_src( $photo_results[0]->attachment_id,'full'));
		// echo "</pre>";
		$counter = 1;
		foreach ($photo_results as $result) {
			$image_attributes_full=wp_get_attachment_image_src( $result->attachment_id,'full');
			//echo get_attached_file( $result->attachment_id );
			//print_r($image_attributes_full);
			?>
			<div class="mySlides" data-totalimg="<?php echo count($photo_results) ?>">
				<div class="numbertext"><?php echo '1 / '.count($photo_results)  ?></div>
				<img src="<?php echo $image_attributes_full[0] ?>" style="width:100%">
				    <a class="prev" onclick="plusSlides_img(-1)">&#10094;</a>
					<a class="next" onclick="plusSlides_img(1)">&#10095;</a>
				  <div class="caption-container">
				  <p id="caption"><?php echo $result->notes ?></p>
				  <a download="<?php echo $image_name ?>" href="<?php echo $image_attributes_full[0] ?>" class="d-btn"><i class="fa fa-download" aria-hidden="true"></i></a>
				</div>
			</div>
			<?php
			$counter++;
		}
	?>
	

	<?php
	foreach ($photo_results as $result) {
		$image_attributes_full=wp_get_attachment_image_src( $result->attachment_id,'full');
		$image_url = explode('/',$image_attributes_full[0]);
		$image_name = $image_url[count($image_url) - 1];
	?>
  
	<?php }	?>

<div class="bottom">
 <div class="bottom-inner mCustomScrollbar" data-mcs-theme="">
	<?php
		$counter = 1;
		foreach ($photo_results as $result) {		
			$image_attributes_full=wp_get_attachment_image_src( $result->attachment_id,'full');
			?>
			<div class="column">
				<img class="demo cursor" src="<?php echo $image_attributes_full[0] ?>" style="width:100%" onclick="currentSlide_img(<?php echo $counter ?>)" alt="image">
			</div>
			<?php
			$counter++;
		}
	?>
	</div>
</div>
  </div>
</div>
</div>

<!-- img-gallary -->

<!-- video-gallary -->

<div class="l-box">


<div id="myvideoModal" class="modal video-modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

<?php
	$video_master = $wpdb->prefix . 'call_sheet_video';
    $sql = $wpdb->prepare("SELECT * FROM $video_master where client_id=%d ORDER BY position",$client_id);
    $vdo_results       = $wpdb->get_results($sql);
    $count=1;
    
	if($vdo_results[0]->is_wordpress == 'yes'){
		$vdo_link = wp_get_attachment_url($vdo_results[0]->attachment_id);
        $image_jwplayer = wp_get_attachment_image_src( get_post_thumbnail_id( $vdo_results[0]->attachment_id ), 'full' );
        
        }
	else{
		$vdo_link =str_replace(".bin","/my-file.mp4",$vdo_results[0]->attachment_id);
        }
?>
      <script type="text/javascript" src="https://content.jwplatform.com/libraries/1viIMBzO.js"></script>
		<div class="myvideoSlides">
                    <!--<video class="myvideo" style="display: none;" controlsList="nodownload">  <source src="<?php echo $vdo_link ?>#t=0.5" type="video/mp4">  </video>-->
                    <div class="myvideo" id="jwplayer_myvideo"></div>
                    <script>
    jwplayer("jwplayer_myvideo").setup({
      file: "<?php echo $vdo_link ?>"
      
    });
</script>
                         <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            <div class="caption-container video_detail">
				  <p id="caption"><?php $full_post=get_post($vdo_results[0]->attachment_id); echo $full_post->post_content; ?></p>
				  <a download="<?php echo get_the_title( $vdo_results[0]->attachment_id) ?>" href="<?php echo $vdo_link ?>" class="d-btn"><i class="fa fa-download" aria-hidden="true"></i></a>
				</div>
		</div>

   

    
<div class="video-bottom bottom">
    <div class="video-bottom-inner mCustomScrollbar" data-mcs-theme="">
	<?php
        $count=1;
        foreach ($vdo_results as $result) {
		if($result->is_wordpress == 'yes')
			$vdo_link = wp_get_attachment_url($result->attachment_id);
		else
			$vdo_link = str_replace(".bin","/my-file.mp4",$result->attachment_id);
			?>
			 <div title_temp="<?php $full_post=get_post($result->attachment_id); echo $full_post->post_content; ?>" class="column vdo-thumb <?php echo $count==1 ? "playing first" : "" ?> <?php echo $count==count($vdo_results) ? "last" : "" ?> " data-url="<?php echo $vdo_link ?>">
                             <div class="video-thumb-title"><?php echo get_the_title( $result->attachment_id) ?></div>   
                             <?php if (has_post_thumbnail( $result->attachment_id ) ){
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $result->attachment_id ), 'full' ); ?>
                                    
                             <img class="videodemo cursor" onclick="currentSlide(<?php echo $count ?>)" src="<?php echo $image[0]; ?>"/> 
                                        <?php
                                }else{
                                  ?>
                             <video class="videodemo cursor" onclick="currentSlide(<?php echo $count ?>)">  <source src="<?php echo $vdo_link ?>#t=0.5" type="video/mp4">  </video>
                                      <?php  
                                }
                                    ?>
                             
			</div>
			<?php
		$count++;	
	}
	?>
</div>
</div>
  </div>
</div>
</div>

<!-- video-gallary -->

<!-- img-gallary-script -->

<?php
}else
	echo "No ".$pos[count($pos)-2]." Found"; 
// get_footer();
?>
<img src="<?php plugin_dir_url( __FILE__ ); ?>images/basics-cross-black.png" style="display: none;"/>
<a class="pause_slider" href="#" style="display: none !important">Pause Slider</a>
  <a class="play_slider" href="#" style="display: none  !important">Play Slider</a>
  <script>
                                    jQuery(document).ready(function(){
                                    jQuery(".mobile_menu_button").click(function(){
    jQuery(".mobile_menu").slideToggle();
});
});
                                    </script>
  <?php  if(wp_is_mobile()){ ?>
  <script>
  jQuery(document).ready(function(){
    jQuery(document).swipe( {
    //Generic swipe handler for all directions
    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
     
      if(direction=="left"){jQuery(".transparent-btns1_nav.prev").click();}
      if(direction=="right"){jQuery(".transparent-btns1_nav.next").click();}
    },
     threshold:20
  });
   jQuery(".rslides").responsiveSlides({
                                                        auto:false,
                                                        pager: true,
                                                        nav: true,
                                                        speed: 500,
                                                        namespace: "transparent-btns"
                                                  });
});
  </script>
  <?php } ?>
<?php
  if(!wp_is_mobile()){
                                                 ?><script>
                                                 jQuery(function() {
                                                    jQuery(".rslides").responsiveSlides({
                                                        auto: true,
                                                        timeout: 8000,  
                                                        pager: true,
                                                        nav: true,
                                                        speed: 500,
                                                        namespace: "transparent-btns"
                                                  });
                                                    });
                                </script>
                <?php
            } ?>
                                