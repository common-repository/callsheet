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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

global $wpdb;
$client_master = $wpdb->prefix . 'call_sheet_client_master';
$delclientid = filter_input(INPUT_GET, 'del_client_id', FILTER_VALIDATE_INT);
$showhideid = filter_input(INPUT_GET, 'show_hide_client_id', FILTER_VALIDATE_INT);
if (isset($delclientid)) {
    $wpdb->delete($client_master, array('client_id' => $delclientid));
}
if (isset($showhideid)) {
    $sql1  = $wpdb->prepare("SELECT show_hide FROM $client_master WHERE client_id=%d", $showhideid);

    $result1 = $wpdb->get_row($sql1);
    if ($result1->show_hide == '1') {

        $wpdb->update($client_master, array("show_hide" => '0'), array('client_id' => $showhideid), '', '');
    } else {

        $wpdb->update($client_master, array("show_hide" => '1'), array('client_id' => $showhideid), '', '');
    }
}

$sql = $wpdb->prepare("SELECT client_id,first_name,last_name,type,show_hide,slug,sync_api FROM %s", $client_master);
$sql_result = str_replace("\'", "", esc_sql($sql));
$results = $wpdb->get_results($sql_result);

?>

<div class="inner-wrap">
    <h3 class="title-h3"><?php _e('All client', 'callsheet'); ?></h3>
    <table class="all_client table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th data-orderable="false" class="img_th"><?php _e('Client ID', 'callsheet'); ?></th>
                <th><?php _e('First Name', 'callsheet'); ?></th>
                <th><?php _e('Last Name', 'callsheet'); ?></th>
                <th><?php _e('Type', 'callsheet'); ?></th>
                <th data-orderable="false"><?php _e('Action', 'callsheet'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $default_url = '<i class="fa fa-user td_list_image"></i>'; /*https://via.placeholder.com/97x151*/
            $photo_master  = $wpdb->prefix . 'call_sheet_photo';
            foreach ($results as $result) {
                $image_path    = '';
                $sql_image     = $wpdb->prepare("SELECT * FROM $photo_master where client_id=%d AND profile=%s LIMIT 1", $result->client_id, '1');
                $results_image = $wpdb->get_results($sql_image);
                foreach ($results_image as $result_image) {
                    $image_attributes = wp_get_attachment_image_src($result_image->attachment_id, 'full');
                    if ($image_attributes[0] == '') {
                        $image_attributes[0] = $default_url;
                    }
                    $image_path = $image_attributes[0];
                }
                if ($image_path == '') {
                    $image_path = $default_url;
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
                <tr style="<?php if ($result->show_hide != '1') {
                                    echo "background-color: #fee0e1;";
                                } ?>">
                    <td>
                        <?php if ($image_path != $default_url) { ?>
                            <img class="td_list_image" src="<?php echo $image_path; ?>" />
                        <?php
                            } else {
                                echo $default_url;
                            }

                            ?>
                    </td>
                    <td><?php echo $result->first_name; ?></td>
                    <td><?php echo $result->last_name; ?></td>
                    <td><?php _e($result->type, 'callsheet'); ?></td>
                    <td>
                        <span class="edit"><a href="admin.php?page=callsheet-edit&client_id=<?php echo  $result->client_id ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>
                        <?php if ($result->show_hide == '1') { ?><span class="show_hide"><a href="admin.php?page=callsheet&show_hide_client_id=<?php echo  $result->client_id ?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span> <?php } else { ?> <span class="show_hide"><a href="admin.php?page=callsheet&show_hide_client_id=<?php echo  $result->client_id ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></span><?php } ?>
                        <span class="delet"><a onClick="if (confirm('Are you sure?')){return true;}else{return false;}" href="admin.php?page=callsheet&del_client_id=<?php echo  $result->client_id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
                        <span class="view_profile"><a target="_blank" href="<?php echo $sulg_url; ?>/" style="margin-left: 10px;"><i class="fa fa-external-link" aria-hidden="true"></i></a></span>
                        <span class="sync_api" data-id="<?php echo  $result->client_id ?>" data-sync="<?php echo (isset($result->sync_api) && $result->sync_api == 1) ? 1 : 0; ?>">
                            <i class="fa fa-refresh <?php if ($result->sync_api == 1) echo ' active'; ?>" aria-hidden="true"></i>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="container">
    <div class="modal fade" id="inputCustomId" tabindex="-1" role="dialog" aria-labelledby="inputCustomId" aria-hidden="true">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e('Close', 'callsheet'); ?></span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"><?php _e('Enter manually Castupload ID', 'callsheet'); ?></h4>
                        <p><?php _e('We are unable automatically found ID for this profile. Please enter manually ID.', 'callsheet'); ?></p>
                    </div>
                    <div class="modal-body">
                        <form id="formCustomId" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                            <div class="form-group">
                                <label for="inputCastauploadID"><?php _e('Castupload ID', 'callsheet'); ?></label>
                                <input type="text" class="form-control" id="inputCastauploadID" aria-describedby="emailHelp" placeholder="Enter ID" name="castauploadId">
                                <small id="show_error" class="help-block"><?php _e('Castupload ID is required and cannot be empty', 'callsheet') ?></small>
                            </div>
                            <div class="showreel-checkbox">
                                <label>
                                    <input type="checkbox" value="" checked id="showreel-input-checkbox-id">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <?php _e('Update Showreel', 'callsheet'); ?>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="update-castupload-id" data-id=""><?php _e('Save changes', 'callsheet'); ?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="submit-custupload-id"><?php _e('Close', 'callsheet'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="modal fade" id="image-loading" tabindex="-1" role="dialog" aria-labelledby="inputCustomId" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center"><?php _e('Image loading', 'callsheet'); ?> <span id="current-image"></span> / <span id="total-images"></span> </h4>
                    </div>
                    <div class="modal-body text-center">
                        <span class="fa fa-spinner fa-spin fa-3x"></span>
                    </div>
                    <div class="modal-footer">
                        <h4 class="text-center"><?php _e('Don\'t refresh page', 'callsheet'); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="modal fade" id="prompt-api-sync" tabindex="-1" role="dialog" aria-labelledby="prompt-api-sync" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center"><?php _e('Update Client Profile', 'callsheet'); ?></h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4><?php _e('All previous data will be erased. Are you sure?', 'callsheet'); ?></h4>
                        <div class="showreel-checkbox">
                            <label>
                                <input type="checkbox" value="" checked id="showreel-input-checkbox">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                <?php _e('Update Showreel', 'callsheet'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="update-client-profile"><?php _e('Apply', 'callsheet'); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Cancel', 'callsheet'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {

        jQuery('.all_client').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    });
</script>