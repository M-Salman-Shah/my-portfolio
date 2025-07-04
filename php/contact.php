<?php
  // contact.php
  // This file handles the contact form submission and sends an email with the form data.
  if ($_SERVER["REQUEST_METHOD"] !== "POST") { 
    die('Invalid request method. Please use the contact form.');
  }

  if( !isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['subject']) || !isset($_POST['message']) ) {
    die('Please fill all required fields!');
  }
  if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
    die('Invalid email address!');
  }
  if( empty($_POST['message']) ) {
    die('Message is required!');
  }
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $to = 'salmanshah4003@gmail.com'; 

  $messageContent = "
    You received a message request from a client:\n\n
    Name: $name\n
    Email: $email\n
    Subject: $subject\n
    Message: \n$message
    ";

  $headers = "From: $email\r\nReply-To: $email\r\n";

  if (mail($to, $subject, $messageContent, $headers)) {
        echo "<script>alert('Your contact form has been submitted successfully! Thank you for your interest. I will contact you within 24 hours.');window.location.href='index.html';</script>";
        header("Location: thank-you.html");
        echo "Email sent successfully!";
        exit;
    } else {
        echo "<script>alert('Something went wrong. Please try again later.');window.history.back();</script>";
  }
?>
