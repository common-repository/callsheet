(function ($) {
    'use strict';

    jQuery(document).ready(function () { 
        var body = jQuery('body');
        
        body.on("click", '.sync_api', function (e) {
            e.preventDefault();
            var synced = parseInt(jQuery(this).attr("data-sync"));
            var user_id = jQuery(this).attr("data-id");
            if (synced == 0) {
                $('#showreel-input-checkbox').prop('checked', false);
                $('#update-client-profile').attr('data-id', user_id);
                $('#prompt-api-sync').modal('show');
            } else if (synced == 1) {
                setTimeout(function () {
                    sync_castupload_data(user_id);
                    jQuery('span[data-id="' + user_id + '"]').attr("data-sync", 0);
                }, 10);
            }
            
        });

        body.on("click", '#prompt-api-sync #update-client-profile', function (e) {
            e.preventDefault();
            var update_showreel = $('#showreel-input-checkbox').is(':checked'); 
            var user_id = jQuery(this).attr("data-id");
            $('#prompt-api-sync').modal('hide');
            sync_castupload_data(user_id, update_showreel);
        });

        body.on("click", '#update-castupload-id', function (e) {
            e.preventDefault();
            var user_id = parseInt(jQuery(this).attr("data-id"));
            var castupload_id = parseInt(jQuery('input[name=castauploadId]').val());
            var update_showreel = $('#showreel-input-checkbox-id').is(':checked'); 
            if (!isNaN(user_id) && parseInt(Number(user_id)) == user_id && !isNaN(parseInt(user_id, 10)) && 
                !isNaN(castupload_id) && parseInt(Number(castupload_id)) == castupload_id && !isNaN(parseInt(castupload_id, 10))) {
                castupload_save_id(user_id, castupload_id, update_showreel);
            }
            $('#inputCustomId').modal('hide');
        });

        function save_multiple_images(actor_id, images) {
            jQuery('#image-loading').modal('show');
            jQuery('#image-loading span#total-images').text(images.length);

            var promises = [];
            for (var i = 0; i < images.length; i++) {
                jQuery('#image-loading span#current-image').text(i+1);
                var url = images[i].url,
                    main_img = images[i].main_picture,
                    copyright = images[i].copyright,
                    request = jQuery.ajax({
                        url: ajaxurl,
                        data: {
                            action: "callsheet_save_image",
                            img_url: url,
                            actor_id: actor_id,
                            main_picture: main_img,
                            copyright: copyright,
                        },
                        type: 'POST',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            var result = data.data;
                            if(main_img) {
                                var current_span = jQuery('span[data-id="' + actor_id + '"]');
                                current_span.find('i').removeClass('fa-spin');
                                var img = jQuery('<img class="td_list_image">');
                                var first_td = current_span.parent('td').parent('tr').children(":first");
                                img.attr('src', result.img);
                                if (jQuery(first_td).find('i.td_list_image').length == 1) {
                                    jQuery(first_td).find('i.td_list_image').replaceWith(img);
                                } else if (jQuery(first_td).find('img.td_list_image').length == 1) {
                                    jQuery(first_td).find('img.td_list_image').replaceWith(img);
                                }
                            }
                        },
                        error: function (errorThrown) {
                            console.log(errorThrown);
                        },
                        async: false
                    });
                
                promises.push(request);
            }

            jQuery.when.apply(null, promises).done(function () {
                jQuery('#image-loading').modal('hide');
            })
        }
        
        function sync_castupload_data(user_id, update_showreel = false) {
            jQuery.ajax({
                url: ajaxurl,
                data: {
                    action: "callsheet_castupload_api_update",
                    user_id: user_id,
                    update_showreel: update_showreel
                },
                type: 'POST',
                beforeSend: function () {
                    jQuery('span[data-id="' + user_id + '"]').find('i').addClass('fa-spin');
                },
                success: function (data) {
                    var current_span = jQuery('span[data-id="' + user_id + '"]');
                    current_span.find('i').removeClass('fa-spin');

                    if (data.success == false) {
                        if (typeof data.data.not_found !== "undefined" && data.data.not_found == true) {
                            show_castupload_id_form(user_id);
                        }
                        return false;
                    }

                    var result = data.data;
                    if (result.sync != false) {
                        current_span.find('i').addClass('active');
                        var fname = current_span.parent('td').parent('tr').children('td').eq(1),
                            lname = current_span.parent('td').parent('tr').children('td').eq(2),
                            type = current_span.parent('td').parent('tr').children('td').eq(3);
                        if (result.fname.length > 0) { fname.text(result.fname); }
                        if (result.lname.length > 0) { lname.text(result.lname); }
                        if (result.gender.length > 0) { type.text(result.gender); }
                        if (result.img.length > 0) {
                            save_multiple_images(user_id, result.img);
                        }
                        jQuery('span[data-id="' + user_id + '"]').attr("data-sync", 1);
                    } else {
                        current_span.find('i').removeClass('active');
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }

        function show_castupload_id_form(user_id) {
            jQuery('#inputCastauploadID').val('');
            jQuery('button#update-castupload-id').attr("data-id", user_id);
            $('#showreel-input-checkbox-id').prop('checked', false);
            jQuery('#inputCustomId').modal('show');
            jQuery('#update-castupload-id').click(function() {
                if(jQuery('#inputCastauploadID').val() == ""){
                    jQuery('#show_error').show();
                    return false;
                }
            });
        }

        function castupload_save_id(user_id, castupload_id, update_showreel = false) {
            jQuery.ajax({
                url: ajaxurl,
                data: {
                    action: "callsheet_castupload_id_update",
                    user_id: user_id,
                    castupload_id: castupload_id,
                    update_showreel: update_showreel
                },
                type: 'POST',
                beforeSend: function () {
                    jQuery('span[data-id="' + user_id + '"]').find('i').addClass('fa-spin');
                },
                success: function (data) {
                    var current_span = jQuery('span[data-id="' + user_id + '"]');
                    current_span.find('i').removeClass('fa-spin');

                    if (data.success == false) {
                        return false;
                    }

                    var result = data.data;
                    if (result.sync != false) {
                        current_span.find('i').addClass('active');
                        var first_td = current_span.parent('td').parent('tr').children(":first"),
                        fname = current_span.parent('td').parent('tr').children('td').eq(1),
                        lname = current_span.parent('td').parent('tr').children('td').eq(2),
                        type = current_span.parent('td').parent('tr').children('td').eq(3);
                        if (result.fname.length > 0) { fname.text(result.fname); }
                        if (result.lname.length > 0) { lname.text(result.lname); }
                        if (result.gender.length > 0) { type.text(result.gender); }
                        if (result.img.length > 0) {
                            save_multiple_images(user_id, result.img);
                        }
                        jQuery('span[data-id="' + user_id + '"]').attr("data-sync", 1);
                    } else {
                        current_span.find('i').removeClass('active');
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }

    });
})(jQuery);
