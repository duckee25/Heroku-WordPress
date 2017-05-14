<?php require_once( '../../../../../wp-load.php' ); ?>
<?php 
$cryptinstall=get_template_directory()."/scripts/crypt/cryptographp.fct.php";
include $cryptinstall; 
?>


<?php
	$captcha = $_GET['captcha'];
  if (chk_crypt($captcha)) {
	  echo "ok";	  
  } else {
	  echo "no";
  }
?>

