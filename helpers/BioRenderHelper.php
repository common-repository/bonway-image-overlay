<?php
/**
 * Returns meta-information based on the provided identifier-value
 * @method bonway_imageoverlay_select_meta
 * @param  string     $value Identifier for the requested block
 */
function bonway_imageoverlay_select_meta($value) {
    $metaArgs = array(
        'post_type'     => 'bonway-imageoverlay',
        'meta_query'    => array(
            array(
                'key'   => 'bio-identifier',
                'value' => $value
           )
       )
   );

   return new WP_Query($metaArgs);
}

/**
 * Get an Image Overlay using its ID
 * @method bonway_imageoverlay_by_id
 * @param  int       $id ID of the block
 * @return string        Block content
 */
function bonway_imageoverlay_by_id($id){
    $post = get_post($id);

    return bonway_imageoverlay_get_io_content($post);
}

/**
 * Get an Image Overlay item using its Identifier
 * @method bonway_imageoverlay_by_identifier
 * @param  string       $identifier Identifier of the block
 * @return string        Block content
 */
function bonway_imageoverlay_by_identifier($identifier){
    //Get the post ID
    $post = get_post(bonway_imageoverlay_select_meta($identifier)->post->ID);

    return bonway_imageoverlay_get_io_content($post);
}

/**
 * Get the content of a requested Image Overlay
 * @method bonway_imageoverlay_get_io_content
 * @param  Object          $post Post to get data from
 * @return string                Content of the post
 */
function bonway_imageoverlay_get_io_content($post) {
    $meta = get_post_meta($post->ID);

    $identifier = $meta["bio-identifier"][0];
    $mainClass = $meta["bio-class"][0];
    $uniqueClass = "bio__container--$identifier";

    $imageSrc = wp_get_attachment_image_src($meta['bio-image'][0], array(1920, 1080));

    $css = bonway_imageoverlay_generate_style($meta, $mainClass, $uniqueClass);
    $block = $css;
    $block .= "<div class='bio-container $uniqueClass js-bio-container $mainClass' style='background-image: url($imageSrc[0])'>";

    if(get_post_type($post) == "bonway-imageoverlay" && strlen($identifier) > 0) {
        ob_start();
        $overlayTxt     = wpautop(apply_filters('the_content', $post->post_content));
        $textAlign = (!strcmp($meta['bio-text-alignment'][0], "centre") ? "center" : (!strcmp($meta['bio-text-alignment'][0], "left") ? "left" : "right"));
        $textVertAlign = (!strcmp($meta['bio-text-vert-alignment'][0], "centre") ? "center" : (!strcmp($meta['bio-text-vert-alignment'][0], "bottom") ? "bottom" : "top"));

        $overlay   = "<div class='bio-container__overlay " . bonway_imageoverlay_get_alignment_classes($meta) . " js-bio-overlay' style='" . $inlineStyle . "'>
                        <span class='bio-container__overlay-inner horalign-" . $textAlign . " vertalign-" . $textVertAlign . "'>" . $overlayTxt . "</span>
                      </div>";
        ob_end_clean();
    }

    $block .= $image . $overlay . "</div></div>";

    register_bonwaybio_global($meta);

    return $block;
}

function bonway_imageoverlay_get_alignment_classes($meta) {
    $horClass = "";
    $vertClass = "";

    $horVal = $meta['bio-horpos'][0];
    if(!strcmp($horVal, "left")) {
        $horClass = "hor-left";
    } elseif(!strcmp($horVal, "right")) {
        $horClass = "hor-right";
    } else {
        $horClass = "hor-centre";
    }

    $vertVal = $meta['bio-vertpos'][0];
    if(!strcmp($vertVal, "top")) {
        $vertClass = "vert-top";
    } elseif(!strcmp($vertVal, "bottom")) {
        $vertClass = "vert-bottom";
    } else {
        $vertClass = "vert-centre";
    }

    $alignClass = $horClass . " " . $vertClass;

    if(!strcmp($horClass, "hor-centre") && !strcmp($vertClass, "vert-centre")) {
        $alignClass .= " centered";
    }

    return $alignClass;
}

function bonway_imageoverlay_generate_style($meta, $mainClass, $uniqueClass) {
    //Colours
    $textColour = $meta['bio-text-colour'][0];
    $backgroundColour = bonway_imageoverlay_hex2rgba($meta['bio-background-colour'][0], $meta['bio-background-alpha'][0]);
    $linkColour = $meta['bio-link-colour'][0];

    //Sizes
    $sizes = "";
    $bRadius = $meta['bio-border-radius'][0]."px";
    if($meta['bio-min-width'][0] == 0 && $meta['bio-max-width'][0] == 0) {
        $sizes .= "max-width: 640px;";
        $sizes .= "width: 100%;";
    } 
    if ($meta['bio-min-width'][0] > 0) {
        $sizes .= "min-width: " . $meta['bio-min-width'][0] . "px;";
    }
    if ($meta['bio-max-width'][0] > 0) {
        $sizes .= "max-width: " . $meta['bio-max-width'][0] . "px;";
        $sizes .= "width: 100%;";
    }

    if($meta['bio-min-height'][0] == 0 && $meta['bio-max-height'][0] == 0) {
        $sizes .= "height: 100%;";
        $sizes .= "max-height: 320px;";
    } 
    if ($meta['bio-min-height'][0] > 0) {
        $sizes .= "min-height: " . $meta['bio-min-height'][0] . "px;";
    }
    if ($meta['bio-max-height'][0] > 0) {
        $sizes .= "height: 100%;";
        $sizes .= "max-height: " . $meta['bio-max-height'][0] . "px;";
    }

    $css = "<style> 
        .$uniqueClass .bio-container__overlay {
            background-color: $backgroundColour;
            border-radius: $bRadius;
            color: $textColour;
            $sizes;
        }

        .$uniqueClass .bio__overlay a,
        .$uniqueClass .bio__overlay a:hover,
        .$uniqueClass .bio__overlay a:active,
        .$uniqueClass .bio__overlay a:focus {
            color: $linkColour;
        }";
    $css .= "</style>";

    return $css;
}

/* Convert hexdec color string to rgb(a) string */
//Source: https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
function bonway_imageoverlay_hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
            return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}