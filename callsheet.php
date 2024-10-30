<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://callsheet.io
 * @since             1.0.0
 * @package           Callsheet
 *
 * @wordpress-plugin
 * Plugin Name:       Callsheet
 * Plugin URI:        https://wordpress.org/plugins/callsheet/
 * Description:       Callsheet allows you to add actors/actresses/directors and their details to show them to end users.
 * Version:           1.0.9
 * Author:            Claudius Neidig
 * Author URI:        https://www.linkedin.com/in/claudius-neidig/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       callsheet
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CALLSHEET_VERSION', '1.0.9' );


/*curl api*/
function callsheet_curl_connect( $url, $request_type, $api_key, $data = array() ) {
    if( $request_type == 'GET' )
        $url .= '?' . http_build_query($data);
 
    $mch = curl_init();
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic '.base64_encode( 'user:'. $api_key )
    );
    curl_setopt($mch, CURLOPT_URL, $url );
    curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
    //curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
    curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
    curl_setopt($mch, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
 
    if( $request_type != 'GET' ) {
        curl_setopt($mch, CURLOPT_POST, true);
        curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
    }
 
    return curl_exec($mch);
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-callsheet-activator.php
 */
function activate_callsheet() {

    $role = get_role( 'editor' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }
    
    $role = get_role( 'author' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }
    
    $role = get_role( 'contributor' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }

    $role = get_role( 'subscriber' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }

    $role = get_role( 'wpseo_manager' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }

    $role = get_role( 'wpseo_editor' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }
     
    $role = get_role( 'translator' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->add_cap( 'manage_options' );
        }
    }

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-callsheet-activator.php';
	Callsheet_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-callsheet-deactivator.php
 */
function deactivate_callsheet() {

    $role = get_role( 'editor' );
   if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
   }

    $role = get_role( 'author' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
    }
   $role = get_role( 'contributor' );
   if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
   }
   $role = get_role( 'subscriber' );
   if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
   }
    $role = get_role( 'wpseo_manager' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
    }
    $role = get_role( 'wpseo_editor' );
    if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
    }
    $role = get_role( 'translator' );
   if(!empty($role)) {
        if($GLOBALS['wp_roles']->is_role( $role ) == true) {
            $role->remove_cap( 'manage_options' );
        }
   }


	require_once plugin_dir_path( __FILE__ ) . 'includes/class-callsheet-deactivator.php';
	Callsheet_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_callsheet' );
register_deactivation_hook( __FILE__, 'deactivate_callsheet' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-callsheet.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_callsheet() {

	$plugin = new Callsheet();
	$plugin->run();


}
run_callsheet();

//save_basic_information
function callsheet_save_basic_information(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    //nationality suggestion
    $tags_master = $wpdb->prefix.'call_sheet_tags_master';
        $nationality_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'nationality');
        $nationality_result       = $wpdb->get_row($nationality_sql);
        $nationality_array=explode(', ', $nationality_result->tags_value);
        $is_nationality_new=false;
        
        //place_of_action suggestion
        $place_of_action_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'place_of_action');
        $place_of_action_result       = $wpdb->get_row($place_of_action_sql);
        $place_of_action_array=explode(', ', $place_of_action_result->tags_value);
        $is_place_of_action_new=false;
        //ethnic_appearance suggestion
        $ethnic_appearance_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'ethnic_appearance');
        $ethnic_appearance_result       = $wpdb->get_row($ethnic_appearance_sql);
        $ethnic_appearance_array=explode(', ', $ethnic_appearance_result->tags_value);
        $is_ethnic_appearance_new=false;
        //language suggestion
        $language_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'language');
        $language_result       = $wpdb->get_row($language_sql);
        $language_array=explode(', ', $language_result->tags_value);
        $is_language_new=false;
        //accents suggestion
        $accents_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'accents');
        $accents_result       = $wpdb->get_row($accents_sql);
        $accents_array=explode(', ', $accents_result->tags_value);
        $is_accents_new=false;
        //singing suggestion
        $singing_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'singing');
        $singing_result       = $wpdb->get_row($singing_sql);
        $singing_array=explode(', ', $singing_result->tags_value);
        $is_singing_new=false;
        //musical_instrument suggestion
        $musical_instrument_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'musical_instrument');
        $musical_instrument_result       = $wpdb->get_row($musical_instrument_sql);
        $musical_instrument_array=explode(', ', $musical_instrument_result->tags_value);
        $is_musical_instrument_new=false;
        //sports suggestion
        $sports_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'sports');
        $sports_result       = $wpdb->get_row($sports_sql);
        $sports_array=explode(', ', $sports_result->tags_value);
        $is_sports_new=false;
        //dancing suggestion
        $dancing_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'dancing');
        $dancing_result       = $wpdb->get_row($dancing_sql);
        $dancing_array=explode(', ', $dancing_result->tags_value);
        $is_dancing_new=false;
        //license suggestion
        $license_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'license');
        $license_result       = $wpdb->get_row($license_sql);
        $license_array=explode(', ', $license_result->tags_value);
        $is_license_new=false;
        //professional_union suggestion
        $professional_union_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'professional_union');
        $professional_union_result       = $wpdb->get_row($professional_union_sql);
        $professional_union_array=explode(', ', $professional_union_result->tags_value);
        $is_professional_union_new=false;
        //genre suggestion
        $genre_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'genre');
        $genre_result       = $wpdb->get_row($genre_sql);
        $genre_array=explode(', ', $genre_result->tags_value);
        $is_genre_new=false;
        //agencies suggestion
        $agencies_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'agencies');
        $agencies_result       = $wpdb->get_row($agencies_sql);
        $agencies_array=explode(', ', $agencies_result->tags_value);
        $is_agencies_new=false;
        
        //state suggestion
        $state_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'state');
        $state_result       = $wpdb->get_row($state_sql);
        $state_array=explode(', ', $state_result->tags_value);
        $is_state_new=false;
        //residence suggestion
        $residence_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'residence');
        $residence_result       = $wpdb->get_row($residence_sql);
        $residence_array=explode(', ', $residence_result->tags_value);
        $is_residence_new=false;
        //hair_colour suggestion
        $hair_colour_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'hair_colour');
        $hair_colour_result       = $wpdb->get_row($hair_colour_sql);
        $hair_colour_array=explode(', ', $hair_colour_result->tags_value);
        $is_hair_colour_new=false;
        //hair_length suggestion
        $hair_length_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'hair_length');
        $hair_length_result       = $wpdb->get_row($hair_length_sql);
        $hair_length_array=explode(', ', $hair_length_result->tags_value);
        $is_hair_length_new=false;
        //voice_range suggestion
        $voice_range_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'voice_range');
        $voice_range_result       = $wpdb->get_row($voice_range_sql);
        $voice_range_array=explode(', ', $voice_range_result->tags_value);
        $is_voice_range_new=false;
        //eye_colour suggestion
        $eye_colour_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'eye_colour');
        $eye_colour_result       = $wpdb->get_row($eye_colour_sql);
        $eye_colour_array=explode(', ', $eye_colour_result->tags_value);
        $is_eye_colour_new=false;
        //stature suggestion
        $stature_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'stature');
        $stature_result       = $wpdb->get_row($stature_sql);
        $stature_array=explode(', ', $stature_result->tags_value);
        $is_stature_new=false;
        //confection_size suggestion
        $confection_size_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'confection_size');
        $confection_size_result       = $wpdb->get_row($confection_size_sql);
        $confection_size_array=explode(', ', $confection_size_result->tags_value);
        $is_confection_size_new=false;
        //place_of_birth suggestion
        $place_of_birth_sql = $wpdb->prepare("SELECT tags_value FROM $tags_master WHERE tags_name=%s",'place_of_birth');
        $place_of_birth_result       = $wpdb->get_row($place_of_birth_sql);
        $place_of_birth_array=explode(', ', $place_of_birth_result->tags_value);
        $is_place_of_birth_new=false;
        
     $client_id=$form_data['client_id'];
        
    $client_master = $wpdb->prefix.'call_sheet_client_master';
    $year_of_birth=$form_data['day_of_birth'].'-'.$form_data['month_of_birth'].'-'.$form_data['year_of_birth'];
    
//place_of_action manage
    $client_place_of_action=explode(',', $form_data['place_of_action']);
    foreach ($client_place_of_action as $value){
        if(!in_array($value,$place_of_action_array)){
              $new_place_of_action.=$value.', ';
              $is_place_of_action_new=true;
              
        }
        }
        if($is_place_of_action_new){
            $new_place_of_action=rtrim($new_place_of_action,',');
            $updated_place_of_action=$place_of_action_result->tags_value.', '.$new_place_of_action;
            $updated_place_of_action=ltrim($updated_place_of_action,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_place_of_action),array( 'tags_name' =>'place_of_action'),'',''); 
        
        }
//ethnic_appearance manage
    $client_ethnic_appearance=explode(',', $form_data['ethnic_appearance']);
    foreach ($client_ethnic_appearance as $value){
        if(!in_array($value,$ethnic_appearance_array)){
              $new_ethnic_appearance.=$value.', ';
              $is_ethnic_appearance_new=true;
              
        }
        }
        if($is_ethnic_appearance_new){
            $new_ethnic_appearance=rtrim($new_ethnic_appearance,',');
            $updated_ethnic_appearance=$ethnic_appearance_result->tags_value.', '.$new_ethnic_appearance;
            $updated_ethnic_appearance=ltrim($updated_ethnic_appearance,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_ethnic_appearance),array( 'tags_name' =>'ethnic_appearance'),'',''); 
        
        }        
 //nationality manage
    $client_nationality=explode(',', $form_data['nationality']);
    
    foreach ($client_nationality as $value){
        if(!in_array($value,$nationality_array)){
            $new_nationality.=$value.', ';
            $is_nationality_new=true;
        }
    }
    if($is_nationality_new){
        $new_nationality=rtrim($new_nationality,',');
        $updated_nationality=$nationality_result->tags_value.', '.$new_nationality;
        $updated_nationality=ltrim($updated_nationality,',');
        $wpdb->update($tags_master,array('tags_value' => $updated_nationality),array( 'tags_name' =>'nationality'),'',''); 
    }
//language manage
    $client_language=explode(',', $form_data['language']);
    foreach ($client_language as $value){
        if(!in_array($value,$language_array)){
              $new_language.=$value.', ';
              $is_language_new=true;
              
        }
        }
        if($is_language_new){
            $new_language=rtrim($new_language,',');
            $updated_language=$language_result->tags_value.', '.$new_language;
            $updated_language=ltrim($updated_language,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_language),array( 'tags_name' =>'language'),'',''); 
        
        }
//genre manage
    $client_genre=explode(',', $form_data['genre']);
    foreach ($client_genre as $value){
        if(!in_array($value,$genre_array)){
              $new_genre.=$value.', ';
              $is_genre_new=true;
              
        }
        }
        if($is_genre_new){
            $new_genre=rtrim($new_genre,',');
            $updated_genre=$genre_result->tags_value.', '.$new_genre;
            $updated_genre=ltrim($updated_genre,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_genre),array( 'tags_name' =>'genre'),'',''); 
        
        }
//accents manage
    $client_accents=explode(',', $form_data['accents']);
    foreach ($client_accents as $value){
        if(!in_array($value,$accents_array)){
              $new_accents.=$value.', ';
              $is_accents_new=true;
              
        }
        }
        if($is_accents_new){
            $new_accents=rtrim($new_accents,',');
            $updated_accents=$accents_result->tags_value.', '.$new_accents;
            $updated_accents=ltrim($updated_accents,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_accents),array( 'tags_name' =>'accents'),'',''); 
        
        }
//singing manage
    $client_singing=explode(',', $form_data['singing']);
    foreach ($client_singing as $value){
        if(!in_array($value,$singing_array)){
              $new_singing.=$value.', ';
              $is_singing_new=true;
              
        }
        }
        if($is_singing_new){
            $new_singing=rtrim($new_singing,',');
            $updated_singing=$singing_result->tags_value.', '.$new_singing;
            $updated_singing=ltrim($updated_singing,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_singing),array( 'tags_name' =>'singing'),'',''); 
        
        }
//musical_instrument manage
    $client_musical_instrument=explode(',', $form_data['musical_instrument']);
    foreach ($client_musical_instrument as $value){
        if(!in_array($value,$musical_instrument_array)){
              $new_musical_instrument.=$value.', ';
              $is_musical_instrument_new=true;
              
        }
        }
        if($is_musical_instrument_new){
            $new_musical_instrument=rtrim($new_musical_instrument,',');
            $updated_musical_instrument=$musical_instrument_result->tags_value.', '.$new_musical_instrument;
            $updated_musical_instrument=ltrim($updated_musical_instrument,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_musical_instrument),array( 'tags_name' =>'musical_instrument'),'',''); 
        
        }
//sports manage
    $client_sports=explode(',', $form_data['sports']);
    foreach ($client_sports as $value){
        if(!in_array($value,$sports_array)){
              $new_sports.=$value.', ';
              $is_sports_new=true;
              
        }
        }
        if($is_sports_new){
            $new_sports=rtrim($new_sports,',');
            $updated_sports=$sports_result->tags_value.', '.$new_sports;
            $updated_sports=ltrim($updated_sports,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_sports),array( 'tags_name' =>'sports'),'',''); 
        
        }
//dancing manage
    $client_dancing=explode(',', $form_data['dancing']);
    foreach ($client_dancing as $value){
        if(!in_array($value,$dancing_array)){
              $new_dancing.=$value.', ';
              $is_dancing_new=true;
              
        }
        }
        if($is_dancing_new){
            $new_dancing=rtrim($new_dancing,',');
            $updated_dancing=$dancing_result->tags_value.', '.$new_dancing;
            $updated_dancing=ltrim($updated_dancing,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_dancing),array( 'tags_name' =>'dancing'),'',''); 
        
        }
//license manage
    $client_license=explode(',', $form_data['license']);
    foreach ($client_license as $value){
        if(!in_array($value,$license_array)){
              $new_license.=$value.', ';
              $is_license_new=true;
              
        }
        }
        if($is_license_new){
            $new_license=rtrim($new_license,',');
            $updated_license=$license_result->tags_value.', '.$new_license;
            $updated_license=ltrim($updated_license,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_license),array( 'tags_name' =>'license'),'',''); 
        
        }
//professional_union manage
    $client_professional_union=explode(',', $form_data['professional_union']);
    foreach ($client_professional_union as $value){
        if(!in_array($value,$professional_union_array)){
              $new_professional_union.=$value.', ';
              $is_professional_union_new=true;
              
        }
        }
        if($is_professional_union_new){
            $new_professional_union=rtrim($new_professional_union,',');
            $updated_professional_union=$professional_union_result->tags_value.', '.$new_professional_union;
            $updated_professional_union=ltrim($updated_professional_union,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_professional_union),array( 'tags_name' =>'professional_union'),'',''); 
        
        }

//state manage
    $client_state=explode(',', $form_data['state']);
    foreach ($client_state as $value){
        if(!in_array($value,$state_array)){
              $new_state.=$value.', ';
              $is_state_new=true;
              
        }
        }
        if($is_state_new){
            $new_state=rtrim($new_state,',');
            $updated_state=$state_result->tags_value.', '.$new_state;
            $updated_state=ltrim($updated_state,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_state),array( 'tags_name' =>'state'),'',''); 
        
        }
//residence manage
    $client_residence=explode(',', $form_data['residence']);
    foreach ($client_residence as $value){
        if(!in_array($value,$residence_array)){
              $new_residence.=$value.', ';
              $is_residence_new=true;
              
        }
        }
        if($is_residence_new){
            $new_residence=rtrim($new_residence,',');
            $updated_residence=$residence_result->tags_value.', '.$new_residence;
            $updated_residence=ltrim($updated_residence,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_residence),array( 'tags_name' =>'residence'),'',''); 
        
        }
//hair_colour manage
    $client_hair_colour=explode(',', $form_data['hair_colour']);
    foreach ($client_hair_colour as $value){
        if(!in_array($value,$hair_colour_array)){
              $new_hair_colour.=$value.', ';
              $is_hair_colour_new=true;
              
        }
        }
        if($is_hair_colour_new){
            $new_hair_colour=rtrim($new_hair_colour,',');
            $updated_hair_colour=$hair_colour_result->tags_value.', '.$new_hair_colour;
            $updated_hair_colour=ltrim($updated_hair_colour,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_hair_colour),array( 'tags_name' =>'hair_colour'),'',''); 
        
        }

//hair_length manage
    $client_hair_length=explode(',', $form_data['hair_length']);
    foreach ($client_hair_length as $value){
        if(!in_array($value,$hair_length_array)){
              $new_hair_length.=$value.', ';
              $is_hair_length_new=true;
              
        }
        }
        if($is_hair_length_new){
            $new_hair_length=rtrim($new_hair_length,',');
            $updated_hair_length=$hair_length_result->tags_value.', '.$new_hair_length;
            $updated_hair_length=ltrim($updated_hair_length,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_hair_length),array( 'tags_name' =>'hair_length'),'',''); 
        
        }
//voice_range manage
    $client_voice_range=explode(',', $form_data['voice_range']);
    foreach ($client_voice_range as $value){
        if(!in_array($value,$voice_range_array)){
              $new_voice_range.=$value.', ';
              $is_voice_range_new=true;
              
        }
        }
        if($is_voice_range_new){
            $new_voice_range=rtrim($new_voice_range,',');
            $updated_voice_range=$voice_range_result->tags_value.', '.$new_voice_range;
            $updated_voice_range=ltrim($updated_voice_range,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_voice_range),array( 'tags_name' =>'voice_range'),'',''); 
        
        }
//eye_colour manage
    $client_eye_colour=explode(',', $form_data['eye_colour']);
    foreach ($client_eye_colour as $value){
        if(!in_array($value,$eye_colour_array)){
              $new_eye_colour.=$value.', ';
              $is_eye_colour_new=true;
              
        }
        }
        if($is_eye_colour_new){
            $new_eye_colour=rtrim($new_eye_colour,',');
            $updated_eye_colour=$eye_colour_result->tags_value.', '.$new_eye_colour;
            $updated_eye_colour=ltrim($updated_eye_colour,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_eye_colour),array( 'tags_name' =>'eye_colour'),'',''); 
        
        }

//stature manage
    $client_stature=explode(',', $form_data['stature']);
    foreach ($client_stature as $value){
        if(!in_array($value,$stature_array)){
              $new_stature.=$value.', ';
              $is_stature_new=true;
              
        }
        }
        if($is_stature_new){
            $new_stature=rtrim($new_stature,',');
            $updated_stature=$stature_result->tags_value.', '.$new_stature;
            $updated_stature=ltrim($updated_stature,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_stature),array( 'tags_name' =>'stature'),'',''); 
        
        }
//confection_size manage
    $client_confection_size=explode(',', $form_data['confection_size']);
    foreach ($client_confection_size as $value){
        if(!in_array($value,$confection_size_array)){
              $new_confection_size.=$value.', ';
              $is_confection_size_new=true;
              
        }
        }
        if($is_confection_size_new){
            $new_confection_size=rtrim($new_confection_size,',');
            $updated_confection_size=$confection_size_result->tags_value.', '.$new_confection_size;
            $updated_confection_size=ltrim($updated_confection_size,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_confection_size),array( 'tags_name' =>'confection_size'),'',''); 
        
        }
//place_of_birth manage
    $client_place_of_birth=explode(',', $form_data['place_of_birth']);
    foreach ($client_place_of_birth as $value){
        if(!in_array($value,$place_of_birth_array)){
              $new_place_of_birth.=$value.', ';
              $is_place_of_birth_new=true;
              
        }
        }
        if($is_place_of_birth_new){
            $new_place_of_birth=rtrim($new_place_of_birth,',');
            $updated_place_of_birth=$place_of_birth_result->tags_value.', '.$new_place_of_birth;
            $updated_place_of_birth=ltrim($updated_place_of_birth,',');
            $wpdb->update($tags_master,array('tags_value' => $updated_place_of_birth),array( 'tags_name' =>'place_of_birth'),'',''); 
        
        }
       
        
        $wpdb->update($client_master,
            array(
                'year_of_birth' => $year_of_birth,
                'place_of_birth' => $form_data['place_of_birth'],
                'nationality' => $form_data['nationality'],
                'state' => $form_data['state'],
                'residence' => $form_data['residence'],
                'place_of_action' => $form_data['place_of_action'],
                'ethnic_appearance' => $form_data['ethnic_appearance'],
                'hair_colour' => $form_data['hair_colour'],
                'hair_length' => $form_data['hair_length'],
                'eye_colour' => $form_data['eye_colour'],
                'stature' => $form_data['stature'],
                'height' => $form_data['height'],
                'weight' => $form_data['weight'],
                'confection_size' => $form_data['confection_size'],
                'language' => $form_data['language'],
                'accents' => $form_data['accents'],
                'singing' => $form_data['singing'],
                'voice_range' => $form_data['voice_range'],
                'musical_instrument' => $form_data['musical_instrument'],
                'sports' => $form_data['sports'],
                'dancing' => $form_data['dancing'],
                'license' => $form_data['license'],
                'professional_union' => $form_data['professional_union'],
                'special_skills' => $form_data['special_skills'],
                'genre' => $form_data['genre'],
                'agencies' => $form_data['agencies'],
                'short_text' => $form_data['short_text']
            ),
            array( 'client_id' =>$client_id ),'','');    
        
    die;
}

//save_social_info_information
function callsheet_save_social_info_information(){
    parse_str($_POST['formdata'], $form_data);
    $client_id=$form_data['client_id'];
    global $wpdb;
    $social_master = $wpdb->prefix . 'call_sheet_social';
         $social_check_sql = $wpdb->prepare("SELECT client_id FROM $social_master WHERE client_id=%d",$client_id);
        $social_check_result       = $wpdb->get_row($social_check_sql);
        if($wpdb->num_rows==0){
             $wpdb->insert($social_master, array(
                 'facebook' => $form_data['facebook'],
                'instagram' => $form_data['instagram'],
                'youTube' => $form_data['youTube'],
                'snapchat' => $form_data['snapchat'],
                'twitter' => $form_data['twitter'],
                'pinterest' => $form_data['pinterest'],
                'linkedIn' => $form_data['linkedIn'],
                'google_plus' => $form_data['google_plus'],
                'tumblr' => $form_data['tumblr'],
                'reddit' => $form_data['reddit'],
                'flickr' => $form_data['flickr'],
                'swarm_by_foursquare' => $form_data['swarm_by_foursquare'],
                'kik' => $form_data['kik'],
                'shots' => $form_data['shots'],
                'periscope' => $form_data['periscope'],
                'medium' => $form_data['medium'],
                'soundCloud' => $form_data['soundCloud'],
                'musical' => $form_data['musical'],
                'homepage' => $form_data['homepage'],
                'client_id' => $client_id
             ));
        }else{
          $wpdb->update($social_master,
            array(
                'facebook' => $form_data['facebook'],
                'instagram' => $form_data['instagram'],
                'youTube' => $form_data['youTube'],
                'snapchat' => $form_data['snapchat'],
                'twitter' => $form_data['twitter'],
                'pinterest' => $form_data['pinterest'],
                'linkedIn' => $form_data['linkedIn'],
                'google_plus' => $form_data['google_plus'],
                'tumblr' => $form_data['tumblr'],
                'reddit' => $form_data['reddit'],
                'flickr' => $form_data['flickr'],
                'swarm_by_foursquare' => $form_data['swarm_by_foursquare'],
                'kik' => $form_data['kik'],
                'periscope' => $form_data['periscope'],
                'shots' => $form_data['shots'],
                'medium' => $form_data['medium'],
                'soundCloud' => $form_data['soundCloud'],
                'homepage' => $form_data['homepage'],
                'musical' => $form_data['musical']
            ),
            array( 'client_id' =>$client_id ),'','');   
        }
        die;
}
//iframe_video
function callsheet_save_video_iframe(){
    $iframe_code=stripslashes($_POST["iframe_code"]);
    global $wpdb;
    $clientid=filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $video_iframe_master = $wpdb->prefix . 'call_sheet_video_iframe';
    $sql_video_iframe  = $wpdb->prepare("SELECT * FROM $video_iframe_master WHERE client_id=%d",$clientid);
    
    $video_iframe_check_result       = $wpdb->get_row($sql_video_iframe);
        if($wpdb->num_rows==0){
             $wpdb->insert($video_iframe_master, array(
                 'iframe_code' => $iframe_code,
                 'client_id' => $clientid
             ));
        }else{
          $wpdb->update($video_iframe_master,
            array(
               'iframe_code' => $iframe_code
                
            ),
            array( 'client_id' =>$clientid ),'','');   
        }
         die;
}

//export data
function callsheet_export_data(){
$tablename = filter_var($_POST['tablename'], FILTER_SANITIZE_STRING);
global $wpdb;
header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
header( 'Content-Description: File Transfer' );
header( 'Content-type: text/csv' );
header( 'Content-Disposition: attachment; filename=data.csv' );
header( 'Expires: 0' );
header( 'Pragma: public' );
$output = fopen("php://output", "w");  

$client_master = $wpdb->prefix.'call_sheet_'.$tablename;
$sql_column_name = $wpdb->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = %s",$client_master);
$arr = $wpdb->get_results($sql_column_name);
$column_name = array();
foreach ($arr as $ui) 
{  
    $rty = $ui->COLUMN_NAME;
	$rty = str_replace("_"," ",$rty);
    array_push($column_name,$rty);
}	 
fputcsv($output, $column_name);    
$sql = $wpdb->prepare("SELECT * FROM $client_master");
$results = $wpdb->get_results($sql);
foreach ($results as $result) 
{  
    $leadArray = (array) $result; 
    fputcsv($output, $leadArray);  
}  
fclose($output);
die;
}
//client_record_edit
function callsheet_client_record_edit(){
   global $wpdb;
   $client_id=filter_var($_REQUEST['client_id'], FILTER_VALIDATE_INT);
   $client_master = $wpdb->prefix.'call_sheet_client_master';
   $sql = $wpdb->prepare("SELECT client_id,first_name,last_name,type,slug FROM $client_master WHERE client_id=%d limit 1",$client_id);
   
   $result = $wpdb->get_row($sql);
   ?>
<div class="media-body-edit">
    <form class="edit_client_form">
                        <div class="fname">
                            <input type="text" class="form-control" name="first_name"  placeholder="<?php _e('First name', 'callsheet'); ?>" value="<?php echo stripslashes($result->first_name); ?>">
                             <input type="hidden" class="form-control" id="update_client_id"  name="update_client_id" value="<?php echo $result->client_id; ?>">
                        </div>
                        <div class="lname">
                            <input type="text" class="form-control" name="last_name" placeholder="<?php _e('Last name', 'callsheet'); ?>" value="<?php echo stripslashes($result->last_name); ?>">
                        </div>

                        <div class="slug">
                            <input type="text" class="form-control" name="slug" placeholder="<?php _e('Slug', 'callsheet'); ?>" value="<?php echo $result->slug; ?>">
                        </div>
                           <select class="form-control" name="type">
                                      <option value="Actor" <?php if($result->type=='Actor'){echo 'selected';} ?>><?php _e('Actor', 'callsheet'); ?></option>
                                      <option value="Actress" <?php if($result->type=='Actress'){echo 'selected';} ?>><?php _e('Actress', 'callsheet'); ?></option>
                                      <option value="Director" <?php if($result->type=='Director'){echo 'selected';} ?>><?php _e('Director', 'callsheet'); ?></option>
                                      <option value="Cinematographer" <?php if($result->type=='Cinematographer'){echo 'selected';} ?>><?php _e('Cinematographer', 'callsheet'); ?></option>
                                      <option value="Writer" <?php if($result->type=='Writer'){echo 'selected';} ?>><?php _e('Writer', 'callsheet'); ?></option>
                          </select>
                        <a class="text-center"> <i class="fa fa-check edit_client_save" aria-hidden="true"></i> </a>
</form>
                    </div>
   <?php
   die;
}
//edit_client_save
function callsheet_edit_client_save(){
    global $wpdb;
    $client_master = $wpdb->prefix.'call_sheet_client_master';
    parse_str($_POST['formdata'], $form_data);
    
      $slug= $form_data['slug'];
      /*$slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
      $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
      $slug = preg_replace('~[^-\w]+~', '', $slug);
      $slug = trim($slug, '-');
      $slug = preg_replace('~-+~', '-', $slug);*/
      $slug = sanitize_title($slug);
      $slug = strtolower($slug);
      if (empty($slug)) {
        $slug= 'n-a';
        }
    
    $checkslug = $wpdb->get_results($wpdb->prepare("SELECT slug FROM $client_master WHERE slug LIKE '%s%' AND client_id!=%d",$slug,$form_data['update_client_id']));
    $numhits=$wpdb->num_rows;
    if($numhits > 0){
        $slug = $slug.'-'.$numhits;
    }
    
    
    $wpdb->update($client_master,array("first_name" => stripslashes($form_data['first_name']),"last_name" => stripslashes($form_data['last_name']),"type" => $form_data['type'],"slug" => $slug),array( 'client_id' =>$form_data['update_client_id']),'','');   
    $client_id=$form_data['update_client_id'];
    $sql = $wpdb->prepare("SELECT client_id,first_name,last_name,type,slug,show_hide FROM $client_master WHERE client_id=%d limit 1",$client_id);
    $result = $wpdb->get_row($sql);

    $sulg_url='';
    //actress
        if(get_option('nisl_actress_url') != false) {
            $actress_url = get_post_field( 'post_name', get_option('nisl_actress_url') );
        }
        else {
            $actress_url = 'actress';
        }
        //writer
        if(get_option('nisl_writer_url') != false) {
            $writer_url = get_post_field( 'post_name', get_option('nisl_writer_url') );
        }
        else {
            $writer_url = 'cinematographers-writers';
        }
        //actor
        if(get_option('nisl_actor_url') != false) {
            $actor_url = get_post_field( 'post_name', get_option('nisl_actor_url') );
            
        }
        else {
            $actor_url = 'actor';
        }
        //director
        if(get_option('nisl_director_url') != false) {
            $director_url = get_post_field( 'post_name', get_option('nisl_director_url') );
        }
        else {
            $director_url = 'director';
        }
        //cinematographer
        if(get_option('nisl_cinematographer_url') != false) {
            $cinemato_url = get_post_field( 'post_name', get_option('nisl_cinematographer_url') );
        }
        else {
            $cinemato_url = 'cinematographers-writers';
        }
    if($result->type=='Actress'){
        $sulg_url=get_option( 'siteurl' ).'/'.$actress_url.'/'.$result->slug;
    }
    if($result->type=='Actor'){
        $sulg_url=get_option( 'siteurl' ).'/'.$actor_url.'/'.$result->slug;
    }
    if($result->type=='Cinematographer'){
        $sulg_url=get_option( 'siteurl' ).'/'.$cinemato_url.'/'.$result->slug;
    }
    if($result->type=='Writer'){
        $sulg_url=get_option( 'siteurl' ).'/'.$writer_url.'/'.$result->slug;
    }
    if($result->type=='Director'){
        $sulg_url=get_option( 'siteurl' ).'/'.$director_url.'/'.$result->slug;
    }
    ?>
    <h4 class="media-heading"><span><?php echo $result->first_name.' '.$result->last_name; ?></span> <a><i class="fa fa-pencil edit_form_btn" aria-hidden="true" id="<?php echo $client_id; ?>"></i></a></h4>
     <p class="desig">
    <span><?php echo $result->type;?></span>
    <span>
        <?php if($result->show_hide=='0') {?>
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>admin/image/offline-icon.png" width="15px" height="15px" title="This user is hidden. This will not be displayed on frontend">
        <?php 
        } else {
            ?>
            <img src="<?php echo plugin_dir_url( __FILE__ );?>admin/image/online-icon.png" width="15px" height="15px" title="This will be displayed on frontend">
            <?php
        } ?>
    </span>
    </p>
    <p class="slug"><?php echo $result->slug;?><a target="_blank" href="<?php echo $sulg_url; ?>/" style="margin-left: 10px;"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
    <?php
    die;
}

//education
function callsheet_new_education_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $education_master = $wpdb->prefix . 'call_sheet_education';
   $wpdb->insert($education_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"education" => $form_data['education'],"position" => $form_data['position']));
    //$form_data['education'] = '';
    die;
}
function callsheet_single_education_record(){
    global $wpdb;
    $educationid = filter_var($_POST['education_id'], FILTER_VALIDATE_INT);
     $education_master = $wpdb->prefix . 'call_sheet_education';
    $sql  = $wpdb->prepare("SELECT * FROM $education_master WHERE education_id=%d",$educationid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_education_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="education_id" placeholder="" name="education_id" value="<?php echo $result->education_id; ?>">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="education"></label>
                                          <div class="col-sm-12">
                                              <textarea type="text"  class="form-control summernote_edu" id="education" rows="3" placeholder="" name="education"><?php echo $result->education; ?></textarea>
                                          </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_education_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $education_master = $wpdb->prefix . 'call_sheet_education';
    $wpdb->update($education_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"education" => $form_data['education']),
        array( 'education_id' =>$form_data['education_id']),'','');   
    die;
}
function callsheet_update_education_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $education_master = $wpdb->prefix . 'call_sheet_education';
    $wpdb->update($education_master,array("position" => $value),array( 'education_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_education_record(){
     global $wpdb;
    $education_master = $wpdb->prefix . 'call_sheet_education';
    $wpdb->delete( $education_master, array( 'education_id' => filter_var($_POST['education_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_education_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $education_master = $wpdb->prefix.'call_sheet_education';
    $sql           = $wpdb->prepare("SELECT * FROM $education_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->education_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo (trim($result->from_month)) ? $result->from_month.'-'.$result->from_year : $result->to_year ?? ''; ?></td>
          <td><?php echo (trim($result->to_month)) ? $result->to_month.'-'.$result->to_year : $result->to_year ?? ''; ?></td>
          <td><?php echo $result->education; ?></td>
          <td>
              <span class="edit edit_education_popup" id="<?php echo $result->education_id; ?>" data-toggle="modal" data-target="#education_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $education_master; ?>" id="<?php echo $result->education_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $education_master; ?>" id="<?php echo $result->education_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_education" id="<?php echo $result->education_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}
//news
function callsheet_new_news_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $news_master = $wpdb->prefix . 'call_sheet_news';
   $wpdb->insert($news_master, array(
        "client_id" => $form_data['client_id'],"news" => $form_data['news'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_news_record(){
    global $wpdb;
    $newsid = filter_var($_POST['news_id'],FILTER_VALIDATE_INT);
     $news_master = $wpdb->prefix . 'call_sheet_news';
    $sql  = $wpdb->prepare("SELECT * FROM $news_master WHERE news_id=%d",$newsid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_news_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="news_id" placeholder="" name="news_id" value="<?php echo $result->news_id; ?>">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="news"></label>
                                          <div class="col-sm-12">
                                              <textarea type="text"  class="form-control summernote_edu" id="news" rows="3" placeholder="" name="news"><?php echo $result->news; ?></textarea>
                                          </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_news_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $news_master = $wpdb->prefix . 'call_sheet_news';
    $wpdb->update($news_master,
        array("news" => $form_data['news']),
        array( 'news_id' =>$form_data['news_id']),'','');   
    die;
}
function callsheet_update_news_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $news_master = $wpdb->prefix . 'call_sheet_news';
    $wpdb->update($news_master,array("position" => $value),array( 'news_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_news_record(){
     global $wpdb;
    $news_master = $wpdb->prefix . 'call_sheet_news';
    $wpdb->delete( $news_master, array( 'news_id' => filter_var($_POST['news_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_news_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    $news_master = $wpdb->prefix.'call_sheet_news';
    $sql           = $wpdb->prepare("SELECT * FROM $news_master where client_id=%d ORDER BY position",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->news_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
         <td><?php echo $result->news; ?></td>
          <td>
              <span class="edit edit_news_popup" id="<?php echo $result->news_id; ?>" data-toggle="modal" data-target="#news_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $news_master; ?>" id="<?php echo $result->news_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $news_master; ?>" id="<?php echo $result->news_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_news" id="<?php echo $result->news_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}


//on_air
function callsheet_new_on_air_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
   $wpdb->insert($on_air_master, array(
        "client_id" => $form_data['client_id'],"on_air_date" => $form_data['on_air_date'],"on_air_to_date" => $form_data['on_air_to_date'],"on_air_time" => $form_data['on_air_time'],"on_air" => stripslashes($form_data['on_air']),"on_air_image" => $form_data['on_air_image'],"title" => stripslashes($form_data['on_air_title']),"role" => $form_data['on_air_role'],"director" => $form_data['on_air_director'],"channel" => $form_data['on_air_channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_on_air_record(){
    global $wpdb;
    $airid = filter_var($_POST['on_air_id'], FILTER_VALIDATE_INT);
     $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
    $sql  = $wpdb->prepare("SELECT * FROM $on_air_master WHERE on_air_id=%d",$airid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_on_air_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="on_air_id" placeholder="" name="on_air_id" value="<?php echo $result->on_air_id; ?>">
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            From date: <input type="date" class="form-control"  id="on_air_date" placeholder="" name="on_air_date" value="<?php echo $result->on_air_date; ?>"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" class="form-control"  id="on_air_time" placeholder="" name="on_air_time" value="<?php echo $result->on_air_time; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            To Date: <input type="date" class="form-control"  id="on_air_to_date" placeholder="" name="on_air_to_date" value="<?php echo $result->on_air_to_date; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_air"><?php _e('Text On Screen', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                              <textarea class="form-control summernote" rows="3" id="on_air_editor" placeholder="" name="on_air"><?php echo stripslashes($result->on_air); ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_air_image"><?php _e('Upload Image', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                               <div class="upload-img">
                                                    <a href="#" class="btn btn-default on_air_upload_image_button button">
                                                        <?php if($result->on_air_image != '') { 
                                                            $display = 'block';
                                                            $link = wp_get_attachment_image_src( $result->on_air_image ); ?>
                                                            <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                                        <?php } else {
                                                            $display = 'none'; ?>
                                                        <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                                                    <?php } ?>
                                                    </a>
                                                        <input type="hidden" id="on_air_image" name="on_air_image" value="<?php echo $result->on_air_image; ?>">
                                                        <a href="#" class="on_air_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                                                </div>
                                                
                                          </div>
                                      </div>
                                      <hr style="border-color: #B6B6B7;"/>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_air_title_edit"><?php _e('Title','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control on_air_title"  id="on_air_title_edit" placeholder="" name="on_air_title" value="<?php echo htmlentities($result->title); ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_air_role"><?php _e('Role','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_air_role_edit" placeholder="" name="on_air_role" value="<?php echo $result->role; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_air_director"><?php _e('Director','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_air_director_edit" placeholder="" name="on_air_director" value="<?php echo $result->director; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_air_channel"><?php _e('Channel/Distributor','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_air_channel_edit" placeholder="" name="on_air_channel" value="<?php echo $result->channel; ?>"/>
                                        </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_on_air_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
    $wpdb->update($on_air_master,
        array("on_air_date" => $form_data['on_air_date'],
            "on_air_to_date" => $form_data['on_air_to_date'],
            "on_air_time" => $form_data['on_air_time'],
            "on_air" => stripslashes($form_data['on_air']),
            "on_air_image" => $form_data['on_air_image'],
            "title" => stripslashes($form_data['on_air_title']),
            "role" => $form_data['on_air_role'],
            "director" => $form_data['on_air_director'],
            "channel" => $form_data['on_air_channel']
            ),
        array( 'on_air_id' =>$form_data['on_air_id']),'','');   
    die;
}
function callsheet_update_on_air_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
    $wpdb->update($on_air_master,array("position" => $value),array( 'on_air_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_on_air_record(){
     global $wpdb;
    $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
    $wpdb->delete( $on_air_master, array( 'on_air_id' => filter_var($_POST['on_air_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_on_air_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $on_air_master = $wpdb->prefix.'call_sheet_on_air';
    $sql           = $wpdb->prepare("SELECT * FROM $on_air_master where client_id=%d ORDER BY on_air_date DESC",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
        
    ?>
        <tr idd="<?php echo $result->on_air_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td>
            <?php 
            if($result->on_air_image != '') {
                 $link = wp_get_attachment_image_src( $result->on_air_image ); ?> 
                 <img src="<?php echo $link[0]; ?>" style="height:100px;width:100px;"/> 
            <?php } ?>
          </td>
         <td><?php echo $result->on_air_date; ?></td>
         <td><?php echo $result->on_air_to_date; ?></td>
         <td><?php echo $result->on_air_time; ?></td>
         <td><?php echo stripslashes($result->on_air); ?></td>
         <td><?php echo $result->title; ?></td>
         <td><?php echo $result->role; ?></td>
         <td><?php echo $result->director; ?></td>
         <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_on_air_popup" id="<?php echo $result->on_air_id; ?>" data-toggle="modal" data-target="#on_air_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $on_air_master; ?>" id="<?php echo $result->on_air_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $on_air_master; ?>" id="<?php echo $result->on_air_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_on_air" id="<?php echo $result->on_air_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
           <td>
              <input type="checkbox" name="air_show_always" id="air_show_always" class="on_air_show_always" table_id="<?php echo $result->on_air_id; ?>" table_name="on_air" value="<?php echo $result->show_always; ?>" <?php if($result->show_always == '1' ) { echo 'checked';} else { echo ''; } ?> >
          </td>
        </tr>
    <?php $count++;}
              die;
}

//on_tv
function callsheet_new_on_tv_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
   $wpdb->insert($on_tv_master, array(
        "client_id" => $form_data['client_id'],"on_tv_date" => $form_data['on_tv_date'],"on_tv_to_date" => $form_data['on_tv_to_date'],"on_tv_time" => $form_data['on_tv_time'],"on_tv" => stripslashes($form_data['on_tv']),"on_tv_image" => $form_data['on_tv_image'],"title" => stripslashes($form_data['on_tv_title']),"role" => $form_data['on_tv_role'],"director" => $form_data['on_tv_director'],"channel" => $form_data['on_tv_channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_on_tv_record(){
    global $wpdb;
    $tvid = filter_var($_POST['on_tv_id'], FILTER_VALIDATE_INT);
     $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
    $sql  = $wpdb->prepare("SELECT * FROM $on_tv_master WHERE on_tv_id=%d",$tvid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_on_tv_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="on_tv_id" placeholder="" name="on_tv_id" value="<?php echo $result->on_tv_id; ?>">
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                           From date: <input type="date" class="form-control"  id="on_tv_date" placeholder="" name="on_tv_date" value="<?php echo $result->on_tv_date; ?>"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" class="form-control"  id="on_tv_time" placeholder="" name="on_tv_time" value="<?php echo $result->on_tv_time; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                           To date: <input type="date" class="form-control"  id="on_tv_to_date" placeholder="" name="on_tv_to_date" value="<?php echo $result->on_tv_to_date; ?>" />
                                        </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_tv"><?php _e('Text On Tv', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                              <textarea class="form-control summernote" rows="3" id="on_tv_editor" placeholder="" name="on_tv"><?php echo stripslashes($result->on_tv); ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_tv_image"><?php _e('Upload Image', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                               <div class="upload-img">
                                                    <a href="#" class="btn btn-default on_tv_upload_image_button button">
                                                        <?php if($result->on_tv_image != '') { 
                                                            $display = 'block';
                                                            $link = wp_get_attachment_image_src( $result->on_tv_image ); ?>
                                                            <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                                        <?php } else {
                                                            $display = 'none'; ?>
                                                        <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                                                    <?php } ?>
                                                    </a>
                                                        <input type="hidden" id="on_tv_image" name="on_tv_image" value="<?php echo $result->on_tv_image; ?>">
                                                        <a href="#" class="on_tv_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                                                </div>
                                                
                                          </div>
                                      </div>
                                      <hr style="border-color: #B6B6B7;"/>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_tv_title_edit"><?php _e('Title','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control on_tv_title"  id="on_tv_title_edit" placeholder="" name="on_tv_title" value="<?php echo htmlentities($result->title); ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_tv_role"><?php _e('Role','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_tv_role_edit" placeholder="" name="on_tv_role" value="<?php echo $result->role; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_tv_director"><?php _e('Director','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_tv_director_edit" placeholder="" name="on_tv_director" value="<?php echo $result->director; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_tv_channel"><?php _e('Channel/Distributor','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_tv_channel_edit" placeholder="" name="on_tv_channel" value="<?php echo $result->channel; ?>"/>
                                        </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_on_tv_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
    $wpdb->update($on_tv_master,
        array("on_tv_date" => $form_data['on_tv_date'],
            "on_tv_to_date" => $form_data['on_tv_to_date'],
            "on_tv_time" => $form_data['on_tv_time'],
            "on_tv" => stripslashes($form_data['on_tv']),
            "on_tv_image" => $form_data['on_tv_image'],
            "title" => stripslashes($form_data['on_tv_title']),
            "role" => $form_data['on_tv_role'],
            "director" => $form_data['on_tv_director'],
            "channel" => $form_data['on_tv_channel']
            ),
        array( 'on_tv_id' =>$form_data['on_tv_id']),'','');   
    die;
}
function callsheet_update_on_tv_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
    $wpdb->update($on_tv_master,array("position" => $value),array( 'on_tv_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_on_tv_record(){
     global $wpdb;
    $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
    $wpdb->delete( $on_tv_master, array( 'on_tv_id' => filter_var($_POST['on_tv_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_on_tv_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $on_tv_master = $wpdb->prefix.'call_sheet_on_tv';
    $sql           = $wpdb->prepare("SELECT * FROM $on_tv_master where client_id=%d ORDER BY on_tv_date DESC",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
        
    ?>
        <tr idd="<?php echo $result->on_tv_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td>
            <?php 
            if($result->on_tv_image != '') {
                 $link = wp_get_attachment_image_src( $result->on_tv_image ); ?> 
                 <img src="<?php echo $link[0]; ?>" style="height:100px;width:100px;"/> 
            <?php } ?>
          </td>
         <td><?php echo $result->on_tv_date; ?></td>
         <td><?php echo $result->on_tv_to_date; ?></td>
         <td><?php echo $result->on_tv_time; ?></td>
         <td><?php echo stripslashes($result->on_tv); ?></td>
         <td><?php echo $result->title; ?></td>
         <td><?php echo $result->role; ?></td>
         <td><?php echo $result->director; ?></td>
         <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_on_tv_popup" id="<?php echo $result->on_tv_id; ?>" data-toggle="modal" data-target="#on_tv_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="on_tv_show_hide" table_name="<?php echo $on_tv_master; ?>" short_table_name="on_tv" id="<?php echo $result->on_tv_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="on_tv_show_hide" table_name="<?php echo $on_tv_master; ?>" short_table_name="on_tv" id="<?php echo $result->on_tv_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_on_tv" id="<?php echo $result->on_tv_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
          <td>
              <input type="checkbox" name="show_always" id="show_always" class="on_tv_show_always" table_id="<?php echo $result->on_tv_id; ?>" table_name="on_tv" value="<?php echo $result->show_always; ?>" <?php if($result->show_always == '1' ) { echo 'checked';} else { echo ''; } ?> >
          </td>
        </tr>
    <?php $count++;}
              die;
}

function callsheet_show_always_update(){
    
     global $wpdb;
     $table_name = filter_var($_POST['table_name'], FILTER_SANITIZE_STRING);
     $uniqueid = filter_var($_POST['id'], FILTER_VALIDATE_INT);
     $master_table = $wpdb->prefix.'call_sheet_'.$table_name;
       $sql="SHOW KEYS FROM $master_table WHERE Key_name = 'PRIMARY'";
     $results=$wpdb->get_row($sql);
      $col_name=$results->Column_name;
      $sql1  = $wpdb->prepare("SELECT show_always FROM $master_table WHERE $col_name=%d",$uniqueid);
      
      $result1=$wpdb->get_row($sql1);
      if($result1->show_always=='1'){
         
        $wpdb->update($master_table,array("show_always" => '0'),array( $col_name =>filter_var($_POST['id'],FILTER_VALIDATE_INT) ),'','');     
      }else{
          
        $wpdb->update($master_table,array("show_always" =>'1'),array($col_name =>filter_var($_POST['id'],FILTER_VALIDATE_INT) ),'','');     
      }
      die;
}

//at_festival
function callsheet_new_at_festival_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
   $wpdb->insert($at_fest_master, array(
        "client_id" => $form_data['client_id'],"at_festival_date" => $form_data['at_festival_date'],"at_festival_to_date" => $form_data['at_festival_to_date'],"at_festival_time" => $form_data['at_festival_time'],"at_festival" => stripslashes($form_data['at_festival']),"at_festival_image" => $form_data['at_festival_image'],"title" => stripslashes($form_data['at_festival_title']),"role" => $form_data['at_festival_role'],"director" => $form_data['at_festival_director'],"channel" => $form_data['at_festival_channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_at_festival_record(){
    global $wpdb;
    $festid = filter_var($_POST['at_festival_id'], FILTER_VALIDATE_INT);
     $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
    $sql  = $wpdb->prepare("SELECT * FROM $at_fest_master WHERE at_festival_id=%d",$festid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_at_festival_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="at_festival_id" placeholder="" name="at_festival_id" value="<?php echo $result->at_festival_id; ?>">
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            From date: <input type="date" class="form-control"  id="at_festival_date" placeholder="" name="at_festival_date" value="<?php echo $result->at_festival_date; ?>"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" class="form-control"  id="at_festival_time" placeholder="" name="at_festival_time" value="<?php echo $result->at_festival_time; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            To date: <input type="date" class="form-control"  id="at_festival_to_date" placeholder="" name="at_festival_to_date" value="<?php echo $result->at_festival_to_date; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="at_festival"><?php _e('Text On Screen', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                              <textarea class="form-control summernote" rows="3" id="at_festival_editor" placeholder="" name="at_festival"><?php echo stripslashes($result->at_festival); ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="at_festival_image"><?php _e('Upload Image', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                               <div class="upload-img">
                                                    <a href="#" class="btn btn-default at_festival_upload_image_button button">
                                                        <?php if($result->at_festival_image != '') { 
                                                            $display = 'block';
                                                            $link = wp_get_attachment_image_src( $result->at_festival_image ); ?>
                                                            <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                                        <?php } else {
                                                            $display = 'none'; ?>
                                                        <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                                                    <?php } ?>
                                                    </a>
                                                        <input type="hidden" id="at_festival_image" name="at_festival_image" value="<?php echo $result->at_festival_image; ?>">
                                                        <a href="#" class="at_festival_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                                                </div>
                                                
                                          </div>
                                      </div>
                                      <hr style="border-color: #B6B6B7;"/>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="at_festival_title_edit"><?php _e('Title','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control at_festival_title"  id="at_festival_title_edit" placeholder="" name="at_festival_title" value="<?php echo htmlentities($result->title); ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="at_festival_role"><?php _e('Role','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="at_festival_role_edit" placeholder="" name="at_festival_role" value="<?php echo $result->role; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="at_festival_director"><?php _e('Director','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="at_festival_director_edit" placeholder="" name="at_festival_director" value="<?php echo $result->director; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="at_festival_channel"><?php _e('Channel','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="at_festival_channel_edit" placeholder="" name="at_festival_channel" value="<?php echo $result->channel; ?>"/>
                                        </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_at_festival_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
    $wpdb->update($at_fest_master,
        array("at_festival_date" => $form_data['at_festival_date'],
            "at_festival_to_date" => $form_data['at_festival_to_date'],
            "at_festival_time" => $form_data['at_festival_time'],
            "at_festival" => stripslashes($form_data['at_festival']),
            "at_festival_image" => $form_data['at_festival_image'],
            "title" => stripslashes($form_data['at_festival_title']),
            "role" => $form_data['at_festival_role'],
            "director" => $form_data['at_festival_director'],
            "channel" => $form_data['at_festival_channel']
            ),
        array( 'at_festival_id' =>$form_data['at_festival_id']),'','');   
    die;
}
function callsheet_update_at_festival_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
    $wpdb->update($at_fest_master,array("position" => $value),array( 'at_festival_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_at_festival_record(){
     global $wpdb;
    $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
    $wpdb->delete( $at_fest_master, array( 'at_festival_id' => filter_var($_POST['at_festival_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_at_festival_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $at_fest_master = $wpdb->prefix.'call_sheet_at_festival';
    $sql           = $wpdb->prepare("SELECT * FROM $at_fest_master where client_id=%d ORDER BY at_festival_date DESC",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->at_festival_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td>
            <?php 
            if($result->at_festival_image != '') {
                 $link = wp_get_attachment_image_src( $result->at_festival_image ); ?> 
                 <img src="<?php echo $link[0]; ?>" style="height:100px;width:100px;"/> 
            <?php } ?>
          </td>
         <td><?php echo $result->at_festival_date; ?></td>
         <td><?php echo $result->at_festival_to_date; ?></td>
         <td><?php echo $result->at_festival_time; ?></td>
         <td><?php echo stripslashes($result->at_festival); ?></td>
         <td><?php echo $result->title; ?></td>
         <td><?php echo $result->role; ?></td>
         <td><?php echo $result->director; ?></td>
         <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_at_festival_popup" id="<?php echo $result->at_festival_id; ?>" data-toggle="modal" data-target="#at_festival_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="at_festival_show_hide" short_table_name="at_festival" table_name="<?php echo $at_fest_master; ?>" id="<?php echo $result->at_festival_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="at_festival_show_hide" table_name="<?php echo $at_fest_master; ?>" short_table_name="at_festival" id="<?php echo $result->at_festival_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_at_festival" id="<?php echo $result->at_festival_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
           <td>
              <input type="checkbox" name="fest_show_always" id="fest_show_always" class="at_fest_show_always" table_id="<?php echo $result->at_festival_id; ?>" table_name="at_festival" value="<?php echo $result->show_always; ?>" <?php if($result->show_always == '1' ) { echo 'checked';} else { echo ''; } ?> >
          </td>
        </tr>
    <?php $count++;}
              die;
}

//on_stage

function callsheet_new_on_stage_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
   $wpdb->insert($on_stage_master, array(
        "client_id" => $form_data['client_id'],"on_stage_date" => $form_data['on_stage_date'],"on_stage_to_date" => $form_data['on_stage_to_date'],"on_stage_time" => $form_data['on_stage_time'],"on_stage" => stripslashes($form_data['on_stage']),"on_stage_image" => $form_data['on_stage_image'],"title" => stripslashes($form_data['on_stage_title']),"role" => $form_data['on_stage_role'],"director" => $form_data['on_stage_director'],"theater" => stripslashes($form_data['on_stage_theater']),"position" => $form_data['position']));
    
    die;
}
function callsheet_single_on_stage_record(){
    global $wpdb;
    $stageid = filter_var($_POST['on_stage_id'], FILTER_VALIDATE_INT);
     $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $sql  = $wpdb->prepare("SELECT * FROM $on_stage_master WHERE on_stage_id=%d",$stageid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_on_stage_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="on_stage_id" placeholder="" name="on_stage_id" value="<?php echo $result->on_stage_id; ?>">
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            From date: <input type="date" class="form-control"  id="on_stage_date" placeholder="" name="on_stage_date" value="<?php echo $result->on_stage_date; ?>"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" class="form-control"  id="on_stage_time" placeholder="" name="on_stage_time" value="<?php echo $result->on_stage_time; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-6">
                                            To date: <input type="date" class="form-control"  id="on_stage_to_date" placeholder="" name="on_stage_to_date" value="<?php echo $result->on_stage_to_date; ?>"/>
                                        </div>
                                       </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_stage"><?php _e('Text On Stage', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                              <textarea class="form-control summernote" rows="3" id="on_stage_editor" placeholder="" name="on_stage"><?php echo stripslashes($result->on_stage); ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_stage_image"><?php _e('Upload Image', 'callsheet'); ?></label>
                                          <div class="col-sm-7">
                                               <div class="upload-img">
                                                    <a href="#" class="btn btn-default on_stage_upload_image_button button">
                                                        <?php if($result->on_stage_image != '') { 
                                                            $display = 'block';
                                                            $link = wp_get_attachment_image_src( $result->on_stage_image ); ?>
                                                            <img src="<?php echo $link[0]; ?>" style="height:150px;width:150px;display:block;"/> 
                                                        <?php } else {
                                                            $display = 'none'; ?>
                                                        <span class="wp-media-buttons-icon"><?php _e('Add Image','callsheet'); ?></span>
                                                    <?php } ?>
                                                    </a>
                                                        <input type="hidden" id="on_stage_image" name="on_stage_image" value="<?php echo $result->on_stage_image; ?>">
                                                        <a href="#" class="on_stage_remove_image_button remove" style="display:<?php echo $display;?>;"><i class="fa fa-times"></i></a>
                                                </div>
                                                
                                          </div>
                                      </div>
                                      <hr style="border-color: #B6B6B7;"/>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_stage_title_edit"><?php _e('Title','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control on_stage_title"  id="on_stage_title_edit" placeholder="" name="on_stage_title" value="<?php echo htmlentities($result->title); ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_stage_role"><?php _e('Role','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_stage_role_edit" placeholder="" name="on_stage_role" value="<?php echo $result->role; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_stage_director"><?php _e('Director','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_stage_director_edit" placeholder="" name="on_stage_director" value="<?php echo $result->director; ?>"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for="on_stage_theater"><?php _e('Theater','callsheet'); ?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  id="on_stage_theater_edit" placeholder="" name="on_stage_theater" value='<?php echo $result->theater; ?>'/>
                                        </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_on_stage_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->update($on_stage_master,
        array("on_stage_date" => $form_data['on_stage_date'],
            "on_stage_to_date" => $form_data['on_stage_to_date'],
            "on_stage_time" => $form_data['on_stage_time'],
            "on_stage" => stripslashes($form_data['on_stage']),
            "on_stage_image" => $form_data['on_stage_image'],
            "title" => stripslashes($form_data['on_stage_title']),
            "role" => $form_data['on_stage_role'],
            "director" => $form_data['on_stage_director'],
            "theater" => stripslashes($form_data['on_stage_theater'])
            ),
        array( 'on_stage_id' =>$form_data['on_stage_id']),'','');   
    die;
}
function callsheet_update_on_stage_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->update($on_stage_master,array("position" => $value),array( 'on_stage_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_on_stage_record(){
     global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->delete( $on_stage_master, array( 'on_stage_id' => filter_var($_POST['on_stage_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_on_stage_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $on_stage_master = $wpdb->prefix.'call_sheet_on_stage';
    $sql           = $wpdb->prepare("SELECT * FROM $on_stage_master where client_id=%d ORDER BY on_stage_date DESC",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->on_stage_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td>
            <?php 
            if($result->on_stage_image != '') {
                 $link = wp_get_attachment_image_src( $result->on_stage_image ); ?> 
                 <img src="<?php echo $link[0]; ?>" style="height:100px;width:100px;"/> 
            <?php } ?>
          </td>
         <td><?php echo $result->on_stage_date; ?></td>
         <td><?php echo $result->on_stage_to_date; ?></td>
         <td><?php echo $result->on_stage_time; ?></td>
         <td><?php echo stripslashes($result->on_stage); ?></td>
         <td><?php echo $result->title; ?></td>
         <td><?php echo $result->role; ?></td>
         <td><?php echo $result->director; ?></td>
         <td><?php echo $result->theater; ?></td>
          <td>
              <span class="edit edit_on_stage_popup" id="<?php echo $result->on_stage_id; ?>" data-toggle="modal" data-target="#on_stage_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="on_stage_show_hide" table_name="<?php echo $on_stage_master; ?>" short_table_name="on_stage" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="on_stage_show_hide" table_name="<?php echo $on_stage_master; ?>" short_table_name="on_stage" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_on_stage" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
           <td>
              <input type="checkbox" name="stage_show_always" id="stage_show_always" class="on_stage_show_always" table_id="<?php echo $result->on_stage_id; ?>" table_name="on_stage" value="<?php echo $result->show_always; ?>" <?php if($result->show_always == '1' ) { echo 'checked';} else { echo ''; } ?> >
          </td>
        </tr>
    <?php $count++;}
              die;
}

//press agency
function callsheet_press_agency_save() {
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $client_id= filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    //agencies manage
    
    $client_agencies=$form_data['agencies'];
    $client_agencies_url=$form_data['agencies_url'];
    $client_agencies_cat=$form_data['agencies_cat'];
    
    $press_agency = array();

    foreach ( $client_agencies as $key=>$name ) {
        
            $press_agency[] = array( 'agency' => $name, 'link' => $client_agencies_url[ $key ], 'category' => $client_agencies_cat[ $key ] );
        
    }
    // $press_agency = array_merge($client_agencies,$client_agencies_url,$client_agencies_cat);
    $client_master = $wpdb->prefix.'call_sheet_client_master';
    $wpdb->update($client_master,
            array('agencies' => serialize($press_agency)),
            array( 'client_id' => $client_id ),'','');
    //echo $client_id;
    //print_r($press_agency);
    
    die;
}
//get agency record
function callsheet_get_agency_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $client_master = $wpdb->prefix.'call_sheet_client_master';
    $sql           = $wpdb->prepare("SELECT * FROM $client_master where client_id=%d",$cid);
    $result       = $wpdb->get_row($sql);
    $counter = 1;
    //echo 'agencies:'.$result->client_id;
    $press_agencies = array();
    $press_agencies = unserialize($result->agencies);
    //print_r($press_agencies);
    foreach ($press_agencies as $press_ag) {
       
    ?>
        
        <div id="TextBoxDiv<?php echo $counter;?>" class="press_agency">
            <!-- <input type="hidden" name="client_id" value="<?php //echo $result->client_id; ?>"/> -->
            <input type="text" class="agency-name" placeholder="Agency Name" data-id="agencies_<?php echo $counter;?>" id="agencies_<?php echo $counter;?>" name="agencies[]" value="<?php echo $press_ag['agency'];; ?>" />
            <input type="text" class="agency-link" placeholder="Agency Link" data-id="agencies_url_<?php echo $counter;?>" id="agencies_url_<?php echo $counter;?>" name="agencies_url[]" value="<?php echo $press_ag['link']; ?>" />
            <select name="agencies_cat[]" id="agencies_cat_<?php echo $counter; ?>" data-id="agencies_cat_<?php echo $counter; ?>">
                <option value="public_relations" <?php if(($press_ag['category']) == 'public_relations') { echo 'selected'; } ?>>Public Relations</option>
                <option value="social_media" <?php if(($press_ag['category']) == 'social_media') { echo 'selected'; } ?>>Social Media</option>
                <option value="public_social" <?php if(($press_ag['category']) == 'public_social') { echo 'selected'; } ?>>Public Relations / Social Media</option>
            </select>
            <button class="remove_data btn btn-default red" data-id="<?php echo $counter;?>">Delete</button>
        </div>
<?php  
        $counter++;
    }    
              die;
}


/*//on_stage
function new_on_stage_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
   $wpdb->insert($on_stage_master, array(
        "client_id" => $form_data['client_id'],"on_stage" => $form_data['on_stage'],"position" => $form_data['position']));
    
    die;
}
function single_on_stage_record(){
    global $wpdb;
     $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $sql  = "SELECT * FROM $on_stage_master WHERE on_stage_id='$_POST[on_stage_id]'";
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_on_stage_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="on_stage_id" placeholder="" name="on_stage_id" value="<?php echo $result->on_stage_id; ?>">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="on_stage"></label>
                                          <div class="col-sm-12">
                                              <textarea type="text"  class="form-control summernote_edu" id="on_stage" rows="3" placeholder="" name="on_stage"><?php echo $result->on_stage; ?></textarea>
                                          </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function edit_on_stage_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->update($on_stage_master,
        array("on_stage" => $form_data['on_stage']),
        array( 'on_stage_id' =>$form_data['on_stage_id']),'','');   
    die;
}
function update_on_stage_position(){
    unset($_POST['action']);
    foreach($_POST as $key => $value) {
    global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->update($on_stage_master,array("position" => $value),array( 'on_stage_id' =>$key),'','');   
}
    die;
}

function delete_on_stage_record(){
     global $wpdb;
    $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
    $wpdb->delete( $on_stage_master, array( 'on_stage_id' => $_POST['on_stage_id'] ) );
    die;
}
function get_on_stage_record(){
    global $wpdb;
    $on_stage_master = $wpdb->prefix.'call_sheet_on_stage';
    $sql           = "SELECT * FROM $on_stage_master where client_id='$_POST[client_id]' ORDER BY position";
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->on_stage_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
         <td><?php echo $result->on_stage; ?></td>
          <td>
              <span class="edit edit_on_stage_popup" id="<?php echo $result->on_stage_id; ?>" data-toggle="modal" data-target="#on_stage_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $on_stage_master; ?>" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $on_stage_master; ?>" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_on_stage" id="<?php echo $result->on_stage_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>

        </tr>
    <?php $count++;}
              die;
}*/

//awards
function callsheet_new_awards_record(){
   parse_str($_POST['formdata'], $form_data);
   
   global $wpdb;
   if(!empty($form_data['awards'])) {
        $award_text = $form_data['awards'];
   }
   
   /*else {
        $award_text = $_POST['notes'];
   }
   */

   $awards_master = $wpdb->prefix . 'call_sheet_awards';
   $wpdb->insert($awards_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"awards" => stripslashes($award_text),"position" => $form_data['position']));
    
    die;
}
function callsheet_single_awards_record(){
    global $wpdb;
    $awdid = filter_var($_POST['awards_id'], FILTER_VALIDATE_INT);
     $awards_master = $wpdb->prefix . 'call_sheet_awards';
    $sql  = $wpdb->prepare("SELECT * FROM $awards_master WHERE awards_id=%d",$awdid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_awards_form">
                                      <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="awards_id" placeholder="" name="awards_id" value="<?php echo $result->awards_id; ?>">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="control-label col-sm-3" for="awards"></label>
                                          <div class="col-sm-12">
                                              <textarea type="text" class="form-control summernote_award" id="awards" rows="3" placeholder="" name="awards"><?php echo stripslashes($result->awards); ?></textarea>
                                          </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_awards_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    if(!empty($form_data['awards'])) {
        $award_text = $form_data['awards'];
   }
   /*else {
        $award_text = $_POST['notes'];
   }*/
    $awards_master = $wpdb->prefix . 'call_sheet_awards';
    $wpdb->update($awards_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"awards" => stripslashes($award_text)),
        array( 'awards_id' =>$form_data['awards_id']),'','');   
    die;
}
function callsheet_update_awards_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $awards_master = $wpdb->prefix . 'call_sheet_awards';
    $wpdb->update($awards_master,array("position" => $value),array( 'awards_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_awards_record(){
     global $wpdb;
    $awards_master = $wpdb->prefix . 'call_sheet_awards';
    $wpdb->delete( $awards_master, array( 'awards_id' => filter_var($_POST['awards_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_awards_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $awards_master = $wpdb->prefix.'call_sheet_awards';
    $sql           = $wpdb->prepare("SELECT * FROM $awards_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->awards_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo $result->from_month.'-'.$result->from_year; ?></td>
          <td><?php echo $result->to_month.'-'.$result->to_year; ?></td>
          <td><?php echo stripslashes($result->awards); ?></td>
          <td>
              <span class="edit edit_awards_popup" id="<?php echo $result->awards_id; ?>" data-toggle="modal" data-target="#awards_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $awards_master; ?>" id="<?php echo $result->awards_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $awards_master; ?>" id="<?php echo $result->awards_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_awards" id="<?php echo $result->awards_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}
//tv
function callsheet_new_tv_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $tv_master = $wpdb->prefix . 'call_sheet_tv';
   $wpdb->insert($tv_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"tv" => stripslashes($form_data['tv']),"description" => stripslashes($form_data['description']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"category" => $form_data['category'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_tv_record(){
    global $wpdb;
    $tvid = filter_var($_POST['tv_id'], FILTER_VALIDATE_INT);
     $tv_master = $wpdb->prefix . 'call_sheet_tv';
    $sql  = $wpdb->prepare("SELECT * FROM $tv_master WHERE tv_id=%d",$tvid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_tv_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="tv_id" placeholder="" name="tv_id" value="<?php echo $result->tv_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="tv"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="tv" rows="3" placeholder="" name="tv"><?php echo stripslashes($result->tv); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                        <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="category"><?php _e('Category', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                                <input type="text" id="category" name="category" class="form-control" value="<?php echo $result->category; ?>" />
                                                    
                                              <!-- <input type="text" class="form-control"  id="channel" placeholder="" name="channel"/> -->
                                          </div>
                                        </div>

                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div> 
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_tv_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $tv_master = $wpdb->prefix . 'call_sheet_tv';
    $wpdb->update($tv_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"tv" => stripslashes($form_data['tv']),"description" => stripslashes($form_data['description']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'], "category"=> $form_data['category']),
        array( 'tv_id' =>$form_data['tv_id']),'','');   
    die;
}
function callsheet_update_tv_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $tv_master = $wpdb->prefix . 'call_sheet_tv';
    $wpdb->update($tv_master,array("position" => $value),array( 'tv_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_tv_record(){
     global $wpdb;
    $tv_master = $wpdb->prefix . 'call_sheet_tv';
    $wpdb->delete( $tv_master, array( 'tv_id' => filter_var($_POST['tv_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_tv_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $tv_master = $wpdb->prefix.'call_sheet_tv';
    $sql           = $wpdb->prepare("SELECT * FROM $tv_master where client_id=%d ORDER BY from_year DESC,from_month DESC,to_year DESC,position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->tv_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo $result->from_month.'-'.$result->from_year; ?></td>
          <td><?php echo $result->to_month.'-'.$result->to_year; ?></td>
          <td><?php echo stripslashes($result->tv); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
           <td><?php if($result->category != '') { _e($result->category,'callsheet');} ?></td>
          <td>
              <span class="edit edit_tv_popup" id="<?php echo $result->tv_id; ?>" data-toggle="modal" data-target="#tv_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $tv_master; ?>" id="<?php echo $result->tv_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $tv_master; ?>" id="<?php echo $result->tv_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_tv" id="<?php echo $result->tv_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}
function callsheet_add_tv_rows() {
    $total_rows = filter_var($_POST['total_rows'],FILTER_VALIDATE_INT);
    $cid = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    $tbl_name = filter_var($_POST['table_name'],FILTER_SANITIZE_STRING);
    $tv_rows = 'nisl_total_rows_'.$cid ;
    $tv_rows_value = get_option($tv_rows);

    $rows_value = array($tbl_name=>$total_rows);

    if ( get_option( $tv_rows ) !== false ) {

        // The option already exists, so we just update it.
        foreach ($tv_rows_value as $key => $value) {

            if(array_key_exists($tbl_name,$tv_rows_value)) {
                
                $tv_rows_value[$tbl_name] = $total_rows;
                
                update_option( $tv_rows, $tv_rows_value );
            }
            else {
                 
                $test_arr = $tv_rows_value + $rows_value;
                
                update_option( $tv_rows, $test_arr );

               
            }
            
        }

    } else {

        // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
        $deprecated = null;
        $autoload = 'no';
        add_option( $tv_rows, $rows_value, $deprecated, $autoload );
    }
    die;
}
function callsheet_get_total_rows_record(){
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $tbl_name = filter_var($_POST['table_name'], FILTER_SANITIZE_STRING);
    $tv_rows = 'nisl_total_rows_'.$cid ;
    $tv_rows_value = get_option($tv_rows);
    if(!$tv_rows_value) {
        $final_val = 5;
    }
    else {
        foreach ($tv_rows_value as $key=>$value) {
        
            if($tbl_name == $key) {
                $final_val = $value;
            }
            else {
                $final_val = 5;
            }
        }
    }
    echo json_encode($final_val);
    die;
}
//film
function callsheet_new_film_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $film_master = $wpdb->prefix . 'call_sheet_film';
   $wpdb->insert($film_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"film" => stripslashes($form_data['film']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"category" => $form_data['category'],"position" => 0));
    
    die;
}
function callsheet_single_film_record(){
    global $wpdb;
    $filmid = filter_var($_POST['film_id'], FILTER_VALIDATE_INT);
     $film_master = $wpdb->prefix . 'call_sheet_film';
    $sql  = $wpdb->prepare("SELECT * FROM $film_master WHERE film_id=%d",$filmid);
    $result  = $wpdb->get_row($sql);
    ?>
        
                                  <form class="form-horizontal edit_film_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="film_id" placeholder="" name="film_id" value="<?php echo $result->film_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="film"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="film" rows="3" placeholder="" name="film"><?php echo stripslashes($result->film); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                        <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Distributor', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="category"><?php _e('Category', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                                <input type="text" id="category" name="category" class="form-control" value="<?php echo $result->category; ?>" />
                                                    
                                              <!-- <input type="text" class="form-control"  id="channel" placeholder="" name="channel"/> -->
                                          </div>
                                        </div>

                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_film_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $film_master = $wpdb->prefix . 'call_sheet_film';
    $wpdb->update($film_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"film" => stripslashes($form_data['film']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"category"=> $form_data['category']),
        array( 'film_id' =>$form_data['film_id']),'','');   
    die;
}
function callsheet_update_film_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $film_master = $wpdb->prefix . 'call_sheet_film';
    $wpdb->update($film_master,array("position" => $value),array( 'film_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_film_record(){
     global $wpdb;
    $film_master = $wpdb->prefix . 'call_sheet_film';
    $wpdb->delete( $film_master, array( 'film_id' => filter_var($_POST['film_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_film_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $film_master = $wpdb->prefix.'call_sheet_film';
    /* $sql_year = "select to_year from $film_master where client_id=".$cid;
     $results_year = $wpdb->get_results($sql_year);

    $i=0;

     foreach ($results_year as $rsyear) {
         $all_to_year = $rsyear->to_year;*/
       
    
    $sql = $wpdb->prepare("SELECT * FROM $film_master where client_id=%d ORDER BY from_year DESC,from_month DESC,position",$cid); //
    
    $results = $wpdb->get_results($sql);
    $count=1;

    /*if($all_to_year == $results_test[$i]->from_year) {
        echo 'in if:';
        $result = $wpdb->get_row($sql.' ORDER BY to_year DESC,from_year DESC,position');
        print_r($result);
    }
    else{
        echo 'in else:';
         $result = $wpdb->get_row($sql.' ORDER BY from_year DESC,from_month DESC,to_year DESC,position');
        print_r($result);
    }*/

    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->film_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo (trim($result->from_month)) ? $result->from_month.'-'.$result->from_year : $result->to_year ?? ''; ?></td>
          <td><?php echo (trim($result->to_month)) ? $result->to_month.'-'.$result->to_year : $result->to_year ?? ''; ?></td>
          <td><?php echo stripslashes($result->film); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
           <td><?php if($result->category != '') { _e($result->category,'callsheet');} ?></td>
          <td>
              <span class="edit edit_film_popup" id="<?php echo $result->film_id; ?>" data-toggle="modal" data-target="#film_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $film_master; ?>"  id="<?php echo $result->film_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $film_master; ?>" id="<?php echo $result->film_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_film" id="<?php echo $result->film_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;
        
        }
    /*$i++;
    
    }*/
              die;
}

//commercial
function callsheet_new_commercial_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
   $wpdb->insert($commercial_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"commercial" => $form_data['commercial'],"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_commercial_record(){
    global $wpdb;
    $commercialid = filter_var($_POST['commercial_id'], FILTER_VALIDATE_INT);
     $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
    $sql  = $wpdb->prepare("SELECT * FROM $commercial_master WHERE commercial_id=%d",$commercialid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_commercial_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="commercial_id" placeholder="" name="commercial_id" value="<?php echo $result->commercial_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="commercial"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="commercial" rows="3" placeholder="" name="commercial"><?php echo $result->commercial; ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                      </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_commercial_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
    $wpdb->update($commercial_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"commercial" => stripslashes($form_data['commercial']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel']),
        array( 'commercial_id' =>$form_data['commercial_id']),'','');   
    die;
}
function callsheet_update_commercial_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
    $wpdb->update($commercial_master,array("position" => $value),array( 'commercial_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_commercial_record(){
     global $wpdb;
    $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
    $wpdb->delete( $commercial_master, array( 'commercial_id' => filter_var($_POST['commercial_id'], FILTER_VALIDATE_INT ) ) );
    die;
}
function callsheet_get_commercial_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $commercial_master = $wpdb->prefix.'call_sheet_commercial';
    $sql           = $wpdb->prepare("SELECT * FROM $commercial_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->commercial_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo $result->from_month.'-'.$result->from_year; ?></td>
          <td><?php echo $result->to_month.'-'.$result->to_year; ?></td>
          <td><?php echo stripslashes($result->commercial); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_commercial_popup" id="<?php echo $result->commercial_id; ?>" data-toggle="modal" data-target="#commercial_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $commercial_master; ?>" id="<?php echo $result->commercial_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $commercial_master; ?>"  id="<?php echo $result->commercial_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_commercial" id="<?php echo $result->commercial_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}

//audio
function callsheet_new_audio_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $audio_master = $wpdb->prefix . 'call_sheet_audio';
   $wpdb->insert($audio_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"audio" => stripslashes($form_data['audio']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_audio_record(){
    global $wpdb;
    $auid = filter_var($_POST['audio_id'], FILTER_VALIDATE_INT);
     $audio_master = $wpdb->prefix . 'call_sheet_audio';
    $sql  = $wpdb->prepare("SELECT * FROM $audio_master WHERE audio_id=%d",$auid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_audio_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="audio_id" placeholder="" name="audio_id" value="<?php echo $result->audio_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="audio"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="audio" rows="3" placeholder="" name="audio"><?php echo stripslashes($result->audio); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                      </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_audio_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $audio_master = $wpdb->prefix . 'call_sheet_audio';
    $wpdb->update($audio_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"audio" => stripslashes($form_data['audio']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel']),
        array( 'audio_id' =>$form_data['audio_id']),'','');   
    die;
}
function callsheet_update_audio_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $audio_master = $wpdb->prefix . 'call_sheet_audio';
    $wpdb->update($audio_master,array("position" => $value),array( 'audio_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_audio_record(){
     global $wpdb;
    $audio_master = $wpdb->prefix . 'call_sheet_audio';
    $wpdb->delete( $audio_master, array( 'audio_id' => filter_var($_POST['audio_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_audio_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $audio_master = $wpdb->prefix.'call_sheet_audio';
    $sql           = $wpdb->prepare("SELECT * FROM $audio_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->audio_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo $result->from_month.'-'.$result->from_year; ?></td>
          <td><?php echo $result->to_month.'-'.$result->to_year; ?></td>
          <td><?php echo stripslashes($result->audio); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_audio_popup" id="<?php echo $result->audio_id; ?>" data-toggle="modal" data-target="#audio_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $audio_master; ?>" id="<?php echo $result->audio_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $audio_master; ?>" id="<?php echo $result->audio_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_audio" id="<?php echo $result->audio_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}



//internet
function callsheet_new_internet_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $internet_master = $wpdb->prefix . 'call_sheet_internet';
   $wpdb->insert($internet_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"internet" => stripslashes($form_data['internet']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_internet_record(){
    global $wpdb;
    $intid = filter_var($_POST['internet_id'], FILTER_VALIDATE_INT);
     $internet_master = $wpdb->prefix . 'call_sheet_internet';
    $sql  = $wpdb->prepare("SELECT * FROM $internet_master WHERE internet_id=%d",$intid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_internet_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="internet_id" placeholder="" name="internet_id" value="<?php echo $result->internet_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="internet"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="internet" rows="3" placeholder="" name="internet"><?php echo stripslashes($result->internet); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_internet_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $internet_master = $wpdb->prefix . 'call_sheet_internet';
    $wpdb->update($internet_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"internet" => stripslashes($form_data['internet']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel']),
        array( 'internet_id' =>$form_data['internet_id']),'','');   
    die;
}
function callsheet_update_internet_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $internet_master = $wpdb->prefix . 'call_sheet_internet';
    $wpdb->update($internet_master,array("position" => $value),array( 'internet_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_internet_record(){
     global $wpdb;
    $internet_master = $wpdb->prefix . 'call_sheet_internet';
    $wpdb->delete( $internet_master, array( 'internet_id' => filter_var($_POST['internet_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_internet_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $internet_master = $wpdb->prefix.'call_sheet_internet';
    $sql           = $wpdb->prepare("SELECT * FROM $internet_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->internet_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo (trim($result->from_month)) ? $result->from_month.'-'.$result->from_year : $result->to_year ?? ''; ?></td>
          <td><?php echo (trim($result->to_month)) ? $result->to_month.'-'.$result->to_year : $result->to_year ?? ''; ?></td>
          <td><?php echo stripslashes($result->internet); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_internet_popup" id="<?php echo $result->internet_id; ?>" data-toggle="modal" data-target="#internet_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $internet_master; ?>" id="<?php echo $result->internet_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $internet_master; ?>" id="<?php echo $result->internet_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_internet" id="<?php echo $result->internet_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}


//other
function callsheet_new_other_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $other_master = $wpdb->prefix . 'call_sheet_other';
   $wpdb->insert($other_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"other" => stripslashes($form_data['other']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel'],"position" => $form_data['position']));
    
    die;
}
function callsheet_single_other_record(){
    global $wpdb;
    $othid = filter_var($_POST['other_id'], FILTER_VALIDATE_INT);
     $other_master = $wpdb->prefix . 'call_sheet_other';
    $sql  = $wpdb->prepare("SELECT * FROM $other_master WHERE other_id=%d",$othid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_other_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="other_id" placeholder="" name="other_id" value="<?php echo $result->other_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="other"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="other" rows="3" placeholder="" name="other"><?php echo stripslashes($result->other); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="casting"><?php _e('Casting', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="casting" value="<?php echo $result->casting; ?>" name="casting"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="production"><?php _e('Production', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="production" value="<?php echo $result->production; ?>" name="production"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="channel"><?php _e('Channel', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="channel" value="<?php echo $result->channel; ?>" name="channel"/>
                                          </div>
                                      </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      
                                  </form>
        <?php
        die;
}
function callsheet_edit_other_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $other_master = $wpdb->prefix . 'call_sheet_other';
    $wpdb->update($other_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"other" => stripslashes($form_data['other']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"casting" => $form_data['casting'],"production" => $form_data['production'],"channel" => $form_data['channel']),
        array( 'other_id' =>$form_data['other_id']),'','');   
    die;
}
function callsheet_update_other_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $other_master = $wpdb->prefix . 'call_sheet_other';
    $wpdb->update($other_master,array("position" => $value),array( 'other_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_other_record(){
     global $wpdb;
    $other_master = $wpdb->prefix . 'call_sheet_other';
    $wpdb->delete( $other_master, array( 'other_id' => filter_var($_POST['other_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_other_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $other_master = $wpdb->prefix.'call_sheet_other';
    $sql           = $wpdb->prepare("SELECT * FROM $other_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->other_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td><?php echo $count ?></td>
          <td><?php echo $result->from_month.'-'.$result->from_year; ?></td>
          <td><?php echo $result->to_month.'-'.$result->to_year; ?></td>
          <td><?php echo stripslashes($result->other); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->casting; ?></td>
          <td><?php echo $result->production; ?></td>
          <td><?php echo $result->channel; ?></td>
          <td>
              <span class="edit edit_other_popup" id="<?php echo $result->other_id; ?>" data-toggle="modal" data-target="#other_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $other_master; ?>" id="<?php echo $result->other_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $other_master; ?>" id="<?php echo $result->other_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_other" id="<?php echo $result->other_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}


//theater
function callsheet_new_theater_record(){
   parse_str($_POST['formdata'], $form_data);
   global $wpdb;
   $theater_master = $wpdb->prefix . 'call_sheet_theater';
   $wpdb->insert($theater_master, array(
        "client_id" => $form_data['client_id'],"from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"theater" => stripslashes($form_data['theater']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"author" => $form_data['author'],"title" => stripslashes($form_data['title']),"position" => $form_data['position']));
    
    die;
}
function callsheet_single_theater_record(){
    global $wpdb;
    $thid = filter_var($_POST['theater_id'], FILTER_VALIDATE_INT);
    $theater_master = $wpdb->prefix . 'call_sheet_theater';
    $sql  = $wpdb->prepare("SELECT * FROM $theater_master WHERE theater_id=%d",$thid);
    $result  = $wpdb->get_row($sql);
    ?>

                                  <form class="form-horizontal edit_theater_form">
                                      <div class="row">
                                          <input type="hidden" class="form-control" id="client_id" placeholder="" name="client_id" value="<?php echo $result->client_id; ?>">
                                      <input type="hidden" class="form-control" id="theater_id" placeholder="" name="theater_id" value="<?php echo $result->theater_id; ?>">
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="from"><?php _e('From', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_month" name="from_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->from_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="from_year" name="from_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->from_year==$i){echo 'selected';} ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="to"><?php _e('To', 'callsheet'); ?> :</label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_month" name="to_month">
                                                  <option value=""></option>
                                                    <?php for($i=1;$i<=12;$i++){ ?> <option <?php if($result->to_month==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="to_year" name="to_year">
                                                  <option value=""></option>
                                                    <?php for($i=2025;$i>=1900;$i--){ ?> <option <?php if($result->to_year==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="title"><?php _e('Title', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea type="text"  class="form-control" id="title" rows="3" placeholder="" name="title"><?php echo stripslashes($result->title); ?></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="description"><?php _e('Awards', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <textarea  class="form-control" rows="2" id="description" placeholder="" name="description"><?php echo stripslashes($result->description); ?></textarea>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="role"><?php _e('Role', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="role" value="<?php echo $result->role; ?>" name="role"/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="director"><?php _e('Director', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="director" value="<?php echo $result->director; ?>" name="director"/>
                                          </div>
                                      </div> 
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="theater"><?php _e('Theater', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="theater" placeholder="" name="theater"><?php echo stripslashes($result->theater); ?></textarea>
                                              </div>
                                         </div>

                                         <div class="form-group col-md-6">
                                          <label class="control-label col-sm-4" for="author"><?php _e('Author', 'callsheet'); ?> :</label>
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control"  id="author" value="<?php echo $result->author; ?>" name="author"/>
                                          </div>
                                      </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label class="control-label col-sm-4" for="description_main"><?php _e('Description', 'callsheet'); ?> :</label>
                                              <div class="col-sm-8">
                                                  <textarea  class="form-control" rows="2" id="description_main" placeholder="" name="description_main"><?php echo stripslashes($result->description_main); ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </form>
        <?php
        die;
}
function callsheet_edit_theater_record(){
    parse_str($_POST['formdata'], $form_data);
    global $wpdb;
    $theater_master = $wpdb->prefix . 'call_sheet_theater';
    $wpdb->update($theater_master,
        array("from_month" => $form_data['from_month'],"from_year" => $form_data['from_year'],"to_month" => $form_data['to_month'],"to_year" => $form_data['to_year'],"theater" => stripslashes($form_data['theater']),"description" => stripslashes($form_data['description']),"description_main" => stripslashes($form_data['description_main']),"role" => $form_data['role'],"director" => $form_data['director'],"author" => $form_data['author'],"title" => stripslashes($form_data['title'])),
        array( 'theater_id' =>$form_data['theater_id']),'','');   
    die;
}
function callsheet_update_theater_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $theater_master = $wpdb->prefix . 'call_sheet_theater';
    $wpdb->update($theater_master,array("position" => $value),array( 'theater_id' =>$key),'','');   
}
    die;
}

function callsheet_delete_theater_record(){
     global $wpdb;
    $theater_master = $wpdb->prefix . 'call_sheet_theater';
    $wpdb->delete( $theater_master, array( 'theater_id' => filter_var($_POST['theater_id'],FILTER_VALIDATE_INT) ) );
    die;
}
function callsheet_get_theater_record(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $theater_master = $wpdb->prefix.'call_sheet_theater';
    $sql           = $wpdb->prepare("SELECT * FROM $theater_master where client_id=%d ORDER BY position",$cid); //from_year DESC,from_month DESC,to_year DESC,
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->theater_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td class="sr_no"><?php echo $count ?></td>
          <td><?php echo (trim($result->from_month)) ? $result->from_month.'-'.$result->from_year : $result->to_year; ?></td>
          <td><?php echo (trim($result->to_month)) ? $result->to_month.'-'.$result->to_year : $result->to_year; ?></td>
          <td><?php echo stripslashes($result->title); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->author; ?></td>
          <td><?php echo stripslashes($result->theater); ?></td>
          <td>
              <span class="edit edit_theater_popup" id="<?php echo $result->theater_id; ?>" data-toggle="modal" data-target="#theater_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $theater_master; ?>" id="<?php echo $result->theater_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $theater_master; ?>" id="<?php echo $result->theater_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_theater" id="<?php echo $result->theater_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}

function callsheet_get_theater_record_by_id(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $theater_master = $wpdb->prefix.'call_sheet_theater';
    $sql           = $wpdb->prepare("SELECT * FROM $theater_master where client_id=%d ORDER BY theater_id DESC LIMIT 1",$cid); //from_year DESC,from_month DESC,to_year DESC,
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <tr idd="<?php echo $result->theater_id; ?>" postion="<?php echo $result->position; ?>" style="<?php if($result->show_hide!='1'){ echo "background-color: #fee0e1;"; }?>">
          <td class="sr_no"><?php echo $count; ?></td>
          <td><?php echo (trim($result->from_month)) ? $result->from_month.'-'.$result->from_year : $result->to_year ?? ''; ?></td>
          <td><?php echo (trim($result->to_month)) ? $result->to_month.'-'.$result->to_year : $result->to_year ?? ''; ?></td>
          <td><?php echo stripslashes($result->title); ?></td>
          <td><?php echo stripslashes($result->description); ?></td>
          <td><?php echo stripslashes($result->description_main); ?></td>
          <td><?php echo $result->role; ?></td>
          <td><?php echo $result->director; ?></td>
          <td><?php echo $result->author; ?></td>
          <td><?php echo stripslashes($result->theater); ?></td>
          <td>
              <span class="edit edit_theater_popup" id="<?php echo $result->theater_id; ?>" data-toggle="modal" data-target="#theater_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
              <?php if($result->show_hide=='1'){ ?><span class="show_hide" table_name="<?php echo $theater_master; ?>" id="<?php echo $result->theater_id; ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> <?php }else{ ?> <span class="show_hide" table_name="<?php echo $theater_master; ?>" id="<?php echo $result->theater_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></span><?php } ?>
              <span class="delet delete_theater" id="<?php echo $result->theater_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
          </td>
        </tr>
    <?php $count++;}
              die;
}



//photos
function callsheet_update_photo_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->update($photo_master,array("position" => $value),array( 'photo_id' =>$key),'','');   
}
    die;
}
function callsheet_chk_profile_update(){
    
    global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->update($photo_master,array("profile" => filter_var($_POST['new_value'],FILTER_SANITIZE_STRING) ),array( 'photo_id' =>filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ),'','');   

    die;
}
function callsheet_chk_overview_update(){
    
    global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->update($photo_master,array("overview" => filter_var($_POST['new_value'],FILTER_SANITIZE_STRING) ),array( 'photo_id' =>filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ),'','');   

    die;
}
function callsheet_chk_mobile_update(){
    
    global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->update($photo_master,array("mobile" => filter_var($_POST['new_value'],FILTER_SANITIZE_STRING) ),array( 'photo_id' =>filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ),'','');   

    die;
}
function callsheet_chk_slider_update(){
    
    global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->update($photo_master,array("slider" => filter_var($_POST['new_value'],FILTER_SANITIZE_STRING) ),array( 'photo_id' =>filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ),'','');   

    die;
}
function callsheet_get_photo_list(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $sql           = $wpdb->prepare("SELECT * FROM $photo_master where client_id=%d ORDER BY position",$cid);
    $results       = $wpdb->get_results($sql);
    $count=1;
    foreach ($results as $result) { 
    ?>
        <div class="col-md-2 col-sm-4 col-xs-2">
                              <div class="thumbnail" idd="<?php echo $result->photo_id; ?>" postion="<?php echo $result->position; ?>">
                                  <span><?php echo $count; ?></span>
                                 
                                  <div class="dlt-photo-btn"><i class="fa fa-times" aria-hidden="true"></i></div>
                                  <?php
                               $image_attributes=wp_get_attachment_image_src( $result->attachment_id,'thumbnail');
                               $image_attributes_full=wp_get_attachment_image_src( $result->attachment_id,'full');
                               ?>
                                  <div class="img-wrap">
                                   <!--  <span class="mask"><i class="fa fa-search-plus" aria-hidden="true"></i></span> -->
                                      <img class="small_img" data-toggle="modal" data-target="#zoom_modal" caption="<?php echo get_the_title($result->attachment_id) ?>" src_full="<?php echo $image_attributes_full[0];  ?>" src="<?php echo $image_attributes[0];  ?>" alt="" style="width:100%">
                                  </div>
                                   <div class="actor-caption longtext" data-toggle="tooltip" data-placement="right" title="<?php echo get_the_title($result->attachment_id) ?>"><?php echo get_the_title($result->attachment_id) ?></div>
                                  <div class="caption">
                                    <p><input type="text" class="form-control copyright_notes" placeholder="Copyright" value="<?php echo $result->notes; ?>" id=""></p>
                                    <p><input type="checkbox" class="form-control chk_profile" idd="<?php echo $result->photo_id; ?>" value="<?php echo $result->profile; ?>" <?php if($result->profile=='1') echo 'checked'; ?>> <?php _e('Profile', 'callsheet'); ?>   
                                        <input type="checkbox" class="form-control chk_overview" idd="<?php echo $result->photo_id; ?>" value="<?php echo $result->overview; ?> " <?php if($result->overview=='1') echo 'checked'; ?>> <?php _e('Overview', 'callsheet'); ?></p>
                                        <input type="checkbox" class="form-control chk_mobile" idd="<?php echo $result->photo_id; ?>" value="<?php echo $result->mobile; ?> " <?php if($result->mobile=='1') echo 'checked'; ?>> <?php _e('Mobile', 'callsheet'); ?>
                                        <input type="checkbox" class="form-control chk_slider" idd="<?php echo $result->photo_id; ?>" value="<?php echo $result->slider; ?> " <?php if($result->slider=='1') echo 'checked'; ?>> <?php _e('Slider', 'callsheet'); ?></p>

                                  </div>
                                
                              </div>
                            </div>
    <?php $count++;}
              die;
}
function callsheet_add_new_photo(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $attachid = filter_var($_POST['attachment_id'], FILTER_VALIDATE_INT);
     $photo_master = $wpdb->prefix . 'call_sheet_photo';
     
      $sql  = $wpdb->prepare("SELECT * FROM $photo_master WHERE attachment_id=%d AND client_id=%d",$attachid,$cid);
      $result=$wpdb->get_results($sql);
    
    if($wpdb->num_rows==0){
     
        $wpdb->insert($photo_master, array(
        "client_id" => filter_var($_POST['client_id'],FILTER_VALIDATE_INT),"attachment_id" => filter_var($_POST['attachment_id'],FILTER_VALIDATE_INT),"profile" => "1","overview" => "0","mobile" => "0", "slider" => "0"));
       
    }
      
    die;
}
function callsheet_edit_photo_notes(){
    global $wpdb;
     $photo_master = $wpdb->prefix . 'call_sheet_photo';
      $wpdb->update($photo_master,array("notes" => filter_var($_POST['notes'],FILTER_SANITIZE_STRING) ),array( 'photo_id' =>filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ),'','');   
    
    die;
}
function callsheet_delete_photo_record(){
     global $wpdb;
    $photo_master = $wpdb->prefix . 'call_sheet_photo';
    $wpdb->delete( $photo_master, array( 'photo_id' => filter_var($_POST['photo_id'],FILTER_VALIDATE_INT) ) );
    die;
}

//video
function callsheet_update_video_position(){
    if(isset($_POST['action'])) {
        unset($_POST['action']);
    }
    foreach($_POST as $key => $value) {
    global $wpdb;
    $video_master = $wpdb->prefix . 'call_sheet_video';
    $wpdb->update($video_master,array("position" => $value),array( 'video_id' =>$key),'','');   
}
    die;
}
function callsheet_get_video_list(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $video_iframe_master = $wpdb->prefix. 'call_sheet_video_iframe';
    $video_master = $wpdb->prefix . 'call_sheet_video';
    $sql  = $wpdb->prepare("SELECT * FROM $video_master where client_id=%d ORDER BY position",$cid);
    $results = $wpdb->get_results($sql);
    $count=1;
    
    foreach ($results as $result) { 
    ?>
        
               
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="video-wrap thumbnail" idd="<?php echo $result->video_id; ?>" postion="<?php echo $result->position; ?>">
                                                
                                                <span><?php echo $count; ?></span>
                                                 
                                                    <div class="dlt-video-btn"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                <?php if($result->is_wordpress=='yes') { ?>
                                                    <div class="actor-caption"><?php echo get_the_title($result->attachment_id) ?></div>
                                                <div class="play-btn" url="<?php echo wp_get_attachment_url($result->attachment_id); ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                                 <?php if (has_post_thumbnail( $result->attachment_id ) ){
                                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $result->attachment_id ), 'full' ); ?>
                                    
                                                        <img class="" src="<?php echo $image[0]; ?>"/> 
                                                <?php }else{ ?>
                                                      <video width="">
                                                <source src="<?php echo wp_get_attachment_url($result->attachment_id); ?>#t=0.5" type="video/mp4">
                                            </video> 
                                             <?php    } 
                                            }else if($result->is_wordpress == 'jw') {
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
                                                    $jsoncode = "https://cdn.jwplayer.com/v2/media/".$result->attachment_id;
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
                                                        foreach ($jwv['images'] as $jimg) {
                                                            //print_r($jurl['type']);
                                                            if($jimg['type'] == "image/jpeg" && $jimg['width'] == '720' ) {
                                                                $jwimage = $jimg['src'];
                                                                
                                                            }

                                                            //$x++;
                                                        } 
                                                       
                                                        //$jwimage = $jwv['images'][3]['src'];
                                                        //$playerurl = $jwv['sources'][3]['file'];

                                                        ?>
                                                         <div class="actor-caption"><?php echo $playertitle; ?></div>
                                                        <div class="play-btn" url="<?php echo $playerurl; ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                                        <img class="" src="<?php echo $jwimage; ?>"/> 
                                                        <?php
                                                    }
                                                    
                                                }
                                                else{ ?>
                                                    <div class="actor-caption"><?php echo get_the_title($result->attachment_id) ?></div>
                                                <div class="play-btn" url="<?php echo str_replace(".bin","/my-file.mp4",$result->attachment_id); ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                           <?php if (has_post_thumbnail( $result->attachment_id ) ){
                                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $result->attachment_id ), 'full' ); ?>
                                    
                             <img class="" src="<?php echo $image[0]; ?>"/> 
                                                 <?php }else{ ?>
                                                
                                                <video width="">
                                                <source src="<?php echo $result->attachment_id; ?>#t=0.5" type="video/mp4">
                                            </video> 
                                                 <?php } } ?>
                                    </div>
                                </div>
                            
           
       
    <?php $count++;} 
    
    die;
}
function callsheet_add_new_video(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $attachid = filter_var($_POST['attachment_id'], FILTER_VALIDATE_INT);
     $video_master = $wpdb->prefix . 'call_sheet_video';
      $sql  = $wpdb->prepare("SELECT * FROM $video_master WHERE attachment_id=%d AND client_id=%d",$attachid,$cid);
      $result=$wpdb->get_results($sql);
    
    if($wpdb->num_rows==0){
      $wpdb->insert($video_master, array(
        "client_id" => filter_var($_POST['client_id'],FILTER_VALIDATE_INT),"is_wordpress"=>"yes","attachment_id" => filter_var($_POST['attachment_id'],FILTER_VALIDATE_INT) ));
    }
    die;
}
function callsheet_add_new_wistia_video(){
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $attachid = filter_var($_POST['attachment_id'], FILTER_VALIDATE_INT);
     $video_master = $wpdb->prefix . 'call_sheet_video';
      $sql  = $wpdb->prepare("SELECT * FROM $video_master WHERE attachment_id=%d AND client_id=%d",$attachid,$cid);
      $result=$wpdb->get_results($sql);
    
    if($wpdb->num_rows==0){
      $wpdb->insert($video_master, array(
        "client_id" => filter_var($_POST['client_id'],FILTER_VALIDATE_INT),"is_wordpress"=>"no","attachment_id" => filter_var($_POST['attachment_id'],FILTER_VALIDATE_INT) ));
    }
    die;
}

function callsheet_delete_video_record(){
     global $wpdb;
    $video_master = $wpdb->prefix . 'call_sheet_video';
    $wpdb->delete( $video_master, array( 'video_id' => filter_var($_POST['video_id'],FILTER_VALIDATE_INT) ) );
    die;
}

function callsheet_get_wistia_video(){
    $page=filter_var($_POST['page'],FILTER_SANITIZE_STRING);
    $count=0;
    global $wpdb;
   $setting_master = $wpdb->prefix . 'call_sheet_setting';
    $sql  = $wpdb->prepare("SELECT api_value FROM $setting_master WHERE api_name=%s",'wistia');
    $result  = $wpdb->get_row($sql);
    $api_value=$result->api_value;
    if($api_value==''){echo  _e('Please set Wistia API value.', 'callsheet'); die;}
    $url="https://api.wistia.com/v1/medias.json?api_password=".$api_value."&per_page=12&page=$page";
    $result = file_get_contents($url);
    $my_array=json_decode($result, true);
    
    foreach ($my_array as $value) {
        $count++;
            ?>
        <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="video-wrap thumbnail wistia_video_add" url="<?php echo $value['assets'][0]['url']; ?>">

                                <div class="add-btn-wistia"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
                                <img src="<?php echo $value['thumbnail']['url']; ?>"/>
                    </div>
                </div>
                <?php
        
    }
    if($count==0){
        echo "<p>No More Video</p>";
    }
    ?>
        <ul class="pager">
            <?php if($page>1) { ?>
            <li><a class="api_page_nav" page="<?php echo $page-1; ?>"><?php _e('Previous', 'callsheet'); ?></a></li>
            <?php } 
            if($count!=0 &&$count==12){
            ?>
            <li><a class="api_page_nav" page="<?php echo $page+1; ?>"><?php _e('Next', 'callsheet'); ?></a></li>
            <?php } ?>
            
        </ul><?php
    die;
}


//jw player video
function callsheet_add_new_jwplayer_video(){
    
    global $wpdb;
    $cid = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $attachid = filter_var($_POST['attachment_id'], FILTER_SANITIZE_STRING);
     $video_master = $wpdb->prefix . 'call_sheet_video';
      $sql  = $wpdb->prepare("SELECT * FROM $video_master WHERE attachment_id=%s AND client_id=%d",$attachid,$cid);
      $result=$wpdb->get_results($sql);
    
    if(COUNT($result)==0){

      $suc = $wpdb->insert($video_master, array(
        "client_id" => filter_var($_POST['client_id'],FILTER_VALIDATE_INT),"is_wordpress"=>"jw","attachment_id" => filter_var($_POST['attachment_id'],FILTER_SANITIZE_STRING) ));
    }
    else{
        $suc = 10;
    }
    echo $suc;
    die;
}

function callsheet_get_jwplayer_video(){
    global $wpdb;
    $page=filter_var($_POST['page'],FILTER_SANITIZE_STRING);
    $playlist_id = filter_var($_POST['playlistid'],FILTER_SANITIZE_STRING);
    $count=0;
    $setting_master = $wpdb->prefix . 'call_sheet_setting';
    $sql  = $wpdb->prepare("SELECT api_value FROM $setting_master WHERE api_name=%s",'jw_key');
    $result  = $wpdb->get_row($sql);
    $api_value=$result->api_value;
     $sql1  = $wpdb->prepare("SELECT api_value FROM $setting_master WHERE api_name=%s",'jw_secret');
    $result1  = $wpdb->get_row($sql1);
    $api_secret=$result1->api_value;
    if($api_value==''){echo  _e('Please set JW API Key value.', 'callsheet'); die;}
    
    $param_string = "api_format=json&api_key=".$api_value."&api_nonce=80684843&api_timestamp=".time()."&text=demo";
    $pam_string = $param_string.$api_secret;
    $api_signature = sha1($pam_string);
    $url="https://api.jwplatform.com/v1/videos/list?api_signature=".$api_signature."&".$param_string;
    $jsoncode = "https://cdn.jwplayer.com/v2/playlists/".$playlist_id;
    // https://cdn.jwplayer.com/v2/media/wWVkDC44
    
    $my_array = json_decode (callsheet_curl_connect($jsoncode,'GET',$api_value),true );

    //$my_array = json_decode(file_get_contents($jsoncode),true);
     /*echo '<pre>';
         print_r($my_array);
         echo '</pre>';*/
         
         //echo count($my_array);
    if(!empty($my_array)) {
        echo '<h1>'.$my_array['title'].'</h1>';
        foreach ($my_array as $vurl) {
            
            while($vurl[$count]['sources']){
                //$x=0;
                foreach ($vurl[$count]['sources'] as $jurl) {
                    //print_r($jurl['type']);
                    if($jurl['type'] == "video/mp4" && ($jurl['label'] == '360p' || $jurl['label'] == '720p' ) ) {
                        $jwurl = $jurl['file'];
                        
                    }

                    //$x++;
                } 
                //echo 'jwplayer '.$jwurl;           
                //$jwurl = $vurl[$count]['sources'][3]['file'];
                if(!empty($vurl[$count]['mediaid'])) {
                    $mid = $vurl[$count]['mediaid'];
                ?>
                <!-- https://cdn.jwplayer.com/libraries/tx1iUuiJ.js -->
                 
                 <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="video-wrap thumbnail jwplayer_video_add" url="<?php echo $jwurl; ?>" mid="<?php echo $mid; ?>">
                        <div class="add-btn-jwplayer"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
                        <h5><?php echo $vurl[$count]['title']; ?></h5>
                        <img src="<?php echo $vurl[$count]['image']; ?>" />
                    </div>
                </div> 
                <?php

                    //$x++;     
                }
                $count++;
            }
        }
    }
    else{
        echo "<div class='messages'>No Videos Found</div>";
    }
    die;
}

function callsheet_show_hide_update(){
    
     global $wpdb;
     $table_name = filter_var($_POST['table_name'],FILTER_SANITIZE_STRING);
     $tabid = filter_var($_POST['id'], FILTER_VALIDATE_INT);
     $sql="SHOW KEYS FROM $table_name WHERE Key_name = 'PRIMARY'";
     $results=$wpdb->get_row($sql);
     $col_name;
      
          $col_name=$results->Column_name;
      
      
      $sql1  = $wpdb->prepare("SELECT show_hide FROM $table_name WHERE $col_name=%d",$tabid);
      
      $result1=$wpdb->get_row($sql1);
      if($result1->show_hide=='1'){
         
        $wpdb->update($table_name,array("show_hide" => '0'),array( $col_name =>filter_var($_POST['id'],FILTER_VALIDATE_INT) ),'','');     
      }else{
          
        $wpdb->update($table_name,array("show_hide" =>'1'),array($col_name =>filter_var($_POST['id'],FILTER_VALIDATE_INT) ),'','');     
      }
      die;
}

//autocomplete of on-tv
function callsheet_get_listing_names() {
    $termarr = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    
    //$term = filter_var($termarr['term'], FILTER_SANITIZE_STRING); 
    $client_id = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    global $wpdb;
    $tv_master = $wpdb->prefix.'call_sheet_tv';
    $film_master = $wpdb->prefix.'call_sheet_film';
    $qry_str = $wpdb->prepare("SELECT client_id,tv as name,role,director,channel FROM $tv_master WHERE client_id=%d and tv LIKE %s
        UNION ALL
        SELECT client_id,film as name,role,director,channel FROM $film_master WHERE client_id=%d and film LIKE %s",$client_id,'%'.$termarr.'%',$client_id,'%'.$termarr.'%');
    $get_data = $wpdb->get_results($qry_str);
    $a_json = array();
    $a_json_row = array();


    foreach($get_data as $data){

        $a_json_row["value"] = $data->name;
        $a_json_row["label"] = $data->name;
        $a_json_row["role"] = $data->role;
        $a_json_row["director"] = $data->director;
        $a_json_row["channel"] = $data->channel;
        
        array_push($a_json, $a_json_row);
        
        }
    echo json_encode($a_json);
    die;
}
//autocomplete of on-screen, on-air
function callsheet_get_on_air_names() {
    global $wpdb;
    $termarr = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    //$term = filter_var($termarr['term'], FILTER_SANITIZE_STRING); 
    
    $client_id = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    $film_master = $wpdb->prefix.'call_sheet_film';
    $tv_master = $wpdb->prefix.'call_sheet_tv';
    $qry_str = $wpdb->prepare("SELECT client_id,film as name,role,director,channel FROM $film_master WHERE client_id=%d and film LIKE %s
        UNION ALL
        SELECT client_id,tv as name,role,director,channel FROM $tv_master WHERE client_id=%d and tv LIKE %s",$client_id,'%'.$termarr .'%',$client_id,'%'.$termarr.'%');
    
    $get_data = $wpdb->get_results($qry_str);
    
    $a_json = array();
    $a_json_row = array();


    foreach($get_data as $data){

        $a_json_row["value"] = $data->name;
       
        $a_json_row["label"] = $data->name;
        $a_json_row["role"] = $data->role;
        $a_json_row["director"] = $data->director;
        $a_json_row["channel"] = $data->channel;
        
        array_push($a_json, $a_json_row);
        
        }
    echo json_encode($a_json);
    die;
}
//autocomplete of on-stage
function callsheet_get_on_stage_names() {
    $termarr = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    
    //$term = filter_var($termarr['term'], FILTER_SANITIZE_STRING); 
    
    $client_id = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    global $wpdb;
    $theater_master = $wpdb->prefix.'call_sheet_theater';

    $qry_str = $wpdb->prepare("SELECT client_id,title as name,role,director,theater FROM $theater_master WHERE client_id=%d and title LIKE %s",$client_id,'%'.$termarr.'%');
    $get_data = $wpdb->get_results($qry_str);
    $a_json = array();
    $a_json_row = array();


    foreach($get_data as $data){

        $a_json_row["value"] = $data->name;
        $a_json_row["label"] = $data->name;
        $a_json_row["role"] = $data->role;
        $a_json_row["director"] = $data->director;
        $a_json_row["theater"] = $data->theater;
        
        array_push($a_json, $a_json_row);
        
        }
    echo json_encode($a_json);
    die;
}
//autocomplete of at-festival
function callsheet_get_at_fest_names() {
    $termarr = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    
    //$term = filter_var($termarr['term'], FILTER_SANITIZE_STRING); 
    
    $client_id = filter_var($_POST['client_id'],FILTER_VALIDATE_INT);
    global $wpdb;
    $tv_master = $wpdb->prefix.'call_sheet_tv';
    $film_master = $wpdb->prefix.'call_sheet_film';
    
    $qry_str = $wpdb->prepare("SELECT client_id,film as name,role,director,channel FROM $film_master WHERE client_id=%d and film LIKE %s
    UNION ALL
    SELECT client_id,tv as name,role,director,channel FROM $tv_master WHERE client_id=%d and tv LIKE %s",$client_id,'%'.$term.'%',$client_id,'%'.$termarr.'%');
    $get_data = $wpdb->get_results($qry_str);
    $foods = array();
    $a_json = array();
    $a_json_row = array();


    foreach($get_data as $data){

        $a_json_row["value"] = $data->name;
       
        $a_json_row["label"] = $data->name;
        $a_json_row["role"] = $data->role;
        $a_json_row["director"] = $data->director;
        $a_json_row["channel"] = $data->channel;
        
        array_push($a_json, $a_json_row);
        
        }
    echo json_encode($a_json);
    die;
}


function callsheet_valset($val){
	if( isset($val) && !empty($val) )
		return true;
	else
		return false;
	die;
}

function callsheet_upgrader($upgrader_object, $options)
{
    // The path to our plugin's main file
    $our_plugin = plugin_basename(__FILE__);
    error_log('upgrader run');
    // If an update has taken place and the updated type is plugins and the plugins element exists
    if ($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {
        // Iterate through the plugins being updated and check if ours is there
        foreach ($options['plugins'] as $plugin) {
            if ($plugin == $our_plugin) {
                error_log('upgrader our plugin');
                require_once plugin_dir_path( __FILE__ ) . 'includes/class-callsheet-activator.php';
                Callsheet_Activator::activate();
            }
        }
    }
}
add_action('upgrader_process_complete', 'callsheet_upgrader', 10, 2);