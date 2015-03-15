<?php
/*
    Plugin Name: Photocart Link
    Plugin URI: http://www.kaymeephotography.com
    Description: Plugin for displaying images from a Photocart Photography Shopping Cart by PicturesPro using a shortcode
    Author: Chad McCoskey
    Version: 1.2
    Author URI: http://www.kaymeephotography.com
    Copyright 2014  Chad McCoskey  (email : chad@kaymeephotography.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//do not allow direct access
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
 header('HTTP/1.0 403 Forbidden');
 exit('Forbidden');
}

/* MAIN FUNCTION */
function photocart_link_images($imgInfo) {
  //$imgInfo: imageID, imageType(thumb,full), imageWidth, imageTitle, imageCaption
  //echo "INSIDE photocart_images: <pre>"; print_r($imgInfo); echo "</pre>";

  $plugins_url = plugins_url() . "/photocart_link/";

  if (is_array($imgInfo)) {

    if ($imgInfo["imageid"] == "" || !$imgInfo["imageid"]) {
      return false;
    }
    else {
      $imgID = $imgInfo["imageid"];
    }
    if ($imgInfo["imagetype"] == "" || !$imgInfo["imagetype"] || ($imgInfo["imagetype"] != "full" && $imgInfo["imagetype"] != "thumb")) {
      $imgType = "full";
    }
    else {
      $imgType = $imgInfo["imagetype"];
    }
    if ($imgInfo["imagewidth"] == "" || !$imgInfo["imagewidth"]) {
      $imgWidth = "";
    }
    else {
      $imgWidth = $imgInfo["imagewidth"];
    }
    if ($imgInfo["imageheight"] == "" || !$imgInfo["imageheight"]) {
      $imgHeight = "";
    }
    else {
      $imgHeight = $imgInfo["imageheight"];
    }
    if ($imgInfo["imagecaption"] == "" || !$imgInfo["imagecaption"]) {
      $imgCaption = "";
    }
    else {
      $imgCaption = $imgInfo["imagecaption"];
    }
    if ($imgInfo["imagetitle"] == "" || !$imgInfo["imagetitle"]) {
      $imgTitle = "";
    }
    else {
      $imgTitle = $imgInfo["imagetitle"];
    }
    if ($imgInfo["imagealign"] == "" || !$imgInfo["imagealign"]) {
      $imgAlign = "none";
    }
    else {
      $imgAlign = $imgInfo["imagealign"];
    }
    if ($imgInfo["contsize"] == "" || !$imgInfo["contsize"]) {
      $contSize = "100";
    }
    else {
      $contSize = $imgInfo["contsize"];
    }
    if ($imgInfo["noimage"] == "" || !$imgInfo["noimage"]) {
      $noImage = "false";
    }
    else {
      $noImage = $imgInfo["noimage"];
    }
  }
  else {
    $imgID = $imgInfo;
    $imgType = "full";
    $imgWidth = "";
    $imgHeight = "";
    $imgCaption = "";
    $imgTitle = "";
    $imgAlign = "none";
    $contSize = "100";
    $noImage = "false";
  }

  $pc_options = get_option("photocart_link_options");
  $pcDir = trim($pc_options["pc_Dir"]);
  $pcDB = trim($pc_options["pc_DB"]);
  $pcDBUser = trim($pc_options["pc_DBUser"]);
  $pcDBPass = trim($pc_options["pc_DBPass"]);

  //CREATE BUTTON STYLING
  $btnStyle = "style=\"";
  $btnText = " value='View in Cart'";
  if ($pc_options["pc_btnBG"] ||  $pc_options["pc_btnBG"] != "") {
    $btnStyle .= "background-color:".$pc_options["pc_btnBG"].";";
  }
  if ($pc_options["pc_btnTextColor"] ||  $pc_options["pc_btnTextColor"] != "") {
    $btnStyle .= "color:".$pc_options["pc_btnTextColor"].";";
  }
  if ($pc_options["pc_btnFontSize"] ||  $pc_options["pc_btnFontSize"] != "") {
    $btnStyle .= "font-size:".$pc_options["pc_btnFontSize"]."px;";
  }
  if ($pc_options["pc_btnText"] ||  $pc_options["pc_btnText"] != "") {
    $btnText = " value='".$pc_options["pc_btnText"]."'";
  }
  $btnStyle .= "\"";

  //echo "HOST: ".$pcDB."<BR>";
  //echo "options:<pre>"; print_r($pc_options); echo "</pre>";
  //echo "imgID = $imgID && type = $imgType<BR>";

  $newdb = new wpdb($pcDBUser, $pcDBPass, $pcDBUser, $pcDB);
  $newdb->show_errors();

  $img_query_results = $newdb->get_results("SELECT pic_id, pic_gal, pic_pic, pic_th, pic_org, pic_title, pic_text FROM pics WHERE pic_id=$imgID");
  foreach($img_query_results as $imgResults)
  {
    $imgID = $imgResults->pic_id;
    $imgOrg = $imgResults->pic_org;
    $imgGal = $imgResults->pic_gal;
    $imgPic = $imgResults->pic_pic;
    $imgTH = $imgResults->pic_th;
    $imgTle = $imgResults->pic_title;
    $imgText = $imgResults->pic_text;
    $imgZoom = $imgPic;
  }

  $gal_query_results = $newdb->get_results("SELECT gal_id, gal_folder FROM galleries WHERE gal_id = $imgGal");

  foreach($gal_query_results as $galResults)
  {
    $galDir = $galResults->gal_folder;
  }
  if ($imgType == "thumb") {
    $imgFile = $imgTH;
  }
  else {
    $imgFile = $imgPic;
  }

  if ($pcDir[strlen($pcDir)-1] != "/") {
    $pcDir .= "/";
  }

  if ($imgCaption == "" || !$imgCaption) {
    $imgCaption = $imgText;
  }

  if ($imgTitle == "" || !$imgTitle) {
    $imgTitle = $imgTle;
  }

  $appLoc = substr($pcDir, 0, strrpos($pcDir,"/",-2));
  $gal = substr($galDir,0,strpos($galDir,"-"));
  $imgPath = plugins_url('decode.php',__FILE__)."?id=".base64_encode($pcDir.$galDir."/".$imgFile);
  $zoomPath = plugins_url('decode.php',__FILE__)."?id=".base64_encode($pcDir.$galDir."/".$imgZoom);
  if ($contSize[strLen($contSize)-1] != "%") $contSize .= "%";

  //echo "$pcDir <BR> $appLoc <BR> $galDir <BR> $imgWidth <BR> $imgHeight <BR> $imgCaption <BR> $imgTitle <BR> $imgAlign <BR> $contSize <BR>";
?>

<?php
  $output = "
  <link rel='stylesheet' href='".$plugins_url."photocart_link.css' type='text/css' media='screen' />
  <link href='".plugin_dir_url( __FILE__ )."lightbox/css/lightbox.css' rel='stylesheet' />
  <script src='".plugin_dir_url( __FILE__ )."lightbox/js/jquery-1.11.0.min.js'></script>
  <script src='".plugin_dir_url( __FILE__ )."lightbox/js/lightbox.min.js'></script>

  <style>
  .pc_img { ";

    if ($imgWidth) { $output .= "	width:".$imgWidth."px;"; }
    if ($imgHeight) { $output .= "    height:".$imgHeight."px;"; }

  $output .= "
  }
  </style>";

  $output .= "<div style='width:".$contSize."' class='photocart pc_caption pc_align".$imgAlign."'>";

  if ($noImage == "false") {
    $output .= "
    <h3>".$imgTitle."</h3><a href='".$zoomPath."' data-lightbox='".$imgZoom."' data-title='".$imgTitle."'><img id=photocart src='".$imgPath."' class='pc_img'></a>
    <p class='pc_caption-text pc_caption.pc_align".$imgAlign."'>".$imgCaption."</p><BR>
    ";
  }

  $pcLink = $appLoc."/index.php?do=photocart&viewGallery=".$gal."#image=".$imgID;

  $output .= "
  <input type=button ".$btnStyle.$btnText." onclick=window.open('".$pcLink."','_blank')>";

  $output .= "</div><BR><BR>";

  return $output;
  //echo $output;
}
/* END MAIN FUNCTION */

/************************************** ADD OPTIONS MENU TO ADMIN -> SETTINGS**************************************/
function photocart_link_admin_actions() {
    add_options_page("PhotoCart Link", "PhotoCart Link", 1, "photocart_link", "photocart_link_admin");
}
function photocart_link_admin() {
  include("photocart_link_admin.php");
}
if (is_admin()) { add_action('admin_menu', 'photocart_link_admin_actions'); }
add_shortcode('photocart_link','photocart_link_images'); //ADD SHORTCODE OPTION [photocart_link imageID={id} imageType={full/thumb} ] //'photocart_link_images'