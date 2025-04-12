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
          <a href="teams.php" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-4 col-12">
            <a href="managegroupmembersdetails.php?teams_id=<?php echo $_GET['teams_id'] ?>">
              <div class="small-box" style="border: 2px solid #000;color:#000;border-radius: 30px;height: 350px;padding: 30px;display: grid;place-items: center;">
                <div style="text-align: center;">
                  <h2 style="margin: unset;">Manage Group Members</h2>
                  <br>
                  <img src="../images/Manage Group Icon.png" width="100px">
                </div>
              </div>
            </a>
          </div>  
          <div class="col-lg-4 col-12">
            <a href="monitorthesis.php?teams_id=<?php echo $_GET['teams_id'] ?>">
              <div class="small-box" style="border: 2px solid #000;color:#000;border-radius: 30px;height: 350px;padding: 30px;display: grid;place-items: center;">
                <div style="text-align: center;">
                  <h2 style="margin: unset;">Monitor Thesis</h2>
                  <br>
                  <img src="../images/Monitor Thesis Icon.png" width="100px">
                </div>
              </div>
            </a>
          </div> 
          <div class="col-lg-4 col-12">
            <a href="setdeadline.php?teams_id=<?php echo $_GET['teams_id'] ?>">
              <div class="small-box" style="border: 2px solid #000;color:#000;border-radius: 30px;height: 350px;padding: 30px;display: grid;place-items: center;">
                <div style="text-align: center;">
                  <h2 style="margin: unset;">Set Deadline</h2>
                  <br>
                  <img src="../images/Set Deadline Icon.png" width="100px">
                </div>
              </div>
            </a>
          </div> 
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>