=== Photocart Link ===
Contributors: Chad McCoskey
Tags: photocart, picturespro
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.01
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
1. Upload all photocart_link files to the /wp-content/plugins/photocart_link/ directory.
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

imageCaption= (optional)
	--Entering a caption will override an entered caption for the photo.
	Defaults to the caption entered for the photo in Photocart.

imageTitle= (optional)
	--Entering a title will override an entered title for the photo.
	Defaults to the title entered for the photo in Photocart.

EXAMPLES
BASE: [photocart_link imageID="99999"]
	--Defaults to imageType="full", size of image in Photocart,
	caption and title of image in Photocart.

OPTIONS:
[photocart_link imageID="99999" imageType="thumb" imageWidth="300" imageCaption="Image Caption" imageTitle="Image Title"]

Notes
The image display CSS can be edited by modifying the photocart_link.css.

== Screenshots ==

== Changelog ==
= 1.0 =
*Initial release.
= 1.01 =
*Added button styling

== Upgrade Notice ==
= 1.0 =
*Initial release.
= 1.01 =
*Added button styling
