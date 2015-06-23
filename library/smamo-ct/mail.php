<?php
/* send en email */
define('WP_USE_THEMES', false);
header('Content-Type: application/json');
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');



$return = array();

//send mail
function sendEmail($name,$virk,$from,$to,$subject,$message){
	$header = "From: ". $name ."" . $virk . "<" . $from . ">\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=utf-8\r\n"; 
	$header.= "X-Priority: 2\r\n"; 
    $header.= "CC:".$from;
	wp_mail($to, $subject, nl2br($message), $header);
}

// cheapass nonce
$validate = 'gwæefUUweuhuwhfWUEFFWWEF';
$auth = wp_strip_all_tags($_POST['auth']);
if(! $auth || $auth != $validate){

    $return['error'] = 'fejl i validator';
    echo json_encode($return);
    exit;
    
}


//Start form processing  
$name       = wp_strip_all_tags($_POST['name']);
$email      = wp_strip_all_tags($_POST['email']);
$message    = wp_strip_all_tags($_POST['message']);
$to         = wp_strip_all_tags($_POST['to']);

sendEmail($name,$comp,$email,$to,'Besked fra '.$name,$message);
    
$return['success'] = true;

echo json_encode($return);

?>