jQuery(document).ready(function($) {
    var addImagesBtn = $('#artiste_tableaux_add_images');
    var imageContainer = $('#artiste_tableaux_image_container');
    var hiddenField = $('#artiste_tableaux_tableau_additional_images');
    var previewImage = $('#previewImage');
    var file_frame;

    addImagesBtn.on('click', function(event) {
        event.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: artisteTableauxData.strings.selectImages,
            button: {
                text: artisteTableauxData.strings.useImages,
            },
            multiple: true
        });

        file_frame.on('select', function() {
            var attachments = file_frame.state().get('selection').map(function(attachment) {
                attachment.toJSON();
                return attachment;
            });

            var attachment_ids = hiddenField.val() ? hiddenField.val().split(',') : [];
            var html = imageContainer.html();

            attachments.forEach(function(attachment) {
                attachment_ids.push(attachment.id);
                html += '<div class="image-wrapper" data-id="' + attachment.id + '" style="display: inline-block; position: relative;">';
                html += '<img src="' + attachment.attributes.sizes.thumbnail.url + '" data-full="' + attachment.attributes.sizes.full.url + '" />';
                html += '<input type="text" name="artiste_tableaux_image_caption[]" placeholder="Légende" class="caption-input" />';
                html += '<button type="button" class="remove-image button">Supprimer</button>';
                html += '</div>';
            });

            hiddenField.val(attachment_ids.join(','));
            imageContainer.html(html);
            addImageHoverListeners();
            addRemoveButtonListeners();
        });

        file_frame.open();
    });

    function addImageHoverListeners() {
        imageContainer.find('img').on('mouseover', function(event) {
            previewImage.show().html('<img src="' + $(this).data('full') + '" style="max-width: 300px;"/>');
            updatePreviewPosition(event);
        }).on('mousemove', function(event) {
            updatePreviewPosition(event);
        }).on('mouseout', function() {
            previewImage.hide();
        });
    }

    function updatePreviewPosition(event) {
        previewImage.css({
            left: (event.clientX + 10) + 'px',
            top: (event.clientY - 150) + 'px'
        });
    }

    function addRemoveButtonListeners() {
        imageContainer.on('click', '.remove-image', function() {
            var wrapper = $(this).closest('.image-wrapper');
            wrapper.remove();
            updateHiddenField();
        });
    }

    function updateHiddenField() {
        var ids = imageContainer.find('.image-wrapper').map(function() {
            return $(this).data('id');
        }).get();
        hiddenField.val(ids.join(','));
    }

    addImageHoverListeners();
    addRemoveButtonListeners();
});