<?php 
    session_start();
    include '../config/config.php';
    class data extends Connection{
        
        public function managdata(){
            $users_id = $_SESSION['id'];
            $sql = "SELECT *,COUNT(id) as totalnotif FROM chat WHERE sender_id = '$users_id' AND chat_notif = 1 OR receiver_id = '$users_id' AND chat_notif = 1";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();

            echo $row['totalnotif'];
        }
    }
    $datarun = new data();
    $datarun->managdata();
 ?>
















