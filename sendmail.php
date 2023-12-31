<?php
// https://www.tutorialspoint.com/php/php_sending_emails.htm
function mail_attachment ($from , $to, $subject, $message, $attachmentFile, $attachmentName) {
     $semi_rand = md5(time());
     $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
     $headers = "From: ".$from .
        "\nMIME-Version: 1.0" .
        "\nContent-Type: multipart/mixed;" .
        "\n boundary=\"{$mime_boundary}\"";

     $email_message .= "This is a multi-part message in MIME format.\n\n" .
        "--{$mime_boundary}\n" .
        "Content-Type:text/html;charset= \"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" .
        $message . "\n\n" .
        "--{$mime_boundary}\n";

    if($attachmentFile) {
         $file = fopen($attachmentFile, 'rb');
         $data = fread($file, filesize($attachmentFile));
         $data = chunk_split(base64_encode($data));
         fclose($file);
         unlink($attachmentFile);
         $email_message .=
             "Content-Type: application/octet-stream; name = \"{$attachmentName}\"\n" .
             "Content-Disposition: attachment;\n" .
             " filename = \"{$attachmentName}\"\n" .
             "Content-Transfer-Encoding: base64\n\n" .
             $data .
             "\n\n" .
             "--{$mime_boundary}--\n";
    }
    echo "\nemail_message=" . $email_message;
    echo "\nheaders=" . $headers;
    $ok = mail($to, $subject, $email_message, $headers);
    if($ok) {
        echo "File Sent Successfully.";
    } else {
        die("Sorry but the email could not be sent. Please go back and try again!");
    }
}

function validateCaptchaToken($token) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => '6Lf3RXcoAAAAACQy7GFr2i9Go8WmpKmwJI5eBuOh',
        'response' => $token
    ];

    // use key 'http' even if you send the request to https://...
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    echo $result;
    $json = json_decode($result);
    $success = $json->success;

    echo "\nsuccess=" . var_dump($success);
    if ($success === false) {
        die("invalid token");
    }
}

echo "<pre>";
$captchaToken = $_REQUEST['captchaToken'];
validateCaptchaToken($captchaToken);
$to = "info@pvl.ee";
$from = $_REQUEST['email'];
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$subject = $_REQUEST['subject'];
$message = "name: " . $name . "<br>" .
    "phone: " . $phone . "<br>" .
    "message:<br><pre>" .
    $_REQUEST['message'] .
    "</pre>";
$file = $_FILES["file"];
echo "\nto=" . $to;
echo "\nfrom=" . $from;
echo "\nsubject=" . $subject;
echo "\nmessage=" . $message;
echo "\nfile=" . $file;
if($file) {
    $filePath = $file['tmp_name'];
    $fileName = $file['name'];
    $toName = 'temp/'.basename($name);
    echo "\nfilePath=" . $filePath;
    echo "\nfileName=" . $fileName;
}
mail_attachment($from, $to, $subject, $message, $filePath, $fileName);
echo "</pre>";
?>
