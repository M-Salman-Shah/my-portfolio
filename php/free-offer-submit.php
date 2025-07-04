<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CAPTCHA check
    $captcha = trim($_POST["captcha"]);
    if ($captcha !== "7") {
        echo "<script>alert('Incorrect CAPTCHA answer. Please try again with correct CAPTCHA answer.'); window.history.back();</script>";
        exit;
    }

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $type = htmlspecialchars($_POST["website_type"]);
    $country = htmlspecialchars($_POST["country"]);
    $idea = htmlspecialchars($_POST["idea"]);
    $hosting = htmlspecialchars($_POST["hosting"]);

    $to = "salmanshah4003@gmail.com";
    $subject = "New Free Website Application";
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $message = "
    You received a new application for a free website:\n\n
    Name: $name\n
    Email: $email\n
    Website Type: $type\n
    Country: $country\n
    Hosting/Domain: $hosting\n
    Idea: \n$idea
    ";

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Your application has been submitted successfully! Thank you for your interest. I will contact you within 24 hours.');window.location.href='index.html';</script>";
        header("Location: thank-you.html");
        exit;
    } else {
        echo "<script>alert('Something went wrong. Please try again later.');window.history.back();</script>";
    }
} else {
    echo "Invalid request method.";
}
?>
