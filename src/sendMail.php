<?php
//// Recipient email address
//$to = "recipient@example.com";
//
//// Subject of the email
//$subject = "Your Magic Link";
//
//// Generate the magic link (replace this with your actual logic)
//$magic_link = "https://example.com/login?token=YOUR_TOKEN";
//
//// HTML email template
//$message = '
//<!DOCTYPE html>
//<html lang="en">
//<head>
//    <meta charset="UTF-8">
//    <meta name="viewport" content="width=device-width, initial-scale=1.0">
//    <title>Magic Link Email</title>
//    <style>
//        body {
//            font-family: Arial, sans-serif;
//            line-height: 1.6;
//            color: #333333;
//            background-color: #f4f4f4;
//            margin: 0;
//            padding: 0;
//        }
//        .email-container {
//            max-width: 600px;
//            margin: 20px auto;
//            background: #ffffff;
//            border-radius: 8px;
//            overflow: hidden;
//            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
//        }
//        .email-header {
//            background: #007BFF;
//            color: #ffffff;
//            text-align: center;
//            padding: 20px;
//        }
//        .email-header h1 {
//            margin: 0;
//            font-size: 24px;
//        }
//        .email-body {
//            padding: 20px;
//        }
//        .email-body p {
//            margin: 0 0 20px;
//        }
//        .email-footer {
//            background: #f4f4f4;
//            color: #666666;
//            text-align: center;
//            padding: 10px;
//            font-size: 12px;
//        }
//        .magic-link {
//            display: inline-block;
//            background: #007BFF;
//            color: #ffffff;
//            text-decoration: none;
//            padding: 10px 20px;
//            border-radius: 5px;
//            font-size: 16px;
//        }
//        .magic-link:hover {
//            background: #0056b3;
//        }
//    </style>
//</head>
//<body>
//    <div class="email-container">
//        <div class="email-header">
//            <h1>Magic Link Login</h1>
//        </div>
//        <div class="email-body">
//            <p>Hello,</p>
//            <p>You requested a magic link to log in. Click the button below to access your account:</p>
//            <p>
//                <a href="' . htmlspecialchars($magic_link) . '" class="magic-link">Log In</a>
//            </p>
//            <p>If you did not request this, you can safely ignore this email.</p>
//        </div>
//        <div class="email-footer">
//            <p>&copy; 2025 Your Company. All rights reserved.</p>
//        </div>
//    </div>
//</body>
//</html>
//';


//// Send the email
//if (mail($to, $subject, $message, $headers)) {
//    echo "Magic link email sent successfully.";
//} else {
//    echo "Failed to send the email.";
//}


function SendMail($to, $subject, $type, object $info): void
{
    $subject = "Cut Or Dye - " . $subject;

    if ($type === "confirmation") {
        $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: #ffffff;
            color: #000000;
            text-align: center;
            padding: 20px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            margin: 0 0 20px;
        }

        .email-footer {
            background: #f4f4f4;
            color: #666666;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Conformation appointment</h1>
    </div>
    <div class="email-body">
        <p>Hello</p>
        <p>Thanks for making an appointment with CutOrDye</p>
        <p>Appointment type: ' . $info->date . '</p>
        <p>Date type: ' . $info->date . '</p>
        <p>Time Slot type: ' . $info->time . '</p>
    </div>
    <div class="email-footer">
        <p>&copy; 2025 Your Company. All rights reserved.</p>
    </div>
</div>
</body>
</html>
        ';
    } else if ($type === "magicLink") {
        $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Link Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: #ffffff;
            color: #000000;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            margin: 0 0 20px;
        }
        .email-footer {
            background: #f4f4f4;
            color: #666666;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        .magic-link {
            display: inline-block;
            background: #007BFF;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .magic-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Magic Link Login</h1>
        </div>
        <div class="email-body">
            <p>Hello,</p>
            <p>You requested a magic link to log in. Click the button below to access your account:</p>
            <p>
                <a href="' . htmlspecialchars($info->magicLink) . '" class="magic-link">Log In</a>
            </p>
            <p>If you did not request this, you can safely ignore this email.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';
    } else if ($type === "test") {
        $message = $info->message;
    }

    // Headers for the email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cut Or Dye <cutordye@example.com>" . "\r\n";

    mail($to, $subject, $message, $headers);
}