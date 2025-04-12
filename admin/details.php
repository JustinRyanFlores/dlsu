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
        <div class="box-header with-border">
                  <?php if($_SESSION['type'] == 1): ?>
                    <a href="managegroupmembersdetails.php?teams_id=<?php echo $_GET['teams_id'] ?>" class="btn btn-lg btn-flat custom-btn" style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fa fa-chevron-left"></i> BACK</a> 
                  <?php endif; ?>
                  <?php if($_SESSION['type'] == 2): ?>
                    <a href="teams.php" class="btn btn-lg btn-flat custom-btn" style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fa fa-chevron-left"></i> BACK</a> 
                  <?php endif; ?>
                </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="box" style="border-top: unset;">
              <div class="box-body table-responsive">

                <div>
                  <?php 
                    $sql = "SELECT * FROM teams WHERE teams_id = '".$_GET['teams_id']."'";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch(); ?>
                    <h4 style="font-size: 23px;font-style: normal;font-weight: bold;"><?php echo $row['name'] ?></h4>
                </div>
                    <?php 
                    $sql = "SELECT * FROM users WHERE id = '".$_GET['users_id']."'";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch(); ?>
                    <div class="form-group">
                      <label>Fullname</label>
                      <div class="form-control"><?php echo ucwords($row['firstname']) ?> <?php echo ucwords($row['lastname']) ?></div>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <div class="form-control"><?php echo $row['email'] ?></div>
                    </div>
                    
                    <?php if($_SESSION['type'] == 1): ?>
                        <?php  
                            $sql = "SELECT individual_grade FROM teams_member WHERE users_id = ?";
                            $stmt = $this->conn()->prepare($sql);
                            $stmt->execute([$_GET['users_id']]);
                            
                            $grade = $stmt->fetch();
                            $selected_grade = $grade['individual_grade'];
                        ?>
                        <form method="post" action="../controller/detailsController.php">
                            <input type="hidden" name="user_id" value="<?= $_GET['users_id'] ?>">
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control">
                                    
                                    <?php if ($selected_grade == 0 || $selected_grade == NULL): ?>
                                        <option value="" disabled selected>Not Yet Graded</option>
                                    <?php endif; ?>
                                
                                    <?php 
                                    $grades = ["4.00", "3.75", "3.50", "3.25", "3.00", "2.75", "2.50", "2.25", "2.00", "1.75", "1.50", "1.25", "1.00", "0.00"];
                                    
                                    foreach ($grades as $g): ?>
                                        <option value="<?= $g ?>" <?= ($selected_grade == $g) ? 'selected' : '' ?>><?= $g ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit" name="change_grade">Save</button>
                        </form>
                    <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/viewtasklistModal.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>