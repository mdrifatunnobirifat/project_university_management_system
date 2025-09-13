<?php
// mail_helper.php - A reusable function to send emails using PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// --- IMPORTANT: Adjust this path to your Composer autoload.php ---
// This line loads all PHPMailer classes automatically.
// Assuming this file (mail_helper.php) is in 'includes/' and 'vendor/' is at project root:
require_once __DIR__ . '/../vendor/autoload.php';
// If mail_helper.php is directly in the project root:
// require_once __DIR__ . '/vendor/autoload.php';
// You must ensure this path is correct for your project structure.


/**
 * Sends an email using PHPMailer with Gmail's SMTP.
 *
 * @param string $toEmail The recipient's email address.
 * @param string $toName The recipient's name (optional).
 * @param string $subject The subject of the email.
 * @param string $bodyHtml The HTML content of the email body.
 * @param string $bodyAltText Optional plain-text alternative for email clients that don't display HTML.
 * @return bool True on success, false on failure.
 */
function sendEmail($toEmail, $toName = '', $subject, $bodyHtml, $bodyAltText = '') {
    $mail = new PHPMailer(true); // Enable exceptions for detailed error messages

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

        // --- GMAIL CREDENTIALS ---
        // Replace with YOUR Gmail address and App Password.
        // DO NOT use your regular Gmail password here!
        // Generate an App Password: Google Account -> Security -> 2-Step Verification -> App Passwords
        $mail->Username   = 'yourgmail@gmail.com';                  // ✅ Your Gmail address
        $mail->Password   = 'abcd efgh ijkl mnop';                  // ✅ Your App Password (no spaces)

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to; use 587 for STARTTLS

        // Optional: Enable debugging. Set to SMTP::DEBUG_SERVER for detailed output.
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        // Recipients
        $mail->setFrom('yourgmail@gmail.com', 'Your Website Name'); // Sender's email and name
        $mail->addAddress($toEmail, $toName);                       // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;
        $mail->AltBody = $bodyAltText; // Plain text for non-HTML mail clients

        $mail->send();
        // echo "✅ Email sent successfully to {$toEmail}!<br>"; // For debugging, remove in production
        return true;

    } catch (Exception $e) {
        error_log("❌ Email could not be sent to {$toEmail}. Mailer Error: {$mail->ErrorInfo}");
        // echo "❌ Email could not be sent to {$toEmail}. Mailer Error: {$mail->ErrorInfo}<br>"; // For debugging, remove in production
        return false;
    }
}
?>