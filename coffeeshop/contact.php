
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['send'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];
   $subject = "Got a message from Website";
   //Import PHPMailer classes into the global namespace
   //These must be at the top of your script, not inside a function
   
   
   //Load Composer's autoloader
   require 'vendor/autoload.php';
   
   //Create an instance; passing `true` enables exceptions
   $mail = new PHPMailer(true);
   
   try {
       //Server settings
       $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
       $mail->isSMTP();                                            //Send using SMTP
       $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'your original email';                     //SMTP username
       $mail->Password   = 'your original password';                               //SMTP password
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
       $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   
       //Recipients
       $mail->setFrom($email, $name);
       $mail->addAddress('your original mail', 'Joe User');     //Add a recipient
       //$mail->addAddress('ellen@example.com');               //Name is optional
       //$mail->addReplyTo('info@example.com', 'Information');
       //$mail->addCC('cc@example.com');
       //$mail->addBCC('bcc@example.com');
   
       //Attachments
       //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
   
       //Content
       $mail->isHTML(true);                                  //Set email format to HTML
       $mail->Subject = $subject;
       $mail->Body    = $message;
   
       $mail->send();
       echo 'Message has been sent';
       header("Location: index.html?mailsend");
   } catch (Exception $e) {
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       header("Location: index.html");
   }
   
}
 /*if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['namessge'];
    $subject = "Got a message from Website";
    
    $to = "dani@gmail.com";
    $headers = "From: ".$name;
    $txt = "You have received an e-mail from ".$name.".\n\n".$message;
    
    mail($to,$subject, $txt, $headers);
    header("Location: index.html?mailsend");
 }*/
?>