<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ludiflex | Login & Registration</title>
</head>
<style>
    /* POPPINS FONT */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .toast-container {
        position: fixed;
        bottom: 20px;
        /* Changed from top to bottom */
        right: 20px;
        z-index: 1000;
    }

    body {
        background: url("https://images5.alphacoders.com/109/1099191.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
    }

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 110vh;
        background: rgba(39, 39, 39, 0.4);
    }

    .nav {
        position: fixed;
        top: 0;
        display: flex;
        justify-content: space-around;
        width: 100%;
        height: 100px;
        line-height: 100px;
        background: linear-gradient(rgba(39, 39, 39, 0.6), transparent);
        z-index: 100;
    }

    .nav-logo p {
        color: white;
        font-size: 25px;
        font-weight: 600;
    }

    .nav-menu ul {
        display: flex;
    }

    .nav-menu ul li {
        list-style-type: none;
    }

    .nav-menu ul li .link {
        text-decoration: none;
        font-weight: 500;
        color: #fff;
        padding-bottom: 15px;
        margin: 0 25px;
    }

    .link:hover,
    .active {
        border-bottom: 2px solid #fff;
    }

    .nav-button .btn {
        width: 130px;
        height: 40px;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.4);
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: .3s ease;
    }

    .btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    #registerBtn {
        margin-left: 15px;
    }

    .btn.white-btn {
        background: rgba(255, 255, 255, 0.7);
    }

    .btn.btn.white-btn:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    .nav-menu-btn {
        display: none;
    }

    .form-box {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 512px;
        height: 500px;
        overflow: hidden;
        z-index: 2;
    }

    .login-container {
        position: absolute;
        left: 4px;
        width: 500px;
        display: flex;
        flex-direction: column;
        transition: .5s ease-in-out;
    }

    .register-container {
        position: absolute;
        right: -520px;
        width: 500px;
        display: flex;
        flex-direction: column;
        transition: .5s ease-in-out;
    }

    .top span {
        color: #fff;
        font-size: small;
        padding: 10px 0;
        display: flex;
        justify-content: center;
    }

    .top span a {
        font-weight: 500;
        color: #fff;
        margin-left: 5px;
    }

    header {
        color: #fff;
        font-size: 30px;
        text-align: center;
        padding: 10px 0 30px 0;
    }

    .two-forms {
        display: flex;
        gap: 10px;
    }

    .input-field {
        font-size: 15px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        height: 50px;
        width: 100%;
        padding: 0 10px 0 45px;
        border: none;
        border-radius: 30px;
        outline: none;
        transition: .2s ease;
    }

    .input-field:hover,
    .input-field:focus {
        background: rgba(255, 255, 255, 0.25);
    }

    ::-webkit-input-placeholder {
        color: #fff;
    }

    .input-box i {
        position: relative;
        top: -35px;
        left: 17px;
        color: #fff;
    }

    .submit {
        font-size: 15px;
        font-weight: 500;
        color: black;
        height: 45px;
        width: 100%;
        border: none;
        border-radius: 30px;
        outline: none;
        background: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        transition: .3s ease-in-out;
    }

    .submit:hover {
        background: rgba(255, 255, 255, 0.5);
        box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
    }

    .two-col {
        display: flex;
        justify-content: space-between;
        color: #fff;
        font-size: small;
        margin-top: 10px;
    }

    .two-col .one {
        display: flex;
        gap: 5px;
    }

    .two label a {
        text-decoration: none;
        color: #fff;
    }

    .two label a:hover {
        text-decoration: underline;
    }

    @media only screen and (max-width: 786px) {
        .nav-button {
            display: none;
        }

        .nav-menu.responsive {
            top: 100px;
        }

        .nav-menu {
            position: absolute;
            top: -800px;
            display: flex;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            width: 100%;
            height: 90vh;
            backdrop-filter: blur(20px);
            transition: .3s;
        }

        .nav-menu ul {
            flex-direction: column;
            text-align: center;
        }

        .nav-menu-btn {
            display: block;
        }

        .nav-menu-btn i {
            font-size: 25px;
            color: #fff;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            cursor: pointer;
            transition: .3s;
        }

        .nav-menu-btn i:hover {
            background: rgba(255, 255, 255, 0.15);
        }
    }

    @media only screen and (max-width: 540px) {
        .wrapper {
            min-height: 100vh;
        }

        .form-box {
            width: 100%;
            height: 500px;
        }

        .register-container,
        .login-container {
            width: 100%;
            padding: 0 20px;
        }

        .register-container .two-forms {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<body>
    <!-- Toast Container -->
    <div class="toast-container">
        @if (session('errors'))
            <div class="toast my-toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Kesalahan</strong>
                    <small>Baru saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <ul>
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Ensure Bootstrap JavaScript is Loaded -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Wrap JavaScript Code in Document Ready Function -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle the toast
                    var toastElement = document.querySelector('.my-toast');
                    var toast = new bootstrap.Toast(toastElement);
                    toast.show();
                });
            </script>
        @endif
    </div>

    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>LOGO .</p>
            </div>

            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
                <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
            </div>

        </nav>



        <!----------------------------- Form box ----------------------------------->
        <div class="form-box">

            <!------------------- login form -------------------------->

            <div class="login-container" id="login">

                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                    <header>Login</header>

                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-box">
                        <input type="text" name="username" class="input-field" placeholder="Username or Email">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="submit" value="Sign In">Sign In</button>
                    </div>
                </form>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>

            <!------------------- registration form -------------------------->
            <div class="register-container" id="register">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Name" name="name">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Username" name="username">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="number" class="input-field" placeholder="Nomor Handphone" name="no_hp">
                            <i class='bx bxs-phone'></i>
                        </div>
                        <div class="input-box">
                            <button type="button" class="input-field" data-bs-toggle="modal"
                                data-bs-target="#imageModal">
                                Pilih Profil
                            </button>
                            <input type="hidden" id="imageInput" name="gambar" />
                            <i class='bx bxs-user'></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Email" name="email">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" name="password">
                        <i class="bx bx-lock-alt"></i>
                    </div>

                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>
                </form>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>

                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Select an Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Here, you can display a list of pre-existing images -->
                    <img width="100" src="storage/profile/avatar1.png" value="avatar1.png" alt="Image 1"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar2.png" value="avatar2.png" alt="Image 2"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar3.png" value="avatar3.png" alt="Image 3"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar4.png" value="avatar4.png" alt="Image 4"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar5.png" value="avatar5.png" alt="Image 5"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar6.png" value="avatar6.png" alt="Image 6"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar7.png" value="avatar7.png" alt="Image 7"
                        class="img-thumbnail">
                    <img width="100" src="storage/profile/avatar8.png" value="avatar8.png" alt="Image 8"
                        class="img-thumbnail">
                    <input type="file" name="gambar" id="customImageInput">
                    <!-- Add more images as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {
            // Handle image selection
            $('.img-thumbnail').click(function() {
                var gambarUrl = $(this).attr('src');
                $('#imageInput').val(gambarUrl); // Set the image URL in the hidden input field
                $('#imageModal').modal('hide'); // Close the modal
            });

            // Handle custom image selection from file input
            $('#customImageInput').change(function() {
                var fileInput = $(this)[0];
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var gambarUrl = e.target.result;
                        $('#imageInput').val(
                            gambarUrl); // Set the image URL in the hidden input field
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            // Handle form submission
            $('form').submit(function() {
                var gambarUrl = $('#imageInput').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'gambar',
                    value: gambarUrl
                }).appendTo('form');
            });
        });
    </script>


    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>

    <script>
        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }

        function register() {
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>

</body>

</html>
