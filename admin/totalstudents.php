<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 

      $selectdepartment = $_POST['selectdepartment'];
      
        
           if (!isset($selectdepartment)) {
            
            $sql = "SELECT *,COUNT(teams_member.teams_member_id) AS totalstudents FROM teams_member INNER JOIN users on teams_member.users_id=users.id";
          
           } else {
            if($_SESSION['type'] == 0){
                $sql = "SELECT *,COUNT(teams_member.teams_member_id) AS totalstudents FROM teams_member INNER JOIN users on teams_member.users_id=users.id WHERE users.department='".$selectdepartment."'";
            } elseif ($_SESSION['type'] == 1) {
                $sql = "SELECT *,COUNT(teams_member.teams_member_id) AS totalstudents FROM teams_member INNER JOIN users on teams_member.users_id=users.id WHERE users.department='".$selectdepartment."' AND teams_member.adviser_id = '".$_SESSION['id']."'";
            }
    
           }
            
            $stmt = $this->conn()->query($sql);
            $row3 = $stmt->fetch(); ?>
           
            STUDENT: <?php echo $row3['totalstudents']; 
?>
<?php } } $data = new data(); $data->managedata(); ?>