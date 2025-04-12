<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 

      $selectdepartment = $_POST['selectdepartment'];
      
        if ($_SESSION['type'] == 0) {
            $sql = "SELECT *,COUNT(teams_id) AS totalgroups FROM teams INNER JOIN users ON teams.users_id=users.id WHERE users.department = '".$selectdepartment."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch(); 
        } elseif ($_SESSION['type'] == 1) {
            $sql = "SELECT *,COUNT(teams_id) AS totalgroups FROM teams INNER JOIN users ON teams.users_id=users.id WHERE users.department = '".$selectdepartment."'  AND teams.adviser_id = '".$_SESSION['id']."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch(); 
        }
?>
        GROUPS: <?php echo $row['totalgroups']; ?>

<?php } } $data = new data(); $data->managedata(); ?>