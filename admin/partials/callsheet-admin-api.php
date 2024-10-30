<?php
global $wpdb;
$setting_master = $wpdb->prefix . 'call_sheet_setting';

$api_query = $wpdb->prepare("SELECT * FROM $setting_master where is_active=%d", 1);
$apis = $wpdb->get_results($api_query);
if ($apis == NULL) return;

if (isset($_POST['save'])) {
    if (!isset($_POST['register_api_nonce']) || !wp_verify_nonce($_POST['register_api_nonce'], 'register_api_action_nonce')) {
        exit('The form is not valid');
    } else {
        if (current_user_can('manage_options')) {
            foreach ($apis as $key => $api) {
                $api_key = sanitize_text_field($_POST[$api->api_name]);
                $result = $wpdb->update($setting_master, array("api_value" => $api_key), array('api_name' => $api->api_name));
            }
        } else {
            echo 'You are not allowd to change';
        }
    }
}

$apis = $wpdb->get_results($api_query);

?>

<div class="inner-wrap">
    <h3 class="title-h3"><?php _e('API detail', 'callsheet'); ?></h3>

    <div class="api-wrap">
        <div class="col-md-6">

            <form method="POST" action="">
                <?php foreach ($apis as $api) : ?>
                    <div class="input-group form-group">
                        <input id="msg" type="text" class="form-control" name="<?php echo $api->api_name; ?>" value="<?php echo $api->api_value; ?>" placeholder="<?php echo $api->api_title; ?> ">
                        <span class="input-group-addon input-api"><?php echo $api->api_title; ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="form-group pull-left">
                    <input type="hidden" name="action" value="register_api_action">
                    <?php wp_nonce_field('register_api_action_nonce', 'register_api_nonce'); ?>
                    <button type="submit" name="save" class="btn btn-primary pull-right"><?php _e('Submit', 'callsheet'); ?></button>
                </div>
            </form>
        </div>
    </div>

</div>