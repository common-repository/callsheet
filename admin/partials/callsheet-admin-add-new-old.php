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
<div class="container">
    <h2><?php _e('Add New Actor', 'callsheet'); ?></h2>
    <p><?php _e('Submit Below Forms For Adding New Actor', 'callsheet'); ?></p>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#bio-data"><?php _e('Bio-Data','callsheet'); ?></a></li>
        <li><a data-toggle="tab" href="#photos"><?php _e('Photos', 'callsheet'); ?></a></li>
        <li><a data-toggle="tab" href="#video"><?php _e('Video', 'callsheet'); ?></a></li>

    </ul>

    <div class="tab-content">
        <div id="bio-data" class="tab-pane fade in active">
            <h3><?php _e('Bio-Data', 'callsheet'); ?></h3>
            <form class="form-horizontal" action="">
                <div class="row">
                     <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="first_name">First Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="last_name">Last Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name">
                    </div>
                </div>
                </div>
               
                <div class="row">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="gender">Gender :</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                        <input type="radio" name="gender">Male
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="gender">Female
                        </label>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="agency">Agency :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="agency" placeholder="Enter Agency Name" name="agency">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="agency_id">Agency ID :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="agency_id" placeholder="Enter Agency ID" name="agency_id">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="agency_contact">Agency Contact :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="agency_contact" placeholder="Enter Contact" name="agency_contact">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="vintage">Vintage :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="agency_id" placeholder="Enter Vintage" name="vintage">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="playing_age_begin">Playing Age Begin :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="playing_age_begin" placeholder="Enter Playing Age Begin" name="playing_age_begin">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="playing_age_start">Playing Age Start :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="playing_age_start" placeholder="Enter Playing Age Start" name="playing_age_start">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="height_cm">Height Cm :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="height_cm" placeholder="Enter Height Cm" name="height_cm">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="size">Size :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="size" placeholder="Enter Size" name="size">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="ethnicity">Ethnicity :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ethnicity" placeholder="Enter Ethnicity" name="ethnicity">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="singing_voice">Singing Voice :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="singing_voice" placeholder="Enter Singing Voice" name="singing_voice">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="eyeColor">Eye Color :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="eyeColor" placeholder="Enter Eye Color" name="eyeColor">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="hairColor">Hair Color :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hairColor" placeholder="Enter Hair Color" name="hairColor">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="bodyphysique">Body Physique :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bodyphysique" placeholder="Enter Body Physique" name="bodyphysique">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="urlVideo">Url Video :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="urlVideo" placeholder="Enter Url Video" name="urlVideo">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="urlHomepage">Url Homepage :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="urlHomepage" placeholder="Enter Url Homepage" name="urlHomepage">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="location">Location :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="location" placeholder="Enter Location" name="location">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="nationality">Nationality :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nationality" placeholder="Enter Nationality" name="nationality">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="accent">Accent :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="accent" placeholder="Enter Accent" name="accent">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="profession">Profession :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="profession" placeholder="Enter Profession" name="profession">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="skill">Skill :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="skill" placeholder="Enter Skill" name="skill">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="dialect">Dialect :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="dialect" placeholder="Enter Dialect" name="dialect">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="foreignLanguage">Foreign Language :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="foreignLanguage" placeholder="Enter Foreign Language" name="foreignLanguage">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="education">Education :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="education" placeholder="Enter Education" name="education">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="awards">Awards :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="awards" placeholder="Enter Awards" name="awards">
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="active">Active :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="active" placeholder="Enter Active" name="active">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-sm-4" for="comment">Comment :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="comment" placeholder="Enter Comment" name="comment">
                    </div>
                </div>
                </div>
                


                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="photos" class="tab-pane fade">
            <h3><?php _e('Photos', 'callsheet'); ?></h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div id="video" class="tab-pane fade">
            <h3><?php _e('Video', 'callsheet'); ?></h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
    </div>
</div>
