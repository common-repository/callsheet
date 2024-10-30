<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://callsheet.io
 * @since      1.0.0
 *
 * @package    Callsheet
 * @subpackage Callsheet/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Callsheet
 * @subpackage Callsheet/admin
 * @author     Claudius Neidig <claudius@gmail.com>
 */
class Callsheet_Admin {

        /**
         * The ID of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string    $plugin_name    The ID of this plugin.
         */
        private $plugin_name;

        /**
         * The version of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string    $version    The current version of this plugin.
         */
        private $version;

        /**
         * Initialize the class and set its properties.
         *
         * @since    1.0.0
         * @param      string    $plugin_name       The name of this plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct( $plugin_name, $version ) {

                $this->plugin_name = $plugin_name;
                $this->version = $version;
              
                add_action('admin_menu', array( $this, 'callsheet_menu_setup' ));
                
                //export_data
                add_action('wp_ajax_export_data', 'callsheet_export_data');
                add_action('wp_ajax_nopriv_export_data', 'callsheet_export_data');
                
                //client_record_edit
                add_action('wp_ajax_client_record_edit', 'callsheet_client_record_edit');
                add_action('wp_ajax_nopriv_client_record_edit', 'callsheet_client_record_edit');
                //edit_client_save
                add_action('wp_ajax_edit_client_save', 'callsheet_edit_client_save');
                add_action('wp_ajax_nopriv_edit_client_save', 'callsheet_edit_client_save');
                
                
                //education
                add_action('wp_ajax_get_education_record', 'callsheet_get_education_record');
                add_action('wp_ajax_nopriv_get_education_record', 'callsheet_get_education_record');
                
                add_action('wp_ajax_new_education_record', 'callsheet_new_education_record');
                add_action('wp_ajax_nopriv_new_education_record', 'callsheet_new_education_record');
                
                add_action('wp_ajax_single_education_record', 'callsheet_single_education_record');
                add_action('wp_ajax_nopriv_single_education_record', 'callsheet_single_education_record');
                
                add_action('wp_ajax_edit_education_record', 'callsheet_edit_education_record');
                add_action('wp_ajax_nopriv_edit_education_record', 'callsheet_edit_education_record');
                
                add_action('wp_ajax_update_education_position', 'callsheet_update_education_position');
                add_action('wp_ajax_nopriv_update_education_position', 'callsheet_update_education_position');
                
                add_action('wp_ajax_delete_education_record', 'callsheet_delete_education_record');
                add_action('wp_ajax_nopriv_delete_education_record', 'callsheet_delete_education_record');
                
                //news
                add_action('wp_ajax_get_news_record', 'callsheet_get_news_record');
                add_action('wp_ajax_nopriv_get_news_record', 'callsheet_get_news_record');
                
                add_action('wp_ajax_new_news_record', 'callsheet_new_news_record');
                add_action('wp_ajax_nopriv_new_news_record', 'callsheet_new_news_record');
                
                add_action('wp_ajax_single_news_record', 'callsheet_single_news_record');
                add_action('wp_ajax_nopriv_single_news_record', 'callsheet_single_news_record');
                
                add_action('wp_ajax_edit_news_record', 'callsheet_edit_news_record');
                add_action('wp_ajax_nopriv_edit_news_record', 'callsheet_edit_news_record');
                
                add_action('wp_ajax_update_news_position', 'callsheet_update_news_position');
                add_action('wp_ajax_nopriv_update_news_position', 'callsheet_update_news_position');
                
                add_action('wp_ajax_delete_news_record', 'callsheet_delete_news_record');
                add_action('wp_ajax_nopriv_delete_news_record', 'callsheet_delete_news_record');
                
                //press agency
                add_action('wp_ajax_get_agency_record', 'callsheet_get_agency_record');
                add_action('wp_ajax_nopriv_get_agency_record', 'callsheet_get_agency_record');

                add_action('wp_ajax_press_agency_save', 'callsheet_press_agency_save');
                add_action('wp_ajax_nopriv_press_agency_save', 'callsheet_press_agency_save');
                
                //on_air
                add_action('wp_ajax_get_on_air_record', 'callsheet_get_on_air_record');
                add_action('wp_ajax_nopriv_get_on_air_record', 'callsheet_get_on_air_record');
                
                add_action('wp_ajax_new_on_air_record', 'callsheet_new_on_air_record');
                add_action('wp_ajax_nopriv_new_on_air_record', 'callsheet_new_on_air_record');

                add_action('wp_ajax_single_on_air_record', 'callsheet_single_on_air_record');
                add_action('wp_ajax_nopriv_single_on_air_record', 'callsheet_single_on_air_record');
                
                add_action('wp_ajax_edit_on_air_record', 'callsheet_edit_on_air_record');
                add_action('wp_ajax_nopriv_edit_on_air_record', 'callsheet_edit_on_air_record');
                
                add_action('wp_ajax_update_on_air_position', 'callsheet_update_on_air_position');
                add_action('wp_ajax_nopriv_update_on_air_position', 'callsheet_update_on_air_position');
                
                add_action('wp_ajax_delete_on_air_record', 'callsheet_delete_on_air_record');
                add_action('wp_ajax_nopriv_delete_on_air_record', 'callsheet_delete_on_air_record');
                
                //at_festival
                add_action('wp_ajax_get_at_festival_record', 'callsheet_get_at_festival_record');
                add_action('wp_ajax_nopriv_get_at_festival_record', 'callsheet_get_at_festival_record');
                
                add_action('wp_ajax_new_at_festival_record', 'callsheet_new_at_festival_record');
                add_action('wp_ajax_nopriv_new_at_festival_record', 'callsheet_new_at_festival_record');

                add_action('wp_ajax_single_at_festival_record', 'callsheet_single_at_festival_record');
                add_action('wp_ajax_nopriv_single_at_festival_record', 'callsheet_single_at_festival_record');
                
                add_action('wp_ajax_edit_at_festival_record', 'callsheet_edit_at_festival_record');
                add_action('wp_ajax_nopriv_edit_at_festival_record', 'callsheet_edit_at_festival_record');
                
                add_action('wp_ajax_update_at_festival_position', 'callsheet_update_at_festival_position');
                add_action('wp_ajax_nopriv_update_at_festival_position', 'callsheet_update_at_festival_position');
                
                add_action('wp_ajax_delete_at_festival_record', 'callsheet_delete_at_festival_record');
                add_action('wp_ajax_nopriv_delete_at_festival_record', 'callsheet_delete_at_festival_record');

                //on_stage
                add_action('wp_ajax_get_on_stage_record', 'callsheet_get_on_stage_record');
                add_action('wp_ajax_nopriv_get_on_stage_record', 'callsheet_get_on_stage_record');
                
                add_action('wp_ajax_new_on_stage_record', 'callsheet_new_on_stage_record');
                add_action('wp_ajax_nopriv_new_on_stage_record', 'callsheet_new_on_stage_record');
                
                add_action('wp_ajax_single_on_stage_record', 'callsheet_single_on_stage_record');
                add_action('wp_ajax_nopriv_single_on_stage_record', 'callsheet_single_on_stage_record');
                
                add_action('wp_ajax_edit_on_stage_record', 'callsheet_edit_on_stage_record');
                add_action('wp_ajax_nopriv_edit_on_stage_record', 'callsheet_edit_on_stage_record');
                
                add_action('wp_ajax_update_on_stage_position', 'callsheet_update_on_stage_position');
                add_action('wp_ajax_nopriv_update_on_stage_position', 'callsheet_update_on_stage_position');
                
                add_action('wp_ajax_delete_on_stage_record', 'callsheet_delete_on_stage_record');
                add_action('wp_ajax_nopriv_delete_on_stage_record', 'callsheet_delete_on_stage_record');
                
                //on_tv
                add_action('wp_ajax_get_on_tv_record', 'callsheet_get_on_tv_record');
                add_action('wp_ajax_nopriv_get_on_tv_record', 'callsheet_get_on_tv_record');
                
                add_action('wp_ajax_new_on_tv_record', 'callsheet_new_on_tv_record');
                add_action('wp_ajax_nopriv_new_on_tv_record', 'callsheet_new_on_tv_record');

                add_action('wp_ajax_single_on_tv_record', 'callsheet_single_on_tv_record');
                add_action('wp_ajax_nopriv_single_on_tv_record', 'callsheet_single_on_tv_record');
                
                add_action('wp_ajax_edit_on_tv_record', 'callsheet_edit_on_tv_record');
                add_action('wp_ajax_nopriv_edit_on_tv_record', 'callsheet_edit_on_tv_record');
                
                add_action('wp_ajax_update_on_tv_position', 'callsheet_update_on_tv_position');
                add_action('wp_ajax_nopriv_update_on_tv_position', 'callsheet_update_on_tv_position');
                
                add_action('wp_ajax_delete_on_tv_record', 'callsheet_delete_on_tv_record');
                add_action('wp_ajax_nopriv_delete_on_tv_record', 'callsheet_delete_on_tv_record');

                add_action('wp_ajax_show_always_update', 'callsheet_show_always_update');
                add_action('wp_ajax_nopriv_show_always_update', 'callsheet_show_always_update');

                //awards
                add_action('wp_ajax_get_awards_record', 'callsheet_get_awards_record');
                add_action('wp_ajax_nopriv_get_awards_record', 'callsheet_get_awards_record');
                
                add_action('wp_ajax_new_awards_record', 'callsheet_new_awards_record');
                add_action('wp_ajax_nopriv_new_awards_record', 'callsheet_new_awards_record');
                
                add_action('wp_ajax_single_awards_record', 'callsheet_single_awards_record');
                add_action('wp_ajax_nopriv_single_awards_record', 'callsheet_single_awards_record');
                
                add_action('wp_ajax_edit_awards_record', 'callsheet_edit_awards_record');
                add_action('wp_ajax_nopriv_edit_awards_record', 'callsheet_edit_awards_record');
                
                add_action('wp_ajax_update_awards_position', 'callsheet_update_awards_position');
                add_action('wp_ajax_nopriv_update_awards_position', 'callsheet_update_awards_position');
                
                add_action('wp_ajax_delete_awards_record', 'callsheet_delete_awards_record');
                add_action('wp_ajax_nopriv_delete_awards_record', 'callsheet_delete_awards_record');
                
                
                //film
                add_action('wp_ajax_get_film_record', 'callsheet_get_film_record');
                add_action('wp_ajax_nopriv_get_film_record', 'callsheet_get_film_record');
                
                add_action('wp_ajax_new_film_record', 'callsheet_new_film_record');
                add_action('wp_ajax_nopriv_new_film_record', 'callsheet_new_film_record');
                
                add_action('wp_ajax_single_film_record', 'callsheet_single_film_record');
                add_action('wp_ajax_nopriv_single_film_record', 'callsheet_single_film_record');
                
                add_action('wp_ajax_edit_film_record', 'callsheet_edit_film_record');
                add_action('wp_ajax_nopriv_edit_film_record', 'callsheet_edit_film_record');
                
                add_action('wp_ajax_update_film_position', 'callsheet_update_film_position');
                add_action('wp_ajax_nopriv_update_film_position', 'callsheet_update_film_position');
                
                add_action('wp_ajax_delete_film_record', 'callsheet_delete_film_record');
                add_action('wp_ajax_nopriv_delete_film_record', 'callsheet_delete_film_record');
                
                
                //tv
                add_action('wp_ajax_get_tv_record', 'callsheet_get_tv_record');
                add_action('wp_ajax_nopriv_get_tv_record', 'callsheet_get_tv_record');
                
                add_action('wp_ajax_new_tv_record', 'callsheet_new_tv_record');
                add_action('wp_ajax_nopriv_new_tv_record', 'callsheet_new_tv_record');
                
                add_action('wp_ajax_single_tv_record', 'callsheet_single_tv_record');
                add_action('wp_ajax_nopriv_single_tv_record', 'callsheet_single_tv_record');
                
                add_action('wp_ajax_edit_tv_record', 'callsheet_edit_tv_record');
                add_action('wp_ajax_nopriv_edit_tv_record', 'callsheet_edit_tv_record');
                
                add_action('wp_ajax_update_tv_position', 'callsheet_update_tv_position');
                add_action('wp_ajax_nopriv_update_tv_position', 'callsheet_update_tv_position');
                
                add_action('wp_ajax_delete_tv_record', 'callsheet_delete_tv_record');
                add_action('wp_ajax_nopriv_delete_tv_record', 'callsheet_delete_tv_record');

                add_action('wp_ajax_add_tv_rows', 'callsheet_add_tv_rows');
                add_action('wp_ajax_nopriv_add_tv_rows', 'callsheet_add_tv_rows');

                add_action('wp_ajax_get_total_rows_record', 'callsheet_get_total_rows_record');
                add_action('wp_ajax_nopriv_get_total_rows_record', 'callsheet_get_total_rows_record');
                
                //commercial
                add_action('wp_ajax_get_commercial_record', 'callsheet_get_commercial_record');
                add_action('wp_ajax_nopriv_get_commercial_record', 'callsheet_get_commercial_record');
                
                add_action('wp_ajax_new_commercial_record', 'callsheet_new_commercial_record');
                add_action('wp_ajax_nopriv_new_commercial_record', 'callsheet_new_commercial_record');
                
                add_action('wp_ajax_single_commercial_record', 'callsheet_single_commercial_record');
                add_action('wp_ajax_nopriv_single_commercial_record', 'callsheet_single_commercial_record');
                
                add_action('wp_ajax_edit_commercial_record', 'callsheet_edit_commercial_record');
                add_action('wp_ajax_nopriv_edit_commercial_record', 'callsheet_edit_commercial_record');
                
                add_action('wp_ajax_update_commercial_position', 'callsheet_update_commercial_position');
                add_action('wp_ajax_nopriv_update_commercial_position', 'callsheet_update_commercial_position');
                
                add_action('wp_ajax_delete_commercial_record', 'callsheet_delete_commercial_record');
                add_action('wp_ajax_nopriv_delete_commercial_record', 'callsheet_delete_commercial_record');
                
                
                //audio
                add_action('wp_ajax_get_audio_record', 'callsheet_get_audio_record');
                add_action('wp_ajax_nopriv_get_audio_record', 'callsheet_get_audio_record');
                
                add_action('wp_ajax_new_audio_record', 'callsheet_new_audio_record');
                add_action('wp_ajax_nopriv_new_audio_record', 'callsheet_new_audio_record');
                
                add_action('wp_ajax_single_audio_record', 'callsheet_single_audio_record');
                add_action('wp_ajax_nopriv_single_audio_record', 'callsheet_single_audio_record');
                
                add_action('wp_ajax_edit_audio_record', 'callsheet_edit_audio_record');
                add_action('wp_ajax_nopriv_edit_audio_record', 'callsheet_edit_audio_record');
                
                add_action('wp_ajax_update_audio_position', 'callsheet_update_audio_position');
                add_action('wp_ajax_nopriv_update_audio_position', 'callsheet_update_audio_position');
                
                add_action('wp_ajax_delete_audio_record', 'callsheet_delete_audio_record');
                add_action('wp_ajax_nopriv_delete_audio_record', 'callsheet_delete_audio_record');
                
                 //internet
                add_action('wp_ajax_get_internet_record', 'callsheet_get_internet_record');
                add_action('wp_ajax_nopriv_get_internet_record', 'callsheet_get_internet_record');
                
                add_action('wp_ajax_new_internet_record', 'callsheet_new_internet_record');
                add_action('wp_ajax_nopriv_new_internet_record', 'callsheet_new_internet_record');
                
                add_action('wp_ajax_single_internet_record', 'callsheet_single_internet_record');
                add_action('wp_ajax_nopriv_single_internet_record', 'callsheet_single_internet_record');
                
                add_action('wp_ajax_edit_internet_record', 'callsheet_edit_internet_record');
                add_action('wp_ajax_nopriv_edit_internet_record', 'callsheet_edit_internet_record');
                
                add_action('wp_ajax_update_internet_position', 'callsheet_update_internet_position');
                add_action('wp_ajax_nopriv_update_internet_position', 'callsheet_update_internet_position');
                
                add_action('wp_ajax_delete_internet_record', 'callsheet_delete_internet_record');
                add_action('wp_ajax_nopriv_delete_internet_record', 'callsheet_delete_internet_record');
                
                 //other
                add_action('wp_ajax_get_other_record', 'callsheet_get_other_record');
                add_action('wp_ajax_nopriv_get_other_record', 'callsheet_get_other_record');
                
                add_action('wp_ajax_new_other_record', 'callsheet_new_other_record');
                add_action('wp_ajax_nopriv_new_other_record', 'callsheet_new_other_record');
                
                add_action('wp_ajax_single_other_record', 'callsheet_single_other_record');
                add_action('wp_ajax_nopriv_single_other_record', 'callsheet_single_other_record');
                
                add_action('wp_ajax_edit_other_record', 'callsheet_edit_other_record');
                add_action('wp_ajax_nopriv_edit_other_record', 'callsheet_edit_other_record');
                
                add_action('wp_ajax_update_other_position', 'callsheet_update_other_position');
                add_action('wp_ajax_nopriv_update_other_position', 'callsheet_update_other_position');
                
                add_action('wp_ajax_delete_other_record', 'callsheet_delete_other_record');
                add_action('wp_ajax_nopriv_delete_other_record', 'callsheet_delete_other_record');
                
                 //theater
                add_action('wp_ajax_get_theater_record', 'callsheet_get_theater_record');
                add_action('wp_ajax_nopriv_get_theater_record', 'callsheet_get_theater_record');

                add_action('wp_ajax_get_theater_record_by_id', 'callsheet_get_theater_record_by_id');
                add_action('wp_ajax_nopriv_get_theater_record_by_id', 'callsheet_get_theater_record_by_id');
                
                add_action('wp_ajax_new_theater_record', 'callsheet_new_theater_record');
                add_action('wp_ajax_nopriv_new_theater_record', 'callsheet_new_theater_record');
                
                add_action('wp_ajax_single_theater_record', 'callsheet_single_theater_record');
                add_action('wp_ajax_nopriv_single_theater_record', 'callsheet_single_theater_record');
                
                add_action('wp_ajax_edit_theater_record', 'callsheet_edit_theater_record');
                add_action('wp_ajax_nopriv_edit_theater_record', 'callsheet_edit_theater_record');
                
                add_action('wp_ajax_update_theater_position', 'callsheet_update_theater_position');
                add_action('wp_ajax_nopriv_update_theater_position', 'callsheet_update_theater_position');
                
                add_action('wp_ajax_delete_theater_record', 'callsheet_delete_theater_record');
                add_action('wp_ajax_nopriv_delete_theater_record', 'callsheet_delete_theater_record');
                
                
                //photo
                add_action('wp_ajax_add_new_photo', 'callsheet_add_new_photo');
                add_action('wp_ajax_nopriv_add_new_photo', 'callsheet_add_new_photo');
                
                add_action('wp_ajax_get_photo_list', 'callsheet_get_photo_list');
                add_action('wp_ajax_nopriv_get_photo_list', 'callsheet_get_photo_list');
                
                add_action('wp_ajax_update_photo_position', 'callsheet_update_photo_position');
                add_action('wp_ajax_nopriv_update_photo_position', 'callsheet_update_photo_position');
                
                add_action('wp_ajax_edit_photo_notes', 'callsheet_edit_photo_notes');
                add_action('wp_ajax_nopriv_edit_photo_notes', 'callsheet_edit_photo_notes');
                
                add_action('wp_ajax_delete_photo_record', 'callsheet_delete_photo_record');
                add_action('wp_ajax_nopriv_delete_photo_record', 'callsheet_delete_photo_record');
                
                add_action('wp_ajax_chk_profile_update', 'callsheet_chk_profile_update');
                add_action('wp_ajax_nopriv_chk_profile_update', 'callsheet_chk_profile_update');
                
                add_action('wp_ajax_chk_overview_update', 'callsheet_chk_overview_update');
                add_action('wp_ajax_nopriv_chk_overview_update', 'callsheet_chk_overview_update');
               
                add_action('wp_ajax_chk_mobile_update', 'callsheet_chk_mobile_update');
                add_action('wp_ajax_nopriv_chk_mobile_update', 'callsheet_chk_mobile_update');

                add_action('wp_ajax_chk_slider_update', 'callsheet_chk_slider_update');
                add_action('wp_ajax_nopriv_chk_slider_update', 'callsheet_chk_slider_update');
               
                //video
                add_action('wp_ajax_add_new_video', 'callsheet_add_new_video');
                add_action('wp_ajax_nopriv_add_new_video', 'callsheet_add_new_video');
                
                add_action('wp_ajax_get_video_list', 'callsheet_get_video_list');
                add_action('wp_ajax_nopriv_get_video_list', 'callsheet_get_video_list');
                
                add_action('wp_ajax_update_video_position', 'callsheet_update_video_position');
                add_action('wp_ajax_nopriv_update_video_position', 'callsheet_update_video_position');
                
                add_action('wp_ajax_delete_video_record', 'callsheet_delete_video_record');
                add_action('wp_ajax_nopriv_delete_video_record', 'callsheet_delete_video_record');
                
                add_action('wp_ajax_get_wistia_video', 'callsheet_get_wistia_video');
                add_action('wp_ajax_nopriv_get_wistia_video', 'callsheet_get_wistia_video');
                
                add_action('wp_ajax_add_new_wistia_video', 'callsheet_add_new_wistia_video');
                add_action('wp_ajax_nopriv_add_new_wistia_video', 'callsheet_add_new_wistia_video');

                add_action('wp_ajax_get_jwplayer_video', 'callsheet_get_jwplayer_video');
                add_action('wp_ajax_nopriv_get_jwplayer_video', 'callsheet_get_jwplayer_video');

                add_action('wp_ajax_add_new_jwplayer_video', 'callsheet_add_new_jwplayer_video');
                add_action('wp_ajax_nopriv_add_new_jwplayer_video', 'callsheet_add_new_jwplayer_video');
                
                //show_hide_row
                add_action('wp_ajax_show_hide_update', 'callsheet_show_hide_update');
                add_action('wp_ajax_nopriv_show_hide_update', 'callsheet_show_hide_update');
                

                //save_basic_information
                add_action('wp_ajax_save_basic_information', 'callsheet_save_basic_information');
                add_action('wp_ajax_nopriv_save_basic_information', 'callsheet_save_basic_information');
                //save_social_info_information
                add_action('wp_ajax_save_social_info_information', 'callsheet_save_social_info_information');
                add_action('wp_ajax_nopriv_save_social_info_information', 'callsheet_save_social_info_information');
                //save_video_iframe
                add_action('wp_ajax_save_video_iframe', 'callsheet_save_video_iframe');
                add_action('wp_ajax_nopriv_save_video_iframe', 'callsheet_save_video_iframe');

                //autocomplete
                add_action('wp_ajax_get_listing_names', 'callsheet_get_listing_names');
                add_action('wp_ajax_nopriv_get_listing_names', 'callsheet_get_listing_names'); 

                add_action('wp_ajax_get_on_air_names', 'callsheet_get_on_air_names');
                add_action('wp_ajax_nopriv_get_on_air_names', 'callsheet_get_on_air_names');

                add_action('wp_ajax_get_on_stage_names', 'callsheet_get_on_stage_names');
                add_action('wp_ajax_nopriv_get_on_stage_names', 'callsheet_get_on_stage_names');

                add_action('wp_ajax_get_at_fest_names', 'callsheet_get_at_fest_names');
                add_action('wp_ajax_nopriv_get_at_fest_names', 'callsheet_get_at_fest_names');

        }
        
        public function enqueue_styles() {
                 wp_enqueue_style( 'autocomplete-css', plugin_dir_url( __FILE__ ) . 'css/jquery.auto-complete.css', array(), $this->version, 'all' );
        }

        public function enqueue_scripts() {
                wp_enqueue_script( 'autocomplete-js', plugin_dir_url( __FILE__ ) . 'js/jquery.auto-complete.js', array( 'jquery' ), $this->version, false );
        }
        
    function callsheet_menu_setup(){
    add_menu_page(__('All Clients', 'callsheet'), 'Callsheet', 'manage_options', 'callsheet', array( $this, 'callsheet_init' ),'dashicons-id');
    add_submenu_page('callsheet',__('Clients', 'callsheet'),__('All Clients', 'callsheet'), 'manage_options','callsheet' ,array( $this, 'callsheet_init' ) );
    add_submenu_page('callsheet',__('Add New Client', 'callsheet'),__('Add New Client', 'callsheet'), 'manage_options','callsheet-add-new' ,array( $this, 'callsheet_add_new' ) );
   
    add_submenu_page('callsheet',__('Values', 'callsheet'),__('Values', 'callsheet'), 'manage_options','callsheet-values' ,array( $this, 'callsheet_values' ) );

    add_submenu_page('callsheet',__('Page url', 'callsheet'),__('Page url', 'callsheet'), 'manage_options','callsheet-page-url' ,array( $this, 'callsheet_page_url' ) );

    add_submenu_page('callsheet',__('Slider', 'callsheet'),__('Slider', 'callsheet'), 'manage_options','callsheet-home-slider' ,array( $this, 'callsheet_home_slider' ) );
    
    add_submenu_page('callsheet', __('Import/Export', 'callsheet'), __('Import/Export', 'callsheet'), 'manage_options','callsheet-import-export' ,array( $this, 'callsheet_import_export' ) );
    add_submenu_page('callsheet', __('API Detail', 'callsheet'), __('API Detail', 'callsheet'), 'manage_options','callsheet-api' ,array( $this, 'callsheet_api' ) );
    add_submenu_page('callsheet', __('Edit Client', 'callsheet'), '', 'manage_options','callsheet-edit' ,array( $this, 'callsheet_edit' ) );
   }
   
function callsheet_init(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                
               include_once 'partials/callsheet-admin-display.php';
        }
function callsheet_add_new(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                include_once 'partials/callsheet-admin-add-new.php';
        }

function callsheet_import_export(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                include_once 'partials/callsheet-admin-import-export.php';
        }
function callsheet_api(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                include_once 'partials/callsheet-admin-api.php';
        }
function callsheet_edit(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'player', plugin_dir_url( __FILE__ ) . 'css/player.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'summer','https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                //wp_enqueue_script( 'player', plugin_dir_url( __FILE__ ) . 'js/jquery.cleanvideoplayer.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'ellipsis', plugin_dir_url( __FILE__ ) . 'js/jquery.ellipsis.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'summer', 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_media();
                
                include_once 'partials/callsheet-admin-edit.php';
        }
function callsheet_values(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                wp_enqueue_media();
                
                include_once 'partials/callsheet-values.php';
        }

        function callsheet_page_url(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                wp_enqueue_media();
                
                include_once 'partials/callsheet-page-urls.php';
        }

        function callsheet_home_slider(){
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callsheet-admin.css', array(), time(), 'all' );
                wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css', array(), $this->version, 'all' );
                
                wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'tagsinput', 'https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'dataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'boot-dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'typeahead', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js', array( 'jquery' ), $this->version, false );
                
                wp_enqueue_media();
                
                include_once 'partials/callsheet-home-slider.php';
        }

   
}
