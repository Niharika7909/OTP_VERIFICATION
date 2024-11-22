<!-- verify_OTP.php -->
<?php
session_start();
require 'OTP_conn.php';

$email = $_SESSION['email'];
$entered_otp = $_POST['otp'];

// Fetch OTP and expiration from the database
$stmt = $conn->prepare("SELECT otp, otp_expiration FROM users_temp WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($otp, $otp_expiration);
$stmt->fetch();
$stmt->close(); // Close the first statement

// Verify OTP
if ($entered_otp == $otp && strtotime($otp_expiration) > time()) {
    $name = $_SESSION['name'];
    $userid = $_SESSION['userid'];
    $password = $_SESSION['password'];
    
    // Prepare and execute the second statement
    $stmt = $conn->prepare("INSERT INTO users (name, userid, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $userid, $email, $password);

    if ($stmt->execute()) {
        echo "OTP Verified. Registration Complete!";
        
        // Clean up: delete temp OTP entry after successful registration
        $stmt = $conn->prepare("DELETE FROM users_temp WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
    } else {
        echo "Error during registration: " . $stmt->error;
    }
    
    $stmt->close(); // Close the second statement
} else {
    echo "Invalid OTP or OTP has expired.";
}

$conn->close(); // Close the database connection
?>