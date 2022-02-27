
<?php
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



//Load Composer's autoloader
require 'vendor/autoload.php';




$name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email =filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$subject =filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$message =filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);







if(empty($_POST['phone2'])){


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;      
    $mail->isSMTP();
    $mail->Username   = 'projecttotheredmoon@gmail.com';                  
    $mail->Password   = 'Redmoonmadness1234';                                         
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->SMTPSecure = 'tls';            
    $mail->Port       = 587; 
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress('projecttotheredmoon@gmail.com', $name);     //Add a recipient
   



    $body ="<p><strong>WEBSITE INQUIRY</strong> Inquiry from a client named " . $name . " the message is '" .$message ."' from " .$email ."</p>";



    $mail->isHTML(true);                                 
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
    header("location: thankyou.html");


}   catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}

if (empty($name)){
    header("Location: contact.html?nouser");
    exit();
}

if (empty($email)){
    header("Location: contact.html?noemail");
    exit();
}

if (empty($subject)){
    header("Location: contact.html?nosubject");
    exit();
}


if (empty($message)){
    header("Location: contact.html?nomessage");
    exit();
}
?>