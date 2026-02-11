<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    /* ===============================
       1️⃣ SEND MAIL TO ADMIN (YOU)
    =============================== */

    $admin_email = "gajendra@kriratech.com";  // 🔴 PUT YOUR EMAIL HERE

    $admin_subject = "New Website Inquiry - " . $subject;

    $admin_body = "New message received:\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Contact No: $phone\n".
                  "Subject: $subject\n\n".
                  "Message:\n$message";

    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mail_to_admin = mail($admin_email, $admin_subject, $admin_body, $headers);


    /* ===============================
       2️⃣ SEND THANK YOU MAIL TO USER
    =============================== */

    $user_subject = "Thank You for Contacting Us";

    $user_body = "Dear $name,\n\n".
                 "Thank you for contacting us.\n".
                 "We have received your inquiry and our team will contact you shortly.\n\n".
                 "Here are the details you submitted:\n\n".
                 "Subject: $subject\n".
                 "Message: $message\n\n".
                 "Best Regards,\n".
                 "Your Company Name";

    $user_headers = "From: noreply@kriratech.com\r\n";

    $mail_to_user = mail($email, $user_subject, $user_body, $user_headers);


    /* ===============================
       3️⃣ RESPONSE BACK TO WEBSITE
    =============================== */

    if($mail_to_admin && $mail_to_user) {
        echo "success";
    } else {
        echo "error";
    }

}
?>
