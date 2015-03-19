<?php
//do not allow direct access
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
 header('HTTP/1.0 403 Forbidden'); 
 exit('Forbidden');
}

/* OPTION NEEDS: 
  location of photocart (url = http://www.mysite.com/photocart/photos/)
  DB hostname
  DB Username/password
*/

add_action( 'load-widgets.php', 'load_color_picker' );  

function load_color_picker() {      
    wp_enqueue_style( 'wp-color-picker' );          
    wp_enqueue_script( 'wp-color-picker' );      
}

global $wpdb;
$options_url = admin_url()."options-general.php?page=photocart_link";
$pc_options = get_option("photocart_link_options");

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
?>

<form name="pc_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <input type="hidden" name="pc_hidden">
  <div class="wrap"><?php echo "<h2>".__('PhotoCart Setup', 'pc_trdom')."</h2>"; ?></div><BR>

  <script type="text/javascript">
  function pc_setButton(field)
  {
    var numbers = /^[0-9]+$/;

    document.getElementById('btn_sample').style.backgroundColor = document.getElementById('pc_btnBG').value;
    document.getElementById('btn_sample').style.color = document.getElementById('pc_btnTextColor').value;
   
    if (field == "t")
    {
      if (document.getElementById("pc_btnText").value != "")
      {
        document.getElementById("btn_sample").value = document.getElementById("pc_btnText").value;
      }
    }
    else if (field == "fs")
    {
      if (document.getElementById("pc_btnFontSize").value != "")
      {
        if (document.getElementById("pc_btnFontSize").value.match(numbers))
        {
          document.getElementById("btn_sample").style.fontSize = document.getElementById("pc_btnFontSize").value + "px";
        }
        else
        {
          alert("Numbers only");
          document.getElementById("pc_btnFontSize").focus();
        }
      }
    }
  }

  function pc_functions(opt)
  {
    if (opt == "get")
    {
      document.pc_form.pc_hidden.value = "getImage";
      document.pc_form.submit();
    }
    if (opt == "set")
    {
      document.pc_form.pc_hidden.value = "setOptions";
      document.pc_form.submit();
    }
  }
  </script>

<script type='text/javascript'>  
    jQuery(document).ready(function($) {  
        $('.my-color-picker').wpColorPicker();  
    });  
</script>

<?php
/* PROCESS PHOTOCART OPTION INFORMATION */

if ($_POST["pc_hidden"] == "setOptions") {
/*
  foreach($_POST as $pKey => $pValue)
  {
    echo "POST: ".$pKey." -- ".$pValue."<BR>";
  }
*/

  $pc_options_array["pc_Dir"] = $_POST["pc_Dir"];
  $pc_options_array["pc_DB"] = $_POST["pc_DB"];
  $pc_options_array["pc_DBUser"] = $_POST["pc_DBUser"];
  $pc_options_array["pc_DBPass"] = $_POST["pc_DBPass"];
  $pc_options_array["pc_btnBG"] = $_POST["pc_btnBG"];
  $pc_options_array["pc_btnTextColor"] = $_POST["pc_btnTextColor"];
  $pc_options_array["pc_btnText"] = $_POST["pc_btnText"];
  $pc_options_array["pc_btnFontSize"] = $_POST["pc_btnFontSize"];

  update_option("photocart_link_options",$pc_options_array);
  echo "<script>alert('Options Set'); window.location='".$options_url."'</script>";
}

//USED FOR TESTING - <input type="button" value="Show Image" onclick="pc_functions('get')" />
?>

  <table border=1 bgcolor="lightgray">
    <tr>
      <td><b><?php _e("Set Photocart Photos Directory: " ); ?></td>
      <td><input type='text' name='pc_Dir' id='pc_Dir' size='50' value='<?php echo $pc_options["pc_Dir"]; ?>'> -- Use full path - http://www.mysite.com/photocart/photos/</td>
    </tr>
    <tr>
      <td><b><?php _e("Set Photocart Database Hostname: " ); ?></td>
      <td><input type='text' name='pc_DB' id='pc_DB' size='50' value='<?php echo $pc_options["pc_DB"];; ?>'></td>
    </tr>
    <tr>
      <td><b><?php _e("Set Photocart Database User: " ); ?></td>
      <td><input type='text' name='pc_DBUser' id='pc_DBUser' size='50' value='<?php echo $pc_options["pc_DBUser"]; ?>'></td>
    </tr>
    <tr>
      <td><b><?php _e("Set Photocart Database Password: " ); ?></td>
      <td><input type='password' name='pc_DBPass' id='pc_DBPass' size='50' value='<?php echo $pc_options["pc_DBPass"]; ?>'></td>
    </tr>
    <tr>
      <td colspan=2>&nbsp;</td>
    </tr>
    <tr>
      <td><h3>Style Button</h3></td>
      <td align=center><input type=button id="btn_sample" <? echo $btnStyle; echo $btnText; ?>"></td>
    </tr>
    <tr>
      <td><b><?php _e("Background Color: " ); ?></b></td>
      <td><input type="text" class="my-color-picker" data-default-color="" name='pc_btnBG' onblur=pc_setButton('bg') id='pc_btnBG' value='<?php
        echo $pc_options["pc_btnBG"]; ?>' /></td>
    </tr>
    <tr>
      <td><b><?php _e("Text Color: " ); ?></b></td>
      <td><input type="text" class="my-color-picker" data-default-color="" name='pc_btnTextColor' id='pc_btnTextColor' onblur=pc_setButton('tc') value='<?php
        echo $pc_options["pc_btnTextColor"]; ?>' /></td>
    </tr>
    <tr>
      <td><b><?php _e("Text: " ); ?></b></td>
      <td><input type="text" size="50" name='pc_btnText' id='pc_btnText' onblur=pc_setButton('t') value='<?php echo $pc_options["pc_btnText"]; ?>'/></td>
    </tr>
    <tr>
      <td><b><?php _e("Font Size: " ); ?></b></td>
      <td><input type="text" size="10" name='pc_btnFontSize' id='pc_btnFontSize' onblur=pc_setButton('fs') value='<?php echo $pc_options["pc_btnFontSize"]; ?>'/> -- In pixels - I.E. 20</td>
    </tr>
  </table>

  <p class="submit">
    <input type="button" value="<?php _e($optButton.'Set Options', 'pc_trdom' ) ?>" onclick="pc_functions('set')" /><BR><BR>
  </p>
</form>