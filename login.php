<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>De La Salle University DASMARINAS</title>
    <link rel="icon" href="images/logo.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .login-box {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 22px;
            color: #3ea1db;
            font-weight: bold;
            letter-spacing: 2px;
            text-align: center;
        }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .toggle-password:hover {
            color: #3ea1db;
        }
        .form-control {
            height: 45px;
            padding-right: 40px;
        }
        .btn-primary {
            background: #3ea1db;
            border: none;
            height: 45px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background: #2b82b5;
        }
        .login-links a {
            color: #3ea1db;
            text-decoration: none;
        }
        .login-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-box">
        <div class="text-center">
            <img src="images/thesishub_logo2.png" width="30%">
            <p class="title mt-2">THESIS TRACKER</p>
            <img src="images/logo2.png" width="50%">
        </div>
        
        <div class="text-center my-3">

        </div>
        
        <p class="text-center text-muted">Sign in to start your session</p>

        <form action="controller/loginController.php" method="POST">
            <div class="mb-3 position-relative">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <i class="fa fa-at position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <i class="fa fa-eye-slash toggle-password"></i>
            </div>

            <div class="error-message text-danger small d-none" id="password-error">
                Password must be at least 8 characters long, include an uppercase, lowercase, and a number.
            </div>
            <div class="valid small text-success d-none" id="password-valid">
                Password meets all requirements.
            </div>

            <div class="text-end login-links">
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3" name="signin">Login</button>
            <hr class="my-4">

            <div class="text-center d-flex justify-content-center align-items-center">
                <p class="mb-0 me-2">Don't have an account?</p>
                <a href="register.php" class="btn btn-link text-primary p-0">Click here</a>
            </div>

           
        
        </form>
    </div>
</div>

<div class="text-center mt-4">
    <p class="text-muted small">
        Designed & Developed by <strong>Team ACE</strong> |  De La Salle University Dasmariñas &copy; 2025
    </p>
</div>
<!-- Bo

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (Required for Toggle Script) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye-slash fa-eye");
            let input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        const passwordInput = $("#password");
        const errorMessage = $("#password-error");
        const validMessage = $("#password-valid");

        function validatePassword(password) {
            return password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password);
        }

        passwordInput.keyup(function () {
            const password = $(this).val();
            if (validatePassword(password)) {
                errorMessage.addClass("d-none");
                validMessage.removeClass("d-none");
            } else {
                errorMessage.removeClass("d-none");
                validMessage.addClass("d-none");
            }
        });
    });
</script>


</body>
</html>
