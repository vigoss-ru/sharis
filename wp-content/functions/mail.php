<?php

// Here we get all the information from the fields sent over by the form.
$name = $_POST['txtName'];
$email = $_POST['txtEmail'];
$message = $_POST['txtMessage'];

$to = 'bl7developer@sharis.de';
$subject = 'Contact with Sharis GmbH';
// $message = 'FROM: '.$name.' Email: '.$email.'Message: '.$message;
$message = 'Name: '.$name.'<br/><br/>Email: '.$email.'<br/><br/>Message: '.$message;
//$headers = 'From: contact@sharis.de' . "\r\n";
$headers = array(
    "From: contact@sharis.de",
    "MIME-Version: 1.0",
    "Content-Type: text/html;charset=utf-8"
);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {	
	mail($to, $subject, $message, implode("\r\n", $headers));
    //mail($to, $subject, $message, $headers); 	
	echo "Your email was sent!";
}else{
	echo "Invalid Email, please provide an correct email.";
}

?>