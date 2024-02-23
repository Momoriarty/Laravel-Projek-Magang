@extends('auth/layout/navbar')
<style>
    .forgot-password-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        backdrop-filter: blur(10px);
        background-color: rgba(75, 75, 75, 0.5);

    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .text-center {
        text-align: center;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
</style>

<body>
    <div class="container">
        <div class="forgot-password-container">
            <h3 class="text-center mb-4">Forgot Password</h3>
            <form action="" method="get">
                <div class="form-group">
                    <label for="username">Username address</label>
                    <input type="text" class="form-control" name="username" id="username"
                        aria-describedby="usernameHelp" placeholder="Enter Username">
                    <small id="usernameHelp" class="form-text text-muted">We'll send a password reset link to your
                        email.</small>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                <div class="text-center mt-3">
                    <a href="#">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

@extends('auth/layout/footer')
