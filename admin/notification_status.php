<?php 
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
      $sql = "SELECT * FROM notification WHERE status = 0";
      $stmt = $this->conn()->query($sql);
      if ($stmt->rowcount() > 0) { 
        echo 0;
      } else {
        echo 1;
      }


} } $data = new data(); $data->managedata(); ?>