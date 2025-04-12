<?php 
    include '../gmail.php';
    include '../config/config.php';
    class data extends Connection{
        public function managdata(){
            $user_email_address = $_SESSION['user_email_address'];
            $sql = "SELECT id FROM users WHERE user_email_address = '".$user_email_address."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $users_id = $row['id'];

            $sql = "SELECT COUNT(users_id) AS total_users_id FROM wishlist WHERE users_id = '".$users_id."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch(); 
            echo $row['total_users_id'];
        }
    }
    $datarun = new data();
    $datarun->managdata();
 ?>
















