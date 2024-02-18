<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <p>
        You have requested to reset your password. Please click the link below to reset your password:
    </p>
    <p>
        <a href="{{ route('password.reset', ['token' => $token]) }}">Reset Password</a>
    </p>
    <p>
        If you did not request a password reset, please ignore this email.
    </p>
</body>
</html>
