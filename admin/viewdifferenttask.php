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
            <div>
              <a href="tasklist.php" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-12">
                <div class="box" style="border-top: unset;">
                  <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th style="font-size: 23px;font-style: normal;">Assigned</th>
                        <th style="font-size: 23px;font-style: normal;">Title</th>
                        <th style="font-size: 23px;font-style: normal;">Description</th>
                        <th style="font-size: 23px;font-style: normal;">Status</th>
                        <th style="font-size: 23px;font-style: normal;">Date</th>
                        <th style="font-size: 23px;font-style: normal;">Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM task WHERE setdeadline_id = '" . $_GET['setdeadline_id'] . "'";
                        $stmt = $this->conn()->query($sql);
                        while ($row = $stmt->fetch()) {

                        ?>
                          <tr>
                            <td style="font-size: 23px;font-style: normal;">
                              <?php
                              $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id = '" . $row['task_id'] . "'";
                              $stmt2 = $this->conn()->query($sql2);
                              while ($row2 = $stmt2->fetch()) { ?>
                                <img src="../images/<?php echo $row2['img'] ?>" width="30px" style="border-radius: 50%;">
                              <?php } ?>
                            </td>
                            <td style="font-size: 23px;font-style: normal;"><?php echo $row['title'] ?></td>
                            <td style="font-size: 23px;font-style: normal;"><?php echo $row['description'] ?></td>
                            <td style="font-size: 23px;font-style: normal;">
                              <?php
                              if ($row['status'] == 1) {
                                echo "<span class='badge btn-primary' style='width: 100%;'>TO DO</span>";
                              } else if ($row['status'] == 2) {
                                echo "<span class='badge btn-success' style='width: 100%;'>IN WORK</span>";
                              } else if ($row['status'] == 3) {
                                echo "<span class='badge btn-danger' style='width: 100%;'>TASK DUE THIS WEEK</span>";
                              } else if ($row['status'] == 4) {
                                echo "<span class='badge btn-danger' style='width: 100%;'>COMPLETED</span>";
                              }
                              ?>
                            </td>
                            <td style="font-size: 23px;font-style: normal;"><?php echo date('F j, Y', strtotime($row['date'])) ?></td>
                            <td style="display: flex; gap: 5px; justify-content: center;">
                              <button class="btn btn-warning btn-sm edit"
                                data-edit_task_id="<?php echo $row['task_id'] ?>"
                                data-edit_title="<?php echo htmlspecialchars($row['title']); ?>"
                                data-edit_description="<?php echo htmlspecialchars($row['description']); ?>">
                                <i class="fa fa-pencil"></i>
                              </button>

                              <?php
                              $sql3 = "SELECT * FROM teams WHERE users_id = '" . $_SESSION['id'] . "'";
                              $stmt3 = $this->conn()->query($sql3);
                              if ($stmt3->rowcount() > 0): ?>
                                <form method="POST" action="../controller/viewdifferenttaskController.php" style="margin: 0; padding: 0;">
                                <input type="hidden" name="setdeadline_id" value="<?php echo $_GET['setdeadline_id'] ?>">
                                  <input type="hidden" name="task_id" value="<?php echo $row['task_id'] ?>">
                                  <button type="submit" name="delete"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this task?');">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                </form>
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
      <?php include 'modal/viewdifferenttaskModal.php'; ?>
      <script>
        $(document).on('click', '.edit', function(e) {
          e.preventDefault();
          $('#edit').modal('show');
          var edit_task_id = $(this).data('edit_task_id');
          var edit_title = $(this).data('edit_title');
          var edit_description = $(this).data('edit_description');

          $('#edit_task_id').val(edit_task_id)
          $('#edit_title').val(edit_title)
          $('#edit_description').val(edit_description)
        });
      </script>
    </body>

    </html>
<?php }
}
$data = new data();
$data->managedata(); ?>