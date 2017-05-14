<?php 
	if(!session_id()) session_start();
	require( '../../../../../wp-load.php' ); ?>
<?php 
$captcha = $_POST['captcha']; 
if($captcha!='' || $captcha!='undefined'){
	$cryptinstall=get_template_directory()."/scripts/crypt/cryptographp.fct.php";
	include $cryptinstall; 
}
?>
<?php
	$list_keys=array_keys($_POST);
	$list_values=array_values($_POST);
	$num=count(array_keys($_POST));
	 

$form = $_POST['form'];
$i = 0;
$pix_array_your_forms = pix_get_option('pix_array_your_forms_'.$_POST['form']);
//while($i<count($pix_array_your_forms)){ 
	
	if (!$errors) {
		if($captcha=='undefined' || chk_crypt($captcha)){
			
			$to = $pix_array_your_forms['recipient'];   
		
			$headers = "MIME-Version: 1.0\n" .
				"From: ". $_POST['email'] . " <". $_POST['email'] . ">\n" .
				"Content-Type: text/html; charset=\"" . 
				pix_get_option('blog_charset') . "\"\n";
			 
		
			$subject = $pix_array_your_forms['subject']; 
			$message = '
			<html>
			<body>
			<table>';
				for($i=0;$i<$num;$i++) {
					if (($list_keys[$i]!="form" && $list_keys[$i]!="captcha" && $i!=0 && $list_keys[$i]!='_') ) {
						if ( $list_keys[$i] == 'email' ) {
							$key_mail = 'Email:';
						} else {
							$key_mail = $list_keys[$i];
						}
						$message.= '<tr><td>'.str_replace('_',' ',$key_mail)."<td>".stripslashes(nl2br($list_values[$i]))."</td></tr>";
					}
				}
		
			$message .='</table>
			</body>
			</html>';
			
		 
		
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			//$result = wp_mail( $to, $subject, $message, $headers, $attachments );
			 
		
			sendmail( $to, $subject, $message, $headers, $attachments );
			echo ' success';
		} else {
			echo 'noCaptcha';
		}
	 
	
	}//endif
//$i++;
//}//endwhile
	 
	 
	function sendmail($to, $subject, $message, $from) {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		 
		add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
		$result = wp_mail($to,$subject,$message,$headers);
		 
		if ($result) echo '1 success';
		else echo 0;
	}


?>