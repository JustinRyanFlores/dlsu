<?php 
  session_start();
  
  if(!isset($_SESSION['id'])){
        header('location:../logout.php');
        exit;
    }
  
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?></head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'profile.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content-wrapper" style="height: 100vh;background-color: #f9f9f9;overflow-y: auto;">
      <section class="content">
          <div class="row">
            <?php $sql = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_member.teams_id = '".$_GET['teams_id']."'";
            $stmt = $this->conn()->query($sql);
            while ($row = $stmt->fetch()) { ?>
              <div class="col-lg-2 col-12">
                <div class="small-box" style="background-color: #e7e9ec6e !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: 350px;">
                  <div class="inner" style="text-align: center;">
                      <i class="fas fa-user-circle" style="font-size: 35px;color:#000;"></i>
                      <p style="color:#000;font-weight: bold;font-size: 23px;margin: 30px 0px;"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                      <button class="btn" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;margin: auto;width: 100px;">DETAILS</button>
                      <button class="btn delete" data-delete_teams_member_id="<?php echo $row['teams_member_id'] ?>" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;width: 100px;margin: 5px auto;">REMOVE</button>
                      <button class="btn" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;margin: auto;width: 100px;">GRADE</button>
                  </div>
                </div>
              </div>  
            <?php } ?>
          </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>