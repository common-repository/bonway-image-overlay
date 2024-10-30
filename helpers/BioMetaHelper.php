<?php
/**
  * Adds a meta box to the post editing screen
  * @method bonway_imageoverlay_meta_box
  */
  function bonway_imageoverlay_meta_box() {
    add_meta_box(
        'bonway_imageoverlay_meta',
        'Additional content',
        'bonway_imageoverlay_meta_fields',
        'bonway-imageoverlay'
 );
}
add_action('add_meta_boxes', 'bonway_imageoverlay_meta_box');

/**
* Outputs the content of the meta box
* @method bonway_imageoverlay_meta_fields
* @param  Object                $post The post being used
*/
function bonway_imageoverlay_meta_fields($post) {
    wp_nonce_field(basename(__FILE__), 'bonway_imageoverlay_nonce');
    $bonway_imageoverlay_meta = get_post_meta($post->ID);

    ?>
    <div class="bio-section bio-section__general">
        <h2>General</h2>
        <div class="bio-section__inner">
            <div class="bio-section__container">
                <span>Overlay Identifier <span class="required">*</span><span>
                <input type="text" name="bio-identifier" id="bio-identifier" required value="<?php if (isset($bonway_imageoverlay_meta['bio-identifier'])) echo $bonway_imageoverlay_meta['bio-identifier'][0]; ?>" />
            </div>
            <div class="bio-section__container">
                <span>Overlay Class</span>
                <input type="text" name="bio-class" id="bio-class" value="<?php if (isset($bonway_imageoverlay_meta['bio-class'])) echo $bonway_imageoverlay_meta['bio-class'][0]; ?>" />
            </div>
        </div>
    </div>
    <div class="bio-section bio-section__position middle-box">
        <h2>Alignment</h2>
        <h4>Overlay</h4>
        <div class="bio-section__inner">
            <?php 
                $horpositions = array(
                    "0" => array("label" => "Left", "value" => "left"),
                    "1" => array("label" => "Centre", "value" => "centre"),
                    "2" => array("label" => "Right", "value" => "right")
                );
                $horpos = (isset($bonway_imageoverlay_meta['bio-horpos'])) ? $bonway_imageoverlay_meta['bio-horpos'][0] : "centre";

                $vertpositions = array(
                    "0" => array("label" => "Top", "value" => "top"),
                    "1" => array("label" => "Centre", "value" => "centre"),
                    "2" => array("label" => "Bottom", "value" => "bottom")
                );
                $vertpos = (isset($bonway_imageoverlay_meta['bio-vertpos'])) ? $bonway_imageoverlay_meta['bio-vertpos'][0] : "centre";
            ?>

            <span>Horizontal position</span>
            <select class="bio-horpos" name="bio-horpos" id="bio-horpos">
                <?php 
                    foreach($horpositions as $key => $val) {
                        $selected = ($horpos == $val['value']) ? "selected" : "";
                        echo "<option value='" . $val['value'] . "'" . $selected .">" . $val['label'] . "</option>";
                    }
                ?>
            </select>
            <span>Vertical position</span>
            <select class="bio-vertpos" name="bio-vertpos" id="bio-vertpos">
                <?php 
                    foreach($vertpositions as $key => $val) {
                        $selected = ($vertpos == $val['value']) ? "selected" : "";
                        echo "<option value='" . $val['value'] . "'" . $selected .">" . $val['label'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <h4>Text</h4>
        <div class="bio-section__inner">
            <?php 
                $alignments = array(
                    "0" => array("label" => "Left", "value" => "left"),
                    "1" => array("label" => "Centre", "value" => "centre"),
                    "2" => array("label" => "Right", "value" => "right")
                );
                $textAlignment = (isset($bonway_imageoverlay_meta['bio-text-alignment'])) ? $bonway_imageoverlay_meta['bio-text-alignment'][0] : "centre";

                $vertAlign = array(
                        "0" => array("label" => "Top", "value" => "top"),
                        "1" => array("label" => "Centre", "value" => "centre"),
                        "2" => array("label" => "Bottom", "value" => "bottom")
                    );
                    $vertTextAlign = (isset($bonway_imageoverlay_meta['bio-text-vert-alignment'])) ? $bonway_imageoverlay_meta['bio-text-vert-alignment'][0] : "centre";
            ?>
            <span>Horizontal alignment</span>
            <select class="bio-text-alignment" name="bio-text-alignment" id="bio-text-alignment">
                <?php 
                    foreach($alignments as $key => $val) {
                        $selected = ($textAlignment == $val['value']) ? "selected" : "";
                        echo "<option value='" . $val['value'] . "'" . $selected .">" . $val['label'] . "</option>";
                    }
                ?>
            </select>
            <span>Vertical alignment</span>
            <select class="bio-text-vert-alignment" name="bio-text-vert-alignment" id="bio-text-vert-alignment">
                <?php 
                    foreach($vertAlign as $key => $val) {
                        $selected = ($vertTextAlign == $val['value']) ? "selected" : "";
                        echo "<option value='" . $val['value'] . "'" . $selected .">" . $val['label'] . "</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="bio-section bio-section__sizes">
        <h2>Sizes</h2>
        <div class="bio-section__inner">
            <div class="bio-section__container">
                <?php $radius = (isset($bonway_imageoverlay_meta['bio-border-radius'])) ? $bonway_imageoverlay_meta['bio-border-radius'][0] : "0"; ?>
                <span>Border radius</span>
                <input type="number" name="bio-border-radius" id="bio-border-radius" value="<?= $radius ?>">
                <label for="bio-border-radius">px</label>
            </div>
            <div class="bio-section__container">
                <?php $minWidth = (isset($bonway_imageoverlay_meta['bio-min-width'])) ? $bonway_imageoverlay_meta['bio-min-width'][0] : "0"; ?>
                <span>Minimum width</span>
                <input type="number" name="bio-min-width" id="bio-min-width" value="<?= $minWidth ?>">
                <label for="bio-min-width">px</label>
            </div>
            <div class="bio-section__container">
                <?php $maxWidth = (isset($bonway_imageoverlay_meta['bio-max-width'])) ? $bonway_imageoverlay_meta['bio-max-width'][0] : "0"; ?>
                <span>Maximum width</span>
                <input type="number" name="bio-max-width" id="bio-max-width" value="<?= $maxWidth ?>">
                <label for="bio-max-width">px</label>
            </div>
            <div class="bio-section__container">
                <?php $minHeight = (isset($bonway_imageoverlay_meta['bio-min-height'])) ? $bonway_imageoverlay_meta['bio-min-height'][0] : "0"; ?>
                <span>Minimum height</span>
                <input type="number" name="bio-min-height" id="bio-min-height" value="<?= $minHeight ?>">
                <label for="bio-min-height">px</label>
            </div>
            <div class="bio-section__container">
                <?php $maxHeight = (isset($bonway_imageoverlay_meta['bio-max-height'])) ? $bonway_imageoverlay_meta['bio-max-height'][0] : "0"; ?>
                <span>Maximum height</span>
                <input type="number" name="bio-max-height" id="bio-max-height" value="<?= $maxHeight ?>">
                <label for="bio-max-height">px</label>
            </div>
        </div>
    </div>
    <div class="bio-section bio-section__colours">
        <h2>Colours</h2>
        <div class="bio-section__inner">
            <?php 
                $textColour = (isset($bonway_imageoverlay_meta['bio-text-colour'])) ? $bonway_imageoverlay_meta['bio-text-colour'][0] : "#000000";
                $backgroundColour = (isset($bonway_imageoverlay_meta['bio-background-colour'])) ? $bonway_imageoverlay_meta['bio-background-colour'][0] : "#ffffff";
                $backgroundAlpha = (isset($bonway_imageoverlay_meta['bio-background-alpha'])) ? $bonway_imageoverlay_meta['bio-background-alpha'][0] : "0.8";
                $linkColour = (isset($bonway_imageoverlay_meta['bio-link-colour'])) ? $bonway_imageoverlay_meta['bio-link-colour'][0] : "#0000ff";
            ?>

            <span>Text colour</span>
            <div class="colour-wrapper bio-section__container">
                <input type="color" id="bio-text-colour" class="js-colour-selector" name="bio-text-colour" value=<?= $textColour ?>>
                <label for="bio-text-colour"><?= $textColour ?></label>
            </div>
            <span>Background colour</span>
            <div class="colour-wrapper bio-section__container">
                <input type="color" id="bio-background-colour" class="js-colour-selector" name="bio-background-colour" value=<?= $backgroundColour ?>>
                <label for="bio-background-colour"><?= $backgroundColour ?></label>
                <span>Alpha</span>
                <input type="number" min=0 max=1 step="0.1" id="bio-background-alpha" name="bio-background-alpha" value=<?= $backgroundAlpha ?>>
            </div>
            <span>Link colour</span>
            <div class="colour-wrapper bio-section__container">
                <input type="color" id="bio-link-colour" class="js-colour-selector" name="bio-link-colour" value=<?= $linkColour ?>>
                <label for="bio-link-colour"><?= $linkColour ?></label>
            </div>
        </div>
    </div>
    <div class="bio-section bio-section__image middle-box">
        <h2>Background image</h2>
        <div class="bio-section__inner">
            <div class="bio-section__container">
                <?php bonway_imageoverlay_image("imageoverlay_image", $postID = $post->ID); ?>
            </div>
        </div>
    </div>
    <?php
}

/**
* Saves the custom meta input
* @method bonway_imageoverlay_meta_save
* @param  int              $post_id ID of the saved post
*/
function bonway_imageoverlay_meta_save($post_id) {
   // Checks save status
   $is_autosave = wp_is_post_autosave($post_id);
   $is_revision = wp_is_post_revision($post_id);
   $is_valid_nonce = (isset($_POST['bonway_imageoverlay_nonce']) && wp_verify_nonce($_POST['bonway_imageoverlay_nonce'], basename(__FILE__))) ? 'true' : 'false';

   // Exits script depending on save status
   if ($is_autosave || $is_revision || !$is_valid_nonce) {
       return;
   }

   // Checks for input and sanitizes/saves if needed
   if(isset($_POST['bio-identifier'])) {
       $query =  bonway_imageoverlay_select_meta($_POST['bio-identifier']);
       $identifierId = $query->post->ID;

       /*
           Check if the identifier is unique, return an error if it's not.
           Post data is still saved, because it's annoying if you lost a
           bunch of work simply because you did not enter a unique identifier.
       */
       if($query->have_posts() == false || $identifierId == $post_id) {
           update_post_meta($post_id, 'bio-identifier', sanitize_text_field($_POST['bio-identifier']));
       } else {
           $bonway_imageoverlay_error = new WP_Error(
               "noUniqueSbeIdentifierError",
               "Image Overlay data has been saved, but the provided Identifier is not unique. Please use another."
          );

           if ($bonway_imageoverlay_error) {
               $_SESSION['bonway_imageoverlay-error_identifier'] = $bonway_imageoverlay_error->get_error_message();
           }

           return;
       }

       $fields = array(
        "bio-class", 
        "bio-image", 
        "bio-horpos",
        "bio-vertpos",
        "bio-text-colour",
        "bio-background-colour",
        "bio-background-alpha",
        "bio-link-colour",
        "bio-border-radius",
        "bio-min-width",
        "bio-min-height",
        "bio-max-width",
        "bio-max-height",
        "bio-text-alignment",
        "bio-text-vert-alignment"
    );

    foreach($fields as $field) {
        if(isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
   }
}
add_action('save_post', 'bonway_imageoverlay_meta_save');

/**
* Returns an error based on session-data after a save
* @method bonway_imageoverlay_custom_errors
*/
function bonway_imageoverlay_custom_errors() {
   if(isset($_SESSION) && array_key_exists('bonway_imageoverlay-error_identifier', $_SESSION)) {?>
       <div class="error notice notice-error is-dismissible">
           <p><?= $_SESSION['bonway_imageoverlay-error_identifier']; ?></p>
       </div><?php

       unset($_SESSION['bonway_imageoverlay-error_identifier']);
   }

   if(isset($_SESSION) && array_key_exists('bonway_imageoverlay-error_file', $_SESSION)) {?>
       <div class="error notice notice-error is-dismissible">
           <p><?= $_SESSION['bonway_imageoverlay-error_file']; ?></p>
       </div><?php

       unset($_SESSION['bonway_imageoverlay-error_file']);
   }
}
add_action('admin_notices', 'bonway_imageoverlay_custom_errors');

function bonway_imageoverlay_image($name, $postID) {
   // Set variables
   $options = get_option('bonway_imageoverlay_image');
   $default_image = plugins_url('../images/no-image.png', __FILE__);
   $meta = get_post_meta($postID);
   $src = $default_image;
   $value = '';

   if(isset($meta['bio-image']) && strlen($meta['bio-image'][0]) > 0) {
       $image_attributes = wp_get_attachment_image_src($meta['bio-image'][0], array(1920, 1080));
       $src = $image_attributes[0];
       $value = $meta['bio-image'][0];
   }

   $text = __('Select image', 'RSSFI_TEXT');

   // Print HTML field
   echo '
       <div class="bio-image__upload">
           <div class="bio-image__container">
               <img data-src="' . $default_image . '" src="' . $src . '" class="js-image-thumb" />
           </div>
           <div class="bio-image__buttons">
               <input type="hidden" name="bio-image" id="bio-image" class="js-bio-image" value="' . $value . '" />
               <button type="submit" class="bio-image__select-btn js-bio-select-btn button">' . $text . '</button>
           </div>
       </div>
   ';
}