<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);

    $to = "kb65019@gmail.com";
    $subject = "New Order from $name";
    $message = "
    <html>
    <head>
    <title>New Order</title>
    </head>
    <body>
    <h2>Order Details</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Phone Number:</strong> $phone</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Address:</strong> $address</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: kb65019@gmail.com" . "\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Order has been sent successfully. We will contact you soon.";
    } else {
        // Get the last error message
        $error = error_get_last()['message'];
        
        // Log the error
        error_log("Error sending email to $to: $error", 3, "/path/to/error_log.log");
        
        // Display a user-friendly message and error details for debugging
        echo "There was an error sending the order. Please try again later.";
        echo "<br><strong>Debug Info:</strong> $error";
    }
}
?>
