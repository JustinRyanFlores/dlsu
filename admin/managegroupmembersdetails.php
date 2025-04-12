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
        <div>
          <?php if (isset($_GET['label']) == 'setdeadline') { ?>
            <a href="setdeadline.php?teams_id=<?php echo $_GET['teams_id'] ?>" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
          <?php } else { ?>
            <a href="teams.php" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
          <?php } ?>
          
        </div>
        <br>
          <div class="row">
            <?php 
            $sql = "SELECT * FROM teams WHERE users_id= '".$_SESSION['id']."' OR adviser_id= '".$_SESSION['id']."'";
            $stmt5 = $this->conn()->query($sql);

            $sql = "SELECT * FROM teams WHERE teams_id= '".$_GET['teams_id']."'";
            $stmt6 = $this->conn()->query($sql);
            $row2 = $stmt6->fetch();

            $sql = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_member.teams_id = '".$_GET['teams_id']."'";
            $stmt = $this->conn()->query($sql);
            while ($row = $stmt->fetch()) { ?>
              <div class="col-lg-2 col-12">
                <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: 350px;">
                  <div class="inner" style="text-align: center;">
                      <img src="../images/<?= $row['img'] ?>" width="35px" height="35px" style="border-radius: 50%;">
                      <p style="color:#000;font-weight: bold;font-size: 23px;margin: 10px 0px;"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                      <p style="color:#000;font-weight: normal;font-size: 18px;margin: 0;"><?php echo $row['section']; ?></p>
                      <?php if($row['individual_grade'] == NULL || $row['individual_grade'] == 0): ?>
                        <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to add grade">Grade: in Progress</p>
                      <?php else: ?>
                       <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to change grade">Grade: <?php echo $row['individual_grade']; ?></p>
                      <?php endif ?>
                      <a href="details.php?users_id=<?php echo $row['users_id'] ?>&teams_id=<?php echo $_GET['teams_id'] ?>" class="btn" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;margin: auto;width: 100px;">DETAILS</a>
                      <?php if($stmt5->rowcount() > 0): ?>
                      <button class="btn delete" data-delete_teams_member_id="<?php echo $row['teams_member_id'] ?>" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;width: 100px;margin: 5px auto;">REMOVE</button>
                      <?php else: ?>
                        <br>
                      <?php endif; ?>
                      <?php 
                           if ($row2['status'] == 1) {
                            echo "<span class='badge btn-success'>GRADED</span>";
                          }
                           ?>
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