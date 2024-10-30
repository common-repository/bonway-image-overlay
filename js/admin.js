// The "Upload" button
document.addEventListener("DOMContentLoaded", function() {
    jQuery('.js-bio-select-btn').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        wp.media.editor.send.attachment = function(props, attachment) {
            console.log(attachment.url);
            jQuery(".js-image-thumb").attr('src', attachment.url);
            jQuery(".js-bio-image").val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        };
        wp.media.editor.open(button);
        return false;
    });

    jQuery(".js-colour-selector").each(function(i, val){
        jQuery(this).on("change", function() {
            var newVal = (jQuery(this)[0].value);
            jQuery(this).next().text(newVal);
        })
    });

    jQuery(".js-bonwaybio-shortcode").on("click", function() {
        copyValue(jQuery(this));
    });

    jQuery(".js-bonwaybio-copy-btn").on("click", function() {
        var sibling = jQuery(this).next();
        copyValue(sibling);
    });
});

function copyValue(el) {
    jQuery(el).focus();
    jQuery(el).select();
    document.execCommand("copy");
}