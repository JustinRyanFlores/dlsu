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
              <form method="POST" action="../controller/setdeadlineController.php">
                <input type="hidden" name="teams_id" value="<?php echo $_GET['teams_id'] ?>">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>List</th>
                      <th>Title</th>
                      <th>Deadline</th>
                      <th>Graded</th>
                      <?php if($_SESSION['type'] == 1): ?>
                      <th>Reminder</th>
                      <?php endif; ?>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM setdeadline WHERE teams_id = '".$_GET['teams_id']."'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) { ?>
                        <tr>
                          <td><?php echo $id; ?></td>
                          <td><?php echo $row['name'] ?></td>
                          <td>
                            <input type="hidden" name="setdeadline_id[]" value="<?php echo $row['setdeadline_id'] ?>">
                            <input type="date" name="deadline[]" value="<?php echo $row['deadline'] ?>" class="form-control" style="border: 2px solid black;color: #000;border-radius: 5px;">
                          </td>
                          <td>
                            <?php
                      $sql = "SELECT * FROM teams WHERE teams_id= '".$_GET['teams_id']."'";
                      $stmt6 = $this->conn()->query($sql);
                      $row6 = $stmt6->fetch();
               
                          if ($row6['status'] == 1) {
                            echo "<span class='badge btn-success'>GRADED</span>";
                          }
                           
                      ?>
                          </td>
                          <?php if($_SESSION['type'] == 1): ?>
                          <td>
                            <a class='btn btn-sm setreminder btn-flat' 
                            data-setreminder_teams_id='<?php echo $row['teams_id'] ?>'
                            data-setreminder_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'
                             style="border: 2px solid black;color: #000;border-radius: 5px;">REMINDER</a>
                          </td>
                          <?php endif; ?>
                          <td>
                            <?php 
                            if ($row['status'] == 0) {
                              echo "<span class='badge btn-warning' style='padding: 10px 20px;'>ONGOING</span>";
                            } else if ($row['status'] == 1) {
                              echo "<span class='badge btn-primary' style='padding: 10px 20px;'>SCHEDULED</span>";
                            } else if ($row['status'] == 2) {
                              echo "<span class='badge btn-danger' style='padding: 10px 20px;'>PAST DUE</span>";
                            } else if ($row['status'] == 3) {
                              echo "<span class='badge btn-success' style='padding: 10px 20px;'>COMPLETED</span>";
                            }
                             ?>
                          </td>
                          <td>
                          <a href="managegroupmembersdetails.php?teams_id=<?php echo $row['teams_id'] ?>&label=setdeadline" class='btn btn-sm btn-flat' style="border: 2px solid black;color: #000;border-radius: 5px;">DETAILS</a>
                          <?php if($_SESSION['type'] == 1): ?>
                          <a class='btn btn-sm changestatus btn-flat' 
                          data-changestatus_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'
                           style="border: 2px solid black;color: #000;border-radius: 5px;">Change Status</a>
                          <?php endif; ?>
                        </td>
                        </tr>
                      <?php $id++; } ?>
                    </tbody>
                  </table>
                  <?php if($_SESSION['type'] == 1): ?>
                  <div style="text-align: right;">
                    <button type="submit" name="setdeadline" class='btn btn-primary btn-sm btn-flat' style="width: 200px;height: 50px;font-size: 25px;font-weight: bold;" 
                            >SAVE</button>
                  </div>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/setdeadlineModal.php'; ?>
  <script>
    $(document).on('click', '.setreminder', function(e){
      e.preventDefault();
      $('#setreminder').modal('show');
      var setreminder_teams_id = $(this).data('setreminder_teams_id');
      var setreminder_setdeadline_id = $(this).data('setreminder_setdeadline_id');

      $('#setreminder_teams_id').val(setreminder_teams_id)
      $('#setreminder_setdeadline_id').val(setreminder_setdeadline_id)

    });

    $(document).on('click', '.changestatus', function(e){
      e.preventDefault();
      $('#changestatus').modal('show');
      var changestatus_setdeadline_id = $(this).data('changestatus_setdeadline_id');
      $('#changestatus_setdeadline_id').val(changestatus_setdeadline_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>