<?php 
  session_start();
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
          <div class="col-xs-12">
            <div class="box">
              <h3 style="text-align: center;">REPORT SUMMARY</h3>
              <div class="box-body table-responsive">
                <?php if($_SESSION['type'] == 0): ?>
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>Title</th>
                      <th>Proponents</th>
                      <th>Adviser</th>
                      <th>Remark</th>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = "SELECT * FROM teams INNER JOIN users ON teams.adviser_id=users.id";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) {
              
                      ?>
                        <tr>
                          <td><?php echo $row['name'] ?></td>
                          <td>
                            <?php $sql3 = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_member.teams_id='".$row['teams_id']."'";
                            $stmt3 = $this->conn()->query($sql3);
                            while ($row3 = $stmt3->fetch()) { ?>
                              <p><?php echo $row3['firstname'] ?> <?php echo $row3['lastname'] ?></p>
                            <?php } ?>
                          </td>
                          <td>
                            <?php echo $row['firstname']; ?>
                          </td>
                          <td>
                            <?php 
                            if ($row['status'] == 0) {
                              echo "<span class='badge btn-primary'>SCHEDULED</span>";
                            } else if ($row['status'] == 1) {
                              echo "<span class='badge btn-success'>COMPLETED</span>";
                            } else if ($row['status'] == 2) {
                              echo "<span class='badge btn-danger'>PAST DUE</span>";
                            }
                             ?>
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