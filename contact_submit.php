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

    $admin_email = "gajendra@kriratech.com";  // Company email - CHANGE THIS TO YOUR EMAIL

    $admin_subject = "New Website Inquiry - " . $subject;

    $admin_body = "New message received from the website:\n\n" .
                  "==============================================\n" .
                  "SENDER DETAILS\n" .
                  "==============================================\n\n" .
                  "Name: $name\n" .
                  "Email: $email\n" .
                  "Contact No: $phone\n" .
                  "Subject: $subject\n\n" .
                  "==============================================\n" .
                  "MESSAGE\n" .
                  "==============================================\n\n" .
                  "$message\n\n" .
                  "==============================================\n\n" .
                  "Please respond to this inquiry at your earliest convenience.\n\n" .
                  "Best Regards,\n" .
                  "Krira Tech Website System";

    $headers = "From: noreply@kriratech.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mail_to_admin = mail($admin_email, $admin_subject, $admin_body, $headers);


    /* ===============================
       2️⃣ SEND THANK YOU MAIL TO USER
    =============================== */

    $user_subject = "Thank You for Contacting Krira Tech";

    $user_body = "Dear $name,\n\n" .
                 "Thank you for reaching out to Krira Tech!\n\n" .
                 "We have successfully received your inquiry and appreciate your interest in our services. " .
                 "Our team is reviewing your message and will get back to you shortly.\n\n" .
                 "==============================================\n" .
                 "YOUR MESSAGE DETAILS\n" .
                 "==============================================\n\n" .
                 "Subject: $subject\n" .
                 "Message: $message\n\n" .
                 "==============================================\n\n" .
                 "We typically respond to all inquiries within 24-48 business hours. " .
                 "If your matter is urgent, please feel free to call us directly at +91 89563 61121.\n\n" .
                 "Explore our innovative solutions in Embedded Systems, Robotics, and IoT at www.kriratech.com\n\n" .
                 "Best Regards,\n" .
                 "Krira Tech Team\n" .
                 "Embedded Systems & Robotics Solutions\n\n" .
                 "---\n" .
                 "This is an automated email. Please do not reply to this message.\n" .
                 "For further queries, contact us at kriratech@gmail.com";

    $user_headers = "From: noreply@kriratech.com\r\n";
    $user_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mail_to_user = mail($email, $user_subject, $user_body, $user_headers);


    /* ===============================
       3️⃣ RETURN JSON RESPONSE FOR AJAX
    =============================== */

    header('Content-Type: application/json');
    
    if($mail_to_admin && $mail_to_user) {
        echo json_encode([
            'success' => true,
            'message' => 'Message sent successfully!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'There was an error sending your message. Please try again or contact us directly.'
        ]);
    }
    exit();

} else {
    // If accessed directly without POST data
    header('Location: index.html#contact');
    exit();
}

?>
