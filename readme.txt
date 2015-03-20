=== Photocart Link ===
Contributors: Chad McCoskey
Tags: photocart, picturespro
Requires at least: 3.0.1
Tested up to: 4.1.1
Stable tag: 1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode to connect to a PicturesPro Photocart Photography Shopping Cart to display images from the cart

== Description ==
Provides a shortcode to connect to a PicturesPro Photocart Photography Shopping Cart to display images from the cart

Features
Place a shortcode with the required photocart image id and optional variables to display a Photocart image on a post or page.
Customizable button on image links.

http://www.kaymeephotography.com
http://kaymeephotography.com/wordpress/downloads/photocart-link/


== Installation ==
1. Upload all photocart_link files to the /wp-content/plugins/photocart-link/ directory.
2. Activate the plugin through the Plugins menu in WordPress.

Access the PhotoCart Link settings page (Settings-PhotoCart Link)
Enter the directory location for the Photocart photos using a full URL (http://www.mysite.com/photocart/photos/)
Enter the Photocart database information with hostname, username, and password.

== Frequently Asked Questions ==
= How do I use this plugin = 
To display a Photocart image in a post or page enter the shortcode [photocart_link]
The following variables are allowed:
imageID= (required)
	--This variable is required.  Obtain the image id for the photocart image
	by clicking on the image within Photocart and looking at the address URL.
	The image ID is listed as "image=32279."  The number is the ID (32279).

imageType= (optional)
	--Photocart stores typically 2 sizes for the images, full & thumbnail.
	Enter either "full" or "thumb" to display that size.
	Defaults to "full".

imageWidth= (optional)
	--Listing a width will set the width to that size overriding the image width.
	Defaults to the imageType width.

imageHeight= (optional)
	--Listing a height will set the height to that size overriding the image height.
	Defaults to the imageType height.

imageCaption= (optional)
	--Entering a caption will override an entered caption for the photo.
	Defaults to the caption entered for the photo in Photocart.

imageTitle= (optional)
	--Entering a title will override an entered title for the photo.
	Defaults to the title entered for the photo in Photocart.

imageAlign= (optional)
        --Entering an alignment will set the container alignment
        Valid values: left right center none
        Defaults to the left

contSize= (optional)
        --Entering an number will set the container size in relation to overall container size
        Enter as a percentage (50%)

noImage= (option)
	--Enter true/false to display the image from the store or not.
	Defaults to false (to display the image)

EXAMPLES
BASE: [photocart_link imageID="99999"]
	--Defaults to imageType="full", size of image in Photocart,
	caption and title of image in Photocart, no alignment, full size container

OPTIONS:
[photocart_link imageID="99999" imageType="thumb" imageWidth="300" imageHeight="300" imageAlign="left" imageCaption="Image Caption" imageTitle="Image Title" contSize="50%" noImage="false"]

Notes
The image display CSS can be edited by modifying the photocart_link.css.
Leaving either imageWidth or imageHeight while entering a number for the
other dimension will create a image proportional to the original.

== Screenshots ==
http://www.kaymeephotography.com

== Changelog ==
= 1.6 =
*Updated TEXT form opener*
*Please note the TEXT version doesn't work so well in Firefox or Chrome
= 1.5 =
*Bug fix for the TEXT form opener
= 1.4 =
*Added a quicktag button to the TEXT editor to make setting shortcode attributes easier
= 1.3 =
*Added a TINYMCE button to the WYSIWYG editor to make setting shortcode attributes easier
= 1.2 =
*Added a lightbox http://lokeshdhakar.com/projects/lightbox2/ *
= 1.1 =
*Added noImage attribute
*Updated the way the shortcode displayed the container
= 1.02 =
*Added flexible image height
*Added flexible container alignment
*Added flexible container size
= 1.01 =
*Added button styling
= 1.0 =
*Initial release.

== Upgrade Notice ==
= 1.6 =
*Updated TEXT form opener*
*Please note the TEXT version doesn't work so well in Firefox or Chrome
= 1.5 =
*Bug fix for the TEXT form opener
= 1.4 =
*Added a quicktag button to the TEXT editor to make setting shortcode attributes easier
= 1.3 =
*Added a TINYMCE button to the WYSIWYG editor to make setting shortcode attributes easier
= 1.2 =
*Added a lightbox http://lokeshdhakar.com/projects/lightbox2/ *
= 1.1 =
*Added noImage attribute
*Updated the way the shortcode displayed the container
= 1.02 =
*Added flexible image height
*Added flexible container alignment
*Added flexible container size
= 1.01 =
*Added button styling
= 1.0 =
*Initial release.
