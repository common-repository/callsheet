<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://callsheet.io
 * @since      1.0.3
 *
 * @package    Callsheet
 * @subpackage Callsheet/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.3
 * @package    Callsheet
 * @subpackage Callsheet/includes
 * @author     Claudius Neidig <claudius@gmail.com>
 */
class Callsheet_Api_Castupload
{
    private $actor_id;
    private $api_key;
    private $site_url = 'https://www.castupload.com/api/v1/actor_profiles';
    private $wpdb;
    private $client_master_table;
    private $settings_table;

    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        global $wpdb;
        $this->wpdb = $wpdb;
        $this->client_master_table = $this->wpdb->prefix . 'call_sheet_client_master';
        $this->settings_table = $this->wpdb->prefix . 'call_sheet_setting';
        $this->photo_table = $this->wpdb->prefix . 'call_sheet_photo';
        $this->film_table = $this->wpdb->prefix . 'call_sheet_film';
        $this->tv_table = $this->wpdb->prefix . 'call_sheet_tv';
        $this->social_table = $this->wpdb->prefix . 'call_sheet_social';
        $this->theater_table = $this->wpdb->prefix . 'call_sheet_theater';
        $this->awards_table = $this->wpdb->prefix . 'call_sheet_awards';
        $this->internet_table = $this->wpdb->prefix . 'call_sheet_internet';
        $this->education_table = $this->wpdb->prefix . 'call_sheet_education';
        $this->postmeta_table = $this->wpdb->prefix . 'postmeta';
        $this->video_iframe = $this->wpdb->prefix . 'call_sheet_video_iframe';
        $this->api_key = $this->get_api_key();
        $this->initHooks();
    }

    public function initHooks()
    {
        add_action('wp_ajax_callsheet_castupload_api_update', [$this, 'castupload_ajax_update_by_name']);
        add_action('wp_ajax_callsheet_castupload_id_update', [$this, 'castupload_ajax_update_by_id']);
        add_action('wp_ajax_callsheet_save_image', [$this, 'callsheet_castupload_save_image']);
        add_action('admin_enqueue_scripts', [$this, 'callsheet_api_sync_enqueue_script']);
    }

    public function callsheet_api_sync_enqueue_script($hook)
    {
        $screen = get_current_screen();
        if (in_array($screen->id, ['toplevel_page_callsheet'])) {
            wp_enqueue_script('callsheet_castupload_api_js', plugin_dir_url(dirname(__FILE__)) . 'admin/js/callsheet-api-sync.js', ['jquery'], $this->version);
        }
    }

    private function get_api_key()
    {
        $query  = $this->wpdb->prepare("SELECT api_value FROM $this->settings_table  WHERE api_name=%s", 'castupload');
        $api_result = $this->wpdb->get_row($query);
        return ($api_result !== NULL) ? $api_result->api_value : NULL;
    }

    private function get_all_actors($api_key)
    {
        if ($api_key == NULL) return NULL;

        $api_args = [
            'headers'   => ['Authorization' => 'Bearer ' . $api_key],
            'method'    => 'GET',
        ];
        $request = wp_remote_get($this->site_url, $api_args);
        $body = wp_remote_retrieve_body($request);

        return json_decode($body, true);
    }

    private function actor_full_name($fname, $lname = '')
    {
        $actor_full_name = trim($fname);
        if ($lname !== '') $actor_full_name .= ' ' . trim($lname);
        return ($actor_full_name != '') ? $actor_full_name : NULL;
    }

    private function set_actor_castupload_id($all_castupload_actors, $actor_full_name, $actor_id)
    {
        if (!$all_castupload_actors || !$actor_full_name) return NULL;
        $castupload_actor_id = false;
        foreach ($all_castupload_actors as $actor) {
            if (strcmp(strtolower($actor['name']), strtolower($actor_full_name)) === 0) $castupload_actor_id = $actor['id'];
        }

        if ($castupload_actor_id) {
            $result = $this->wpdb->update($this->client_master_table, ['client_api_id' => $castupload_actor_id], ['client_id' => $actor_id], '', '');
        }
        return ($result !== NULL) ? $castupload_actor_id : NULL;
    }

    private function get_actor_data_by_castupload_id($castupload_actor_id)
    {
        if (!$castupload_actor_id) return null;
        $api_args = [
            'headers'   => ['Authorization' => 'Bearer ' . $this->api_key],
            'method'    => 'GET',
        ];
        $response = wp_remote_get('https://www.castupload.com/api/v1/actor_profiles/' . $castupload_actor_id . '/?locale=de', $api_args);
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code != 200) return NULL;
        $body = wp_remote_retrieve_body($response);
        $actor_data = json_decode($body);
        return $actor_data;
    }

    private function set_actor_castupload_data($actor_id, $actor_data)
    {
        if (!$actor_id || !is_object($actor_data)) return NULL;

        $insert_data = [
            'year_of_birth' => strlen((string) $actor_data->year_of_birth ) == 4 ? '--'.$actor_data->year_of_birth : $actor_data->year_of_birth,
            'place_of_birth' => $actor_data->place_of_birth,
            'nationality' => $this->filter_data($actor_data->nationalities, true),
            'state' => $actor_data->state,
            'residence' => $actor_data->city,
            'place_of_action' => $actor_data->accommodation_options, //?
            'ethnic_appearance' => $this->filter_data($actor_data->ethnic_appearances),
            'hair_colour' => $actor_data->hair_color,
            'hair_length' => $actor_data->hair_length,
            'eye_colour' => $actor_data->eye_color,
            'stature' => $actor_data->fiqure, //?
            'height' => $actor_data->height,
            'weight' => $actor_data->weight,
            'confection_size' => null, //?
            'language' => $this->filter_data($actor_data->languages, true),
            'accents' => ($this->filter_data($actor_data->accents)) ? $this->filter_data($actor_data->accents, true) . $this->filter_data($actor_data->dialects) ? ', '. $this->filter_data($actor_data->dialects, true) : '' : $this->filter_data($actor_data->dialects, true) ?? null,
            'singing' => $this->filter_data($actor_data->singing, true),
            'voice_range' => ucfirst($actor_data->pitch),
            'musical_instrument' => $this->filter_data($actor_data->instruments, true),
            'sports' => $this->filter_data($actor_data->sports, true),
            'dancing' => $this->filter_data($actor_data->dances, true),
            'license' => $this->filter_data($actor_data->drivers_licenses) ? $this->filter_data($actor_data->drivers_licenses, true) .', '.$this->filter_data($actor_data->licenses, true) : $this->filter_data($actor_data->licenses, true),
            'professional_union' => '',
            'special_skills' => '',
            'genre' => '',
            'agencies' => $actor_data->talent_agency_id,
            'short_text' => '',
        ];


        $format = [
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
        ];
        $result = $this->wpdb->update($this->client_master_table, $insert_data, array('client_id' => $actor_id), $format, '%d');
        return ($result !== NULL) ? $result : NULL;
    }

    private function filter_data($data, $ucfirst = false)
    {
        if (is_object($data)) {
            $data = array_keys((array) $data);
            if ($ucfirst) $data = array_map('ucfirst', $data);
            $string = rtrim(implode(', ', $data), ',');
            return ($string !== 0 || $string != '') ? $string : NULL;
        } elseif (is_array($data) ) {
            if (!$data) return NULL;
            if ($ucfirst) $data = array_map('ucfirst', $data);
            $string = rtrim(implode(', ', $data), ',');
            return ($string !== 0 || $string != '') ? $string : NULL;
        } else {
            return $data ? $data : NULL;
        }
    }

    private function get_actor_data($actor_id)
    {
        $query  = $this->wpdb->prepare("SELECT first_name, last_name, sync_api FROM $this->client_master_table WHERE client_id=%d", $actor_id);
        $result = $this->wpdb->get_row($query);
        return $result;
    }

    private function set_sync_status($actor_id, $status)
    {
        $result = $this->wpdb->update($this->client_master_table, ['sync_api' => $status], ['client_id' => $actor_id], '', '');
        return $result;
    }

    private function set_actor_name($actor_id, $fname, $lname, $gender)
    {
        $gender = (trim(strtolower($gender)) == 'm') ? 'Actor' : 'Actress';
        $slug = str_replace(' ', '-', trim(strtolower($fname)) . '-' . trim(strtolower($lname)));
        $data = ['first_name' => $fname, 'last_name' => $lname, 'type' => $gender, 'slug' => $slug];
        return $this->wpdb->update($this->client_master_table, $data, ['client_id' => $actor_id], ['%s', '%s', '%s', '%s'], '%d');
    }

    private function set_castupload_id($actor_id, $castupload_id)
    {
        $result = $this->wpdb->update($this->client_master_table, ['client_api_id' => $castupload_id], ['client_id' => $actor_id], '%d', '%d');
        return $result;
    }

    private function callsheet_download_image($img_url, $description = null)
    {
        if ($img_url == '') return null;
        $img_name = basename($img_url);

        $sql = $this->wpdb->prepare(
            "SELECT post_id FROM $this->postmeta_table
            WHERE meta_key = '_wp_attached_file' AND meta_value LIKE '%s'",
            '%/' . $img_name
        );
        $id = $this->wpdb->get_var($sql);

        if ($id > 0) {
            return $id;
        } else {
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            if (function_exists('media_sideload_image')) {
                $id = media_sideload_image($img_url, 0, $description = null, $return = 'id');
                return $id;
            }
        }
        return null;
    }

    private function callsheet_clear_actor_photos($actor_id)
    {
        $this->wpdb->delete($this->photo_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_tvs($actor_id)
    {
        $this->wpdb->delete($this->tv_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_films($actor_id)
    {
        $this->wpdb->delete($this->film_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_links($actor_id)
    {
        $this->wpdb->delete($this->social_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_theatre($actor_id)
    {
        $this->wpdb->delete($this->theater_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_awards($actor_id)
    {
        $this->wpdb->delete($this->awards_table, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_internet($actor_id)
    {
        $this->wpdb->delete($this->internet_table, ['client_id' => $actor_id]);
    }
    
    private function callsheet_clear_actor_video_iframe($actor_id)
    {
        $this->wpdb->delete($this->video_iframe, ['client_id' => $actor_id]);
    }

    private function callsheet_clear_actor_education($actor_id)
    {
        $this->wpdb->delete($this->education_table, ['client_id' => $actor_id]);
    }

    private function callsheet_save_photos($actor_id, $attachment_id, $copyright = null, $profile_type = null)
    {
        if (!$actor_id || !$attachment_id) return null;

        $data = [
            'client_id' => $actor_id,
            'attachment_id' => $attachment_id,
            'notes' => $copyright,
            'overview' => $profile_type ? 1 : null,
            'profile' => !$profile_type ? 1 : null,
        ];
        $format = ['%d', '%d', '%s', '%d', '%d'];
        $this->wpdb->insert($this->photo_table, $data, $format);
        $photos_id = $this->wpdb->insert_id;
        return $photos_id;
    }

    private function callsheet_save_films($actor_id, $film_data)
    {
        if (!$actor_id || !$film_data) return null;

        foreach ($film_data as $film) {
            $category = $film->info;
            $channel = null;
            $channel_data = explode(',', $film->info);
            if (count($channel_data) == 2) {
                foreach ($channel_data as $key => $value) {
                    $channel_data[$key] = trim($value);
                }
                $category = $channel_data[0];
                $channel = $channel_data[1];
            } 
            $data = [
                'client_id' => $actor_id,
                'from_year' => $film->year_from,
                'to_year' => $film->year_to == $film->year_from ? null : $film->year_to,
                'film' => trim($film->name, '"'),
                'role' => $film->role_type ? $film->role .' '. $film->role_type : $film->role,
                'director' => $film->director,
                'casting' => $film->caster,
                'production' => $film->distributor,
                'channel' => $channel,
                // 'category' => $category,
                'description_main' => $film->info
            ];
            $format = ['%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s'];
            $this->wpdb->insert($this->film_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_tvs($actor_id, $tv_data)
    {
        if (!$actor_id || !$tv_data) return null;
        
        foreach ($tv_data as $tv) {

            $category = null;
            $channel = $tv->distributor;
            $channel_data = explode(',', $tv->distributor);
            if (count($channel_data) == 2) {
                foreach ($channel_data as $key => $value) {
                    $channel_data[$key] = trim($value);
                }
                $category = $channel_data[0];
                $channel = $channel_data[1];
            } 

            $data = [
                'client_id' => $actor_id,
                'from_year' => $tv->year_from,
                'to_year' => $tv->year_to == $tv->year_from ? null : $tv->year_to,
                'tv' => trim($tv->name),
                'channel' => $channel,
                'role' => $tv->role,
                'director' => $tv->director,
                'casting' => $tv->caster,
                'category' => $category,
            ];
            $format = ['%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'];
            $this->wpdb->insert($this->tv_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_social($actor_id, $social_data)
    {
        if (!$actor_id || !$social_data) return null;

        $data = [
            'client_id' => $actor_id,
            'facebook'  => (trim($social_data['facebook_page'])) ? 'https://www.facebook.com/' . $social_data['facebook_page'] : null,
            'instagram' => (trim($social_data['instagram_username'])) ? 'https://www.instagram.com/' . $social_data['instagram_username'] : null,
            'twitter'   => (trim($social_data['twitter_handle'])) ? 'https://twitter.com/' . $social_data['twitter_handle'] : null,
            'homepage'  => $social_data['homepage_url'] ?? null,
        ];

        $format = ['%d', '%s', '%s', '%s', '%s'];
        $this->wpdb->insert($this->social_table, $data, $format);
        $this->wpdb->insert_id;
    }

    private function callsheet_save_theatre($actor_id, $theatre_data)
    {
        if (!$actor_id || !$theatre_data) return null;

        foreach ($theatre_data as $theatre) {
            $data = [
                'client_id' => $actor_id,
                'from_year' => $theatre->year_from,
                'to_year' => $theatre->year_from == $theatre->year_to ? null : $theatre->year_to,
                'title' =>  $theatre->name,
                'role' =>  $theatre->role,
                'director' =>  $theatre->director,
                'theater' =>  $theatre->distributor,
            ];
            $format = ['%d', '%d', '%d', '%s', '%s', '%s', '%s'];
            $this->wpdb->insert($this->theater_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_awards($actor_id, $awards_data)
    {
        if (!$actor_id || !$awards_data) return null;

        foreach ($awards_data as $award) {
            $data = [
                'client_id' => $actor_id,
                'from_year' => $award->year_from,
                'to_year' => $award->year_to == $award->year_from ? null : $award->year_to,
                'awards' => $award->info ? $award->name .', '. $award->info : $award->name,
            ];

            $format = ['%d', '%d', '%d', '%s'];
            $this->wpdb->insert($this->awards_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_internet($actor_id, $internet_data)
    {
        if (!$actor_id || !$internet_data) return null;

        foreach ($internet_data as $internet) {
            $data = [
                'client_id' => $actor_id,
                'from_year' => $internet->year_from,
                'to_year' => $internet->year_to == $internet->year_from ? '' : $internet->year_to,
                'internet' => $internet->name,
                'description_main' => $internet->info,
            ];

            $format = ['%d', '%d', '%d', '%s', '%s'];
            $this->wpdb->insert($this->internet_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_video_showreels($actor_id, $video_data)
    {
        if (!$actor_id || !$video_data) return null;

        foreach ($video_data as $video) {
            if(!$video->url) return null;
            $iframe = '<div style="position: relative; display: block; height: 0; padding: 0; -webkit-overflow-scrolling: touch; overflow: hidden; -ms-overflow-style: -ms-autohiding-scrollbar; padding-top: 54%;">
    <iframe
        src="'. $video->url .'?autoplay=false&iframe=true&locale=de"
        width="auto"
        allowfullscreen
        style="border: none; position: absolute; top: 0; right: 0; left: 0; bottom: 0; height: 100%; width: 100%; border: 0;">
    </iframe>
</div>';
            
            $data = [
                'client_id' => $actor_id,
                'iframe_code' => $iframe,
            ];

            $format = ['%d', '%s'];
            $this->wpdb->insert($this->video_iframe, $data, $format);
            return $this->wpdb->insert_id;
        }
    }

    private function callsheet_save_video_external($actor_id, $video_url)
    {
        if (!$actor_id || $video_url == '') return null;

        if(strpos($video_url, 'schauspielervideos') === false) return null;

        $iframe = "<link type='text/css' rel='stylesheet' href='https://video.filmmakers.de/iframe.css'>
<div class='embed-container'>
<iframe width='960' height='720' scrolling='no' src='".$video_url."'></iframe>
</div>";
            $data = [
                'client_id' => $actor_id,
                'iframe_code' => $iframe,
            ];

            $format = ['%d', '%s'];
            $this->wpdb->insert($this->video_iframe, $data, $format);
            return $this->wpdb->insert_id;
        
    }

    private function get_castupload_actor_id($actor_id)
    {
        $query  = $this->wpdb->prepare("SELECT client_id, client_api_id FROM $this->client_master_table  WHERE client_id=%d", $actor_id);
        $api_result = $this->wpdb->get_row($query);
        return ($api_result !== NULL) ? $api_result->client_api_id : NULL;
    }

    private function callsheet_save_education($actor_id, $education_data)
    {
        if (!$actor_id || !$education_data) return null;

        foreach ($education_data as $education) {
            $data = [
                'client_id' => $actor_id,
                'from_year' => $education->year_from,
                'to_year' => $education->year_to,
                'education' => $education->name,
            ];

            $format = ['%d', '%d', '%d', '%s', '%s'];
            $this->wpdb->insert($this->education_table, $data, $format);
            $this->wpdb->insert_id;
        }
    }

    private function set_actor_showreel_data($actor_id, $actor_data)
    {
        //video saving
        if ((isset($actor_data->showreels) && count($actor_data->showreels) > 0) ||
            (isset($actor_data->external_showreel) && $actor_data->external_showreel != '')) {
            $this->callsheet_clear_actor_video_iframe($actor_id);

            $this->callsheet_save_video_showreels($actor_id, $actor_data->showreels);

            //$this->callsheet_save_video_external($actor_id, $actor_data->external_showreel);
        }
    }

    private function set_actor_castupload_data_from_api($actor_id, $actor_data)
    {
        //award saving
        if (isset($actor_data->vita->award) && count($actor_data->vita->award) > 0) {
            $this->callsheet_clear_actor_awards($actor_id);
            $this->callsheet_save_awards($actor_id, $actor_data->vita->award);
        }

        //film saving
        if (isset($actor_data->vita->film) && count($actor_data->vita->film) > 0) {
            $this->callsheet_clear_actor_films($actor_id);
            $this->callsheet_save_films($actor_id, $actor_data->vita->film);
        }

        //tv saving
        if (isset($actor_data->vita->television) && count($actor_data->vita->television) > 0) {
            $this->callsheet_clear_actor_tvs($actor_id);
            $this->callsheet_save_tvs($actor_id, $actor_data->vita->television);
        }

        //theatre saving
        if (isset($actor_data->vita->theatre) && count($actor_data->vita->theatre) > 0) {
            $this->callsheet_clear_actor_theatre($actor_id);
            $this->callsheet_save_theatre($actor_id, $actor_data->vita->theatre);
        }

        //internet saving
        if (isset($actor_data->vita->internet) && count($actor_data->vita->internet) > 0) {
            $this->callsheet_clear_actor_internet($actor_id);
            $this->callsheet_save_internet($actor_id, $actor_data->vita->internet);
        }

        //education saving
        if (isset($actor_data->vita->education) && count($actor_data->vita->education) > 0) {
            $this->callsheet_clear_actor_education($actor_id);
            $this->callsheet_save_education($actor_id, $actor_data->vita->education);
        }

        //social saving
        $this->callsheet_clear_actor_links($actor_id);
        $this->callsheet_save_social($actor_id, [
            'homepage_url' => $actor_data->homepage_url ?? null,
            'imdb_link' => $actor_data->imdb_link ?? null,
            'facebook_page' => $actor_data->facebook_page ?? null,
            'twitter_handle' => $actor_data->twitter_handle ?? null,
            'instagram_username' => $actor_data->instagram_username ?? null,
            'filmmakers_url' => $actor_data->filmmakers_url ?? null,
            'sv_url' => $actor_data->sv_url ?? null,
        ]);
        $result = $this->set_actor_castupload_data($actor_id, $actor_data);
        return ($result >= 0) ? ['fname' => $actor_data->first_name, 'lname' => $actor_data->last_name, 'gender' => $actor_data->gender] : NULL;
    }

    public function castupload_ajax_update_by_name()
    {
        $actor_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        $update_showreel = filter_input(INPUT_POST, 'update_showreel', FILTER_VALIDATE_BOOLEAN);

        if (!$actor_id) wp_send_json_error(['message' => __('Wrong profile id', 'callsheet'), 'sync' => false]);
        if (!$this->api_key || $this->api_key == '') wp_send_json_error(['message' => __('Empty Castupload Api Key', 'callsheet'), 'sync' => false]);

        $actor_data = $this->get_actor_data($actor_id);
        if ($actor_data == NULL) wp_send_json_error(['message' => __('Not exist with current id', 'callsheet'), 'sync' => false]);

        $sync_status = $actor_data->sync_api;

        if ($sync_status == 1) {
            $sync = $this->set_sync_status($actor_id, '0');
            return ($sync == 1) ? wp_send_json_success(['message' => __('Unsynchronised', 'callsheet'), 'sync' => false]) : wp_send_json_error(['message' => __('Unable to Unsync', 'callsheet'), 'sync' => true]);
        } else {
            //getting all actors from castupload api
            $all_actors = $this->get_all_actors($this->api_key);

            $castupload_actor_id = $this->get_castupload_actor_id($actor_id);

            if (!$castupload_actor_id) {

                $full_actor_name = $this->actor_full_name($actor_data->first_name, $actor_data->last_name);

                $castupload_actor_id = $this->set_actor_castupload_id($all_actors, $full_actor_name, $actor_id);
            }

            if (!$castupload_actor_id) wp_send_json_error(['not_found' => true, 'sync' => false]);

            $actor_data = $this->get_actor_data_by_castupload_id($castupload_actor_id);

            $this->set_actor_name($actor_id, $actor_data->first_name, $actor_data->last_name, $actor_data->gender);

            $result = $this->set_actor_castupload_data_from_api($actor_id, $actor_data);

            if ($update_showreel) $this->set_actor_showreel_data($actor_id, $actor_data);

            $img_arr = [];
            if (isset($actor_data->pictures) && count($actor_data->pictures) > 0) {
                //clean before loaded photos from profile
                $this->callsheet_clear_actor_photos($actor_id);

                foreach ($actor_data->pictures as $key => $image) {
                    if ($image->url == '') continue;
                    $img_arr[] = [
                        'url'       => $image->url,
                        'main_picture' => $image->main_picture,
                        'copyright' => $image->copyright,
                    ];
                }
            }

            if (!$result) wp_send_json_error(['message' => __('Failed to update', 'callsheet'), 'sync' => true]);

            $sync = $this->set_sync_status($actor_id, '1');
            if ($sync < 1) wp_send_json_error(['message' => __('Account not synced', 'callsheet'), 'sync' => false]);
            wp_send_json_success([
                'message' => __('Successfully synchronized', 'callsheet'),
                'sync' => true,
                'img' => $img_arr ?? null,
                'fname' => $result['fname'],
                'lname' => $result['lname'],
                'gender' => $result['gender'] == 'm' ? __('Actor', 'callsheet') : __('Actress', 'callsheet'),
            ]);
        }
    }

    public function castupload_ajax_update_by_id()
    {
        $actor_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        $castupload_id = filter_input(INPUT_POST, 'castupload_id', FILTER_VALIDATE_INT);
        $update_showreel = filter_input(INPUT_POST, 'update_showreel', FILTER_VALIDATE_BOOLEAN);

        if (!$actor_id) wp_send_json_error(['message' => __('Wrong profile id', 'callsheet'), 'sync' => false]);
        if (!$castupload_id) wp_send_json_error(['message' => __('Castupload id must be integer', 'callsheet'), 'sync' => false]);

        //getting all actors from castupload api
        $all_actors = $this->get_all_actors($this->api_key);
        if (!$all_actors) wp_send_json_error(['message' => __('Failed to get data from API', 'callsheet'), 'sync' => false]);

        //check if exist ID in API
        $actors_ids = array_column($all_actors, 'id');
        if (!in_array($castupload_id, $actors_ids)) wp_send_json_error(['message' => __('Not found with this ID', 'callsheet'), 'sync' => false]);

        $update_status = $this->set_castupload_id($actor_id, $castupload_id);
        if (!$update_status) wp_send_json_error(['message' => __('Error while updating ID', 'callsheet'), 'sync' => false]);

        $actor_data = $this->get_actor_data_by_castupload_id($castupload_id);

        $this->set_actor_name($actor_id, $actor_data->first_name, $actor_data->last_name, $actor_data->gender);

        $result = $this->set_actor_castupload_data_from_api($actor_id, $actor_data);

        if ($update_showreel) $this->set_actor_showreel_data($actor_id, $actor_data);

        $img_arr = [];
        if (isset($actor_data->pictures) && count($actor_data->pictures) > 0) {
            //clean before loaded photos from profile
            $this->callsheet_clear_actor_photos($actor_id);

            foreach ($actor_data->pictures as $key => $image) {
                if (!$image->url) continue;
                $img_arr[] = [
                    'url'       => $image->url,
                    'main_picture' => $image->main_picture,
                    'copyright' => $image->copyright,
                ];
            }
        }

        if (!$result) wp_send_json_error(['message' => __('Failed to update', 'callsheet'), 'sync' => true]);

        $sync = $this->set_sync_status($actor_id, '1');
        if ($sync < 1) wp_send_json_error(['message' => __('Account not synced', 'callsheet'), 'sync' => false]);
        wp_send_json_success([
            'message' => __('Successfully synchronized', 'callsheet'),
            'sync' => true,
            'img' => $img_arr ?? null,
            'fname' => $result['fname'],
            'lname' => $result['lname'],
            'gender' => $result['gender'] == 'm' ? __('Actor', 'callsheet') : __('Actress', 'callsheet'),
        ]);
    }

    public function callsheet_castupload_save_image ()
    {
        $img_url = filter_input(INPUT_POST, 'img_url', FILTER_VALIDATE_URL);
        $actor_id = filter_input(INPUT_POST, 'actor_id', FILTER_VALIDATE_INT);
        $main_picture = filter_input(INPUT_POST, 'main_picture', FILTER_VALIDATE_BOOLEAN);
        $copyright = filter_input(INPUT_POST, 'copyright', FILTER_SANITIZE_STRING);

        if(!$img_url || !$actor_id) return wp_send_json_error(['message' => __('Wrong image parameters', 'callsheet'), 'sync' => false]);
        
        $attachemnt_id = $this->callsheet_download_image($img_url);
        if(!$attachemnt_id) wp_send_json_error(['message' => __('Image not saved', 'callsheet')]);

        $this->callsheet_save_photos($actor_id, $attachemnt_id, $copyright, $main_picture);
        $profile_photo = wp_get_attachment_image_url($attachemnt_id);
        wp_send_json_success(['message' => __('Image successfully loaded', 'callsheet'), 'img' => $main_picture ? $profile_photo : false]);
    }
}
