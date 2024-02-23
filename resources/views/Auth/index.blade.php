@extends('auth/layout/navbar')
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
                        <label><a href="{{ 'forgot_password' }}">Forgot password?</a></label>
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
                            <i class="bx bx-user"></i>

                        </div>
                        <div class="input-box ">
                            <input type="hidden" id="imageInput" name="gambar" />
                            <img id="selectedImage" style="display:none" width="50" class="img-thumbnail mt-2"
                                alt="Selected Image">
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Email" name="email">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="input-box">
                                <input type="password" class="input-field" placeholder="Password" name="password">
                                <i class="bx bx-lock-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="input-box">
                                <input type="password" class="input-field" placeholder="Konfirmasi Password"
                                    name="k_password">
                                <i class="bx bx-lock-alt"></i>
                            </div>
                        </div>
                    </div>


                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>

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
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img width="100" src="/storage/profile/avatar1.png" value="avatar1.png" alt="Image 1"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar2.png" value="avatar2.png" alt="Image 2"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar3.png" value="avatar3.png" alt="Image 3"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar4.png" value="avatar4.png" alt="Image 4"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar5.png" value="avatar5.png" alt="Image 5"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar6.png" value="avatar6.png" alt="Image 6"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar7.png" value="avatar7.png" alt="Image 7"
                        class="img-thumbnail">
                    <img width="100" src="/storage/profile/avatar8.png" value="avatar8.png" alt="Image 8"
                        class="img-thumbnail">
                    <input type="file" name="gambar" id="customImageInput">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@extends('auth/layout/footer')