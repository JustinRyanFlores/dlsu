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
          <a href="tasklist.php" class='btn btn-lg' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <?php if($_SESSION['type'] == 1): ?>
                <div class="box-header with-border">
                   <a href="#addnew" data-toggle="modal" class="btn btn-success custom-btn"><i class="fa fa-plus"></i> Add Task</a> 
                </div>
              <?php endif; ?>
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th style="font-size: 23px;font-style: normal;">Title</th>
                    <th style="font-size: 23px;font-style: normal;">Due Date</th>
                    <th style="font-size: 23px;font-style: normal;">Status</th>
                    <th style="font-size: 23px;font-style: normal;">Action</th>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = "SELECT setdeadline.*, reminder.notes FROM setdeadline LEFT JOIN reminder ON reminder.setdeadline_id = setdeadline.setdeadline_id WHERE setdeadline.teams_id = '".$_GET['teams_id']."'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) { ?>
                      <tr>
                        <td style="font-size: 23px;font-style: normal;">
                            <?php 
                                echo "<span style='display:inline-block; margin-right: 20px;'>{$row['name']}</span>";
                                if($row['notif'] == 1) {
                                    echo "<div title='New file uploaded' style='display:inline-block; width: 7px;height: 7px;border-radius: 50%;background: red;box-shadow: 0px 0px 5px red;'>";
                                }
                            ?>
                        </td>
                        <td style="font-size: 23px;font-style: normal;"><?= ($row['deadline'] != NULL || $row['deadline'] != 0) ? date('F j, Y', strtotime($row['deadline'])) : "~" ?></td>
                        <td class="text-center" style="font-size: 23px;font-style: normal;">
                          <?php 
                            if ($row['status'] == 0) {
                              echo "<span class='badge btn-warning' style='padding: 10px 20px;width: 100%;'>ONGOING</span>";
                            } else if ($row['status'] == 1) {
                              echo "<span class='badge btn-primary' style='padding: 10px 20px; width: 100%;'>SCHEDULED</span>";
                            } else if ($row['status'] == 2) {
                              echo "<span class='badge btn-danger' style='padding: 10px 20px; width: 100%;'>PAST DUE</span>";
                            } else if ($row['status'] == 3) {
                              echo "<span class='badge btn-success' style='padding: 10px 20px; width: 100%;'>COMPLETED</span>";
                            }
                             ?>
                        </td>
                        <td class="text-center">
                            
                          <button class='btn btn-primary btn-sm edit btn-table' 
                          data-edit_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'
                          >COMMENT</button>
                          
                          <?php if($_SESSION['type'] == 1): ?>
                          
                            <button class='btn btn-success btn-sm edit2 btn-table' 
                            data-edit2_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'
                            data-edit2_name='<?php echo $row['name'] ?>'
                            data-edit2_deadline='<?php echo $row['deadline'] ?>'
                            data-edit2_status='<?php echo $row['status'] ?>'
                            data-edit2_notes='<?php echo $row['notes'] ?>'
                            >EDIT</button>
                            
                            <button class='btn btn-danger btn-sm delete btn-table' 
                            data-delete_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'
                            >REMOVE</button>

                            <a href="tasklistfile.php?setdeadline_id=<?php echo $row['setdeadline_id'] ?>&teams_id=<?php echo $_GET['teams_id'] ?>" class='btn btn-primary btn-sm btn-table'>VIEW FILE</a>
                            
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
  <?php include 'modal/viewtasklistModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_setdeadline_id = $(this).data('edit_setdeadline_id');
      $('#edit_setdeadline_id').val(edit_setdeadline_id)
    });

    $(document).on('click', '.edit2', function(e){
      e.preventDefault();
      $('#edit2').modal('show');
      var edit2_setdeadline_id = $(this).data('edit2_setdeadline_id');
      var edit2_name = $(this).data('edit2_name');
      var edit2_deadline = $(this).data('edit2_deadline');
      var edit2_status = $(this).data('edit2_status');
      var edit2_notes = $(this).data('edit2_notes');
      
      
      $('#edit2_setdeadline_id').val(edit2_setdeadline_id)
      $('#edit2_name').val(edit2_name)
      $('#edit2_deadline').val(edit2_deadline)
      $('#edit2_status').val(edit2_status)
      $('#edit2_notes').val(edit2_notes)
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var delete_setdeadline_id = $(this).data('delete_setdeadline_id');
      $('#delete_setdeadline_id').val(delete_setdeadline_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>