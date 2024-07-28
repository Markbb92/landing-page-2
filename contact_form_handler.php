<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (!empty($_POST["demo-name"]) && !empty($_POST["demo-email"]) && !empty($_POST["demo-message"])) {
        // Sanitize and validate the input
        $name = htmlspecialchars(strip_tags($_POST["demo-name"]));
        $email = filter_var($_POST["demo-email"], FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars(strip_tags($_POST["demo-message"]));

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Optional fields
        $copy = isset($_POST["demo-copy"]) ? "Yes" : "No";
        $human = isset($_POST["demo-human"]) ? "Yes" : "No";

        // Send email or save data to database (example email sending)
        $to = "your-email@example.com";  // Replace with your email address
        $subject = "Contact Form Submission from $name";
        $body = "Name: $name\nEmail: $email\nMessage: $message\nSend Copy: $copy\nHuman: $human";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Thank you for your message.";
        } else {
            echo "Sorry, there was an error sending your message.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
