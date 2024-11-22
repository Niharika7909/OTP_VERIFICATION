<!-- OTP_Form2.php -->
<?php
session_start();
require 'OTP_conn.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['userid'] = $_POST['userid'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['email'] = $_POST['email'];

    $email = $_SESSION['email'];
    $otp = rand(100000, 999999);
    $otp_expiration = date("Y-m-d H:i:s", strtotime('+10 minutes'));

    $stmt = $conn->prepare("INSERT INTO users_temp (email, otp, otp_expiration) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE otp=?, otp_expiration=?");
    $stmt->bind_param("sssss", $email, $otp, $otp_expiration, $otp, $otp_expiration);
    $stmt->execute();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'niharikasharma7909@gmail.com';
        $mail->Password = 'hlnifixyucuqxfma';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('youremail@gmail.com', 'Your App');
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is $otp.";

        $mail->send();
        $message = "OTP sent to your email.";
    } catch (Exception $e) {
        $message = "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter OTP</h2>
        <form action="verify_OTP.php" method="POST">
            <p><?php echo $message; ?></p>
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit" name="verify_otp">Verify</button>
        </form>
    </div>
</body>
</html>