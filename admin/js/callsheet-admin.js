(function ($) {

    'use strict';

    

   jQuery(document).ready(function () {

        jQuery('.summernote').summernote({height: 300});

        jQuery('.summernote-short-text').summernote({height: 300});

        jQuery('.summernote-special-skills').summernote({height: 300});

        jQuery('.autosave').hide();



        

        

         

        /*jQuery('.vi_items_control_item').each(function() {

            jQuery(this).click(function() {

           

                var v_src = jQuery('video.h5_lb_video source').attr('src');

                v_src = v_src + '?autoplay=0';

                alert(v_src);

                jQuery('video.h5_lb_video source').attr('src',v_src);

                jQuery('video.h5_lb_video').attr('src',v_src);

            

            });

        });*/

        

       

        jQuery('.clickphotostab').click(function() { /*activaTab('photos');*/ 

            jQuery('ul.nav a[href="#photos"]').tab('show'); 

            window.location.hash = '#photos'; 

            

        });

        /* var tabValue = jQuery(".nav-tabs .active > a").attr("href");

        jQuery('ul.nav a[href="'+tabValue+'"]').tab('show'); 

            window.location.hash = tabValue; */



        var hash = window.location.hash;

          hash && jQuery('ul.nav a[href="' + hash + '"]').tab('show');



          jQuery('.nav-tabs a').click(function (e) {

            jQuery(this).tab('show');

            var scrollmem = jQuery('body').scrollTop();

            window.location.hash = this.hash;

            jQuery('html,body').scrollTop(scrollmem);

          });



       jQuery(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {



   if(e.target.id=='get_on_social'){get_agency_data();}

   if(e.target.id=='get_education'){get_education_data(); get_total_rows_education();}

   if(e.target.id=='get_awards'){get_awards_data(); get_total_rows_awards();}

   if(e.target.id=='get_film'){get_film_data(); get_total_rows_film();}

   if(e.target.id=='get_tv'){ get_tv_data(); get_total_rows_tv();}

   if(e.target.id=='get_theater'){get_theater_data(); get_total_rows_theater();}

   if(e.target.id=='get_commercial'){get_commercial_data(); get_total_rows_commercial();}

   if(e.target.id=='get_audio'){get_audio_data(); get_total_rows_audio();}

   if(e.target.id=='get_internet'){get_internet_data(); get_total_rows_internet();}

   if(e.target.id=='get_other'){get_other_data(); get_total_rows_other();}

   if(e.target.id=='get_news'){get_news_data();}

   if(e.target.id=='get_on_air'){get_on_air_data(); get_on_stage_data(); get_at_festival_data(); get_on_tv_data(); }

   /*if(e.target.id=='get_on_stage'){}*/

   if(e.target.id=='get_photos'){get_photo_list();}

   if(e.target.id=='get_video'){get_video_list();}

})



var client_id = control_vars.client_id;

        

 jQuery('[data-toggle="tooltip"]').tooltip();   

       jQuery(document).delegate(".awards_add_click", "click", function () {

           

       });

       jQuery(document).delegate(".education_add_click", "click", function () {

          

                  

       });

       jQuery(document).delegate(".edit_form_btn", "click", function () {

            var client_id = this.id;



            jQuery.ajax({

                data: {action: 'client_record_edit', client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery(".custom_edit_form .media-body").html(data);



                }

            });

        });

       jQuery(document).delegate(".edit_client_save", "click", function () {

             var formdata = jQuery('.edit_client_form').serialize();



            jQuery.ajax({

                data: {action: 'edit_client_save', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery(".custom_edit_form .media-body").html(data);



                }

            });

        });

       //education

          jQuery('.education_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var education_id = jQuery(this).closest('tr').attr("idd");

                    new_position += education_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_education_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_education_data();

                    }

                });

            }

        });

        

        /*add_education_rows(5);

        add_awards_rows(5);

        add_film_rows(5);

        add_tv_rows(5);

        add_theater_rows(5);

        add_commercial_rows(5);

        add_audio_rows(5);

        add_other_rows(5);

        add_internet_rows(5);*/

        //get_education_data();

        function get_education_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_education_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.education_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.education_save').click(function (e) {



            if(jQuery('.add_education_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.add_education_form .summernote').summernote('code');

                jQuery('.add_education_form .summernote').text(notes);

            }



            var formdata = jQuery('.add_education_form').serialize();

            jQuery.ajax({

                data: {action: 'new_education_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    //formdata.reset();

                    

                    jQuery('.add_education_form .summernote').summernote("reset");

                    jQuery('.add_education_form')[0].reset();

                    jQuery('#education_add').modal('hide');

                    get_education_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_education_popup", "click", function () {

            var education_id = this.id;



            jQuery.ajax({

                data: {action: 'single_education_record', education_id: education_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#education_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote_edu').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_education", "click", function () {

            var education_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_education_record', education_id: education_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_education_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.education_edit_save').click(function (e) {

            if(jQuery('.edit_education_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.edit_education_form .summernote_edu').summernote('code');

                jQuery('.edit_education_form .summernote_edu').text(notes);

            }



            var formdata = jQuery('.edit_education_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_education_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#education_edit').modal('hide');

                    get_education_data();



                }

            });



        });



        jQuery('#education-number-records').change(function() {

            var tot_rec = jQuery("#education-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_education_rows(tot_rec);

            

        });

        function add_education_rows(total_records) {

            alert('client id in edu'+client_id);

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'education',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_education();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_education() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=education',

                async: false,

                success: function (data) {

                    jQuery('#education-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }



        //news

          jQuery('.news_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var news_id = jQuery(this).closest('tr').attr("idd");

                    new_position += news_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_news_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_news_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_news_data();

        function get_news_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_news_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.news_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.news_save').click(function (e) {

            if(jQuery('.add_news_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.add_news_form .summernote').summernote('code');

                jQuery('.add_news_form .summernote').text(notes);

            }



            var formdata = jQuery('.add_news_form').serialize();

            jQuery.ajax({

                data: {action: 'new_news_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('.add_news_form .summernote').summernote("reset");

                    jQuery('.add_news_form')[0].reset();

                    jQuery('#news_add').modal('hide');

                    get_news_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_news_popup", "click", function () {

            var news_id = this.id;



            jQuery.ajax({

                data: {action: 'single_news_record', news_id: news_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#news_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote_edu').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_news", "click", function () {

            var news_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_news_record', news_id: news_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_news_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.news_edit_save').click(function (e) {

            if(jQuery('.edit_news_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.edit_news_form .summernote_edu').summernote('code');

                jQuery('.edit_news_form .summernote_edu').text(notes);

            }



            var formdata = jQuery('.edit_news_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_news_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#news_edit').modal('hide');

                    get_news_data();



                }

            });



        });

        //Agency

        var client_id = control_vars.client_id;

        function get_agency_data() {

            //jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_agency_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('#TextBoxesGroup').html(data);

                     jQuery("#wait").css("display", "none");

                     //jQuery(".tab-content").css("opacity", "1");

                }

            });

        }



        //add agency

        jQuery(document).on('change','.agency-link',function() {

            

        });

        jQuery('.on_save_agency').click(function (e) {

            var agency_name = jQuery('.agency-name');

            var link_class = jQuery('.agency-link');

            var url ='';

            var ag_name = '';

            for(var i = 0; i < agency_name.length; i++) {

                ag_name = agency_name[i].value;

                if(ag_name == '') {

                   alert('Name should not be empty');

                       jQuery(agency_name[i]).focus();

                       return false; 

                }

            }

            for(var i = 0; i < link_class.length; i++) {    

                url =  link_class[i].value;

                if(url==''){

                     

                }

                else{

                    if(validateURL(url)) {

                        

                    }else{

                       alert('It Must be valid URL');

                       jQuery(link_class[i]).focus();

                       return false;

                        //jQuery(".save_information").attr('disabled', 'disabled');

                        

                    }

                }

            }

                

            var formdata = jQuery('.press_agencies_form').serialize();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text('Saving..');



            jQuery.ajax({

                data: {action: 'press_agency_save',client_id:client_id, formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    get_agency_data();

                    setTimeout(function(){

                            $('.autosave').removeClass('saving');

                            $('.autosave').addClass('saved');

                            $(".autosave").text("Saved..!!"); 

                        }, 1500);

                                

                        setTimeout(function(){

                            $('.autosave').removeClass('saved');

                            $(".autosave").hide();

                         }, 5000);



                }

            });



        });

        //delete

        jQuery(document).on("click", ".remove_data", function (event) {

   

            var id = jQuery(this).data('id');

            jQuery(this).parent('#TextBoxDiv'+id).remove();

            

        });



        //add_new_agency

        jQuery('#add_new_agency').click(function (e) {

        var counter = 1;

        counter++;

        

        var newTextBoxDiv = $(document.createElement('div'))

         .attr("id", 'TextBoxDiv' + counter).addClass('press_agency');



        newTextBoxDiv.after().html(

          '<input type="text" placeholder="Agency Name" class="agency-name" data-id="agencies_'+counter+'" id="agencies_'+counter+'" name="agencies[]" value="" />&nbsp;<input class="agency-link" placeholder="Agency Link" type="text" data-id="agencies_url_'+counter+'" id="agencies_url_'+counter+'" name="agencies_url[]" value="" />&nbsp;<select name="agencies_cat[]" id="agencies_cat_'+counter+'" data-id="agencies_cat_'+counter+'"><option value="public_relations">Public Relations</option><option value="social_media">Social Media</option><option value="public_social">Public Relations / Social Media</option></select>&nbsp;<button class="remove_data btn btn-default red" data-id="'+counter+'">Delete</button>');



        newTextBoxDiv.appendTo("#TextBoxesGroup");

    

        });



        

        //on_air

        //   jQuery('.on_air_table tbody').sortable({



        //     stop: function (event, ui) {

        //         var new_position = '';

        //         jQuery(this).children().each(function (index) {

        //             jQuery(this).closest('tr').attr("postion", index + 1);

        //             var position = index + 1;

        //             var on_air_id = jQuery(this).closest('tr').attr("idd");

        //             new_position += on_air_id + '=' + position + '&';

        //         });



        //         jQuery.ajax({

        //             type: 'POST',

        //             url: control_vars.admin_url,

        //             data: 'action=update_on_air_position&' + new_position,

        //             async: false,

        //             success: function (data) {

        //                 get_on_air_data();

        //             }

        //         });

        //     }

        // });



        jQuery('body').on('click', '.on_air_upload_image_button', function(e){

            e.preventDefault();

            //var serviceid = jQuery(this).attr('data-serid');

            //var stored_id = $('#featured_img_'+serviceid).val();

            var button = jQuery(this),

                custom_uploader = wp.media({

            title: 'Insert image',

            library : {

                // uncomment the next line if you want to attach image to the current post

                // uploadedTo : wp.media.view.settings.post.id, 

                type : 'image'

            },

            button: {

                text: 'Use this image' // button label text

            },

            multiple: false // for multiple image selection set to true

            }).on('select', function() { // it also has "open" and "close" events 

            var attachments = custom_uploader.state().get('selection').first().toJSON();

            

            jQuery('#on_air_image').val(attachments.id);

            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();

            jQuery('.on_air_remove_image_button').css('display','inline-block');

            

            })

            .open();

        });

         jQuery('body').on('click', '.on_air_remove_image_button', function(){

            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

            return false;

        });



        var client_id = control_vars.client_id;

        

        

        //get_on_air_data();

        function get_on_air_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_on_air_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.on_air_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        //checkbox change to show always on frontend

        jQuery('body').on('change', '.on_air_show_always', function (e) {

             

             var table_name=jQuery(this).attr("table_name");

             

             var id=jQuery(this).attr("table_id");

             jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

             jQuery.ajax({

                        data: 'action=show_always_update&table_name=' + table_name + '&id=' + id,

                       type: 'post',

                        url: control_vars.admin_url,

                        success: function (data) {



                        var get_record='get_'+table_name+'_data';

                   

                        eval(get_record+"()");

                           setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                        }

         });

         });



        jQuery('.on_air_save').click(function (e) {

            /*jQuery('#on_air_role').removeAttr('disabled');

            jQuery('#on_air_director').removeAttr('disabled');

            jQuery('#on_air_channel').removeAttr('disabled'); */



            if(jQuery('.add_on_air_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.add_on_air_form .summernote').summernote('code');

                jQuery('.add_on_air_form .summernote').text(notes);

            }

            var formdata = jQuery('.add_on_air_form').serialize();

            jQuery.ajax({

                data: {action: 'new_on_air_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('.add_on_air_form .summernote').summernote("reset");

                    jQuery('.add_on_air_form')[0].reset();

                    jQuery('.on_air_remove_image_button').hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

                    jQuery('#on_air_add').modal('hide');

                    get_on_air_data();



                }

            });



        });

       /* var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);

       */ 



       var client_id = control_vars.client_id;

       

       //jQuery('#on_air_title').suggest(control_vars.admin_url +'?action=get_on_air_names&name='+name+'&client_id='+client_id);

        jQuery('#on_air_title').autocomplete({

           source: function(name, response) {



                jQuery.ajax({

                    url: control_vars.admin_url,

                    data: {action:'get_on_air_names',name:name.term,client_id:client_id},

                    type: 'post',

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        console.log('in if');



                        /*jQuery('#on_air_director').attr('disabled',true);

                        jQuery('#on_air_role').attr('disabled',true);

                        jQuery('#on_air_channel').attr('disabled',true);*/



                        jQuery(this).val(ui.item.value);

                        jQuery('#on_air_role').val(ui.item.role);

                        jQuery('#on_air_director').val(ui.item.director);

                        jQuery('#on_air_channel').val(ui.item.channel); 



                        /*jQuery(this).css('background-color','#f9f9cf');

                        jQuery('#on_air_role').css('background-color','#f9f9cf');

                        jQuery('#on_air_director').css('background-color','#f9f9cf');

                        jQuery('#on_air_channel').css('background-color','#f9f9cf'); */

                        

                         

                    }

                    

                    return false;

            }

        });

        jQuery(document).on('keyup','#on_air_title_edit', function() {





        var client_id = control_vars.client_id;

        var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);



        

        jQuery(this).autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data){     /*jQuery('#on_air_role_edit').removeAttr('disabled');

                        jQuery('#on_air_director_edit').removeAttr('disabled');

                        jQuery('#on_air_channel_edit').removeAttr('disabled'); */

                     /*jQuery(this).next().addClass('frm_container_hide');*/},

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_on_air_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        /*jQuery('#on_air_director_edit').attr('disabled',true);

                        jQuery('#on_air_role_edit').attr('disabled',true);

                        jQuery('#on_air_channel_edit').attr('disabled',true);*/



                        jQuery(this).val(ui.item.value);

                        jQuery('#on_air_role_edit').val(ui.item.role);

                        jQuery('#on_air_director_edit').val(ui.item.director);

                        jQuery('#on_air_channel_edit').val(ui.item.channel); 

                    }

                    

                    

                    //jQuery(this).css('background-color','#f9f9cf');

                    // jQuery('#on_air_role_edit').css('background-color','#f9f9cf');

                    // jQuery('#on_air_director_edit').css('background-color','#f9f9cf');

                    // jQuery('#on_air_channel_edit').css('background-color','#f9f9cf'); 

                    

                

                return false;

            },

            minLength: 1

        });

        });

            jQuery(document).delegate(".edit_on_air_popup", "click", function () {

            var on_air_id = this.id;

            

            jQuery.ajax({

                data: {action: 'single_on_air_record', on_air_id: on_air_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#on_air_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_on_air", "click", function () {

            var on_air_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_on_air_record', on_air_id: on_air_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_on_air_data();

                    }

                });

            } else {

                return false;

            }



        });





        

        jQuery('.on_air_edit_save').click(function (e) {

            /*jQuery('#on_air_role_edit').removeAttr('disabled');

            jQuery('#on_air_director_edit').removeAttr('disabled');

            jQuery('#on_air_channel_edit').removeAttr('disabled'); */



            if(jQuery('.edit_on_air_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.edit_on_air_form .summernote').summernote('code');

                jQuery('.edit_on_air_form .summernote').text(notes);

            }



            var formdata = jQuery('.edit_on_air_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_on_air_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#on_air_edit').modal('hide');

                    get_on_air_data();



                }

            });



        });





        //on_tv ON TV

        jQuery('body').on('click', '.on_tv_upload_image_button', function(e){

            e.preventDefault();

            //var serviceid = jQuery(this).attr('data-serid');

            //var stored_id = $('#featured_img_'+serviceid).val();

            var button = jQuery(this),

                custom_uploader = wp.media({

            title: 'Insert image',

            library : {

                // uncomment the next line if you want to attach image to the current post

                // uploadedTo : wp.media.view.settings.post.id, 

                type : 'image'

            },

            button: {

                text: 'Use this image' // button label text

            },

            multiple: false // for multiple image selection set to true

            }).on('select', function() { // it also has "open" and "close" events 

            var attachments = custom_uploader.state().get('selection').first().toJSON();

            

            jQuery('#on_tv_image').val(attachments.id);

            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();

            jQuery('.on_tv_remove_image_button').css('display','inline-block');

            

            })

            .open();

        });

         jQuery('body').on('click', '.on_tv_remove_image_button', function(){

            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

            return false;

        });



        var client_id = control_vars.client_id;

        

        

        //get_on_tv_data();

        function get_on_tv_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_on_tv_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.on_tv_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        //checkbox change to show always on frontend

        jQuery('body').on('change', '.on_tv_show_always', function (e) {

             

             var table_name=jQuery(this).attr("table_name");

             

             var id=jQuery(this).attr("table_id");

             jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

             jQuery.ajax({

                        data: 'action=show_always_update&table_name=' + table_name + '&id=' + id,

                       type: 'post',

                        url: control_vars.admin_url,

                        success: function (data) {



                        var get_record='get_'+table_name+'_data';

                   

                        eval(get_record+"()");

                           setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                        }

         });

         });



        jQuery('.on_tv_save').click(function (e) {

            /*jQuery('#on_air_role').removeAttr('disabled');

            jQuery('#on_air_director').removeAttr('disabled');

            jQuery('#on_air_channel').removeAttr('disabled'); */



            if(jQuery('.add_on_tv_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.add_on_tv_form .summernote').summernote('code');

                jQuery('.add_on_tv_form .summernote').text(notes);

            }

            var formdata = jQuery('.add_on_tv_form').serialize();

            jQuery.ajax({

                data: {action: 'new_on_tv_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('.add_on_tv_form .summernote').summernote("reset");

                    jQuery('.add_on_tv_form')[0].reset();

                    jQuery('.on_tv_remove_image_button').hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

                    jQuery('#on_tv_add').modal('hide');

                    get_on_tv_data();



                }

            });



        });

        /*var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete_tv.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);

        */

        var client_id = control_vars.client_id;

      

        jQuery('#on_tv_title').autocomplete({

            

           

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data,ui){

                /*jQuery('#on_air_role').removeAttr('disabled');

                        jQuery('#on_air_director').removeAttr('disabled');

                        jQuery('#on_air_channel').removeAttr('disabled'); */

                },

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_listing_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        console.log('in if');

 

                        jQuery(this).val(ui.item.value);

                        jQuery('#on_tv_role').val(ui.item.role);

                        jQuery('#on_tv_director').val(ui.item.director);

                        jQuery('#on_tv_channel').val(ui.item.channel); 

                         

                    }

                    

                    return false;

            }

            

            

            

        });

        

        // jQuery('#on_tv_title').autocomplete({

            

        //     search: function (event,ui) {

        //         window.pageIndex = 0;

                

        //     },

        //     response: function(data,ui){

        //         /*jQuery('#on_air_role').removeAttr('disabled');

        //                 jQuery('#on_air_director').removeAttr('disabled');

        //                 jQuery('#on_air_channel').removeAttr('disabled'); */

        //         },

        //     source: cur_url,

        //     select: function( event, ui ) {

        //             console.log('in autocomplete:');

        //             /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

        //             */

        //             if(ui.item.value) {

        //                 console.log('in if');



        //                 /*jQuery('#on_air_director').attr('disabled',true);

        //                 jQuery('#on_air_role').attr('disabled',true);

        //                 jQuery('#on_air_channel').attr('disabled',true);*/



        //                 jQuery(this).val(ui.item.value);

        //                 jQuery('#on_tv_role').val(ui.item.role);

        //                 jQuery('#on_tv_director').val(ui.item.director);

        //                 jQuery('#on_tv_channel').val(ui.item.channel); 



        //                 /*jQuery(this).css('background-color','#f9f9cf');

        //                 jQuery('#on_air_role').css('background-color','#f9f9cf');

        //                 jQuery('#on_air_director').css('background-color','#f9f9cf');

        //                 jQuery('#on_air_channel').css('background-color','#f9f9cf'); */

                        

                         

        //             }

                    

        //             return false;

        //     },

        //     minLength: 1

        // });

        jQuery(document).on('keyup','#on_tv_title_edit', function() {





        var client_id = control_vars.client_id;

       /* var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete_tv.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);

*/

        

        jQuery(this).autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data){ },

           source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_listing_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                       



                        jQuery(this).val(ui.item.value);

                        jQuery('#on_tv_role_edit').val(ui.item.role);

                        jQuery('#on_tv_director_edit').val(ui.item.director);

                        jQuery('#on_tv_channel_edit').val(ui.item.channel); 

                    }

                    

                   

                    

                

                return false;

            }

        });

        });

            jQuery(document).delegate(".edit_on_tv_popup", "click", function () {

            var on_tv_id = this.id;

            

            jQuery.ajax({

                data: {action: 'single_on_tv_record', on_tv_id: on_tv_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#on_tv_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_on_tv", "click", function () {

            var on_tv_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_on_tv_record', on_tv_id: on_tv_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_on_tv_data();

                    }

                });

            } else {

                return false;

            }



        });





        

        jQuery('.on_tv_edit_save').click(function (e) {

            /*jQuery('#on_air_role_edit').removeAttr('disabled');

            jQuery('#on_air_director_edit').removeAttr('disabled');

            jQuery('#on_air_channel_edit').removeAttr('disabled'); */



            if(jQuery('.edit_on_tv_form .note-editor').hasClass('codeview')) {

                var notes = jQuery('.edit_on_tv_form .summernote').summernote('code');

                jQuery('.edit_on_tv_form .summernote').text(notes);

            }



            var formdata = jQuery('.edit_on_tv_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_on_tv_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#on_tv_edit').modal('hide');

                    get_on_tv_data();



                }

            });



        });





        //on_stage



        //   jQuery('.on_stage_table tbody').sortable({



        //     stop: function (event, ui) {

        //         var new_position = '';

        //         jQuery(this).children().each(function (index) {

        //             jQuery(this).closest('tr').attr("postion", index + 1);

        //             var position = index + 1;

        //             var on_stage_id = jQuery(this).closest('tr').attr("idd");

        //             new_position += on_stage_id + '=' + position + '&';

        //         });



        //         jQuery.ajax({

        //             type: 'POST',

        //             url: control_vars.admin_url,

        //             data: 'action=update_on_stage_position&' + new_position,

        //             async: false,

        //             success: function (data) {

        //                 get_on_stage_data();

        //             }

        //         });

        //     }

        // });

        jQuery('body').on('click', '.on_stage_upload_image_button', function(e){

            e.preventDefault();

            //var serviceid = jQuery(this).attr('data-serid');

            //var stored_id = $('#featured_img_'+serviceid).val();

            var button = jQuery(this),

                custom_uploader = wp.media({

            title: 'Insert image',

            library : {

                // uncomment the next line if you want to attach image to the current post

                // uploadedTo : wp.media.view.settings.post.id, 

                type : 'image'

            },

            button: {

                text: 'Use this image' // button label text

            },

            multiple: false // for multiple image selection set to true

            }).on('select', function() { // it also has "open" and "close" events 

            var attachments = custom_uploader.state().get('selection').first().toJSON();

            

            jQuery('#on_stage_image').val(attachments.id);

            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();

            jQuery('.on_stage_remove_image_button').css('display','inline-block');

            

            })

            .open();

        });

         jQuery('body').on('click', '.on_stage_remove_image_button', function(){

            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

            return false;

        });

        var client_id = control_vars.client_id;

        

        

        //get_on_stage_data();

        function get_on_stage_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_on_stage_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.on_stage_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        //checkbox change to show always on frontend

        jQuery('body').on('change', '.on_stage_show_always', function (e) {

             

             var table_name=jQuery(this).attr("table_name");

             

             var id=jQuery(this).attr("table_id");

             jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

             jQuery.ajax({

                        data: 'action=show_always_update&table_name=' + table_name + '&id=' + id,

                       type: 'post',

                        url: control_vars.admin_url,

                        success: function (data) {



                        var get_record='get_'+table_name+'_data';

                   

                        eval(get_record+"()");

                           setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                        }

         });

         });



        jQuery('.on_stage_save').click(function (e) {

            /*jQuery('#on_stage_role').removeAttr('disabled');

            jQuery('#on_stage_director').removeAttr('disabled');

            jQuery('#on_stage_theater').removeAttr('disabled');*/



            if(jQuery('.add_on_stage_form .note-editor').hasClass('codeview')) {

                var notes1 = jQuery('.add_on_stage_form .summernote').summernote('code');

                jQuery('.add_on_stage_form .summernote').text(notes1);

            }



            var formdata = jQuery('.add_on_stage_form').serialize();

            jQuery.ajax({

                data: {action: 'new_on_stage_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('.add_on_stage_form .summernote').summernote("reset");

                    jQuery('.add_on_stage_form')[0].reset();

                    jQuery('.on_stage_remove_image_button').hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

                    jQuery('#on_stage_add').modal('hide');

                    get_on_stage_data();



                }

            });



        });

        var client_id = control_vars.client_id;

        var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete_onstage.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);



        

        jQuery('#on_stage_title').autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data,ui){ /*jQuery('#on_stage_role').removeAttr('disabled');

                        jQuery('#on_stage_director').removeAttr('disabled');

                        jQuery('#on_stage_theater').removeAttr('disabled');*/ },

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_on_stage_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        console.log('in if');

                        jQuery(this).val(ui.item.value);

                        jQuery('#on_stage_role').val(ui.item.role);

                        jQuery('#on_stage_director').val(ui.item.director);

                        jQuery('#on_stage_theater').val(ui.item.theater); 

                        

                        // jQuery(this).css('background-color','#f9f9cf');

                        // jQuery('#on_stage_role').css('background-color','#f9f9cf');

                        // jQuery('#on_stage_director').css('background-color','#f9f9cf');

                        // jQuery('#on_stage_theater').css('background-color','#f9f9cf'); 

                        /*

                        jQuery('#on_stage_role').attr('disabled',true);

                        jQuery('#on_stage_director').attr('disabled',true);

                        jQuery('#on_stage_theater').attr('disabled',true); */

                    }

                   return false;

            }

        });

        jQuery(document).on('keyup','#on_stage_title_edit', function() {





        var client_id = control_vars.client_id;

        var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete_onstage.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);



        

        jQuery(this).autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data){  jQuery('#on_stage_role_edit').removeAttr('disabled');

                        jQuery('#on_stage_director_edit').removeAttr('disabled');

                        jQuery('#on_stage_theater_edit').removeAttr('disabled');

                    /*jQuery(this).next().addClass('frm_container_hide');*/},

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_on_stage_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        jQuery(this).val(ui.item.value);

                        jQuery('#on_stage_role_edit').val(ui.item.role);

                        jQuery('#on_stage_director_edit').val(ui.item.director);

                        jQuery('#on_stage_theater_edit').val(ui.item.theater); 



                        // jQuery('#on_stage_role_edit').attr('disabled',true);

                        // jQuery('#on_stage_director_edit').attr('disabled',true);

                        // jQuery('#on_stage_theater_edit').attr('disabled',true); 

                    }

                    // jQuery(this).css('background-color','#f9f9cf');

                    // jQuery('#on_stage_role_edit').css('background-color','#f9f9cf');

                    // jQuery('#on_stage_director_edit').css('background-color','#f9f9cf');

                    // jQuery('#on_stage_theater_edit').css('background-color','#f9f9cf'); 

                    

                

                return false;

            }

        });

        });

            jQuery(document).delegate(".edit_on_stage_popup", "click", function () {

            var on_stage_id = this.id;

            

            jQuery.ajax({

                data: {action: 'single_on_stage_record', on_stage_id: on_stage_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#on_stage_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_on_stage", "click", function () {

            var on_stage_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_on_stage_record', on_stage_id: on_stage_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_on_stage_data();

                    }

                });

            } else {

                return false;

            }



        });





        

        jQuery('.on_stage_edit_save').click(function (e) {

            /*jQuery('#on_stage_role_edit').removeAttr('disabled');

            jQuery('#on_stage_director_edit').removeAttr('disabled');

            jQuery('#on_stage_theater_edit').removeAttr('disabled');*/



            if(jQuery('.edit_on_stage_form .note-editor').hasClass('codeview')) {

                var notes1 = jQuery('.edit_on_stage_form .summernote').summernote('code');

                jQuery('.edit_on_stage_form .summernote').text(notes1);

            }



            var formdata = jQuery('.edit_on_stage_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_on_stage_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#on_stage_edit').modal('hide');

                    get_on_stage_data();



                }

            });



        });



        //on_stage

         /* jQuery('.on_stage_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var on_stage_id = jQuery(this).closest('tr').attr("idd");

                    new_position += on_stage_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_on_stage_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_on_stage_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_on_stage_data();

        function get_on_stage_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_on_stage_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.on_stage_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.on_stage_save').click(function (e) {

            var formdata = jQuery('.add_on_stage_form').serialize();

            jQuery.ajax({

                data: {action: 'new_on_stage_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#on_stage_add').modal('hide');

                    jQuery('.add_on_stage_form')[0].reset()

                    get_on_stage_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_on_stage_popup", "click", function () {

            var on_stage_id = this.id;



            jQuery.ajax({

                data: {action: 'single_on_stage_record', on_stage_id: on_stage_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#on_stage_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote_edu').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_on_stage", "click", function () {

            var on_stage_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_on_stage_record', on_stage_id: on_stage_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_on_stage_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.on_stage_edit_save').click(function (e) {

            var formdata = jQuery('.edit_on_stage_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_on_stage_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#on_stage_edit').modal('hide');

                    get_on_stage_data();



                }

            });



        });*/





        //at_festival

        //   jQuery('.at_festival_table tbody').sortable({



        //     stop: function (event, ui) {

        //         var new_position = '';

        //         jQuery(this).children().each(function (index) {

        //             jQuery(this).closest('tr').attr("postion", index + 1);

        //             var position = index + 1;

        //             var at_festival_id = jQuery(this).closest('tr').attr("idd");

        //             new_position += at_festival_id + '=' + position + '&';

        //         });



        //         jQuery.ajax({

        //             type: 'POST',

        //             url: control_vars.admin_url,

        //             data: 'action=update_at_festival_position&' + new_position,

        //             async: false,

        //             success: function (data) {

        //                 get_at_festival_data();

        //             }

        //         });

        //     }

        // });

        jQuery('body').on('click', '.at_festival_upload_image_button', function(e){

            e.preventDefault();

            //var serviceid = jQuery(this).attr('data-serid');

            //var stored_id = $('#featured_img_'+serviceid).val();

            var button = jQuery(this),

                custom_uploader = wp.media({

            title: 'Insert image',

            library : {

                // uncomment the next line if you want to attach image to the current post

                // uploadedTo : wp.media.view.settings.post.id, 

                type : 'image'

            },

            button: {

                text: 'Use this image' // button label text

            },

            multiple: false // for multiple image selection set to true

            }).on('select', function() { // it also has "open" and "close" events 

            var attachments = custom_uploader.state().get('selection').first().toJSON();

            

            jQuery('#at_festival_image').val(attachments.id);

            jQuery(button).removeClass('button').html('<img class="true_pre_image" src="' + attachments.url + '" style="display:block;height:150px;width:150px;" />').next().val(attachments.id).next().show();

            jQuery('.at_festival_remove_image_button').css('display','inline-block');

            

            })

            .open();

        });

         jQuery('body').on('click', '.at_festival_remove_image_button', function(){

            jQuery(this).hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

            return false;

        });



        var client_id = control_vars.client_id;

        

        

        //get_at_festival_data();

        function get_at_festival_data() {

            

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_at_festival_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.at_festival_table tbody').html(data);

                     jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        //checkbox change to show always on frontend

        jQuery('body').on('change', '.at_fest_show_always', function (e) {

             

             var table_name=jQuery(this).attr("table_name");

             

             var id=jQuery(this).attr("table_id");

             jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

             jQuery.ajax({

                        data: 'action=show_always_update&table_name=' + table_name + '&id=' + id,

                       type: 'post',

                        url: control_vars.admin_url,

                        success: function (data) {



                        var get_record='get_'+table_name+'_data';

                   

                        eval(get_record+"()");

                           setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                        }

         });

         });



        jQuery('.at_festival_save').click(function (e) {

            /*jQuery('#at_festival_role').removeAttr('disabled');

            jQuery('#at_festival_director').removeAttr('disabled');

            jQuery('#at_festival_channel').removeAttr('disabled'); 

*/

            if(jQuery('.add_at_festival_form .note-editor').hasClass('codeview')) {

                var notes2 = jQuery('.add_at_festival_form .summernote').summernote('code');

                jQuery('.add_at_festival_form .summernote').text(notes2);

            }



            var formdata = jQuery('.add_at_festival_form').serialize();

            jQuery.ajax({

                data: {action: 'new_at_festival_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('.add_at_festival_form .summernote').summernote("reset");

                    jQuery('.add_at_festival_form')[0].reset();

                    jQuery('.at_festival_remove_image_button').hide().prev().val('').prev().addClass('button').html('<span class="wp-media-buttons-icon">Add image</span>');

                    jQuery('#at_festival_add').modal('hide');

                    get_at_festival_data();



                }

            });



        });

        var client_id = control_vars.client_id;

        var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete_atfest.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);



        

        jQuery('#at_festival_title').autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data,ui){

                /*jQuery('#at_festival_role').removeAttr('disabled');

                        jQuery('#at_festival_director').removeAttr('disabled');

                        jQuery('#at_festival_channel').removeAttr('disabled'); */

                },

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_at_fest_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        console.log('in if');



                        /*jQuery('#at_festival_director').attr('disabled',true);

                        jQuery('#at_festival_role').attr('disabled',true);

                        jQuery('#at_festival_channel').attr('disabled',true);*/



                        jQuery(this).val(ui.item.value);

                        jQuery('#at_festival_role').val(ui.item.role);

                        jQuery('#at_festival_director').val(ui.item.director);

                        jQuery('#at_festival_channel').val(ui.item.channel); 



                        /*jQuery(this).css('background-color','#f9f9cf');

                        jQuery('#at_festival_role').css('background-color','#f9f9cf');

                        jQuery('#at_festival_director').css('background-color','#f9f9cf');

                        jQuery('#at_festival_channel').css('background-color','#f9f9cf'); */

                        

                         

                    }

                    

                    return false;

            },

            minLength: 1

        });

        jQuery(document).on('keyup','#at_festival_title_edit', function() {





        var client_id = control_vars.client_id;

        var cur_url = control_vars.plugin_uri+'/autocomplete-search/autocomplete.php';

        cur_url = updateQueryStringParameter(cur_url, 'client_id', client_id);



        

        jQuery(this).autocomplete({

            

            search: function (event,ui) {

                window.pageIndex = 0;

                

            },

            response: function(data){     /*jQuery('#at_festival_role_edit').removeAttr('disabled');

                        jQuery('#at_festival_director_edit').removeAttr('disabled');

                        jQuery('#at_festival_channel_edit').removeAttr('disabled'); */

                     /*jQuery(this).next().addClass('frm_container_hide');*/},

            source: function(name, response) {

                jQuery.ajax({

                    

                    data: {action:'get_at_fest_names',name:name.term,client_id:client_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function(data) {

                        response(JSON.parse(data));

                    }

                });

            },

            select: function( event, ui ) {

                    console.log('in autocomplete:');

                    /*jQuery(this).parent().find( ".cls_add_food" ).attr( "which_type", ui.item.type);

                    */

                    if(ui.item.value) {

                        /*jQuery('#at_festival_director_edit').attr('disabled',true);

                        jQuery('#at_festival_role_edit').attr('disabled',true);

                        jQuery('#at_festival_channel_edit').attr('disabled',true);*/



                        jQuery(this).val(ui.item.value);

                        jQuery('#at_festival_role_edit').val(ui.item.role);

                        jQuery('#at_festival_director_edit').val(ui.item.director);

                        jQuery('#at_festival_channel_edit').val(ui.item.channel); 

                    }

                    

                    

                    //jQuery(this).css('background-color','#f9f9cf');

                    // jQuery('#at_festival_role_edit').css('background-color','#f9f9cf');

                    // jQuery('#at_festival_director_edit').css('background-color','#f9f9cf');

                    // jQuery('#at_festival_channel_edit').css('background-color','#f9f9cf'); 

                    

                

                return false;

            },

            minLength: 1

        });

        });

            jQuery(document).delegate(".edit_at_festival_popup", "click", function () {

            var at_festival_id = this.id;

            

            jQuery.ajax({

                data: {action: 'single_at_festival_record', at_festival_id: at_festival_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#at_festival_edit .modal-body").html(data);

                  //

                  

                  jQuery('.summernote').summernote({height: 300});

                }

            });

        });

            jQuery(document).delegate(".delete_at_festival", "click", function () {

            var at_festival_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_at_festival_record', at_festival_id: at_festival_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_at_festival_data();

                    }

                });

            } else {

                return false;

            }



        });





        

        jQuery('.at_festival_edit_save').click(function (e) {

            /*jQuery('#at_festival_role_edit').removeAttr('disabled');

            jQuery('#at_festival_director_edit').removeAttr('disabled');

            jQuery('#at_festival_channel_edit').removeAttr('disabled'); */



            if(jQuery('.edit_at_festival_form .note-editor').hasClass('codeview')) {

                var notes2 = jQuery('.edit_at_festival_form .summernote').summernote('code');

                jQuery('.edit_at_festival_form .summernote').text(notes2);

            }



            var formdata = jQuery('.edit_at_festival_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_at_festival_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#at_festival_edit').modal('hide');

                    get_at_festival_data();



                }

            });



        });





        //awards

        jQuery('.awards_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var awards_id = jQuery(this).closest('tr').attr("idd");

                    new_position += awards_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_awards_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_awards_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_awards_data();

        function get_awards_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_awards_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.awards_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.awards_save').click(function (e) {

            if(jQuery('.note-editor').hasClass('codeview')) {

                var notes = jQuery('.add_awards_form .summernote').summernote('code');

                jQuery('.add_awards_form .summernote').text(notes);

            }

            var awards_data = jQuery('.add_awards_form').serialize();

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: {action: 'new_awards_record', formdata: awards_data},

                success: function (data) {

                    

                    jQuery('.add_awards_form .summernote').summernote("reset");

                    jQuery('.add_awards_form')[0].reset();

                    jQuery('#awards_add').modal('hide');

                    get_awards_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_awards_popup", "click", function () {

            var awards_id = this.id;

            

            jQuery.ajax({

                data: {action: 'single_awards_record', awards_id: awards_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#awards_edit .modal-body").html(data);

                    //

                    jQuery('.summernote_award').summernote({height: 300});

                    //jQuery('.summernote_award').summernote('codeview.activate');

                    

                    }

            });

        });

            jQuery(document).delegate(".delete_awards", "click", function () {

            var awards_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_awards_record', awards_id: awards_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_awards_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.awards_edit_save').click(function (e) {

            if(jQuery('.note-editor').hasClass('codeview')) {

                var notes = jQuery('.edit_awards_form .summernote_award').summernote('code');

                jQuery('.edit_awards_form .summernote_award').text(notes);

            }



            var formdata = jQuery('.edit_awards_form').serialize();

            

            jQuery.ajax({

                data: {action: 'edit_awards_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#awards_edit').modal('hide');

                    get_awards_data();



                }

            });



        });

        jQuery('#awards-number-records').change(function() {

            var tot_rec = jQuery("#awards-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_awards_rows(tot_rec);

            

        });

        function add_awards_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'awards',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_awards();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_awards() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=awards',

                async: false,

                success: function (data) {

                    jQuery('#awards-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }

        //film

        jQuery('.film_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var film_id = jQuery(this).closest('tr').attr("idd");

                    new_position += film_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_film_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_film_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_film_data();

        function get_film_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_film_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.film_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.film_save').click(function (e) {

            var formdata = jQuery('.add_film_form').serialize();

            jQuery.ajax({

                data: {action: 'new_film_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#film_add').modal('hide');

                    jQuery('.add_film_form')[0].reset()

                    get_film_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_film_popup", "click", function () {

            var film_id = this.id;



            jQuery.ajax({

                data: {action: 'single_film_record', film_id: film_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#film_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_film", "click", function () {

            var film_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_film_record', film_id: film_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_film_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.film_edit_save').click(function (e) {

            var formdata = jQuery('.edit_film_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_film_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#film_edit').modal('hide');

                    get_film_data();



                }

            });



        });

        jQuery('#film-number-records').change(function() {

            var tot_rec = jQuery("#film-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_film_rows(tot_rec);

            

        });

        function add_film_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'film',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_film();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_film() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=film',

                async: false,

                success: function (data) {

                    jQuery('#film-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }

        

        //tv

        jQuery('.tv_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var tv_id = jQuery(this).closest('tr').attr("idd");

                    new_position += tv_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_tv_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_tv_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_tv_data();

        function get_tv_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_tv_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.tv_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.tv_save').click(function (e) {

            var formdata = jQuery('.add_tv_form').serialize();

            jQuery.ajax({

                data: {action: 'new_tv_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#tv_add').modal('hide');

                    jQuery('.add_tv_form')[0].reset()

                    get_tv_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_tv_popup", "click", function () {

            var tv_id = this.id;



            jQuery.ajax({

                data: {action: 'single_tv_record', tv_id: tv_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#tv_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_tv", "click", function () {

            var tv_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_tv_record', tv_id: tv_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_tv_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.tv_edit_save').click(function (e) {

            var formdata = jQuery('.edit_tv_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_tv_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#tv_edit').modal('hide');

                    get_tv_data();



                }

            });



        });

        jQuery('#tv-number-records').change(function() {

            var tot_rec = jQuery("#tv-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_tv_rows(tot_rec);

            

        });

        function add_tv_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'tv',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_tv();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_tv() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=tv',

                async: false,

                success: function (data) {

                    jQuery('#tv-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }

        //commercial

        jQuery('.commercial_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var commercial_id = jQuery(this).closest('tr').attr("idd");

                    new_position += commercial_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_commercial_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_commercial_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_commercial_data();

        function get_commercial_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_commercial_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.commercial_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.commercial_save').click(function (e) {

            var formdata = jQuery('.add_commercial_form').serialize();

            jQuery.ajax({

                data: {action: 'new_commercial_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#commercial_add').modal('hide');

                    jQuery('.add_commercial_form')[0].reset()

                    get_commercial_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_commercial_popup", "click", function () {

            var commercial_id = this.id;



            jQuery.ajax({

                data: {action: 'single_commercial_record', commercial_id: commercial_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#commercial_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_commercial", "click", function () {

            var commercial_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_commercial_record', commercial_id: commercial_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_commercial_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.commercial_edit_save').click(function (e) {

            var formdata = jQuery('.edit_commercial_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_commercial_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#commercial_edit').modal('hide');

                    get_commercial_data();



                }

            });



        });

        jQuery('#commercial-number-records').change(function() {

            var tot_rec = jQuery("#commercial-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_commercial_rows(tot_rec);

            

        });

        function add_commercial_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'commercial',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_commercial();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_commercial() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=commercial',

                async: false,

                success: function (data) {

                    jQuery('#commercial-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }



        //audio

        jQuery('.audio_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var audio_id = jQuery(this).closest('tr').attr("idd");

                    new_position += audio_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_audio_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_audio_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_audio_data();

        function get_audio_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_audio_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.audio_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.audio_save').click(function (e) {

            var formdata = jQuery('.add_audio_form').serialize();

            jQuery.ajax({

                data: {action: 'new_audio_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#audio_add').modal('hide');

                    jQuery('.add_audio_form')[0].reset()

                    get_audio_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_audio_popup", "click", function () {

            var audio_id = this.id;



            jQuery.ajax({

                data: {action: 'single_audio_record', audio_id: audio_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#audio_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_audio", "click", function () {

            var audio_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_audio_record', audio_id: audio_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_audio_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.audio_edit_save').click(function (e) {

            var formdata = jQuery('.edit_audio_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_audio_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#audio_edit').modal('hide');

                    get_audio_data();



                }

            });



        });

        jQuery('#audio-number-records').change(function() {

            var tot_rec = jQuery("#audio-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_audio_rows(tot_rec);

            

        });

        function add_audio_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'audio',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_audio();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_audio() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=audio',

                async: false,

                success: function (data) {

                    jQuery('#audio-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }

        

        //internet

        jQuery('.internet_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var internet_id = jQuery(this).closest('tr').attr("idd");

                    new_position += internet_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_internet_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_internet_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_internet_data();

        function get_internet_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_internet_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.internet_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.internet_save').click(function (e) {

            var formdata = jQuery('.add_internet_form').serialize();

            jQuery.ajax({

                data: {action: 'new_internet_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#internet_add').modal('hide');

                    jQuery('.add_internet_form')[0].reset()

                    get_internet_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_internet_popup", "click", function () {

            var internet_id = this.id;



            jQuery.ajax({

                data: {action: 'single_internet_record', internet_id: internet_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#internet_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_internet", "click", function () {

            var internet_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_internet_record', internet_id: internet_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_internet_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.internet_edit_save').click(function (e) {

            var formdata = jQuery('.edit_internet_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_internet_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#internet_edit').modal('hide');

                    get_internet_data();



                }

            });



        });

        jQuery('#internet-number-records').change(function() {

            var tot_rec = jQuery("#internet-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_internet_rows(tot_rec);

            

        });

        function add_internet_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'internet',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_internet();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_internet() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=internet',

                async: false,

                success: function (data) {

                    jQuery('#internet-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }



        //other

        jQuery('.other_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var other_id = jQuery(this).closest('tr').attr("idd");

                    new_position += other_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_other_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_other_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_other_data();

        function get_other_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_other_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.other_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.other_save').click(function (e) {

            var formdata = jQuery('.add_other_form').serialize();

            jQuery.ajax({

                data: {action: 'new_other_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#other_add').modal('hide');

                    jQuery('.add_other_form')[0].reset()

                    get_other_data();



                }

            });



        });

        

            jQuery(document).delegate(".edit_other_popup", "click", function () {

            var other_id = this.id;



            jQuery.ajax({

                data: {action: 'single_other_record', other_id: other_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#other_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_other", "click", function () {

            var other_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_other_record', other_id: other_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_other_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.other_edit_save').click(function (e) {

            var formdata = jQuery('.edit_other_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_other_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#other_edit').modal('hide');

                    get_other_data();



                }

            });



        });

        jQuery('#other-number-records').change(function() {

            var tot_rec = jQuery("#other-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_other_rows(tot_rec);

            

        });

        function add_other_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'other',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_other();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_other() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=other',

                async: false,

                success: function (data) {

                    jQuery('#other-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }



        //theater

        function update_theater_pos(){

            var new_position = '';

                jQuery('.theater_table tbody').children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var theater_id = jQuery(this).closest('tr').attr("idd");

                    new_position += theater_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_theater_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_theater_data();

                    }

                });

        }

        jQuery('.theater_table tbody').sortable({



            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                    jQuery(this).closest('tr').attr("postion", index + 1);

                    var position = index + 1;

                    var theater_id = jQuery(this).closest('tr').attr("idd");

                    new_position += theater_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_theater_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_theater_data();

                    }

                });

            }

        });

        var client_id = control_vars.client_id;

        

        //get_theater_data();

        function get_theater_data() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_theater_record&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.theater_table tbody').html(data);

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }



        function get_theater_data_by_id() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_theater_record_by_id&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery('.theater_table tbody').prepend(data);

                    update_theater_pos();

                    var i = 1;

                    jQuery('.theater_table tbody tr td.sr_no').each(function() {

                        jQuery(this).html(i);

                        i++;

                    });

                    

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                }

            });

        }

        

        jQuery('.theater_save').click(function (e) {

            var formdata = jQuery('.add_theater_form').serialize();

            jQuery.ajax({

                data: {action: 'new_theater_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#theater_add').modal('hide');

                    jQuery('.add_theater_form')[0].reset();



                    get_theater_data_by_id();



                }

            });



        });

        

            jQuery(document).delegate(".edit_theater_popup", "click", function () {

            var theater_id = this.id;



            jQuery.ajax({

                data: {action: 'single_theater_record', theater_id: theater_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery("#theater_edit .modal-body").html(data);



                }

            });

        });

            jQuery(document).delegate(".delete_theater", "click", function () {

            var theater_id = this.id;

            if (confirm("Are you sure?")) {

                jQuery.ajax({

                    data: {action: 'delete_theater_record', theater_id: theater_id},

                    type: 'post',

                    url: control_vars.admin_url,

                    success: function (data) {



                        get_theater_data();

                    }

                });

            } else {

                return false;

            }



        });

        jQuery('.theater_edit_save').click(function (e) {

            var formdata = jQuery('.edit_theater_form').serialize();

            jQuery.ajax({

                data: {action: 'edit_theater_record', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    jQuery('#theater_edit').modal('hide');

                    get_theater_data();



                }

            });



        });

        jQuery('#theater-number-records').change(function() {

            var tot_rec = jQuery("#theater-number-records option:selected").val();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            add_theater_rows(tot_rec);

            

        });

        function add_theater_rows(total_records) {

            

            jQuery.ajax({

                data: {action: 'add_tv_rows', table_name:'theater',total_rows: total_records,client_id: client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                    get_total_rows_theater();

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saving');

                        jQuery('.autosave').addClass('saved');

                        jQuery(".autosave").text("Saved..!!"); 

                    }, 1500);

                            

                    setTimeout(function(){

                        jQuery('.autosave').removeClass('saved');

                        jQuery(".autosave").hide();

                     }, 5000);



                }

            });

        }

        function get_total_rows_theater() {

            

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_total_rows_record&client_id=' + client_id+'&table_name=theater',

                async: false,

                success: function (data) {

                    jQuery('#theater-number-records option').each(function() {

                        if(jQuery(this).val() == data) {

                            jQuery(this).attr('selected','selected');

                        }

                        else {

                            jQuery(this).removeAttr('selected');

                        }

                    });

                    

                }

            });

        }

        

        //tags input

        jQuery('#nationality').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#nationality").tagsinput('input').val('');

                },

                source: control_vars.nationality_suggestion

            },

            freeInput: true

        });

        

        //tags input

        jQuery('#state').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#state").tagsinput('input').val('');

                },

                source: control_vars.state_suggestion

            },

            freeInput: true

        });

        

        //tags input

        jQuery('#hair_colour').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#hair_colour").tagsinput('input').val('');

                },

                source: control_vars.hair_colour_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#hair_length').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#hair_length").tagsinput('input').val('');

                },

                source: control_vars.hair_length_suggestion

            },

            freeInput: true

        });

        

        //tags input

        jQuery('#residence').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#residence").tagsinput('input').val('');

                },

                source: control_vars.residence_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#eye_colour').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#eye_colour").tagsinput('input').val('');

                },

                source: control_vars.eye_colour_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#stature').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#stature").tagsinput('input').val('');

                },

                source: control_vars.stature_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#confection_size').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#confection_size").tagsinput('input').val('');

                },

                source: control_vars.confection_size_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#place_of_birth').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#place_of_birth").tagsinput('input').val('');

                },

                source: control_vars.place_of_birth_suggestion

            },

            freeInput: true

        });

        //tags input

        jQuery('#height').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#height").tagsinput('input').val('');

                }

            },

            freeInput: true

        });

        //tags input

        jQuery('#weight').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#weight").tagsinput('input').val('');

                }

            },

            freeInput: true

        });

        

        



        jQuery('#place_of_action').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#place_of_action").tagsinput('input').val('');

                },

                source: control_vars.place_of_action_suggestion

            },

            freeInput: true

        });

        

        jQuery('#ethnic_appearance').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#ethnic_appearance").tagsinput('input').val('');

                },

                source: control_vars.ethnic_appearance_suggestion

            },

            freeInput: true

        });

        

        jQuery('#language').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#language").tagsinput('input').val('');

                },

                source: control_vars.language_suggestion

            },

            freeInput: true

        });

        

        jQuery('#accents').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#accents").tagsinput('input').val('');

                },

                source: control_vars.accents_suggestion

            },

            freeInput: true

        });

        

        jQuery('#singing').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#singing").tagsinput('input').val('');

                },

                source: control_vars.singing_suggestion

            },

            freeInput: true

        });

        

        jQuery('#musical_instrument').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#musical_instrument").tagsinput('input').val('');

                },

                source: control_vars.musical_instrument_suggestion

            },

            freeInput: true

        });

        

        jQuery('#sports').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#sports").tagsinput('input').val('');

                },

                source: control_vars.sports_suggestion

            },

            freeInput: true

        });

        

        jQuery('#dancing').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#dancing").tagsinput('input').val('');

                },

                source: control_vars.dancing_suggestion

            },

            freeInput: true

        });

        

        jQuery('#license').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#license").tagsinput('input').val('');

                },

                source: control_vars.license_suggestion

            },

            freeInput: true

        });

        

        jQuery('#professional_union').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#professional_union").tagsinput('input').val('');

                },

                source: control_vars.professional_union_suggestion

            },

            freeInput: true

        });

        jQuery('#genre').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#genre").tagsinput('input').val('');

                },

                source: control_vars.genre_suggestion

            },

            freeInput: true

        });

        

        jQuery('#language_director').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#language_director").tagsinput('input').val('');

                },

                source: control_vars.language_suggestion

            },

            freeInput: true

        });

        jQuery('#voice_range').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#voice_range").tagsinput('input').val('');

                },

                source: control_vars.voice_range_suggestion

            },

            freeInput: true

        });

        jQuery('#agencies').tagsinput({

            typeahead: {

                afterSelect: () => {

                    jQuery("#agencies").tagsinput('input').val('');

                },

                source: control_vars.agencies_suggestion

            },

            freeInput: true

        });

        //photo

        // get_photo_list();

        function get_photo_list() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_photo_list&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                    jQuery('.user_photo_list .row').html(data);

                            jQuery('.longtext').ellipsis({

                            lines: 2

                            

                          });



                }

            });

        }

        jQuery('body').on('click', '.misha_upload_image_button', function (e) {

            e.preventDefault();



            var button = jQuery(this),

                    custom_uploader = wp.media({

                        title: 'Insert Image',

                        library: {

                            type: 'image'

                        },

                        button: {

                            text: 'Use this image'

                        },

                        multiple: true

                    }).on('select', function () {

                //single image

                // var attachment = custom_uploader.state().get('selection').first().toJSON();

                //alert(attachment.id);



                //For multi Image

                var attachments = custom_uploader.state().get('selection'),

                        i = 0;

                attachments.each(function (attachment) {

                    //alert(attachment['id']);

                    jQuery.ajax({

                        type: 'POST',

                        url: control_vars.admin_url,

                        data: 'action=add_new_photo&attachment_id=' + attachment['id'] + '&client_id=' + control_vars.client_id,

                        async: false,

                        success: function (data) {



                        }

                    });

                    i++;

                });

                get_photo_list();

            })

                    .open();

        });

        

        jQuery('.user_photo_list .row').sortable({

            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                jQuery(this).closest('.thumbnail').attr("postion", index + 1);

                var position = index + 1;

                console.log(jQuery(this));

                var photo_id = jQuery(this).find('.thumbnail').attr("idd");

                new_position += photo_id + '=' + position + '&';



                jQuery('.autosave').show();

                jQuery('.autosave').addClass('saving');

                jQuery('.autosave').text("Saving...");

                

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_photo_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_photo_list();

                        setTimeout(function(){

                            $('.autosave').removeClass('saving');

                            $('.autosave').addClass('saved');

                            $(".autosave").text("Saved..!!"); 

                        }, 1500);

                                

                        setTimeout(function(){

                            $('.autosave').removeClass('saved');

                            $(".autosave").hide();

                         }, 5000);



                    }

                });

            }

        });

        jQuery('body').on('change', '.copyright_notes', function (e) {

            var photo_id = jQuery(this).closest('.thumbnail').attr("idd");

            var notes=(this).value;

            jQuery.ajax({

                data: {action: 'edit_photo_notes', photo_id: photo_id,notes:notes},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   



                }

            });

        });

         jQuery('body').on('click', '.small_img', function (e) {

             var full_url=jQuery(this).attr("src_full");

             var caption=jQuery(this).attr("caption");

             jQuery("#zoom_modal #zoom_image").attr("src",full_url);

             jQuery(".zoom_modal_caption").html(caption);

         });

         jQuery('body').on('click', '.zoom_modal_close', function (e) {

             

             jQuery('#zoom_modal').modal('hide');

         });

         jQuery('body').on('change', '.chk_profile', function (e) {

             

            var photo_id = jQuery(this).attr("idd");

              if(jQuery(this).prop('checked') == true){

    var new_value = '1';

}else{

    var new_value = '0'; 

}

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

         

            jQuery.ajax({

                data: {action: 'chk_profile_update', photo_id: photo_id, new_value: new_value},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   get_photo_list();

                  

                    setTimeout(function(){

                        $('.autosave').removeClass('saving');

                        $('.autosave').addClass('saved');

                        $(".autosave").text("Saved..!!"); 

                    }, 1500);



                    setTimeout(function(){

                        $('.autosave').removeClass('saved');

                        $(".autosave").hide();

                     }, 5000);

                }

            });

         });

         jQuery('body').on('change', '.chk_overview', function (e) {

             if(jQuery(this).prop('checked') == true){

    var new_value = '1';

}else{

    var new_value = '0'; 

}

            var photo_id = jQuery(this).attr("idd");

           

            

            jQuery.ajax({

                data: {action: 'chk_overview_update', photo_id: photo_id, new_value: new_value},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   get_photo_list();



                }

            });

         });

          jQuery('body').on('change', '.chk_mobile', function (e) {

             if(jQuery(this).prop('checked') == true){

    var new_value = '1';

}else{

    var new_value = '0'; 

}

            var photo_id = jQuery(this).attr("idd");

           

            

            jQuery.ajax({

                data: {action: 'chk_mobile_update', photo_id: photo_id, new_value: new_value},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   get_photo_list();



                }

            });

         });

        jQuery('body').on('click', '.dlt-photo-btn', function (e) {

            var photo_id = jQuery(this).closest('.thumbnail').attr("idd");

            /*if (confirm("Are you sure?")) {*/

            jQuery.ajax({

                data: {action: 'delete_photo_record', photo_id: photo_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   get_photo_list();



                }

            });

        /*}else{

             return false;

        }*/

        });

        jQuery('body').on('change', '.chk_slider', function (e) {

             if(jQuery(this).prop('checked') == true){

                var new_value = '1';

            }else{

                var new_value = '0'; 

            }

                        var photo_id = jQuery(this).attr("idd");

                       

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");



            jQuery.ajax({

                data: {action: 'chk_slider_update', photo_id: photo_id, new_value: new_value},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



                   get_photo_list();



                   setTimeout(function(){

                        $('.autosave').removeClass('saving');

                        $('.autosave').addClass('saved');

                        $(".autosave").text("Saved..!!"); 

                    }, 1500);



                    setTimeout(function(){

                        $('.autosave').removeClass('saved');

                        $(".autosave").hide();

                     }, 5000);



                }

            });

         });

        

        //video

         //get_video_list();

        function get_video_list() {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                type: 'POST',

                url: control_vars.admin_url,

                data: 'action=get_video_list&client_id=' + client_id,

                async: false,

                success: function (data) {

                    jQuery("#wait").css("display", "none");

                     jQuery(".tab-content").css("opacity", "1");

                    jQuery('.video_list .row').html(data);

                  

                }

            });

        }

        jQuery('body').on('click', '.add_new_video_btn', function (e) {

            e.preventDefault();



            var button = jQuery(this),

                    custom_uploader = wp.media({

                        title: 'Insert Video',

                        library: {

                            type: 'video'

                        },

                        button: {

                            text: 'Use this Video'

                        },

                        multiple: true

                    }).on('select', function () {

                //single image

                // var attachment = custom_uploader.state().get('selection').first().toJSON();

                //alert(attachment.id);



                //For multi Image

                var attachments = custom_uploader.state().get('selection'),

                        i = 0;

                attachments.each(function (attachment) {

                    //alert(attachment['id']);

                    jQuery.ajax({

                        type: 'POST',

                        url: control_vars.admin_url,

                        data: 'action=add_new_video&attachment_id=' + attachment['id'] + '&client_id=' + control_vars.client_id,

                        async: false,

                        success: function (data) {



                        }

                    });

                    i++;

                });

                get_video_list();

            })

                    .open();

        });

        

        jQuery('.video_list .row').sortable({

            stop: function (event, ui) {

                var new_position = '';

                jQuery(this).children().each(function (index) {

                jQuery(this).closest('.thumbnail').attr("postion", index + 1);

                var position = index + 1;

                

                var video_id = jQuery(this).find('.thumbnail').attr("idd");

                new_position += video_id + '=' + position + '&';

                });



                jQuery.ajax({

                    type: 'POST',

                    url: control_vars.admin_url,

                    data: 'action=update_video_position&' + new_position,

                    async: false,

                    success: function (data) {

                        get_video_list();

                    }

                });

            }

        });

        //On other tab click pause video

        jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

var target = jQuery(e.target).attr("href")

if(target != "#video"){

   jwplayer('jwplayer_myvideo_test').pause();

}

});

        jQuery('body').on('click', '.dlt-video-btn', function (e) {

            var video_id = jQuery(this).closest('.thumbnail').attr("idd");

            var video_url=jQuery(this).next('.play-btn').attr("url");

            var current_url=jQuery("#current_url").attr("current_url");

           

            

            

            if (confirm("Are you sure?")) {

                if(video_url == current_url){

                

                  jwplayer('jwplayer_myvideo_test').load([{'file':''}]);

            }

            jQuery.ajax({

                data: {action: 'delete_video_record', video_id: video_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   get_video_list();



                }

            });

        }else{

             return false;

        }

        });

        

          jQuery('body').on('change', '#playlist_id', function (e) {
            var playlist_id  = jQuery(this).val();
            jQuery(".tab-content").css("opacity", "0.5");
            jQuery("#wait").css("display", "block");
            jQuery.ajax({
                data: {action: 'get_jwplayer_video',page:1,playlistid:playlist_id},
                type: 'post',
                url: control_vars.admin_url,
                success: function (data) {
                   jQuery("#get-player-modal .row").html(data);
                    
                    jQuery("#wait").css("display", "none");
                    jQuery(".tab-content").css("opacity", "1");
                }
            });
        });

         jQuery('body').on('click', '.jwplayer_video_add', function (e) {
             var video_url = jQuery(this).attr("mid");
            
            jQuery.ajax({
                data: 'action=add_new_jwplayer_video&attachment_id=' + video_url + '&client_id=' + control_vars.client_id,
                type: 'post',
                url: control_vars.admin_url,
                success: function (response) {
                    
                    if(response==10) {
                        jQuery(".video_list_jwplayer").append('<div class="messages">Video is added already.</div>');
                    }
                    else {
                        jQuery('.messages').hide();
                        get_video_list();
                    }

                }
            });
        });



        jQuery('body').on('click', '.play-btn', function (e) {

            var video_url = jQuery(this).attr("url");

            //jQuery(".preview_video").attr("src",video_url);

            //jQuery('.preview_video').trigger('play');

            jQuery("#current_url").attr("current_url",video_url);

            jwplayer('jwplayer_myvideo_test').load([{'file':video_url}]);

            jwplayer('jwplayer_myvideo_test').play();

        });

        

        jQuery('body').on('click', '.get_video_btn', function (e) {

            jQuery(".tab-content").css("opacity", "0.5");

            jQuery("#wait").css("display", "block");

            jQuery.ajax({

                data: {action: 'get_wistia_video',page:1},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   jQuery("#get-video-modal .row").html(data);

                    jQuery("#wait").css("display", "none");

                    jQuery(".tab-content").css("opacity", "1");

                }

            });

        });

        jQuery('body').on('click', '.api_page_nav', function (e) {

            

            var page = jQuery(this).attr("page");

            jQuery.ajax({

                data: {action: 'get_wistia_video',page:page},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   jQuery("#get-video-modal .row").html(data);



                }

            });

        });

        jQuery('body').on('click', '.wistia_video_add', function (e) {

             var video_url = jQuery(this).attr("url");

            

            jQuery.ajax({

                data: 'action=add_new_wistia_video&attachment_id=' + video_url + '&client_id=' + control_vars.client_id,

               

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    get_video_list();



                }

            });

        });







//Auto seelct current month and year for Add New Record popup      

var d = new Date();

var n = d.getMonth();

var n_new=n+1

var y = d.getFullYear();



jQuery('[name="from_year"] option[value="'+y+'"]').prop('selected', true);

jQuery('[name="from_month"] option[value="'+n_new+'"]').prop('selected', true);



//Hide_show_rows

  jQuery('body').on('click', '.at_festival_show_hide', function (e) {

     console.log('in at festival');

     var table_name=jQuery(this).attr("table_name");

     var short_table_name=jQuery(this).attr("short_table_name");

     var id=jQuery(this).attr("id");

     

     jQuery.ajax({

                data: 'action=show_hide_update&table_name=' + table_name + '&id=' + id,

               type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



                    var temp=jQuery(".tabs_class li.active").find('a').attr('href');

                    var temp2=temp.replace('#', '');



                    var temp3='get_'+short_table_name+'_data';

                    console.log(temp);

                    console.log(temp2);

                    console.log(temp3);

                    eval(temp3+"()");

                }

 });

 });

 jQuery('body').on('click', '.on_stage_show_hide', function (e) {

     console.log('in on stage');

     var table_name=jQuery(this).attr("table_name");

     var short_table_name=jQuery(this).attr("short_table_name");

     var id=jQuery(this).attr("id");

     

     jQuery.ajax({

                data: 'action=show_hide_update&table_name=' + table_name + '&id=' + id,

               type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



                    var temp=jQuery(".tabs_class li.active").find('a').attr('href');

                    var temp2=temp.replace('#', '');



                    var temp3='get_'+short_table_name+'_data';

                    console.log(temp);

                    console.log(temp2);

                    console.log(temp3);

                    eval(temp3+"()");

                }

 });

 });

jQuery('body').on('click', '.on_tv_show_hide', function (e) {

     console.log('in on stage');

     var table_name=jQuery(this).attr("table_name");

     var short_table_name=jQuery(this).attr("short_table_name");

     var id=jQuery(this).attr("id");

     

     jQuery.ajax({

                data: 'action=show_hide_update&table_name=' + table_name + '&id=' + id,

               type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



                    var temp=jQuery(".tabs_class li.active").find('a').attr('href');

                    var temp2=temp.replace('#', '');



                    var temp3='get_'+short_table_name+'_data';

                    console.log(temp);

                    console.log(temp2);

                    console.log(temp3);

                    eval(temp3+"()");

                }

 });

 });

 jQuery('body').on('click', '.show_hide', function (e) {

     console.log('in common');

     var table_name=jQuery(this).attr("table_name");

     var id=jQuery(this).attr("id");

     

     jQuery.ajax({

                data: 'action=show_hide_update&table_name=' + table_name + '&id=' + id,

               type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



                    var temp=jQuery(".tabs_class li.active").find('a').attr('href');

                    var temp2=temp.replace('#', '');



                    var temp3='get_'+temp2+'_data';

                    

                    eval(temp3+"()");

                }

 });

 });



 jQuery('.basic_info_form').on('change', 'input, select, textarea', function(){

     var formdata = jQuery('.basic_info_form').serialize();

        jQuery('.autosave').show();

        jQuery('.autosave').addClass('saving');

        jQuery('.saving').text("Saving...");

          jQuery.ajax({

                data: {action: 'save_basic_information', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                    

                        setTimeout(function(){

                            $('.autosave').removeClass('saving');

                            $('.autosave').addClass('saved');

                            $(".saved").text("Saved..!!"); 

                        }, 1500);

                                

                        setTimeout(function(){

                            $('.autosave').removeClass('saved');

                            $(".autosave").hide();

                                

                        }, 5000);

                }

            });

          

});

 $(".summernote-short-text").on("summernote.change", function (e) {   // callback as jquery custom event 

    if(jQuery('.summernote-short-text .note-editor').hasClass('codeview')) {

        var notes = jQuery('.summernote-short-text').summernote('code');

        jQuery('.summernote-short-text').text(notes);

    }

    var formdata = jQuery('.basic_info_form').serialize();

            jQuery('.autosave').show();

            jQuery('.autosave').addClass('saving');

            jQuery('.autosave').text("Saving...");

            jQuery.ajax({

                data: {action: 'save_basic_information', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   setTimeout(function(){

                    $('.autosave').removeClass('saving');

                    $('.autosave').addClass('saved');

                $(".autosave").text("Saved..!!"); 

            }, 1500);

                    

                    setTimeout(function(){

                        $('.autosave').removeClass('saved');

                        $(".autosave").hide();

                            

                    }, 5000);



                }

            });

});

 $(".summernote-special-skills").on("summernote.change", function (e) {   // callback as jquery custom event 

    if(jQuery('.summernote-special-skills .note-editor').hasClass('codeview')) {

        var notes = jQuery('.summernote-special-skills').summernote('code');

        jQuery('.summernote-special-skills').text(notes);

    }

    var formdata = jQuery('.basic_info_form').serialize();

    jQuery('.autosave').show();

    jQuery('.autosave').addClass('saving');

    jQuery('.autosave').text("Saving...");

            jQuery.ajax({

                data: {action: 'save_basic_information', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   setTimeout(function(){

                    $('.autosave').removeClass('saving');

                    $('.autosave').addClass('saved');

                $(".autosave").text("Saved..!!"); 

            }, 1500);

                

                    setTimeout(function(){

                      $('.autosave').removeClass('saved');

                        $(".autosave").hide();

                            

                    }, 5000);



                }

            });

});

 jQuery('.social_info_form').on('change', 'input', function(){

    var url = jQuery(this).val().trim();

        if(url==''){

             

        }

        else {

            if(validateURL(url)) {

                

            }else{

               alert('It Must be valid URL');

               jQuery(this).focus();

               return false;

                /*jQuery(".save_information").attr('disabled', 'disabled');*/

                

            }

        }

     var formdata = jQuery('.social_info_form').serialize();

       jQuery('.autosave').show();

       jQuery('.autosave').addClass('saving');

       jQuery('.autosave').text("Saving...");

            jQuery.ajax({

                data: {action: 'save_social_info_information', formdata: formdata},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {



             setTimeout(function(){

                $('.autosave').removeClass('saving');

                $('.autosave').addClass('saved');

                $(".autosave").text("Saved..!!"); 

            }, 1500);

                

                    setTimeout(function(){

                        $('.autosave').removeClass('saved');

                        $(".autosave").hide();

                            

                    }, 5000);

                   

                }

            });



});



jQuery('.video_iframe_save').on('click', function(){

    var iframe_code=jQuery('.video_iframe_edit').val();

            jQuery.ajax({

                data: {action: 'save_video_iframe', iframe_code: iframe_code,client_id:control_vars.client_id},

                type: 'post',

                url: control_vars.admin_url,

                success: function (data) {

                   jQuery(".video_iframe_preview").html(iframe_code);



                }

            });



});

 

 jQuery(".website").on('change', function() {



    });

   function validateURL(textval) {

  var urlregex = new RegExp( "^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");

  return urlregex.test(textval);

}

function activaTab(tab){

  jQuery('.nav-tabs a[href="#' + tab + '"]').tab('show');

}

function updateQueryStringParameter(uri, key, value) {

          var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");

          var separator = uri.indexOf('?') !== -1 ? "&" : "?";

          if (uri.match(re)) {

            return uri.replace(re, '$1' + key + "=" + value + '$2');

          }

          else {

            return uri + separator + key + "=" + value;

          }

        }  

    });

})(jQuery);

 