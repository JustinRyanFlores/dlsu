<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>De La Salle University DASMARINAS</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
 <style>
    .form-group {
      position: relative;
    }
    .error-message {
      color: red;
      font-size: 1.2rem;
      margin-top: 5px;
      display: none;
    }
    .valid {
      color: green;
      font-size: 1.2rem;
      display: none;
    }
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 12px;
      cursor: pointer;
    }
    .title {
    font-size: 24px; 
    color: #3ea1db; 
    font-weight: 600;
    letter-spacing: 3px;
  }
  </style>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body" style="padding: 20px 30px;">
      <div style="width: 100%;text-align: center;">
        <img src="images/thesishub_logo2.png" width="30%">
        <p class="text-center title">THESIS TRACKER</p>
        <img src="images/logo2.png" width="30%">
      </div> 
      <div style="display: flex;justify-content: space-evenly;padding: 0px 50px;">
        <h3 class="text-center" style="border-bottom: 3px solid #3ea1db;width: 100%;padding: 5px;"><a href="login.php" class="text-decoration-none" style="color: #000;">Login</a></h3>
        <h3 class="text-center" style="width: 100%;padding: 5px;"><a href="register.php" class="text-decoration-none" style="color: #000;">Signup</a></h3>
      </div>
      <br>
      <p class="login-box-msg">Sign in to start your session</p>
      <br>
      <form action="controller/loginController.php" method="POST">
          <div class="form-group has-feedback form-control" style="height: 45px;">
            <input type="email" name="email" placeholder="Email" style="width: 100%;height: 100%;border: unset;box-shadow: none;outline-style: none;" required>
            <span class="fa fa-at form-control-feedback" style="margin-top: 6px;"></span>
          </div>
          <div class="form-group has-feedback form-control" style="height: 45px;margin-bottom: 10px;">
            <input type="password" name="password" id="password" placeholder="******" style="width: 100%;height: 100%;border: unset;box-shadow: none;outline-style: none;" required>
            <i class="fa fa-eye-slash toggle-password" style="position: absolute; right: 15px; top: 10px; cursor: pointer;margin-top: 6px;"></i>
          </div>
          <div class="error-message text-danger" id="password-error" style="margin-bottom: 10px;">
            Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one number.
          </div>
          <div class="valid" id="password-valid" style="margin-bottom: 10px;">
            Password meets all requirements.
          </div>
          <div>
            <a href="forgotpassword.php" class="text-decoration-none" style="color: #3ea1db;">Forgot Password?</a>
          </div><br>
          <div class="row">
          <div class="col-xs-12">
                <button type="submit" class="btn btn-block btn-flat submit" style="background: #3ea1db; color: #fff; border: unset;height: 45px;font-size: 23px;" name="signin"  disa>Login</button>
              </div>
          </div>
      </form>
      <br>
    </div>
</div>

<script src="dist/js/jquery.js"></script>
<script>
  $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye-slash fa-eye");
      var input = $(this).prev("input");
      if (input.attr("type") === "password") {
          input.attr("type", "text");
      } else {
          input.attr("type", "password");
      }
  });
</script>

<script>
    $(document).ready(function () {
      const passwordInput = $("#password");
      const errorMessage = $("#password-error");
      const validMessage = $("#password-valid");
      const submitButton = $(".submit");

      // Password validation rules
      const validatePassword = (password) => {
        const minLength = 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumber;
      };

      // Validate password on input
      passwordInput.keyup(function () {
        const password = $(this).val();
        if (validatePassword(password)) {
          errorMessage.hide();
          validMessage.show();
       //   submitButton.prop("disabled", false);
        } else {
          errorMessage.show();
          validMessage.hide();
       //   submitButton.prop("disabled", true);
        }
      });
    });
  </script>
</body>
</html>
