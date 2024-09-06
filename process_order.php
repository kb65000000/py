<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);

    // إعداد تفاصيل البريد الإلكتروني
    $to = "kb65019@gmail.com"; // استبدل هذا ببريدك الإلكتروني
    $subject = "طلب جديد من $name";
    $message = "
    <html>
    <head>
    <title>طلب جديد</title>
    </head>
    <body>
    <h2>تفاصيل الطلب</h2>
    <p><strong>الاسم:</strong> $name</p>
    <p><strong>رقم الهاتف:</strong> $phone</p>
    <p><strong>البريد الإلكتروني:</strong> $email</p>
    <p><strong>العنوان:</strong> $address</p>
    </body>
    </html>
    ";

    // إعداد الرأس للرسالة
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: kb65019@gmail.com" . "\r\n"; // يمكنك استبداله ببريد مخصص لإرسال الرسائل

    // إرسال البريد الإلكتروني
    if(mail($to, $subject, $message, $headers)) {
        echo "تم إرسال الطلب بنجاح. سيتم التواصل معك قريباً.";
    } else {
        error_log("Error sending email to $to", 3, "/path/to/error_log.log");
        echo "حدث خطأ أثناء إرسال الطلب. حاول مرة أخرى.";
    }

}
?>
