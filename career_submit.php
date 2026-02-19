<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position_type = $_POST['position_type'];
    $experience = $_POST['experience'];
    $skills = isset($_POST['skills']) ? $_POST['skills'] : 'Not provided';

    /* ===============================
       1️⃣ SEND MAIL TO ADMIN (HR/Company)
    =============================== */

    $admin_email = "gajendra@kriratech.com";  // Company email

    $admin_subject = "New Career Application - " . $position_type . " Position";

    $admin_body = "Dear Hiring Team,\n\n" .
                  "A new career application has been received through the website.\n\n" .
                  "==============================================\n" .
                  "APPLICANT DETAILS\n" .
                  "==============================================\n\n" .
                  "Full Name: $name\n" .
                  "Email Address: $email\n" .
                  "Contact Number: $phone\n" .
                  "Position Type: $position_type\n" .
                  "Experience Level: $experience\n\n" .
                  "Skills & Qualifications:\n$skills\n\n" .
                  "==============================================\n\n" .
                  "Please review the application and contact the candidate if their profile matches the requirements.\n\n" .
                  "Best Regards,\n" .
                  "Krira Tech Website System";

    $headers = "From: noreply@kriratech.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mail_to_admin = mail($admin_email, $admin_subject, $admin_body, $headers);


    /* ===============================
       2️⃣ SEND THANK YOU MAIL TO APPLICANT
    =============================== */

    $user_subject = "Thank You for Your Application - Krira Tech";

    $user_body = "Dear $name,\n\n" .
                 "Thank you for expressing your interest in joining Krira Tech!\n\n" .
                 "We have successfully received your application for the $position_type position. " .
                 "Our HR team will carefully review your profile and qualifications.\n\n" .
                 "==============================================\n" .
                 "APPLICATION SUMMARY\n" .
                 "==============================================\n\n" .
                 "Position Applied: $position_type\n" .
                 "Experience Level: $experience\n" .
                 "Contact Email: $email\n" .
                 "Contact Phone: $phone\n\n" .
                 "==============================================\n\n" .
                 "What happens next?\n" .
                 "- Our team will review your application within 5-7 business days\n" .
                 "- If your profile matches our requirements, we will contact you for the next steps\n" .
                 "- Please ensure your contact details are accurate for smooth communication\n\n" .
                 "In the meantime, you can learn more about us at www.kriratech.com\n\n" .
                 "We appreciate your interest in being part of our team!\n\n" .
                 "Best Regards,\n" .
                 "HR Team\n" .
                 "Krira Tech\n" .
                 "Embedded Systems & Robotics Solutions\n\n" .
                 "---\n" .
                 "This is an automated email. Please do not reply to this message.\n" .
                 "For queries, contact us at kriratech@gmail.com or +91 89563 61121";

    $user_headers = "From: noreply@kriratech.com\r\n";
    $user_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mail_to_user = mail($email, $user_subject, $user_body, $user_headers);


    /* ===============================
       3️⃣ REDIRECT BACK TO WEBSITE
    =============================== */

    if($mail_to_admin && $mail_to_user) {
        header("Location: index.html?career=success#career");
        exit();
    } else {
        header("Location: index.html?career=error#career");
        exit();
    }

} else {
    // If accessed directly without POST data
    header("Location: index.html#career");
    exit();
}

?>
