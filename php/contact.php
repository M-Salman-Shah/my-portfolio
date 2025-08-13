<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Display errors directly on the page
ini_set('display_startup_errors', 1); // Display startup errors
?>

<?php

  // DB Connection
  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = 'rootroot';
  $db_name = 'portfolio';

  // Create connection
  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] !== "GET") { 
    die('Invalid request method. Please use the contact form.');
  }

  $name = htmlspecialchars($_GET['name']);
  $email = htmlspecialchars($_GET['email']);
  $subject = htmlspecialchars($_GET['subject']);
  $message = htmlspecialchars($_GET['message']);

  // Save to database
  $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $stmt->execute();
 
?>