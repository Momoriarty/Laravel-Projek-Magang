<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .forgot-password-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forgot-password-container">
            <h3 class="text-center mb-4">Forgot Password</h3>
            <form action="" method="get">
                <div class="form-group">
                    <label for="Username">Username address</label>
                    <input type="text" class="form-control" name="username" id="Username" aria-describedby="UsernameHelp"
                        placeholder="Enter Username">
                    <small id="UsernameHelp" class="form-text text-muted">We'll send a password reset link to your
                        Username.</small>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                <div class="text-center mt-3">
                    <a href="#">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
