<?php
// https://www.tutorialspoint.com/php/php_sending_emails.htm
$to = "timur.kozlov@gmail.com"; // info@pvl.ee
$subject = $_POST['subject'];
$message = $_POST['message'];
$header = "From:" . $_POST['email'] . "\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail($to, $subject, $message, $header);
echo " | to=" . $to;
echo " | subject=" . $subject;
echo " | message=" . $message;
echo " | header=" . $header;
if( $retval == true ) {
    echo "Message sent successfully...";
} else {
    echo "Message could not be sent...";
}
?>
