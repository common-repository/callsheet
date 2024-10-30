<?php

/**
 * Fired during plugin activation
 *
 * @link       https://callsheet.io
 * @since      1.0.0
 *
 * @package    Callsheet
 * @subpackage Callsheet/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Callsheet
 * @subpackage Callsheet/includes
 * @author     Claudius Neidig <claudius@gmail.com>
 */
class Callsheet_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        //client_master table
        $client_master = $wpdb->prefix . 'call_sheet_client_master';
        $sql = "CREATE TABLE IF NOT EXISTS $client_master (
              client_id mediumint(9) NOT NULL AUTO_INCREMENT,
              first_name varchar(100) ,
              last_name varchar(100) ,
              type varchar(100) ,
              year_of_birth varchar(20) ,
              place_of_birth varchar(40) ,
              nationality text ,
              state varchar(100) ,
              residence varchar(100) ,
              place_of_action text ,
              ethnic_appearance text ,
              hair_colour varchar(100) ,
              hair_length varchar(100) ,
              eye_colour varchar(100) ,
              stature varchar(100) ,
              height varchar(10) ,
              weight varchar(10) ,
              confection_size varchar(100) ,
              language text ,
              accents text ,
              singing text ,
              voice_range varchar(100) ,
              musical_instrument text ,
              sports text ,
              dancing text ,
              license text ,
              professional_union text ,
              special_skills longtext,
              short_text longtext,
              genre text,
              agencies text,
              slug varchar(300),
              show_hide varchar(3) DEFAULT '1',
              PRIMARY KEY  (client_id)
              
            )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //tags_master table
        $tags_master = $wpdb->prefix . 'call_sheet_tags_master';
        $sql = "CREATE TABLE IF NOT EXISTS $tags_master (
              tags_row_id mediumint(9) NOT NULL AUTO_INCREMENT,
              tags_name varchar(100) ,
              tags_display_name varchar(100) ,
              tags_value longtext,
              PRIMARY KEY  (tags_row_id)
              
            )ENGINE = InnoDB $charset_collate;";

        dbDelta($sql);
        $sql_tags = "SELECT * FROM {$tags_master}";

        $result = $wpdb->get_results($sql_tags);

        if ($wpdb->num_rows == 0) {
            //Insert default value in tags_master
            $sql = "INSERT INTO $tags_master values (0,'place_of_birth','Place Of Birth',''),(0,'nationality','Nationality',''),(0,'state','State',''),(0,'residence','1st Residence',''),(0,'place_of_action','Place Of Action',''),(0,'ethnic_appearance','Ethnic Appearance',''),(0,'hair_colour','Hair Colour',''),(0,'hair_length','Hair Length',''),(0,'eye_colour','Eye Colour',''),(0,'stature','Stature',''),(0,'confection_size','Confection Size',''),(0,'language','Language',''),(0,'accents','Accents',''),(0,'singing','Singing',''),(0,'voice_range','Voice Range',''),(0,'musical_instrument','Musical Instrument',''),(0,'sports','Sports',''),(0,'dancing','Dancing',''),(0,'license','License',''),(0,'professional_union','Professional Union',''),(0,'genre','Genre',''),(0,'agencies','Agencies','')";
            dbDelta($sql);
        }


        //social Table
        $social_master = $wpdb->prefix . 'call_sheet_social';
        $sql = "CREATE TABLE IF NOT EXISTS $social_master (
                  social_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  facebook varchar(200) ,
                  instagram varchar(200) ,
                  youTube varchar(200) ,
                  snapchat varchar(200) ,
                  twitter varchar(200) ,
                  pinterest varchar(200) ,
                  linkedIn varchar(200) ,
                  google_plus varchar(200) ,
                  tumblr varchar(200) ,
                  reddit varchar(200) ,
                  flickr varchar(200) ,
                  swarm_by_foursquare varchar(200) ,
                  kik varchar(200) ,
                  shots varchar(200) ,
                  periscope varchar(200) ,
                  medium varchar(200) ,
                  soundCloud varchar(200) ,
                  musical varchar(200) ,
                  homepage varchar(200) ,
                  PRIMARY KEY  (social_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk12_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //Education Table
        $education_master = $wpdb->prefix . 'call_sheet_education';
        $sql = "CREATE TABLE IF NOT EXISTS $education_master (
                  education_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  education varchar(500) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (education_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //awards Table
        $awards_master = $wpdb->prefix . 'call_sheet_awards';
        $sql = "CREATE TABLE IF NOT EXISTS $awards_master (
                  awards_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  awards varchar(500) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (awards_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk2_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //film Table
        $film_master = $wpdb->prefix . 'call_sheet_film';
        $sql = "CREATE TABLE IF NOT EXISTS $film_master (
                  film_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  film varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  category varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (film_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk3_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //tv Table
        $tv_master = $wpdb->prefix . 'call_sheet_tv';
        $sql = "CREATE TABLE IF NOT EXISTS $tv_master (
                  tv_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  tv varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  category varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (tv_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk4_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);


        //Commercial Table
        $commercial_master = $wpdb->prefix . 'call_sheet_commercial';
        $sql = "CREATE TABLE IF NOT EXISTS $commercial_master (
                  commercial_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  commercial varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (commercial_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk5_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //Audio Table
        $audio_master = $wpdb->prefix . 'call_sheet_audio';
        $sql = "CREATE TABLE IF NOT EXISTS $audio_master (
                  audio_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  audio varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (audio_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk6_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);


        //Internet Table
        $internet_master = $wpdb->prefix . 'call_sheet_internet';
        $sql = "CREATE TABLE IF NOT EXISTS $internet_master (
                  internet_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  internet varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (internet_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk7_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //Other Table
        $other_master = $wpdb->prefix . 'call_sheet_other';
        $sql = "CREATE TABLE IF NOT EXISTS $other_master (
                  other_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  other varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  casting varchar(100) ,
                  production varchar(100) ,
                  channel varchar(100) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (other_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk8_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);


        //theater Table
        $theater_master = $wpdb->prefix . 'call_sheet_theater';
        $sql = "CREATE TABLE IF NOT EXISTS $theater_master (
                  theater_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  from_month varchar(10) ,
                  from_year varchar(10) ,
                  to_month varchar(10) ,
                  to_year varchar(10) ,
                  title varchar(500) ,
                  description varchar(500) ,
                  description_main varchar(500) ,
                  role varchar(100) ,
                  director varchar(100) ,
                  author varchar(100) ,
                  theater varchar(500) ,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (theater_id),
                  
                  CONSTRAINT " . $wpdb->prefix . "_fk9_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  
                    )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);


        //Photo Table
        $photo_master = $wpdb->prefix . 'call_sheet_photo';
        $sql = "CREATE TABLE IF NOT EXISTS $photo_master (
                  photo_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  attachment_id mediumint(9) NOT NULL,
                  notes varchar(100) ,
                  position mediumint(9) ,
                  overview varchar(3) ,
                  profile varchar(3) ,
                  mobile varchar(3) ,
                  slider varchar(3) ,
                  PRIMARY KEY  (photo_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk1_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //Video Table
        $video_master = $wpdb->prefix . 'call_sheet_video';
        $sql = "CREATE TABLE IF NOT EXISTS $video_master (
                  video_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  attachment_id varchar(400) NOT NULL,
                  is_wordpress varchar(10) NOT NULL,
                  position mediumint(9) ,
                  PRIMARY KEY  (video_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk10_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //News Table
        $news_master = $wpdb->prefix . 'call_sheet_news';
        $sql = "CREATE TABLE IF NOT EXISTS $news_master (
                  news_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  news longtext,
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  PRIMARY KEY  (news_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk15_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //On Air Table is on Screen
        $on_air_master = $wpdb->prefix . 'call_sheet_on_air';
        $sql = "CREATE TABLE IF NOT EXISTS $on_air_master (
                  on_air_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  on_air_date varchar(500) ,
                  on_air_to_date varchar(500) ,
                  on_air_time varchar(500) ,
                  on_air longtext,
                  on_air_image varchar(500),
                  title varchar(500) ,
                  role varchar(500) , 
                  director varchar(500) ,
                  channel varchar(500) , 
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  show_always varchar(3) DEFAULT '0',
                  PRIMARY KEY  (on_air_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk115_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //On Stage Table
        $on_stage_master = $wpdb->prefix . 'call_sheet_on_stage';
        $sql = "CREATE TABLE IF NOT EXISTS $on_stage_master (
                  on_stage_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  on_stage_date varchar(500) ,
                  on_stage_to_date varchar(500) ,
                  on_stage_time varchar(500) ,
                  on_stage longtext,
                  on_stage_image varchar(500),
                  title varchar(500) ,
                  role varchar(500) , 
                  director varchar(500) ,
                  theater varchar(500) , 
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  show_always varchar(3) DEFAULT '0',
                  PRIMARY KEY  (on_stage_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk215_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //at festival
        $at_fest_master = $wpdb->prefix . 'call_sheet_at_festival';
        $sql = "CREATE TABLE IF NOT EXISTS $at_fest_master (
                  at_festival_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  at_festival_date varchar(500) ,
                  at_festival_to_date varchar(500) ,
                  at_festival_time varchar(500) ,
                  at_festival longtext,
                  at_festival_image varchar(500),
                  title varchar(500) ,
                  role varchar(500) , 
                  director varchar(500) ,
                  channel varchar(500) , 
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  show_always varchar(3) DEFAULT '0',
                  PRIMARY KEY  (at_festival_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk315_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //On tv Table is on Screen
        $on_tv_master = $wpdb->prefix . 'call_sheet_on_tv';
        $sql = "CREATE TABLE IF NOT EXISTS $on_tv_master (
                  on_tv_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  on_tv_date varchar(500) ,
                  on_tv_to_date varchar(500) ,
                  on_tv_time varchar(500) ,
                  on_tv longtext,
                  on_tv_image varchar(500),
                  title varchar(500) ,
                  role varchar(500) , 
                  director varchar(500) ,
                  channel varchar(500) , 
                  position mediumint(9) ,
                  show_hide varchar(3) DEFAULT '1',
                  show_always varchar(3) DEFAULT '0',
                  PRIMARY KEY  (on_tv_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk415_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //video_iframe Table
        $video_iframe_master = $wpdb->prefix . 'call_sheet_video_iframe';
        $sql = "CREATE TABLE IF NOT EXISTS $video_iframe_master (
                  video_iframe_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  client_id mediumint(9) NOT NULL,
                  iframe_code longtext,
                  PRIMARY KEY  (video_iframe_id),
                  CONSTRAINT " . $wpdb->prefix . "_fk25_client_master FOREIGN KEY (client_id)
                  REFERENCES $client_master(client_id)
                  ON DELETE CASCADE
                  )ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);

        //Setting table
        $setting_master = $wpdb->prefix . 'call_sheet_setting';
        $sql = "CREATE TABLE IF NOT EXISTS $setting_master (
                  setting_id mediumint(9) NOT NULL AUTO_INCREMENT,
                  api_name varchar(200) NOT NULL,
                  api_value varchar(200) NOT NULL,
                  PRIMARY KEY  (setting_id)
                  )ENGINE = InnoDB $charset_collate;";

        dbDelta($sql);
        $sql  = "SELECT * FROM {$setting_master}";
        $result = $wpdb->get_results($sql);

        // if ($wpdb->num_rows == 0) {
        //     //Insert default value in tags_master
        //     $sql = "INSERT INTO $setting_master values (0,'wistia',''),(0,'vda_pool','')";
        //     dbDelta($sql);
        // }

        //modify client_master table
        //check if exist needable fields
        //insert temporary data
        $wpdb->insert($client_master, ['first_name' => 'tmp', 'last_name' => 'tmp'], ['%s', '%s']);
        $inserted_id = $wpdb->insert_id;
        $sql  = $wpdb->prepare("SELECT * FROM $client_master WHERE client_id = %d", $inserted_id);
        $result = $wpdb->get_row($sql);
        //verify if column sync_api exist
        if (!isset($result->sync_api)) {
            $wpdb->query("ALTER TABLE $client_master
	ADD COLUMN `sync_api` INT(1) NULL DEFAULT '0';");
        }
        //verify if column client_api_id exist
        if (!isset($result->client_api_id)) {
            $wpdb->query("ALTER TABLE $client_master
	ADD COLUMN `client_api_id` INT(10) NULL DEFAULT '0';");
        }
        //remove temporary data
        $wpdb->query("DELETE  FROM $client_master WHERE client_id = $inserted_id");

        //modify setting_master table
        $settings = $wpdb->get_results("SELECT * FROM $setting_master", ARRAY_A);
        if ($settings) {
            foreach ($settings as $key => $value) {
                unset($settings[$key]['setting_id']);
            }
            $unique_values = array_unique($settings, SORT_REGULAR);
        }
        //modify setting_master table
        $wpdb->insert($setting_master, ['api_name' => 'tmp', 'api_value' => 'tmp'], ['%s', '%s']);
        $inserted_id = $wpdb->insert_id;
        $sql  = $wpdb->prepare("SELECT * FROM $setting_master WHERE setting_id = %d", $inserted_id);
        $data = [
            [
                'name'  => 'wistia',
                'title' => 'Wistia',
                'value' => '',
                'is_active' => 1,
            ],
            [
                'name'  => 'vda_pool',
                'title' => 'Vda Pool',
                'value' => '',
                'is_active' => 1,
            ],
            [
                'name'  => 'jw_key',
                'title' => 'JW Player API Key',
                'value' => '',
                'is_active' => 1,
            ],
            [
                'name'  => 'jw_secret',
                'title' => 'JW Player Secret Key',
                'value' => '',
                'is_active' => 1,
            ],
            [
                'name'  => 'castupload',
                'title' => 'Castupload',
                'value' => '',
                'is_active' => 1,
            ],
        ];

        $client_result = $wpdb->get_row($sql);
        if (!isset($client_result->api_title) || !isset($client_result->is_active)) {
            $settings = $wpdb->get_results("SELECT * FROM $setting_master", ARRAY_A);
            if ($settings) {
                foreach ($settings as $key => $value) {
                    //remove temporary data from array
                    if ($settings[$key]['setting_id'] == $inserted_id) unset($settings[$key]);
                    unset($settings[$key]['setting_id']);
                }
                $unique_values = array_unique($settings, SORT_REGULAR);

                foreach ($unique_values as $key => $value) {
                    foreach ($unique_values as $key2 => $value2) {
                        if ($value["api_name"] == $value2["api_name"]) {
                            if ($value["api_value"] !== $value2["api_value"]) {
                                if ($value["api_value"] == '') {
                                    unset($unique_values[$key]);
                                }
                            }
                        }
                    }
                }

                //prepeare data to insert
                $old_data = [];
                foreach ($unique_values as $key => $value) {
                    $old_data[] = [
                        'name'  => $value['api_name'],
                        'title' => $value['api_name'],
                        'value' => $value['api_value'],
                        'is_active' => 1,
                    ];
                }

                $merged_data = array_merge($old_data, $data);

                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                $delete = $wpdb->query("DROP TABLE IF EXISTS $setting_master");
                $sql = "CREATE TABLE IF NOT EXISTS $setting_master (
                          setting_id mediumint(9) NOT NULL AUTO_INCREMENT,
                          api_name varchar(200) NOT NULL,
                          api_title varchar(200) NOT NULL,
                          api_value varchar(200) NOT NULL,
                          is_active int(1) NOT NULL DEFAULT '1',
                          PRIMARY KEY  (`setting_id`),
                          UNIQUE  (`api_name`)
                          )ENGINE = InnoDB $charset_collate;";

                dbDelta($sql);

                foreach ($merged_data as $value) {
                    $insert_data = [
                        'api_name' => $value['name'],
                        'api_title' => $value['title'],
                        'api_value' => $value['value'],
                        'is_active' => $value['is_active'],
                    ];

                    $format = ['%s', '%s', '%s', '%d'];
                    $wpdb->insert($setting_master, $insert_data, $format);
                    $wpdb->insert_id;
                }
            }
        } else {
            foreach ($data as $value) {
                $insert_data = [
                    'api_name' => $value['name'],
                    'api_title' => $value['title'],
                    'api_value' => $value['value'],
                    'is_active' => $value['is_active'],
                ];

                $format = ['%s', '%s', '%s', '%d'];
                $wpdb->insert($setting_master, $insert_data, $format);
                $wpdb->insert_id;
            }
        }

        $wpdb->query("DELETE FROM $setting_master WHERE setting_id = $inserted_id");
        
    }
}
