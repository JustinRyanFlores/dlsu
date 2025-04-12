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
            <?php $sql = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_member.teams_id='".$_GET['teams_id']."'";
            $stmt = $this->conn()->query($sql);
            while ($row = $stmt->fetch()) { ?>
              <div class="col-lg-2 col-12">
                <div class="small-box" style="background-color: #e7e9ec6e !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: 350px;">
                  <div class="inner" style="text-align: center;">
                    <img src="../images/<?= $row['img'] ?>" width="35px" height="35px" style="border-radius: 50%;">
                      <p style="color:#000;font-weight: bold;font-size: 23px;margin: 30px 0px;"><?php echo ucwords($row['firstname']); ?> <?php echo ucwords($row['lastname']); ?></p>
                      <a href="details.php?users_id=<?php echo $row['users_id'] ?>&teams_id=<?php echo $row['teams_id'] ?>" class="btn" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;margin: auto;width: 100px;">DETAILS</a>
                      <?php if($_SESSION['type'] == 1): ?>
                        <button class="btn delete" data-delete_teams_member_id="<?php echo $row['teams_member_id'] ?>" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;width: 100px;margin: 5px auto;">REMOVE</button>
                      <?php endif; ?>
                  </div>
                </div>
              </div>  
            <?php } ?>
          </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/viewmembersModal.php'; ?>
  <script>
    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var delete_teams_member_id = $(this).data('delete_teams_member_id');
      $('#delete_teams_member_id').val(delete_teams_member_id)
    });
 
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>