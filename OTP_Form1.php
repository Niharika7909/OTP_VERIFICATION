<!-- register_step1.php -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Step 1</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 150%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            margin-right: 20px;
            color: #333;
        }

        .form-container input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            margin-right: 20px;

            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>User Registration</h2>
        <form action="OTP_Form2.php" method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="text" name="userid" placeholder="Enter User ID" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <button type="submit" name="proceed">Proceed</button>
        </form>
    </div>
</body>
</html>