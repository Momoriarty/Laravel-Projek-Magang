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
