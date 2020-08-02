<?php
require 'SAFMMailer.php';


$smtp = array(
    'debug' => 0, // Change debug to 0 during production
    'host' => 'outlook.office365.com',
    'port' => 587,
    'secure' => 'tls',
    'auth' => true,
    'username' => 'contacts@safmsolutions.com.au',
    'password' => 'DFmwj697'
);

// Change email accounts as necessary
$recipients = array(
    "phillip.trinh@safmsolutions.com.au" => "Phillip Trinh",
    "phillip.trinh1@gmail.com" => "Phillip Trinh");

$safmmailer = new SAFMMailer(true, $smtp);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get the form fields and remove whitespace
    $firstname = trim($_POST["first-name"]);
    $lastname = trim($_POST["last-name"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $company = trim($_POST["organisation"]);
    $message = trim($_POST["message"]);

    // Check for any empty fields
    if(empty($firstname) OR empty($lastname) OR empty($message) OR empty($email) OR empty($phone) OR empty($company)){
        // Set a 400 response code and exit
        http_response_code(400);
        echo "There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    $subject = "New message from $firstname $lastname";

    $safmmailer->sendMail($smtp,$firstname, $lastname, $email, $phone, $company, $message, $subject, $recipients);
}else{
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>
