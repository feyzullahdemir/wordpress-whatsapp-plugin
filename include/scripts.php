<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<script>

jQuery("document").ready(function($) {



    $('.cndev_upload_image, .cndev_light_img_bg').click(function(e) {

        var uploadButtonParent = $(this).parent();

        e.preventDefault();
        var image = wp.media({
        title: 'Upload Image'}).open()
        .on('select', function(e){


            var images_length = image.state().get("selection").length;
            var images = image.state().get("selection").models;

            console.log(images);

            var image_url = images[0].toJSON().url;
            var image_alt = images[0].toJSON().alt;
            var image_caption = images[0].toJSON().caption;
            var image_title = images[0].toJSON().title;
            var image_id = images[0].toJSON().id;


            uploadButtonParent.find('.cndev_light_img_bg').attr('src', image_url);
            uploadButtonParent.find('.cndev_image_input').val(image_url);

        });

    });



    $('.cndevelopment-btn-chat .chat_button_type').on('change', function() {

        var imgURL = $(this).val();
        if( imgURL === 'custom') {
            $(".cndev_upload_image").trigger("click");
        } else {
            $(".cndevelopment-btn-chat img.cndev_light_img_bg").attr("src", imgURL);
            $(".cndevelopment-btn-chat .cndev_image_input").val(imgURL);
        }

    });

});

</script>
