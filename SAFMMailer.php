<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/phpmailer/src/Exception.php';
require 'lib/phpmailer/src/PHPMailer.php';
require 'lib/phpmailer/src/SMTP.php';
require 'lib/phpmailer/src/OAuth.php';

class SAFMMailer {

    public $mail;

    public function __construct($exceptions = false, $smtp = array()){
        $this->mail = new PHPMailer($exceptions);
        // Set up the server
        if(!empty($smtp)){
            $this->mail->isSMTP();
            $this->mail->SMTPDebug = $smtp["debug"];
            $this->mail->Host = $smtp["host"];
            $this->mail->Port = $smtp["port"];
            $this->mail->SMTPSecure = $smtp["secure"];
            $this->mail->SMTPAuth = $smtp["auth"];
            $this->mail->Username = $smtp["username"];
            $this->mail->Password = $smtp["password"];
        }
    }

    public function sendMail($smtp = array(), $firstname, $lastname, $email, $phone, $company, $message, $subject, $recipients = array()){
        $keys = array_keys($recipients);
        // echo $recipients[$keys[0]];
        // Check if fields are empty
        if(empty($firstname) OR empty($lastname) OR empty($message) OR empty($phone) OR empty($company) OR empty($subject)){
            // Set a 400 response code and exit
            http_response_code(400);
            echo "There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set email content
        $email_content = "First Name: $firstname<br>";
        $email_content .= "Last Name: $lastname<br>";
        $email_content .= "Phone: $phone<br>";
        $email_content .= "Company: $company<br>";
        $email_content .= "<br>$message<br>";

        // Recipients
        $this->mail->setFrom($smtp["username"], "Contacts");
        $this->mail->addAddress($keys[0], $recipients[$keys[0]]);
        $this->mail->addReplyTo($email, $firstname . " " . $lastname);

        // Add CC
        if(sizeof($recipients) > 1){
          foreach($keys as $index => $e){
              if($index == 0) continue;
              $this->mail->AddCC($e, $recipients[$e]);
          }
        }

        // Content
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $email_content;
        $this->mail->AltBody = $email_content;

        // Send the mail
        try{
            $this->mail->send();
            http_response_code(200);
            //echo "Message has been sent";
        }catch(Exception $e){
            http_response_code(500);
            echo 'Message could not be sent';
        }
    }
}


?>
