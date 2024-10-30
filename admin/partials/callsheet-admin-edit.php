<?php



/**

 * Provide a admin area view for the plugin

 *

 * This file is used to markup the admin-facing aspects of the plugin.

 *

 * @link       https://callsheet.io

 * @since      1.0.0

 *

 * @package    Callsheet

 * @subpackage Callsheet/admin/partials

 */

?>

<script src="https://code.jquery.com/jquery-migrate-1.1.0.js"></script>

<?php

if ($_REQUEST['client_id'] == '') {

    $url = "admin.php?page=callsheet";

    ?>

    <script>

        window.location = "<?php echo $url; ?>";

    </script>

<?php exit();

} else {



    $client_id = filter_var($_REQUEST['client_id'], FILTER_VALIDATE_INT);

    global $wpdb;

    $client_master = $wpdb->prefix . 'call_sheet_client_master';

    $tags_master = $wpdb->prefix . 'call_sheet_tags_master';



    if (isset($_POST['save_basic_information'])) {

        $birthday = sanitize_text_field($_POST['day_of_birth']);

        $birthmonth = sanitize_text_field($_POST['month_of_birth']);

        $birthyear = sanitize_text_field($_POST['year_of_birth']);

        $birthplace = filter_var($_POST['place_of_birth'], FILTER_SANITIZE_STRING);

        $nationality_value = filter_var($_POST['nationality'], FILTER_SANITIZE_STRING);

        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);

        $residence = filter_var($_POST['residence'], FILTER_SANITIZE_STRING);

        $action_place = filter_var($_POST['place_of_action'], FILTER_SANITIZE_STRING);

        $ethnic_value = filter_var($_POST['ethnic_appearance'], FILTER_SANITIZE_STRING);

        $hair_colour_value = filter_var($_POST['hair_colour'], FILTER_SANITIZE_STRING);

        $hair_length_value = filter_var($_POST['hair_length'], FILTER_SANITIZE_STRING);

        $eye_colour_value = filter_var($_POST['eye_colour'], FILTER_SANITIZE_STRING);

        $stature_value = filter_var($_POST['stature'], FILTER_SANITIZE_STRING);

        $height_value = filter_var($_POST['height'], FILTER_SANITIZE_STRING);

        $weight_value = filter_var($_POST['weight'], FILTER_SANITIZE_STRING);

        $confection_size_value = filter_var($_POST['confection_size'], FILTER_SANITIZE_STRING);

        $language_value = filter_var($_POST['language'], FILTER_SANITIZE_STRING);

        $accents_value = filter_var($_POST['accents'], FILTER_SANITIZE_STRING);

        $singing_value = filter_var($_POST['singing'], FILTER_SANITIZE_STRING);

        $voice_range_value = filter_var($_POST['voice_range'], FILTER_SANITIZE_STRING);

        $musical_instrument_value = filter_var($_POST['musical_instrument'], FILTER_SANITIZE_STRING);

        $sports_value = filter_var($_POST['sports'], FILTER_SANITIZE_STRING);

        $dancing_value = filter_var($_POST['dancing'], FILTER_SANITIZE_STRING);

        $license_value = filter_var($_POST['license'], FILTER_SANITIZE_STRING);

        $professional_union_value = filter_var($_POST['professional_union'], FILTER_SANITIZE_STRING);

        $special_skills_value = filter_var($_POST['special_skills'], FILTER_SANITIZE_STRING);

        $genre_value = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);

        $agencies_value = filter_var($_POST['agencies'], FILTER_SANITIZE_STRING);

        $short_text_value = filter_var($_POST['short_text'], FILTER_SANITIZE_STRING);



        $year_of_birth = $birthday . '-' . $birthmonth . '-' . $birthyear;

        $wpdb->update(

            $client_master,

            array(

                'year_of_birth' => $year_of_birth,

                'place_of_birth' => $birthplace,

                'nationality' => $nationality_value,

                'state' => $state,

                'residence' => $residence,

                'place_of_action' => $action_place,

                'ethnic_appearance' => $ethnic_value,

                'hair_colour' => $hair_colour_value,

                'hair_length' => $hair_length_value,

                'eye_colour' => $eye_colour_value,

                'stature' => $stature_value,

                'height' => $height_value,

                'weight' => $weight_value,

                'confection_size' => $confection_size_value,

                'language' => $language_value,

                'accents' => $accents_value,

                'singing' => $singing_value,

                'voice_range' => $voice_range_value,

                'musical_instrument' => $musical_instrument_value,

                'sports' => $sports_value,

                'dancing' => $dancing_value,

                'license' => $license_value,

                'professional_union' => $professional_union_value,

                'special_skills' => $special_skills_value,

                'genre' => $genre_value,

                'agencies' => $agencies_value,

                'short_text' => $short_text_value

            ),

            array('client_id' => $client_id),

            '',

            ''

        );

        $social_master = $wpdb->prefix . 'call_sheet_social';

        $social_check_sql = $wpdb->prepare("SELECT client_id FROM $social_master WHERE client_id=%d", $client_id);

        $social_check_result       = $wpdb->get_row($social_check_sql);



        $facebook_value = filter_var($_POST['facebook'], FILTER_SANITIZE_URL);

        $instagram_value = filter_var($_POST['instagram'], FILTER_SANITIZE_URL);

        $youtube_value = filter_var($_POST['youTube'], FILTER_SANITIZE_URL);

        $snapchat_value = filter_var($_POST['snapchat'], FILTER_SANITIZE_URL);

        $twitter_value = filter_var($_POST['twitter'], FILTER_SANITIZE_URL);

        $pinterest_value = filter_var($_POST['pinterest'], FILTER_SANITIZE_URL);

        $linkedIn_value = filter_var($_POST['linkedIn'], FILTER_SANITIZE_URL);

        $google_plus_value = filter_var($_POST['google_plus'], FILTER_SANITIZE_URL);

        $tumblr_value = filter_var($_POST['tumblr'], FILTER_SANITIZE_URL);

        $reddit_value = filter_var($_POST['reddit'], FILTER_SANITIZE_URL);

        $flickr_value = filter_var($_POST['flickr'], FILTER_SANITIZE_URL);

        $swarm_by_foursquare_value = filter_var($_POST['swarm_by_foursquare'], FILTER_SANITIZE_URL);

        $kik_value = filter_var($_POST['kik'], FILTER_SANITIZE_URL);

        $shots_value = filter_var($_POST['shots'], FILTER_SANITIZE_URL);

        $periscope_value = filter_var($_POST['periscope'], FILTER_SANITIZE_URL);

        $medium_value = filter_var($_POST['medium'], FILTER_SANITIZE_URL);

        $soundCloud_value = filter_var($_POST['soundCloud'], FILTER_SANITIZE_URL);

        $musical_value = filter_var($_POST['musical'], FILTER_SANITIZE_URL);

        $homepage_value = filter_var($_POST['homepage'], FILTER_SANITIZE_URL);



        if ($wpdb->num_rows == 0) {

            $wpdb->insert($social_master, array(

                'facebook' => $facebook_value,

                'instagram' => $instagram_value,

                'youTube' => $youtube_value,

                'snapchat' => $snapchat_value,

                'twitter' => $twitter_value,

                'pinterest' => $pinterest_value,

                'linkedIn' => $linkedIn_value,

                'google_plus' => $google_plus_value,

                'tumblr' => $tumblr_value,

                'reddit' => $reddit_value,

                'flickr' => $flickr_value,

                'swarm_by_foursquare' => $swarm_by_foursquare_value,

                'kik' => $kik_value,

                'shots' => $shots_value,

                'periscope' => $periscope_value,

                'medium' => $medium_value,

                'soundCloud' => $soundCloud_value,

                'musical' => $musical_value,

                'homepage' => $homepage_value,

                'client_id' => $client_id

            ));

        } else {

            $wpdb->update(

                $social_master,

                array(

                    'facebook' => $facebook_value,

                    'instagram' => $instagram_value,

                    'youTube' => $youtube_value,

                    'snapchat' => $snapchat_value,

                    'twitter' => $twitter_value,

                    'pinterest' => $pinterest_value,

                    'linkedIn' => $linkedIn_value,

                    'google_plus' => $google_plus_value,

                    'tumblr' => $tumblr_value,

                    'reddit' => $reddit_value,

                    'flickr' => $flickr_value,

                    'swarm_by_foursquare' => $swarm_by_foursquare_value,

                    'kik' => $kik_value,

                    'periscope' => $periscope_value,

                    'shots' => $shots_value,

                    'medium' => $medium_value,

                    'soundCloud' => $soundCloud_value,

                    'homepage' => $homepage_value,

                    'musical' => $musical_value

                ),

                array('client_id' => $client_id),

                '',

                ''

            );

        }

    }

    //sync_api



    //nationality suggestion

    $nationality_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'nationality');

    $nationality_result       = $wpdb->get_row($nationality_sql);

    $nationality_array = explode(',', $nationality_result->tags_value);

    $is_nationality_new = false;



    //place_of_action suggestion

    $place_of_action_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'place_of_action');

    $place_of_action_result       = $wpdb->get_row($place_of_action_sql);

    $place_of_action_array = explode(',', $place_of_action_result->tags_value);

    $is_place_of_action_new = false;

    //ethnic_appearance suggestion

    $ethnic_appearance_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'ethnic_appearance');

    $ethnic_appearance_result       = $wpdb->get_row($ethnic_appearance_sql);

    $ethnic_appearance_array = explode(',', $ethnic_appearance_result->tags_value);

    $is_ethnic_appearance_new = false;

    //language suggestion

    $language_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'language');

    $language_result       = $wpdb->get_row($language_sql);

    $language_array = explode(',', $language_result->tags_value);

    $is_language_new = false;

    //accents suggestion

    $accents_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'accents');

    $accents_result       = $wpdb->get_row($accents_sql);

    $accents_array = explode(',', $accents_result->tags_value);

    $is_accents_new = false;

    //singing suggestion

    $singing_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'singing');

    $singing_result       = $wpdb->get_row($singing_sql);

    $singing_array = explode(',', $singing_result->tags_value);

    $is_singing_new = false;

    //musical_instrument suggestion

    $musical_instrument_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'musical_instrument');

    $musical_instrument_result       = $wpdb->get_row($musical_instrument_sql);

    $musical_instrument_array = explode(',', $musical_instrument_result->tags_value);

    $is_musical_instrument_new = false;

    //sports suggestion

    $sports_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'sports');

    $sports_result       = $wpdb->get_row($sports_sql);

    $sports_array = explode(',', $sports_result->tags_value);

    $is_sports_new = false;

    //dancing suggestion

    $dancing_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'dancing');

    $dancing_result       = $wpdb->get_row($dancing_sql);

    $dancing_array = explode(',', $dancing_result->tags_value);

    $is_dancing_new = false;

    //license suggestion

    $license_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'license');

    $license_result       = $wpdb->get_row($license_sql);

    $license_array = explode(',', $license_result->tags_value);

    $is_license_new = false;

    //professional_union suggestion

    $professional_union_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'professional_union');

    $professional_union_result       = $wpdb->get_row($professional_union_sql);

    $professional_union_array = explode(',', $professional_union_result->tags_value);

    $is_professional_union_new = false;

    //genre suggestion

    $genre_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'genre');

    $genre_result       = $wpdb->get_row($genre_sql);

    $genre_array = explode(',', $genre_result->tags_value);

    $is_genre_new = false;

    //agencies suggestion

    $agencies_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'agencies');

    $agencies_result       = $wpdb->get_row($agencies_sql);

    $agencies_array = explode(',', $agencies_result->tags_value);

    $is_agencies_new = false;



    //state suggestion

    $state_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'state');

    $state_result       = $wpdb->get_row($state_sql);

    $state_array = explode(',', $state_result->tags_value);

    $is_state_new = false;

    //residence suggestion

    $residence_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'residence');

    $residence_result       = $wpdb->get_row($residence_sql);

    $residence_array = explode(',', $residence_result->tags_value);

    $is_residence_new = false;

    //hair_colour suggestion

    $hair_colour_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'hair_colour');

    $hair_colour_result       = $wpdb->get_row($hair_colour_sql);

    $hair_colour_array = explode(',', $hair_colour_result->tags_value);

    $is_hair_colour_new = false;

    //hair_length suggestion

    $hair_length_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'hair_length');

    $hair_length_result       = $wpdb->get_row($hair_length_sql);

    $hair_length_array = explode(',', $hair_length_result->tags_value);

    $is_hair_length_new = false;

    //voice_range suggestion

    $voice_range_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'voice_range');

    $voice_range_result       = $wpdb->get_row($voice_range_sql);

    $voice_range_array = explode(',', $voice_range_result->tags_value);

    $is_voice_range_new = false;

    //eye_colour suggestion

    $eye_colour_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'eye_colour');

    $eye_colour_result       = $wpdb->get_row($eye_colour_sql);

    $eye_colour_array = explode(',', $eye_colour_result->tags_value);

    $is_eye_colour_new = false;

    //stature suggestion

    $stature_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'stature');

    $stature_result       = $wpdb->get_row($stature_sql);

    $stature_array = explode(',', $stature_result->tags_value);

    $is_stature_new = false;

    //confection_size suggestion

    $confection_size_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'confection_size');

    $confection_size_result       = $wpdb->get_row($confection_size_sql);

    $confection_size_array = explode(',', $confection_size_result->tags_value);

    $is_confection_size_new = false;

    //place_of_birth suggestion

    $place_of_birth_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s", 'place_of_birth');

    $place_of_birth_result       = $wpdb->get_row($place_of_birth_sql);

    $place_of_birth_array = explode(',', $place_of_birth_result->tags_value);

    $is_place_of_birth_new = false;



    $sql = $wpdb->prepare("SELECT * FROM $client_master WHERE client_id=%d limit 1", $client_id);

    $result = $wpdb->get_row($sql) or die(mysql_error());

    $temp_array = explode('-', $result->year_of_birth);

    $day_of_birth = $temp_array[0];

    $month_of_birth = (isset($temp_array[1])) ? $temp_array[1] : null;

    $year_of_birth = (isset($temp_array[2])) ? $temp_array[2] : null;



    $photo_master = $wpdb->prefix . 'call_sheet_photo';

    $sql_image           = $wpdb->prepare("SELECT attachment_id FROM $photo_master WHERE client_id=%d and profile=%s order by position limit 1", $client_id, '1');

    $result_image       = $wpdb->get_row($sql_image);



    if (!isset($result_image->attachment_id) || $result_image->attachment_id == '') {

        $image_attributes[0] = 'https://www.w3schools.com/bootstrap/img_avatar1.png';

    } else {

        $image_attributes = wp_get_attachment_image_src($result_image->attachment_id, 'thumbnail');

    }

    if ($result->type == 'Director') {

        $is_director = true;

    } else {

        $is_director = false;

    }

    $sync_api = (isset($result->sync_api) && $result->sync_api != 1) ? 0 : 1;

}

$sulg_url = '';

//actress

if (get_option('nisl_actress_url') != false) {

    $actress_url = get_post_field('post_name', get_option('nisl_actress_url'));

} else {

    $actress_url = 'actress';

}

//writer

if (get_option('nisl_writer_url') != false) {

    $writer_url = get_post_field('post_name', get_option('nisl_writer_url'));

} else {

    $writer_url = 'cinematographers-writers';

}

//actor

if (get_option('nisl_actor_url') != false) {

    $actor_url = get_post_field('post_name', get_option('nisl_actor_url'));

} else {

    $actor_url = 'actor';

}

//director

if (get_option('nisl_director_url') != false) {

    $director_url = get_post_field('post_name', get_option('nisl_director_url'));

} else {

    $director_url = 'director';

}

//cinematographer

if (get_option('nisl_cinematographer_url') != false) {

    $cinemato_url = get_post_field('post_name', get_option('nisl_cinematographer_url'));

} else {

    $cinemato_url = 'cinematographers-writers';

}





if ($result->type == 'Actress') {

    $sulg_url = get_option('siteurl') . '/' . $actress_url . '/' . $result->slug;

}

if ($result->type == 'Actor') {

    $sulg_url = get_option('siteurl') . '/' . $actor_url . '/' . $result->slug;

}

if ($result->type == 'Cinematographer') {

    $sulg_url = get_option('siteurl') . '/' . $cinemato_url . '/' . $result->slug;

}

if ($result->type == 'Writer') {

    $sulg_url = get_option('siteurl') . '/' . $writer_url . '/' . $result->slug;

}

if ($result->type == 'Director') {

    $sulg_url = get_option('siteurl') . '/' . $director_url . '/' . $result->slug;

}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="edit_form inner-wrap">

    <div class="autosave" style="text-align:center;"></div>

    <div class="form-title">

        <div class="media custom_edit_form">

            <div class="media-left">

                <a class="clickphotostab">

                    <img src="<?php echo $image_attributes[0]; ?>" class="media-object" style="width:60px">

                    <span class="overlayphotos">Change Photo</span>

                </a>

            </div>

            <div class="media-body">

                <h4 class="media-heading"><span><?php echo stripslashes($result->first_name) . ' ' . stripslashes($result->last_name); ?></span> <a><i class="fa fa-pencil edit_form_btn" aria-hidden="true" id="<?php echo $client_id; ?>"></i></a></h4>

                <p class="desig">

                    <span><?php echo $result->type; ?></span>

                    <span>

                        <?php if ($result->show_hide == '0') { ?>

                            <img src="<?php echo plugin_dir_url(__DIR__); ?>image/offline-icon.png" width="15px" height="15px" title="This user is hidden. This will not be displayed on frontend">

                        <?php

                        } else {

                            ?>

                            <img src="<?php echo plugin_dir_url(__DIR__); ?>image/online-icon.png" width="15px" height="15px" title="This will be displayed on frontend">

                        <?php

                        } ?>

                    </span>

                </p>

                <p class="desig"><?php echo $result->slug; ?><a target="_blank" href="<?php echo $sulg_url; ?>/" style="margin-left: 10px;"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>

            </div>



        </div>

    </div>

    <ul class="nav nav-tabs tabs_class">

        <li class="active"><a data-toggle="tab" href="#basic_information"><?php _e('Basic', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_on_social" href="#social"><?php _e('Links', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_on_air" href="#on_air"><?php _e('On Air', 'callsheet'); ?></a></li>

        <!-- <li><a data-toggle="tab" id="get_on_stage" href="#on_stage"><?php _e('On Stage', 'callsheet'); ?></a></li> -->

        <li><a data-toggle="tab" id="get_news" href="#news"><?php _e('Press', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_photos" href="#photos"><?php _e('Photos', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_video" href="#video"><?php _e('Videos', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_education" href="#education"><?php _e('Education', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_awards" href="#awards"><?php _e('Awards', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_film" href="#film"><?php _e('Movie', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_tv" href="#tv"><?php _e('TV', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_theater" href="#theater"><?php _e('Theater', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_commercial" href="#commercial"><?php _e('Commercial', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_audio" href="#audio"><?php _e('Audio', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_internet" href="#internet"><?php _e('Internet', 'callsheet'); ?></a></li>

        <li><a data-toggle="tab" id="get_other" href="#other"><?php _e('Other', 'callsheet'); ?></a></li>





    </ul>



    <div class="tab-content">

        <div id="basic_information" class="tab-pane fade in active">

            <form class="form-horizontal basic_info_form" action="" method="post">

                <div class="row">

                    <div class="form-group col-md-12">

                        <label class="control-label col-sm-2" for="nationality"><?php _e('Nationality', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="nationality" placeholder="" name="nationality" value="<?php echo $result->nationality; ?>">

                        </div>

                    </div>

                    <?php if (!$is_director) { ?>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="ethnic_appearance"><?php _e('Ethnic appearance', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="ethnic_appearance" placeholder="" name="ethnic_appearance" value="<?php echo $result->ethnic_appearance; ?>">

                            </div>

                        </div>



                    <?php } ?>

                    <div class="form-group col-md-12">

                        <label class="control-label col-sm-2" for="residence"><?php _e('1st residence', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="residence" placeholder="" name="residence" value="<?php echo $result->residence; ?>">



                        </div>

                    </div>

                    <div class="form-group col-md-12">

                        <label class="control-label col-sm-2" for="state"><?php _e('(Federal) State', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="state" placeholder="" name="state" value="<?php echo $result->state; ?>">



                        </div>

                    </div>

                    <?php if (!$is_director) { ?>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="place_of_action"><?php _e('Place of action', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="place_of_action" placeholder="" name="place_of_action" value="<?php echo $result->place_of_action; ?>">

                            </div>

                        </div>

                    <?php } ?>

                    <div class="form-group col-sm-12">



                        <label class="control-label col-sm-2" for="Place of Birth"><?php _e('Place of Birth', 'callsheet'); ?> :</label>

                        <div class="b-place col-sm-8">

                            <input type="text" class="form-control" id="place_of_birth" placeholder="" name="place_of_birth" value="<?php echo $result->place_of_birth; ?>">



                        </div>

                    </div>

                    <div class="form-group col-md-12">

                        <label class="control-label col-sm-2" for="year_of_birth"><?php _e('Year of birth', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <div class="date-dd">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <input type="text" style="width: 28%;display: inline-block;" class="form-control" id="day_of_birth" placeholder="<?php _e('Day', 'callsheet'); ?>" name="day_of_birth" value="<?php echo $day_of_birth; ?>">

                                <input type="text" style="width: 28%;display: inline-block;" class="form-control" id="month_of_birth" placeholder="<?php _e('Month', 'callsheet'); ?>" name="month_of_birth" value="<?php echo $month_of_birth; ?>">

                                <input type="text" style="width: 35%;display: inline-block;" class="form-control" id="year_of_birth" placeholder="<?php _e('Year', 'callsheet'); ?>" name="year_of_birth" value="<?php echo $year_of_birth; ?>">

                            </div>



                        </div>

                    </div>



                    <?php if (!$is_director) { ?>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="height"><?php _e('Height', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="height" placeholder="" name="height" value="<?php echo $result->height; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="weight"><?php _e('Weight', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="weight" placeholder="" name="weight" value="<?php echo $result->weight; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="stature"><?php _e('Stature', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="stature" placeholder="" name="stature" value="<?php echo $result->stature; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="confection_size"><?php _e('Confection size', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="confection_size" placeholder="" name="confection_size" value="<?php echo $result->confection_size; ?>">



                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="hair_colour"><?php _e('Hair colour', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="hair_colour" placeholder="" name="hair_colour" value="<?php echo $result->hair_colour; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="hair_length"><?php _e('Hair length', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="hair_length" placeholder="" name="hair_length" value="<?php echo $result->hair_length; ?>">



                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="eye_colour"><?php _e('Eye colour', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="eye_colour" placeholder="" name="eye_colour" value="<?php echo $result->eye_colour; ?>">



                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="voice_range"><?php _e('Voice range', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="voice_range" placeholder="" name="voice_range" value="<?php echo $result->voice_range; ?>">



                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="professional_union"><?php _e('Professional union', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="professional_union" placeholder="" name="professional_union" value="<?php echo $result->professional_union; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="short_text"><?php _e('Short text', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <textarea class="form-control summernote-short-text" rows="5" id="short_text" name="short_text"><?php echo $result->short_text; ?></textarea>

                            </div>

                        </div>



                        <div class="skills_section col-md-12">

                            <h3>SKILLS</h3>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="sports"><?php _e('Sports', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="sports" placeholder="" name="sports" value="<?php echo $result->sports; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="license"><?php _e('License', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="license" placeholder="" name="license" value="<?php echo $result->license; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="musical_instrument"><?php _e('Musical instrument', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="musical_instrument" placeholder="" name="musical_instrument" value="<?php echo $result->musical_instrument; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="singing"><?php _e('Singing', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="singing" placeholder="" name="singing" value="<?php echo $result->singing; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="dancing"><?php _e('Dancing', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="dancing" placeholder="" name="dancing" value="<?php echo $result->dancing; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="language"><?php _e('Language(s)', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="language" placeholder="" name="language" value="<?php echo $result->language; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="accents"><?php _e('Dialects / accents', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="accents" placeholder="" name="accents" value="<?php echo $result->accents; ?>">

                            </div>

                        </div>



                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="special_skills"><?php _e('Special skills', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <textarea class="form-control summernote-special-skills" rows="5" id="special_skills" name="special_skills"><?php echo $result->special_skills; ?></textarea>

                            </div>

                        </div>

                    <?php } ?>

                </div>





                <?php if ($is_director) {

                    ?>

                    <div class="row">

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="language"><?php _e('Language(s)', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="language_director" placeholder="" name="language" value="<?php echo $result->language; ?>">

                            </div>

                        </div>

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="genre"><?php _e('Genre', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="genre" placeholder="" name="genre" value="<?php echo $result->genre; ?>">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-12">

                            <label class="control-label col-sm-2" for="short_text"><?php _e('Short text', 'callsheet'); ?> :</label>

                            <div class="col-sm-8">

                                <textarea class="form-control summernote-short-text" rows="5" id="short_text" name="short_text"><?php echo $result->short_text; ?></textarea>

                            </div>

                        </div>

                    </div>

                <?php



                } ?>





                <!--<div class="row">

                    <div class="form-group"> 

                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-default save_information" name="save_basic_information">Save Information</button>

                    </div>

                </div>

                </div> -->



            </form>



        </div>



        <div id="education" class="tab-pane fade education">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="education-number-records" id="education-number-records" class="education-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default education_add_click" data-toggle="modal" data-target="#education_add"><?php _e('', 'callsheet'); ?>Add New Record</button>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered education_table">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Education', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="education_add" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for Education', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_education_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="from_month" name="from_month">

                                            <option value=""></option>

                                            <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="from_year" name="from_year">

                                            <option value=""></option>

                                            <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="to_month" name="to_month">

                                            <option value=""></option>

                                            <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="to_year" name="to_year">

                                            <option value=""></option>

                                            <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="education"></label>

                                    <div class="col-sm-12">

                                        <textarea class="form-control summernote" rows="3" id="education_editor" placeholder="" name="education"></textarea>

                                    </div>

                                </div>

                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default education_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="education_edit" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Education', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default education_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->

        </div>







        <div id="awards" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="awards-number-records" id="awards-number-records" class="awards-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default awards_add_click" data-toggle="modal" data-target="#awards_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered awards_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="awards_add" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for awards', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_awards_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="from_month" name="from_month">

                                            <option value=""></option>

                                            <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="from_year" name="from_year">

                                            <option value=""></option>

                                            <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="to_month" name="to_month">

                                            <option value=""></option>

                                            <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                    <div class="col-sm-3">

                                        <select class="form-control" id="to_year" name="to_year">

                                            <option value=""></option>

                                            <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="awards"></label>

                                    <div class="col-sm-12">

                                        <textarea class="form-control summernote" rows="3" id="awards" placeholder="" name="awards"></textarea>

                                    </div>

                                </div>

                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default awards_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="awards_edit" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Awards', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default awards_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->



        </div>



        <div id="film" class="tab-pane fade">



            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="film-number-records" id="film-number-records" class="film-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#film_add"><?php _e('', 'callsheet'); ?>Add New Record</button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered film_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Film', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Distributor', 'callsheet'); ?></th>

                            <th><?php _e('Category', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="film_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for Movie', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_film_form">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="film"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="film" placeholder="" name="film"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Distributor', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Category', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" id="category" name="category" class="form-control" placeholder="" />



                                            <!-- <input type="text" class="form-control"  id="channel" placeholder="" name="channel"/> -->

                                        </div>

                                    </div>



                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default film_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="film_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Film', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default film_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->



        </div>



        <div id="tv" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="tv-number-records" id="tv-number-records" class="tv-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#tv_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered tv_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month', 'callsheet'); ?>)</th>

                            <th><?php _e('TV', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Channel', 'callsheet'); ?></th>

                            <th><?php _e('Category', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="tv_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for tv', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_tv_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="tv"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="tv" placeholder="" name="tv"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Category', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" id="category" name="category" class="form-control" placeholder="" />



                                            <!-- <input type="text" class="form-control"  id="channel" placeholder="" name="channel"/> -->

                                        </div>

                                    </div>



                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default tv_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="tv_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Film', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default tv_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->



        </div>



        <div id="theater" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="theater-number-records" id="theater-number-records" class="theater-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#theater_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered theater_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Title', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Author', 'callsheet'); ?></th>

                            <th><?php _e('Theater', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="theater_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for theater', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_theater_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="title"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="title" placeholder="" name="title"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>





                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="theater"><?php _e('Theater', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="theater" placeholder="" name="theater"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="author"><?php _e('Author', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="author" placeholder="" name="author" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default theater_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="theater_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for theater', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default theater_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->





        </div>



        <div id="commercial" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="commercial-number-records" id="commercial-number-records" class="commercial-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#commercial_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered commercial_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Commercial', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Channel', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="commercial_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('', 'callsheet'); ?>Add new Record for commercial</h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_commercial_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="commercial"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="commercial" placeholder="" name="commercial"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default commercial_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="commercial_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Commercial', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default commercial_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->



        </div>



        <div id="audio" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="audio-number-records" id="audio-number-records" class="audio-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#audio_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered audio_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Audio', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Channel', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="audio_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for audio', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_audio_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="audio"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="audio" placeholder="" name="audio"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default audio_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="audio_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Audio', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default audio_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->







        </div>



        <div id="internet" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="internet-number-records" id="internet-number-records" class="internet-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#internet_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered internet_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Internet', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Channel', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="internet_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for internet', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_internet_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="internet"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="internet" placeholder="" name="internet"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default internet_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="internet_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Internet', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default internet_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->











        </div>



        <div id="other" class="tab-pane fade">

            <div class="total-records">

                <label>Select records to display on frontend</label>

                <select name="other-number-records" id="other-number-records" class="other-records">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>

            </div>

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#other_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table  table-bordered other_table ">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('From (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('To (Year/Month)', 'callsheet'); ?></th>

                            <th><?php _e('Other', 'callsheet'); ?></th>

                            <th><?php _e('Awards', 'callsheet'); ?></th>

                            <th><?php _e('Description', 'callsheet'); ?></th>

                            <th><?php _e('Role', 'callsheet'); ?></th>

                            <th><?php _e('Director', 'callsheet'); ?></th>

                            <th><?php _e('Casting', 'callsheet'); ?></th>

                            <th><?php _e('Production', 'callsheet'); ?></th>

                            <th><?php _e('Channel', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="other_add" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for other', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_other_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_month" name="from_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="from_year" name="from_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_month" name="to_month">

                                                <option value=""></option>

                                                <?php for ($i = 1; $i <= 12; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="to_year" name="to_year">

                                                <option value=""></option>

                                                <?php for ($i = 2025; $i >= 1900; $i--) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="other"><?php _e('Title', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="3" id="other" placeholder="" name="other"></textarea>

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description" placeholder="" name="description"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="role" placeholder="" name="role" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="director" placeholder="" name="director" />

                                        </div>

                                    </div>



                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="casting" placeholder="" name="casting" />

                                        </div>

                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="production" placeholder="" name="production" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <input type="text" class="form-control" id="channel" placeholder="" name="channel" />

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>

                                        <div class="col-sm-8">

                                            <textarea class="form-control" rows="2" id="description_main" placeholder="" name="description_main"></textarea>

                                        </div>

                                    </div>

                                </div>



                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default other_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="other_edit" role="dialog">

                <div class="modal-dialog modal-lg">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Other', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default other_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->

        </div>



        <div id="social" class="tab-pane fade">

            <form class="form-horizontal press_agencies_form" method="post">



                <div class="row">

                    <h3><?php _e('Agency', 'callsheet'); ?> </h3>

                    <div class="form-group col-md-12">

                        <!-- <div class="col-sm-3">

                            <label class="control-label" for="facebook"><?php _e('Agency Name', 'callsheet'); ?> :</label>

                            

                                <input type="text" class="form-control" id="agencies" placeholder="" name="agencies" value="<?php echo $result->agencies; ?>">

                           

                            

                        </div> -->

                        <button type="button" class="btn btn-default" id="add_new_agency">Add new</button>

                        <div id="TextBoxesGroup">

                            <?php



                            $counter = 1;



                            ?>

                        </div>

                        <button type="button" class="btn btn-default on_save_agency green">Submit</button>

                    </div>

                </div>



            </form>

            <form class="form-horizontal social_info_form" action="" method="post">

                <?php

                $social_master = $wpdb->prefix . 'call_sheet_social';

                $sql_social  = $wpdb->prepare("SELECT * FROM $social_master WHERE client_id=%d", $result->client_id);



                $result_social = $wpdb->get_row($sql_social);

                ?>

                <div class="row">

                    <h3><?php _e('Social Links', 'callsheet'); ?> </h3>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="facebook"><?php _e('Facebook', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php if (isset($result->client_id)) echo $result->client_id; ?>">

                            <input type="text" class="form-control website" name="facebook" value="<?php if (isset($result_social->facebook)) echo $result_social->facebook; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="instagram"><?php _e('Instagram', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="instagram" value="<?php if (isset($result_social->instagram)) echo $result_social->instagram; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="youTube"><?php _e('YouTube', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="youTube" value="<?php if (isset($result_social->youTube)) echo $result_social->youTube; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="snapchat"><?php _e('Snapchat', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="snapchat" value="<?php if (isset($result_social->snapchat)) echo $result_social->snapchat; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="twitter"><?php _e('Twitter', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="twitter" value="<?php if (isset($result_social->twitter)) echo $result_social->twitter; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="pinterest"><?php _e('Pinterest', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="pinterest" value="<?php if (isset($result_social->pinterest)) echo $result_social->pinterest; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="linkedIn"><?php _e('LinkedIn', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="linkedIn" value="<?php if (isset($result_social->linkedIn)) echo $result_social->linkedIn; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="google_plus"><?php _e('Google Plus', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="google_plus" value="<?php if (isset($result_social->google_plus)) echo $result_social->google_plus; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="tumblr"><?php _e('Tumblr', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="tumblr" value="<?php if (isset($result_social->tumblr)) echo $result_social->tumblr; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="reddit"><?php _e('Reddit', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="reddit" value="<?php if (isset($result_social->reddit)) echo $result_social->reddit; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="flickr"><?php _e('Flickr', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="flickr" value="<?php if (isset($result_social->flickr)) echo $result_social->flickr; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="swarm_by_foursquare"><?php _e('Swarm By Foursquare', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="swarm_by_foursquare" value="<?php if (isset($result_social->swarm_by_foursquare)) echo $result_social->swarm_by_foursquare; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="kik"><?php _e('Kik', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="kik" value="<?php if (isset($result_social->kik)) echo $result_social->kik; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="shots"><?php _e('Shots', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="shots" value="<?php if (isset($result_social->shots)) echo $result_social->shots; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="periscope"><?php _e('Periscope', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="periscope" value="<?php if (isset($result_social->periscope)) echo $result_social->periscope; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="medium"><?php _e('Medium', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="medium" value="<?php if (isset($result_social->medium)) echo $result_social->medium; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="soundCloud"><?php _e('SoundCloud', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="soundCloud" value="<?php if (isset($result_social->soundCloud)) echo $result_social->soundCloud; ?>">

                        </div>

                    </div>

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="musical"><?php _e('Musical.ly', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="musical" value="<?php if (isset($result_social->musical)) echo $result_social->musical; ?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label class="control-label col-sm-4" for="Homepage"><?php _e('Homepage', 'callsheet'); ?> :</label>

                        <div class="col-sm-8">

                            <input type="text" class="form-control website" name="homepage" value="<?php if (isset($result_social->homepage)) echo $result_social->homepage; ?>">

                        </div>

                    </div>



                </div>

            </form>

        </div>

        <div id="news" class="tab-pane fade news">

            <div class="add-btn">

                <button class="btn btn-default news_add_click" data-toggle="modal" data-target="#news_add"><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered news_table">

                    <thead>

                        <tr>

                            <th><?php _e('Sr No', 'callsheet'); ?></th>

                            <th><?php _e('Press', 'callsheet'); ?></th>

                            <th><?php _e('Action', 'callsheet'); ?></th>

                        </tr>

                    </thead>

                    <tbody>



                    </tbody>

                </table>

            </div>

            <!-- Modal -->

            <div class="modal fade" id="news_add" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Add new Record for Press', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <form class="form-horizontal add_news_form">

                                <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php if (isset($result->client_id)) echo $result->client_id; ?>">

                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="news"></label>

                                    <div class="col-sm-12">

                                        <textarea class="form-control summernote" rows="3" id="news_editor" placeholder="" name="news"></textarea>

                                    </div>

                                </div>

                            </form>

                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default news_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>



            <div class="modal fade" id="news_edit" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Edit Record for Press', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">



                        </div>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-default news_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>





                </div>



            </div>

            <!-- Modal -->

        </div>



        <div id="on_air" class="tab-pane fade on_air">

            <div class="on-screen-section">

                <h3><?php _e('On Screen', 'callsheet'); ?></h3>

                <div class="add-btn">

                    <button class="btn btn-default on_air_add_click" data-toggle="modal" data-target="#on_air_add"><?php _e('Add New Record', 'callsheet'); ?></button>

                </div>



                <div class="table-responsive">

                    <table class="table table-bordered on_air_table">

                        <thead>

                            <tr>

                                <th><?php _e('Sr No', 'callsheet'); ?></th>

                                <th><?php _e('Image', 'callsheet'); ?></th>

                                <th><?php _e('From Date', 'callsheet'); ?></th>

                                <th><?php _e('To Date', 'callsheet'); ?></th>

                                <th><?php _e('Time', 'callsheet'); ?></th>

                                <th><?php _e('On Screen', 'callsheet'); ?></th>

                                <th><?php _e('Title', 'callsheet'); ?></th>

                                <th><?php _e('Role', 'callsheet'); ?></th>

                                <th><?php _e('Director', 'callsheet'); ?></th>

                                <th><?php _e('Channel', 'callsheet'); ?></th>

                                <th><?php _e('Action', 'callsheet'); ?></th>

                                <th><?php _e('Show Always', 'callsheet'); ?>

                                    <!-- <br><span style="font-size: 10px;"><?php _e('(check to show always on frontend)', 'callsheet'); ?></span> -->

                                </th>

                            </tr>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

                <!-- Modal -->

                <div class="modal fade" id="on_air_add" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Add new Record for On Screen', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal add_on_air_form">

                                    <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            From date: <input type="date" class="form-control" id="on_air_date" placeholder="" name="on_air_date" />

                                        </div>

                                        <div class="col-sm-6">

                                            <input type="time" class="form-control" id="on_air_time" placeholder="" name="on_air_time" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            To date: <input type="date" class="form-control" id="on_air_to_date" placeholder="" name="on_air_to_date" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air"><?php _e('Text On Screen', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <textarea class="form-control summernote" rows="3" id="on_air_editor" placeholder="" name="on_air"></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air_image"><?php _e('Upload Image', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <div class="upload-img">

                                                <a href="#" class="btn btn-default on_air_upload_image_button button"><span class="wp-media-buttons-icon"><?php _e('Add Image', 'callsheet'); ?></span></a>

                                                <input type="hidden" id="on_air_image" name="on_air_image">

                                                <a href="#" class="on_air_remove_image_button remove" style="display:none;"><i class="fa fa-times"></i></a>

                                            </div>



                                        </div>

                                    </div>

                                    <hr style="border-color: #B6B6B7;" />

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air_title"><?php _e('Title', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control on_air_title" id="on_air_title" placeholder="" name="on_air_title" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air_role"><?php _e('Role', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_air_role" placeholder="" name="on_air_role" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air_director"><?php _e('Director', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_air_director" placeholder="" name="on_air_director" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_air_channel"><?php _e('Channel/Distributor', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_air_channel" placeholder="" name="on_air_channel" />

                                        </div>

                                    </div>

                                </form>

                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_air_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>



                <div class="modal fade" id="on_air_edit" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Edit Record for On Screen', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">



                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_air_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>

                <!-- Modal -->

            </div><!-- on screen section over -->



            <div class="on-tv-section">

                <h3><?php _e('On Tv', 'callsheet'); ?></h3>

                <div class="add-btn">

                    <button class="btn btn-default on_tv_add_click" data-toggle="modal" data-target="#on_tv_add"><?php _e('Add New Record', 'callsheet'); ?></button>

                </div>



                <div class="table-responsive">

                    <table class="table table-bordered on_tv_table">

                        <thead>

                            <tr>

                                <th><?php _e('Sr No', 'callsheet'); ?></th>

                                <th><?php _e('Image', 'callsheet'); ?></th>

                                <th><?php _e('From Date', 'callsheet'); ?></th>

                                <th><?php _e('To Date', 'callsheet'); ?></th>

                                <th><?php _e('Time', 'callsheet'); ?></th>

                                <th><?php _e('On Tv', 'callsheet'); ?></th>

                                <th><?php _e('Title', 'callsheet'); ?></th>

                                <th><?php _e('Role', 'callsheet'); ?></th>

                                <th><?php _e('Director', 'callsheet'); ?></th>

                                <th><?php _e('Channel', 'callsheet'); ?></th>

                                <th><?php _e('Action', 'callsheet'); ?></th>

                                <th><?php _e('Show Always', 'callsheet'); ?>

                                    <!-- <br><span style="font-size: 10px;"><?php _e('(check to show always on frontend)', 'callsheet'); ?></span> -->

                                </th>

                            </tr>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

                <!-- Modal -->

                <div class="modal fade" id="on_tv_add" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Add new Record for On Tv', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal add_on_tv_form">

                                    <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            From date: <input type="date" class="form-control" id="on_tv_date" placeholder="" name="on_tv_date" />

                                        </div>

                                        <div class="col-sm-6">

                                            <input type="time" class="form-control" id="on_tv_time" placeholder="" name="on_tv_time" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            To date: <input type="date" class="form-control" id="on_tv_to_date" placeholder="" name="on_tv_to_date" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv"><?php _e('Text On Tv', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <textarea class="form-control summernote" rows="3" id="on_tv_editor" placeholder="" name="on_tv"></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv_image"><?php _e('Upload Image', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <div class="upload-img">

                                                <a href="#" class="btn btn-default on_tv_upload_image_button button"><span class="wp-media-buttons-icon"><?php _e('Add Image', 'callsheet'); ?></span></a>

                                                <input type="hidden" id="on_tv_image" name="on_tv_image">

                                                <a href="#" class="on_tv_remove_image_button remove" style="display:none;"><i class="fa fa-times"></i></a>

                                            </div>



                                        </div>

                                    </div>

                                    <hr style="border-color: #B6B6B7;" />

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv_title"><?php _e('Title', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control on_tv_title" id="on_tv_title" placeholder="" name="on_tv_title" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv_role"><?php _e('Role', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_tv_role" placeholder="" name="on_tv_role" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv_director"><?php _e('Director', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_tv_director" placeholder="" name="on_tv_director" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_tv_channel"><?php _e('Channel/Distributor', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_tv_channel" placeholder="" name="on_tv_channel" />

                                        </div>

                                    </div>

                                </form>

                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_tv_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>



                <div class="modal fade" id="on_tv_edit" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Edit Record for On Tv', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">



                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_tv_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>

                <!-- Modal -->

            </div><!-- on tv section over -->



            <div class="on-stage-section">

                <h3><?php _e('On Stage', 'callsheet'); ?></h3>

                <div class="add-btn">

                    <button class="btn btn-default on_stage_add_click" data-toggle="modal" data-target="#on_stage_add"><?php _e('Add New Record', 'callsheet'); ?></button>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered on_stage_table">

                        <thead>

                            <tr>

                                <th><?php _e('Sr No', 'callsheet'); ?></th>

                                <th><?php _e('Image', 'callsheet'); ?></th>

                                <th><?php _e('From Date', 'callsheet'); ?></th>

                                <th><?php _e('To Date', 'callsheet'); ?></th>

                                <th><?php _e('Time', 'callsheet'); ?></th>

                                <th><?php _e('On Stage', 'callsheet'); ?></th>

                                <th><?php _e('Title', 'callsheet'); ?></th>

                                <th><?php _e('Role', 'callsheet'); ?></th>

                                <th><?php _e('Director', 'callsheet'); ?></th>

                                <th><?php _e('Theater', 'callsheet'); ?></th>

                                <th><?php _e('Action', 'callsheet'); ?></th>

                                <th><?php _e('Show Always', 'callsheet'); ?>

                                    <!-- <br><span style="font-size: 10px;"><?php _e('(check to show always on frontend)', 'callsheet'); ?></span> -->

                                </th>

                            </tr>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

                <!-- Modal -->

                <div class="modal fade" id="on_stage_add" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Add new Record for On Stage', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal add_on_stage_form">

                                    <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            From date: <input type="date" class="form-control" id="on_stage_date" placeholder="" name="on_stage_date" />

                                        </div>

                                        <div class="col-sm-6">

                                            <input type="time" class="form-control" id="on_stage_time" placeholder="" name="on_stage_time" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            To date: <input type="date" class="form-control" id="on_stage_to_date" placeholder="" name="on_stage_to_date" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage"><?php _e('Text On Stage', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <textarea class="form-control summernote" rows="3" id="on_stage_editor" placeholder="" name="on_stage"></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage_image"><?php _e('Upload Image', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <div class="upload-img">

                                                <a href="#" class="btn btn-default on_stage_upload_image_button button"><span class="wp-media-buttons-icon"><?php _e('Add Image', 'callsheet'); ?></span></a>

                                                <input type="hidden" id="on_stage_image" name="on_stage_image">

                                                <a href="#" class="on_stage_remove_image_button remove" style="display:none;"><i class="fa fa-times"></i></a>

                                            </div>



                                        </div>

                                    </div>

                                    <hr style="border-color: #B6B6B7;" />

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage_title"><?php _e('Title', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control on_stage_title" id="on_stage_title" placeholder="" name="on_stage_title" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage_role"><?php _e('Role', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_stage_role" placeholder="" name="on_stage_role" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage_director"><?php _e('Director', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_stage_director" placeholder="" name="on_stage_director" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="on_stage_theater"><?php _e('Theater', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="on_stage_theater" placeholder="" name="on_stage_theater" />

                                        </div>

                                    </div>

                                </form>

                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_stage_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>



                <div class="modal fade" id="on_stage_edit" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Edit Record for On Stage', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">



                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default on_stage_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>

                <!-- Modal -->



            </div><!-- on stage section over -->









            <!-- At festival section -->

            <div class="at-festival-section">

                <h3><?php _e('At Festival', 'callsheet'); ?></h3>

                <div class="add-btn">

                    <button class="btn btn-default at_festival_add_click" data-toggle="modal" data-target="#at_festival_add"><?php _e('Add New Record', 'callsheet'); ?></button>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered at_festival_table">

                        <thead>

                            <tr>

                                <th><?php _e('Sr No', 'callsheet'); ?></th>

                                <th><?php _e('Image', 'callsheet'); ?></th>

                                <th><?php _e('From Date', 'callsheet'); ?></th>

                                <th><?php _e('To Date', 'callsheet'); ?></th>

                                <th><?php _e('Time', 'callsheet'); ?></th>

                                <th><?php _e('At Festival', 'callsheet'); ?></th>

                                <th><?php _e('Title', 'callsheet'); ?></th>

                                <th><?php _e('Role', 'callsheet'); ?></th>

                                <th><?php _e('Director', 'callsheet'); ?></th>

                                <th><?php _e('Theater', 'callsheet'); ?></th>

                                <th><?php _e('Action', 'callsheet'); ?></th>

                                <th><?php _e('Show Always', 'callsheet'); ?>

                                    <!-- <br><span style="font-size: 10px;"><?php _e('(check to show always on frontend)', 'callsheet'); ?></span> -->

                                </th>

                            </tr>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

                <!-- Modal -->

                <div class="modal fade" id="at_festival_add" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Add new Record for At Festival', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal add_at_festival_form">

                                    <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            From date: <input type="date" class="form-control" id="at_festival_date" placeholder="" name="at_festival_date" />

                                        </div>

                                        <div class="col-sm-6">

                                            <input type="time" class="form-control" id="at_festival_time" placeholder="" name="at_festival_time" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-6">

                                            To date: <input type="date" class="form-control" id="at_festival_to_date" placeholder="" name="at_festival_to_date" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival"><?php _e('Text At Festival', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <textarea class="form-control summernote" rows="3" id="at_festival_editor" placeholder="" name="at_festival"></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival_image"><?php _e('Upload Image', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <div class="upload-img">

                                                <a href="#" class="btn btn-default at_festival_upload_image_button button"><span class="wp-media-buttons-icon"><?php _e('Add Image', 'callsheet'); ?></span></a>

                                                <input type="hidden" id="at_festival_image" name="at_festival_image">

                                                <a href="#" class="at_festival_remove_image_button remove" style="display:none;"><i class="fa fa-times"></i></a>

                                            </div>



                                        </div>

                                    </div>

                                    <hr style="border-color: #B6B6B7;" />

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival_title"><?php _e('Title', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control at_festival_title" id="at_festival_title" placeholder="" name="at_festival_title" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival_role"><?php _e('Role', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="at_festival_role" placeholder="" name="at_festival_role" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival_director"><?php _e('Director', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="at_festival_director" placeholder="" name="at_festival_director" />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="at_festival_channel"><?php _e('Channel', 'callsheet'); ?></label>

                                        <div class="col-sm-7">

                                            <input type="text" class="form-control" id="at_festival_channel" placeholder="" name="at_festival_channel" />

                                        </div>

                                    </div>

                                </form>

                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default at_festival_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>



                <div class="modal fade" id="at_festival_edit" role="dialog">

                    <div class="modal-dialog modal-lg">



                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Edit Record for At Festival', 'callsheet'); ?></h4>

                            </div>

                            <div class="modal-body">



                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-default at_festival_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                            </div>

                        </div>





                    </div>



                </div>

                <!-- Modal -->



            </div><!-- At Festival section over -->







        </div><!-- on air tab over -->



        <!-- <div id="on_stage" class="tab-pane fade on_stage">

            <div class="add-btn">

                <button  class="btn btn-default on_stage_add_click" data-toggle="modal" data-target="#on_stage_add" ><?php _e('Add New Record', 'callsheet'); ?></button>

            </div>

                <div class="table-responsive">           

                        <table class="table table-bordered on_stage_table">

                          <thead>

                            <tr>

                              <th><?php _e('Sr No', 'callsheet'); ?></th>

                              <th><?php _e('On Stage', 'callsheet'); ?></th>

                              <th><?php _e('Action', 'callsheet'); ?></th>

                            </tr>

                          </thead>

                          <tbody>

                            

                          </tbody>

                        </table>

                </div>-->

        <!-- Modal -->

        <!-- <div class="modal fade" id="on_stage_add" role="dialog">

                          <div class="modal-dialog">-->



        <!-- Modal content-->

        <!--<div class="modal-content">

                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title"><?php _e('Add new Record for On Stage', 'callsheet'); ?></h4>

                              </div>

                              <div class="modal-body">

                                  <form class="form-horizontal add_on_stage_form">

                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">

                                      <div class="form-group">

                                          <label class="control-label col-sm-3" for="on_stage"></label>

                                          <div class="col-sm-12">

                                              <textarea  class="form-control summernote" rows="3" id="on_stage_editor" placeholder="" name="on_stage"></textarea>

                                          </div>

                                      </div>

                                  </form>

                              </div>

                                  

                                  <div class="modal-footer">

                                <button type="button" class="btn btn-default on_stage_save green"><?php _e('Save', 'callsheet'); ?></button>

                                <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                              </div> 

                              </div>

                             

                                

                            </div>



                        </div>

             

             <div class="modal fade" id="on_stage_edit" role="dialog">

                 <div class="modal-dialog">-->



        <!-- Modal content-->

        <!--<div class="modal-content">

                         <div class="modal-header">

                             <button type="button" class="close" data-dismiss="modal">&times;</button>

                             <h4 class="modal-title"><?php _e('Edit Record for On Stage', 'callsheet'); ?></h4>

                         </div>

                         <div class="modal-body">



                         </div>



                         <div class="modal-footer">

                             <button type="button" class="btn btn-default on_stage_edit_save green"><?php _e('Save', 'callsheet'); ?></button>

                             <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                         </div> 

                     </div>





                 </div>



             </div>-->

        <!-- Modal -->

        <!--  </div> -->



        <div id="photos" class="tab-pane fade">

            <div class="add-btn">

                <button class="btn btn-default misha_upload_image_button"><?php _e('Add New Photos', 'callsheet'); ?></button>

            </div>

            <div class="img-wrap user_photo_list">

                <div class="row">



                </div>

            </div>

            <!-- Zoom Modal -->

            <div id="zoom_modal" class="modal">

                <span class="close zoom_modal_close">&times;</span>

                <div class="img-caption zoom_modal_caption">Jhone Smith</div>



                <img class="modal-content" id="zoom_image">



            </div>





            <!-- Zoom Modal -->

        </div>



        <div id="video" class="tab-pane fade">

            <div class="add-btn">

                <button class="btn btn-default" data-toggle="modal" data-target="#video-code-modal"><?php _e('Type Html Code', 'callsheet'); ?></button>

                <button class="btn btn-default get_video_btn" data-toggle="modal" data-target="#get-video-modal"><?php _e('Get Video From Wistia', 'callsheet'); ?></button>

                <button class="btn btn-default get_jwplayer_btn" data-toggle="modal" data-target="#get-player-modal"><?php _e('Get Video From JW Player', 'callsheet'); ?></button>

                <button class="btn btn-default add_new_video_btn"><?php _e('Add New Videos', 'callsheet'); ?></button>

            </div>

            <div class="video-block">

                <?php



                $video_master = $wpdb->prefix . 'call_sheet_video';

                $video_sql  = $wpdb->prepare("SELECT * FROM $video_master where client_id=%d ORDER BY position", $result->client_id);

                $result_video  = $wpdb->get_row($video_sql);



                $temp_video_url = '';



                ?> <?php if (isset($result_video->is_wordpress) && $result_video->is_wordpress == 'yes') {

                        $temp_video_url = wp_get_attachment_url($result_video->attachment_id);

                    } else if(isset($result_video->is_wordpress) && $result_video->is_wordpress == 'jw' ){
                        //$temp_video_url = ;
                        $setting_master = $wpdb->prefix . 'call_sheet_setting';
                        $apisql  = $wpdb->prepare("SELECT api_value FROM $setting_master WHERE api_name=%s",'jw_key');
                        $apiresult  = $wpdb->get_row($apisql);
                        $api_value=$apiresult->api_value;
                         $apisql1  = $wpdb->prepare("SELECT api_value FROM $setting_master WHERE api_name=%s",'jw_secret');
                        $apiresult1  = $wpdb->get_row($apisql1);
                        $api_secret=$apiresult1->api_value;
                        if($api_value==''){echo  _e('Please set JW API Key value.', 'callsheet'); die;}
                        
                        $param_string = "api_format=json&api_key=".$api_value."&api_nonce=80684843&api_timestamp=".time()."&text=demo";
                        $pam_string = $param_string.$api_secret;
                        $api_signature = sha1($pam_string);
                        $url="https://api.jwplatform.com/v1/videos/list?api_signature=".$api_signature."&".$param_string;
                        $jsoncode = "https://cdn.jwplayer.com/v2/media/".$result_video->attachment_id;
                        $fetch_video = json_decode(file_get_contents($jsoncode),true);
                        $v_details = $fetch_video['playlist'];
                        foreach ($v_details as $key => $jwv) {
                            $playertitle =  $jwv['title'];
                            foreach ($jwv['sources'] as $jvurl) {
                                //print_r($jurl['type']);
                                if($jvurl['type'] == "video/mp4" && ($jvurl['label'] == '360p' || $jvurl['label'] == '720p' ) ) {
                                    $playerurl = $jvurl['file'];
                                    
                                }

                                //$x++;
                            }
                        } 
                        $temp_video_url = $playerurl;
                            
                    }else {

                        if (isset($result_video->attachment_id)) {

                            $temp_video_url = str_replace(".bin", "/my-file.mp4", $result_video->attachment_id);

                        }

                    } ?>



                <div class="row" style="<?php if ($result_video == '') echo 'display:none;'; ?>">

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <script type="text/javascript" src="https://content.jwplatform.com/libraries/1viIMBzO.js"></script>





                        <div id="current_url" current_url="<?php echo $temp_video_url; ?>"></div>

                        <div class="myvideo" id="jwplayer_myvideo_test"></div>

                        <script>

                            jwplayer("jwplayer_myvideo_test").setup({



                                file: "<?php echo $temp_video_url; ?>"



                            });

                        </script>





                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <div class="video_list">

                            <div class="row">

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <?php

                    $video_iframe_master = $wpdb->prefix . 'call_sheet_video_iframe';

                    $sql_video_iframe  = $wpdb->prepare("SELECT * FROM $video_iframe_master WHERE client_id=%d", $result->client_id);



                    $result_video_iframe = $wpdb->get_row($sql_video_iframe);

                    ?>

                    <script>

                        jQuery(document).ready(function() {

                            var $video_block = jQuery('.video-block').find('iframe');



                            var $video_src = $video_block.attr('src');

                            if (jQuery.browser.safari || jQuery.browser.mozilla) {

                                if ($video_src !== undefined) {

                                    var $check_site = $video_src.split('/');

                                    console.log($check_site);



                                    if ($check_site[2] == 'video.filmmakers.de') {

                                        jQuery('.video-block').find('iframe').attr('src', $video_src + '&autoplay=0');

                                    } else if ($check_site[2] != 'www.schauspielervideos.de') {



                                        jQuery('.video-block').find('iframe').attr('src', $video_src + '?autoplay=0');

                                    } else {

                                        jQuery('.video-block').find('iframe').attr('src', $video_src + '/?autoplay=0');

                                    }

                                }

                            }

                        });

                    </script>

                    <div class="col-md-6 video_iframe_preview">
                        <?php echo str_replace('.html','.html?autoplay=0',$result_video_iframe->iframe_code) ?? ''; ?>
                    </div>



                </div>

            </div>

            <!-- Modal -->

            <div id="video-code-modal" class="modal fade" role="dialog">

                <div class="modal-dialog">



                    <!-- Modal content-->

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Video Code', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <textarea class="form-control video_iframe_edit" rows="5" name="video_iframe"><?php echo $result_video_iframe->iframe_code ?? ''; ?></textarea>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default video_iframe_save green" data-dismiss="modal"><?php _e('Save', 'callsheet'); ?></button>

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>



                </div>

            </div>

            <div class="modal fade" id="get-video-modal" role="dialog">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('Wistia Video List', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">

                            <div class="video_list_wistia">

                                <div class="row">



                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>

                </div>

            </div>



            <div class="modal fade" id="get-player-modal" role="dialog">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h4 class="modal-title"><?php _e('JW Player Videos List', 'callsheet'); ?></h4>

                        </div>

                        <div class="modal-body">
                             Add Playlist Id here : <input type="text" placeholder="add playlist id" id="playlist_id" name="playlist_id" />
                            <div class="video_list_jwplayer">

                                <div class="row">



                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default red" data-dismiss="modal"><?php _e('Close', 'callsheet'); ?></button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Modal -->

        </div>



    </div>

</div>

<div id="wait" style="display: none;"><img src='<?php echo trailingslashit(plugin_dir_url(__FILE__)) . '../image/spinner.gif' ?>' width="100" height="100" /></div>

<?php



wp_enqueue_script('callsheet_tags_suggestion', trailingslashit(plugin_dir_url(__FILE__)) . '../js/callsheet-admin.js', array('jquery'), time(), true);

wp_localize_script(

    'callsheet_tags_suggestion',

    'control_vars',

    array(

        'client_id' => $result->client_id,

        'admin_url' =>   admin_url('admin-ajax.php'),

        'plugin_uri' => plugin_dir_url(__FILE__),

        'nationality_suggestion' => $nationality_array,

        'place_of_action_suggestion' => $place_of_action_array,

        'ethnic_appearance_suggestion' => $ethnic_appearance_array,

        'language_suggestion' => $language_array,

        'accents_suggestion' => $accents_array,

        'singing_suggestion' => $singing_array,

        'musical_instrument_suggestion' => $musical_instrument_array,

        'sports_suggestion' => $sports_array,

        'dancing_suggestion' => $dancing_array,

        'license_suggestion' => $license_array,

        'professional_union_suggestion' => $professional_union_array,

        'genre_suggestion' => $genre_array,

        'state_suggestion' => $state_array,

        'residence_suggestion' => $residence_array,

        'hair_colour_suggestion' => $hair_colour_array,

        'hair_length_suggestion' => $hair_length_array,

        'voice_range_suggestion' => $voice_range_array,

        'eye_colour_suggestion' => $eye_colour_array,

        'stature_suggestion' => $stature_array,

        'confection_size_suggestion' => $confection_size_array,

        'place_of_birth_suggestion' => $place_of_birth_array,

        'agencies_suggestion' => $agencies_array

    )

);



?>