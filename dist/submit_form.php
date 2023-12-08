<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set the recipient email address
    $to = "your_email@example.com";  // Replace with your email address

    // Set the subject of the email
    $subject = "New Contact Form Submission";

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Enable verbose debug output
        $mail->SMTPDebug = 2;

        // Set mailer to use SMTP
        $mail->isSMTP();

        // Specify your SMTP server
        $mail->Host = 'your_smtp_server';

        // Enable SMTP authentication
        $mail->SMTPAuth = true;

        // SMTP username and password
        $mail->Username = 'your_smtp_username';
        $mail->Password = 'your_smtp_password';

        // Set sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Set email subject and body
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Attempt to send the email
        $mail->send();
        echo "Thank you for your message! We will get back to you shortly.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    // If the form is not submitted via POST, redirect to the form page
    header("Location: contact_form.html");
    exit();
}
?>
