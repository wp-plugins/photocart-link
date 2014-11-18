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

global $wpdb;
$options_url = admin_url()."options-general.php?page=photocart_link";
$pc_options = get_option("photocart_link_options");

?>

<form name="pc_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <input type="hidden" name="pc_hidden">
  <div class="wrap"><?php echo "<h2>".__('PhotoCart Setup', 'pc_trdom')."</h2>"; ?></div><BR>

  <script type="text/javascript">
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

<?php
/* PROCESS PHOTOCART OPTION INFORMATION */

if ($_POST["pc_hidden"] == "setOptions") {
/*
  echo "dir: ".$_POST["pc_Dir"]."<BR>";
  echo "dir: ".$_POST["pc_DB"]."<BR>";
  echo "dir: ".$_POST["pc_DBUser"]."<BR>";
  echo "dir: ".$_POST["pc_DBPass"]."<BR>";
*/

  $pc_options_array["pc_Dir"] = $_POST["pc_Dir"];
  $pc_options_array["pc_DB"] = $_POST["pc_DB"];
  $pc_options_array["pc_DBUser"] = $_POST["pc_DBUser"];
  $pc_options_array["pc_DBPass"] = $_POST["pc_DBPass"];

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
  </table>
  <p class="submit">
    <input type="button" value="<?php _e($optButton.'Set Options', 'pc_trdom' ) ?>" onclick="pc_functions('set')" /><BR><BR>
  </p>
</form>