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
          <a href="viewgroup.php?teams_id=<?php echo $_GET['teams_id'] ?>" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th style="font-size: 23px;font-style: normal;">Groups</th>
                    <th style="font-size: 23px;font-style: normal;">Status</th>
                    <th style="font-size: 23px;font-style: normal;"></th>
                  </thead>
                  <tbody>
                    <?php 

                    if($_SESSION['type'] == 1){
                      $sql = "SELECT * FROM teams WHERE adviser_id = '".$_SESSION['id']."'";
                    } else {
                      $sql = "SELECT * FROM teams";
                    }
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) {

                    if($_SESSION['type'] == 0){
                      $sql2 = "SELECT * FROM users WHERE id = '".$row['adviser_id']."'";
                      $stmt2 = $this->conn()->query($sql2);
                      $row2 = $stmt2->fetch();
                    }

                     ?>
                      <tr>
                        <td style="font-size: 23px;font-style: normal;"><?php echo $row['name'] ?> 
                        <?php if($_SESSION['type'] == 0 AND $stmt2->rowcount() > 0): ?>
                          (<?php echo $row2['firstname'] ?> <?php echo $row2['lastname'] ?>)
                        <?php endif; ?>
                        </td>
                        <td>
                          <?php 
                          if ($row['status'] == 0) {
                          } else if ($row['status'] == 1) {
                            echo "<span class='badge btn-success'>Passed</span>";
                          } else if ($row['status'] == 2) {
                            echo "<span class='badge btn-danger'>Redefense</span>";
                          } else if ($row['status'] == 3) {
                            echo "<span class='badge btn-danger'>Failed</span>";
                          }
                           ?>
                        </td>
                        <td>
                          <a href="managegroupmembersdetails.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-success btn-sm btn-flat' >DETAILS</a>
                          <?php if($_SESSION['type'] == 1): ?>
                          <button class='btn btn-primary btn-sm changestatus btn-flat' 
                          data-changestatus_teams_id='<?php echo $row['teams_id'] ?>'
                          >Change Status</button>
                          <button class='btn btn-danger btn-sm deleteteams btn-flat' 
                          data-deleteteams_teams_id='<?php echo $row['teams_id'] ?>'
                          >REMOVE</button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/teamsModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_teams_id = $(this).data('edit_teams_id');
      var edit_name = $(this).data('edit_name');

      $('#edit_teams_id').val(edit_teams_id)
      $('#edit_name').val(edit_name)
    });

    $(document).on('click', '.changestatus', function(e){
      e.preventDefault();
      $('#changestatus').modal('show');
      var changestatus_teams_id = $(this).data('changestatus_teams_id');
      $('#changestatus_teams_id').val(changestatus_teams_id)
    });

    $(document).on('click', '.changestatus2', function(e){
      e.preventDefault();
      $('#changestatus2').modal('show');
      var changestatus2_teams_id = $(this).data('changestatus2_teams_id');
      $('#changestatus2_teams_id').val(changestatus2_teams_id)
    });

    $(document).on('click', '.deleteteams', function(e){
      e.preventDefault();
      $('#deleteteams').modal('show');
      var deleteteams_teams_id = $(this).data('deleteteams_teams_id');
      $('#deleteteams_teams_id').val(deleteteams_teams_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>