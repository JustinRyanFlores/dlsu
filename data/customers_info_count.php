<?php 
    include '../config/config.php';
    class data extends Connection{
        public function managdata(){
            $sql = "SELECT *,COUNT(customers_info_id) as totalnotif FROM customers_info WHERE customers_info_notif = 1";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();

            echo $row['totalnotif'];
        }
    }
    $datarun = new data();
    $datarun->managdata();
 ?>

