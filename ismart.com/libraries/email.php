<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';





function send_mail($send_to_mail,$send_to_fullname, $subject, $content){
    $mail = new PHPMailer(true);
    global $config;
    $config_email = $config['email'];
try {
    //Server settings
    $mail->CharSet = $config_email['charset'];
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $config_email['smtp_user'];                     // SMTP username
    $mail->Password   = $config_email['smtp_pass'];   
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                // SMTP password
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
    $mail->addAddress($send_to_mail, $send_to_fullname);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
//    $mail->addAttachment('11.docx');         // Add attachments
//     $mail->addAttachment('11.docx', 'FILE_moi.docx');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Đã gửi thành công';
} catch (Exception $e) {
    echo "Email không được gửi chi tiết lỗi: {$mail->ErrorInfo}";
}
}