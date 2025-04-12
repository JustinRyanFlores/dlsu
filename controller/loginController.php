<?php
  
  include '../config/config.php';
  session_start();
  
  class login extends Connection{
  
    public function loginuser(){ 

      if (isset($_POST['signin'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowcount() > 0) {

          $row = $stmt->fetch();

          if (password_verify($password, $row['password'])) {
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['type'] = $row['type'];

            if ($row['type'] == 2) {
              header('location:../admin/dashboard.php');
            } else if ($row['type'] == 1) {

              if ($row['status'] == 0) {
                echo "<script type='text/javascript'>alert('Your Account need Approval by an admin');</script>";
                echo "<script>window.location.href='../login.php';</script>";
              } else {
                header('location:../admin/dashboard.php');
              }
              

            } else {
              header('location:../admin/dashboard.php');
            }
            
        
          } else {

            echo "<script type='text/javascript'>alert('Invalid Password');</script>";
            echo "<script>window.location.href='../login.php';</script>";

          }

        } else {

            echo "<script type='text/javascript'>alert('Invalid Email And Password');</script>";
            echo "<script>window.location.href='../login.php';</script>";

        } 
       
      } 
         
    }

  }
  
  $loginrun = new login();
  $loginrun->loginuser();

?>



