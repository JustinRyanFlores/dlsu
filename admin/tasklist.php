<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('location:../logout.php');
  exit;
}

include '../config/config.php';
class data extends Connection
{
  public function managedata()
  {
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
                <div class="box" style="border-top: unset;">
                  <div class="box-body table-responsive">
                    <?php if ($_SESSION['type'] != 1): ?>
                      <table id="example1" class="table table-bordered">
                        <thead>
                          <th style="font-size: 23px;font-style: normal;">Title</th>
                          <th style="font-size: 23px;font-style: normal;">Due Date</th>
                          <th style="font-size: 23px;font-style: normal;">Status</th>
                          <th style="font-size: 23px;font-style: normal;">Action</th>
                        </thead>
                        <tbody>
                          <?php

                          $sql = "SELECT * FROM teams_member WHERE users_id = '" . $_SESSION['id'] . "'";
                          $stmt = $this->conn()->query($sql);
                          $row = $stmt->fetch();

                          if ($stmt->rowcount() > 0) {
                            $teams_id = $row['teams_id'];
                          } else {
                            $teams_id = 0;
                          }

                          $sql = "SELECT * FROM setdeadline WHERE teams_id = '" . $teams_id . "'";
                          $stmt = $this->conn()->query($sql);
                          while ($row = $stmt->fetch()) {

                            $sql3 = "SELECT * FROM teams WHERE users_id = '" . $_SESSION['id'] . "'";
                            $stmt3 = $this->conn()->query($sql3);

                          ?>
                            <tr>
                              <td style="font-size: 23px;font-style: normal;"><?php echo $row['name'] ?></td>
                              <td style="font-size: 23px;font-style: normal;"><?= ($row['deadline'] != NULL || $row['deadline'] != 0) ? date('F j, Y', strtotime($row['deadline'])) : "~" ?></td>
                              <td class="text-center" style="font-size: 23px;font-style: normal;">
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
                              <td class="text-center">
                                <?php
                                if ($stmt3->rowcount() > 0): ?>
                                  <button class='btn btn-success btn-sm edit btn-table'
                                    data-edit_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'>+ SUBTASK</button>
                                <?php endif; ?>
                                <a href="viewdifferenttask.php?setdeadline_id=<?php echo $row['setdeadline_id'] ?>" class='btn btn-warning btn-sm btn-table'>VIEW TASK</a>
                                <!-- <a href="tasklistcomments.php?setdeadline_id=<?php echo $row['setdeadline_id'] ?>" class='btn btn-primary btn-sm btn-table'>VIEW COMMENTS</a> -->


                                <?php if ($_SESSION['type'] == 2): ?>
                                  <button class='btn btn-info btn-sm uploadfile btn-table'
                                    data-uploadfile_setdeadline_id='<?php echo $row['setdeadline_id'] ?>'>UPLOAD FILE</button>
                                <?php endif; ?>

                                <a href="tasklistfile.php?setdeadline_id=<?php echo $row['setdeadline_id'] ?>" class='btn btn-primary btn-sm btn-table'>VIEW FILE</a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    <?php endif; ?>

                    <?php if ($_SESSION['type'] == 1): ?>
                      <table id="example1" class="table table-bordered">
                        <thead>
                          <th style="font-size: 23px;font-style: normal;">Teams</th>
                          <th style="font-size: 23px;font-style: normal;">Action</th>
                        </thead>
                        <tbody>
                          <?php $sql = "SELECT * FROM teams WHERE adviser_id = '" . $_SESSION['id'] . "'";
                          $stmt = $this->conn()->query($sql);
                          while ($row = $stmt->fetch()) { ?>
                            <tr>
                              <td style="font-size: 23px;font-style: normal;"><?php echo $row['name'] ?></td>
                              <td>
                                <a href="viewtasklist.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-warning btn-sm btn-table'>VIEW</a>
                              </td>
                            </tr>
                          <?php } ?>
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
        $(document).on('click', '.edit', function(e) {
          e.preventDefault();
          $('#addnew').modal('show');
          var edit_setdeadline_id = $(this).data('edit_setdeadline_id');

          $('#edit_setdeadline_id').val(edit_setdeadline_id)
        });

        $(document).on('click', '.uploadfile', function(e) {
          e.preventDefault();
          $('#uploadfile').modal('show');
          var uploadfile_setdeadline_id = $(this).data('uploadfile_setdeadline_id');

          $('#uploadfile_setdeadline_id').val(uploadfile_setdeadline_id)
        });

        $(document).on('click', '.delete', function(e) {
          e.preventDefault();

          $('#delete').modal('show');
          var delete_templates_id = $(this).data('delete_templates_id');

          $('#delete_templates_id').val(delete_templates_id)
        });
      </script>
    </body>

    </html>
<?php }
}
$data = new data();
$data->managedata(); ?>
