<?php 
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
      $sql = "UPDATE notification SET status = 1 WHERE status = 0";
      $stmt = $this->conn()->query($sql);
      $stmt->execute([]);
 } } $data = new data(); $data->managedata(); ?>