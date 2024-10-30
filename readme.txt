=== Bonway Image Overlay ===
Contributors: bonwayservices
Tags: image, overlay, bonway
Requires at least: 4.9.7
Tested up to: 5.1
Requires PHP: 7.0
Stable tag: 1.3.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create image overlay entries that can then be added to pages/posts individually using shortcodes.

== Description ==

The Bonway Image Overlay plugin is a lightweight, versatile plugin designed to making it easy for everyday users to add images with an overlaid text.
All the options might seem daunting but it is all to make sure you, the user, are in control:

* The **General** block allows you to set the identifier used for the shortcode, and the overlay's class used for custom styling purposes
* The **Position** block allows you to position the overlay both horizontally as well as vertically
* The **Text alignment** block allows you to determine where the text in the overlay nudges towards
* The **Sizes** block lets you determine the border-radius (roundness), as well as the minimum and maximum width and height for each overlay
* The **Colours** block lets you determine the colours used, as well as the transparency of the overlay's background
* The **Background image** block speaks for itself: Here you can choose the image to be shown

Getting the overlay on your site is simple is pie:
Simply click on the shortcode, or the accompanied button, in the overview-table and the shortcode is copied to your clipboard. Then all you have to do is edit the page/post you want this overlay on, and paste it.

== Screenshots ==

1. Showcase of all the options the plugin has to offer
2. Collage of different image overlays
 
== Changelog ==

= 1.3.3 =
* Bugfix: Fixed a styling issue concerning the alignment and size of the overlay item

= 1.3.2 =
* Bugfix: Fixed an error where the styling would break if the 'minimum-width' had a value of 0

= 1.3.1 =
* Bugfix: Responsive min-width caused screen bloat (e.g.; screen is 320px wide, min-width is 500px, the overlay would be 180px too wide)

= 1.3.0 =
* Bugfix: Fixed the bug that was causing incorrect overlay alignment
* Bugfix: Fixed a bug where the toolbar for the text-edit mode would shove itself over the textfield
* Bugfix: When a minimum width/height was filled in, the width would still be 100%. This is no longer the case.
* Improvement: Placed all alignment options in the same container
* New Feature: Text can now be vertically aligned in an overlay

= 1.2.2 =
* Bugfix: Fixed a styling bug that hid the 'Add link' popup
* Bugifx: Fixed a styling issue where the overlay sometimes exceeded the bounds of the image

= 1.2.1 =
* Bugfix: Colour-selection did not show the correct initial colours; they were all black boxes
* Bugfix: When no image was chosen, but the overlay was saved, no image was shown. This has been corrected by showing a **no-image.png**
* Bugfix: The system registered the shortcode **bonwayio**, not **bonwaybio**. This has been corrected.
* Bugfix: Fixed click-to-copy; it now works as intended.
* Improvement: **no-image.png** updated to use the new Bonway logo.

= 1.2.0 =
* New Feature: Option for text-alignment
* Improvement: Styling of the admin area

= 1.1.0 =
* Improvement: Added default styling for the frontend
* Improvement: Added default styling for the admin-area
* New Feature: Added the options to determine the overlay's alignment
* New Feature: Added the options for different sizes, such as the roundness of the overlay's corners, and min/max width.
* New Feature: Added the options for different colour-sets

= 1.0.0 =
* Basic module with no custom options besides an identifier and class

== Upgrade Notice ==

= 1.3.0 =
An update for the Bonway Image Overlay Plugin is ready: Please update the plugin, as it fixes several bugs, and introduces a new feature.
