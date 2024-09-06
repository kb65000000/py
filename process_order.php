<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "kb65019@gmail.com"; // استبدل بعنوان بريدك الإلكتروني
    $subject = "رسالة جديدة من الموقع";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "<html>
                <body>
                    <p><strong>الاسم:</strong> $name</p>
                    <p><strong>البريد الإلكتروني:</strong> $email</p>
                    <p><strong>الرسالة:</strong><br>$message</p>
                </body>
            </html>";

    if (mail($to, $subject, $body, $headers)) {
        echo "تم إرسال الرسالة بنجاح!";
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة لاحقاً.";
    }
}
?>
