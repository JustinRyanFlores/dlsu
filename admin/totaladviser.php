<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
        if($_SESSION['type'] == 0){
          $selectdepartment = $_POST['selectdepartment'];
           if ($selectdepartment == "Information Technology") {
            
            $sql = "SELECT * FROM totalgroups WHERE id = 2";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
          
           } else {
    
            $sql = "SELECT * FROM totalgroups WHERE id = 3";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
    
           }
            
            $stmt = $this->conn()->query($sql);
            $row3 = $stmt->fetch(); ?>
           
            ADVISER:<?php echo $row['total'];
    }
?>

<?php } } $data = new data(); $data->managedata(); ?>