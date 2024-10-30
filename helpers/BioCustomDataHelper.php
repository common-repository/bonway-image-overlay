<?php
/*
#==============================================================================#
[Post Types, Shortcodes, and Custom Columns]
#==============================================================================#
 */

/**
 * Registers a new posttype for the Bonway bio
 * @method bonway_imageoverlay_post_type
 */
function bonway_imageoverlay_post_type()
{
    $labels = array(
        'name'          => __('Image Overlays'),
        'singular_name' => __('Image Overlay'),
 );

    $rewrite = array(
        'slug'  => 'bonway-imageoverlay'
 );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'menu_icon'             => plugins_url('../images/bonway_logo_mini.png', __FILE__),
        'rewrite'               => $rewrite,
 );

    register_post_type('bonway-imageoverlay', $args);
}
add_action('init', 'bonway_imageoverlay_post_type');

/**
 * Registers the shortcode for the image overlays
 * @method bonway_imageoverlay
 * @param  array               $atts    An array of attributes used for the shortcode
 * @param  string              $content Default NULL
 * @return Object                       Content of the selected block
 */
function bonway_imageoverlay($atts, $content=NULL){
    $atts = shortcode_atts(array(
        'id' => '',
        'identifier' => ''
  ), $atts, 'bonway_imageoverlay');
    $id = $atts['id'];
    $identifier = $atts['identifier'];

    return ("" !== $id) ? bonway_imageoverlay_by_id($id) : bonway_imageoverlay_by_identifier($identifier);
}
add_shortcode('bonwaybio','bonway_imageoverlay');

/**
 * Initialize the custom columns for the module
 * @method bonway_imageoverlay_custom_columns
 * @param  array                   $columns Default param
 */
function bonway_imageoverlay_custom_columns($columns) {
    $columns['bonway_imageoverlay_id'] = "ID";
    $columns['bonway_imageoverlay_identifier'] = "Identifier";
    $columns['bonway_imageoverlay_identifier_shortcode'] = "Identifier Shortcode";

    return $columns;
}
add_filter('manage_bonway-imageoverlay_posts_columns', 'bonway_imageoverlay_custom_columns');

/**
 * Insert data into custom columns
 * @method bonway_imageoverlay_custom_column_data
 * @param  array                  $column  Array of custom columns
 * @param  integer                $post_id ID of the post
 */
function bonway_imageoverlay_custom_column_data($column, $post_id) {
    switch ($column) {
        case "bonway_imageoverlay_id" :
            echo "ID";
            break;

        case 'bonway_imageoverlay_identifier' :
            $identifier = get_post_meta(get_the_ID(), 'bio-identifier', true);
            echo (!empty($identifier)) ? $identifier : 'No identifier set';
            break;
        case 'bonway_imageoverlay_identifier_shortcode' :
            $identifier = get_post_meta(get_the_ID(), 'bio-identifier', true);
            $printId = (!empty($identifier)) ? "[bonwaybio identifier=&quot;" . $identifier . "&quot;]" : "No identifier set";
            $showCopy = (!empty($identifier)) ? "can-copy" : "";
            echo '<div class="' . $showCopy . ' bonwaybio-inputcontainer"><div class="copy-btn js-bonwaybio-copy-btn"></div><input class="js-bonwaybio-shortcode readonly" value="' . $printId . '" readonly></input></div>';
            break;
    }
}
add_action('manage_bonway-imageoverlay_posts_custom_column' , 'bonway_imageoverlay_custom_column_data', 10, 2);