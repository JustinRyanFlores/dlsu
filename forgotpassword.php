<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password | DLSU-D</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            width: 420px; /* Adjusted container width */
            background: #fff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-box img {
            max-width: 55%;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #00bf63;
            color: #fff;
            font-size: 18px;
            font-weight: Regular;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: darkgreen;
            color: #fff !important; 
        }
        .form-group {
            position: relative;
        }
        .form-group .fa {
            position: absolute;
            right: 15px;
            top: 12px;
            color: #888;
        }
        .text-muted {
            font-size: 14px;
            display: block;
            margin-top: 15px;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<!-- Forgot Password Form -->
<div class="login-box">
    <img src="images/logo2.png" alt="DLSU-D Logo">
    
    <h3 class="text-center " style="font-weight:bold ">Forgot Password</h3>
    <p class="text-muted">Enter your email address below to receive a password reset link.</p>

    <form action="controller/forgotpasswordController.php" method="POST">
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            <span class="fa fa-envelope"></span>
        </div>
        <button type="submit" class="btn btn-custom" name="sendemail">Send Reset Link</button>
    </form>

    <a href="login.php" class="text-muted">Back to Login</a>
</div>

<!-- Footer with Credits -->
<div class="footer">
    <p>Designed & Developed by <strong>Thesis Tracker</strong> | De La Salle University Dasmariñas &copy; 2025</p>
</div>

<!-- Bootstrap Scripts -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
