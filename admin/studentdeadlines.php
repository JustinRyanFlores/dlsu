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
        <div style="display: flex;justify-content: space-between;">
          <a href="dashboard.php" class='btn btn-lg btn-flat' style="border: 2px solid #000;border-radius: 10px;color: #000;font-style: normal;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>

          <?php
$sql = "SELECT *,teams.name AS teams_name,teams.teams_id AS teams_teams_id FROM teams_member INNER JOIN teams ON teams_member.teams_id=teams.teams_id WHERE teams_member.users_id= '".$_SESSION['id']."'";
          $stmt2 = $this->conn()->query($sql);
          $row4 = $stmt2->fetch();
          ?>
          <div style="text-align: right;font-size: 23px;color: #00bf63;font-weight: bold;color: #000;font-style: normal;">
            (<?php echo $row4['teams_name']; ?>) - Deadlines
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <div class="box" style="border: unset;">
              <div class="box-body table-responsive">
                <?php if($_SESSION['type'] != 1): ?>
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th style="font-size: 23px;font-style: normal;">Deadline</th>
                      <th style="font-size: 23px;font-style: normal;">Due Date</th>
                      <th style="font-size: 23px;font-style: normal;">Status</th>
                    </thead>
                    <tbody>
                      <?php 

                      $sql = "SELECT * FROM teams_member WHERE users_id = '".$_SESSION['id']."'";
                      $stmt = $this->conn()->query($sql);
                      $row = $stmt->fetch();
                      
                      if ($stmt->rowcount() > 0) {
                        $teams_id = $row['teams_id'];
                      } else {
                        $teams_id = 0;
                      }

                      $sql = "SELECT * FROM setdeadline WHERE teams_id = '".$teams_id."'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) {

                        $sql3 = "SELECT * FROM teams WHERE users_id = '".$_SESSION['id']."'";
                        $stmt3 = $this->conn()->query($sql3);

                       ?>
                        <tr>
                          <td style="font-size: 23px;font-style: normal;"><?php echo $row['name'] ?></td>
                          <td style="font-size: 23px;font-style: normal;"><?php echo date('F j, Y', strtotime($row['deadline'])) ?></td>
                          <td style="font-size: 23px;font-style: normal;">
                            <?php 
                            if ($row['status'] == 0) {
                              echo "<span class='badge btn-warning' style='padding: 10px 20px; width: 100%;'>ONGOING</span>";
                            } else if ($row['status'] == 1) {
                              echo "<span class='badge btn-primary' style='padding: 10px 20px; width: 100%;'>SCHEDULED</span>";
                            } else if ($row['status'] == 2) {
                              echo "<span class='badge btn-danger' style='padding: 10px 20px; width: 100%;'>PAST DUE</span>";
                            } else if ($row['status'] == 3) {
                              echo "<span class='badge btn-success' style='padding: 10px 20px; width: 100%;'>COMPLETED</span>";
                            }
                             ?>
                          </td>
                        </tr>
                      <?php $id++; } ?>
                    </tbody>
                  </table>
                <?php endif; ?>

                <?php if($_SESSION['type'] == 1): ?>
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>List</th>
                      <th>Teams</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM teams WHERE adviser_id = '".$_SESSION['id']."'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) { ?>
                        <tr>
                          <td><?php echo $id; ?></td>
                          <td><?php echo $row['name'] ?></td>
                          <td>
                            <a href="viewtasklist.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-warning btn-sm btn-flat' 
                            >VIEW</a>
                          </td>
                        </tr>
                      <?php $id++; } ?>
                    </tbody>
                  </table>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/tasklistModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#addnew').modal('show');
      var edit_setdeadline_id = $(this).data('edit_setdeadline_id');

      $('#edit_setdeadline_id').val(edit_setdeadline_id)
    });

    $(document).on('click', '.uploadfile', function(e){
      e.preventDefault();
      $('#uploadfile').modal('show');
      var uploadfile_setdeadline_id = $(this).data('uploadfile_setdeadline_id');

      $('#uploadfile_setdeadline_id').val(uploadfile_setdeadline_id)
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();

      $('#delete').modal('show');
      var delete_templates_id = $(this).data('delete_templates_id');
      
      $('#delete_templates_id').val(delete_templates_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>