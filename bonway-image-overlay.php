<?php

/*
Plugin Name: Bonway Image Overlay
Description: Create simple images with an overlay, which can then be added to pages through shortcodes.
Version: 1.3.3
Author: Bonway Services
Author URI: https://bonway-services.nl
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

include 'helpers/BioCustomDataHelper.php';
include 'helpers/BioRenderHelper.php';
include 'helpers/BioMetaHelper.php';

/*
#==============================================================================#
[Basic hooks]
#==============================================================================#
 */
/**
 * Activation Hook for the module
 * @method bonway_imageoverlay_activation
 */
function bonway_imageoverlay_activation() {

}
register_activation_hook(__FILE__, 'bonway_imageoverlay_activation');

/**
 * Deactivation Hook for the module
 * @method bonway_imageoverlay_deactivation
 */
function bonway_imageoverlay_deactivation() {

}
register_deactivation_hook(__FILE__, 'bonway_imageoverlay_deactivation');

/**
 * Uninstall Hook for the module
 * @method bonway_imageoverlay_uninstall
 */
function bonway_imageoverlay_uninstall() {
    bonway_imageoverlay_deactivation();
}
register_uninstall_hook(__FILE__, 'bonway_imageoverlay_uninstall');

/*
#==============================================================================#
[Styling/Scripts of the plugin]
#==============================================================================#
*/

/**
 * Enqueues all css/js used by this plugin
 * @method bonwaybio_register_css_js
 */
add_action('admin_enqueue_scripts', 'bonwaybio_register_css_js');
function bonwaybio_register_css_js($hook)
{
    $current_screen = get_current_screen();
    $screenId = $current_screen->id;

    if ($screenId === 'bonway-imageoverlay' || $screenId === 'edit-bonway-imageoverlay') {
        wp_enqueue_style('bonwaybio_admin_style', plugins_url('style/admin.css',__FILE__ ));
        wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), array('jquery'));
    }
}

add_action('wp_enqueue_scripts', 'register_bonwaybio_global');
function register_bonwaybio_global() {
    wp_enqueue_style('bonwaybio_style', plugins_url('style/style.css', __FILE__));
}