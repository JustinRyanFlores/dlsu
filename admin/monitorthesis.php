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
            <div class="mb-5">
              <a href="teams.php" class="btn btn-lg btn-flat" style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
            </div>

            <div style="display: flex;justify-content: space-between; margin-top: 20px;">
              <div style="display: flex; align-items: center;">
                <button class="btn btn-primary"><i class="fas fa-calendar-alt"> </i> Deadlines</button>
              </div>

              <div style="text-align: center; padding: 5px 30px;border-radius: 50px;justify-content: center;align-content: center;">
                <?php $sql = "SELECT * FROM teams WHERE teams_id = '" . $_GET['teams_id'] . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch(); ?>

                <div><i class="fas fa-users"></i> <span class="fw-bold">Group:</span>
                  <h4 style="font-weight: bold;"><u> <?php echo $row['name'] ?></u>
                </div>
              </div>
            </div>

            <div style="display: flex; justify-content: space-around; background-color: rgb(112, 230, 241); padding: 10px 20px;border-radius: 10px;">
              <?php $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE teams_id = '" . $_GET['teams_id'] . "'";
              $stmt = $this->conn()->query($sql);
              $row = $stmt->fetch(); ?>

              <h4 style="font-weight: bold;"><?php echo $row['totaltask'] ?> Total Task/s</h4>

              <?php $sql = "SELECT *,COUNT(task_id) AS totaltaskcompleted FROM task WHERE teams_id = '" . $_GET['teams_id'] . "' AND status = 4";
              $stmt = $this->conn()->query($sql);
              $row = $stmt->fetch(); ?>
              <h4 style="font-weight: bold;"><?php echo $row['totaltaskcompleted'] ?> Completed Task/s</h4>
            </div>

            <br>
            <div class="row">
              <div class="col-lg-3 col-md-6 col-12">
                <div class="" style="padding: 30px;box-shadow: unset;">
                  <div>
                    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                      <h4 style="margin: unset;font-weight: bold;color: #000;">TO DO</h4>
                      <div style="border: 1px solid black;width: 20px;height: 20px;border-radius: 50%;display: grid;place-items: center;font-weight: bold;">
                        <?php
                        $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 1 AND teams_id = '" . $_GET['teams_id'] . "'";
                        $stmt = $this->conn()->query($sql);
                        $row = $stmt->fetch();
                        echo $row['totaltask'];
                        ?>
                      </div>
                    </div>
                    <div style="background-color: #000;width: 100%;height: 8px;border-radius: 5px;"></div>
                    <br>
                    <?php $sql = "SELECT * FROM task WHERE status = 1 AND teams_id = '" . $_GET['teams_id'] . "'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) {

                      $sql3 = "SELECT *,COUNT(task_comment_id) AS total_comment FROM task_comment WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_comment = $row3['total_comment'];

                      $sql3 = "SELECT *,COUNT(task_like_id) AS total_like FROM task_like WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_like = $row3['total_like'];

                    ?>
                      <br>
                      <div style="background-color: #fff;border-radius: 20px;border: 2px solid black;">
                        <div style="padding: 20px;">
                          <h5 style="font-weight: bold;"><?php echo $row['title'] ?></h5>
                          <p><?php echo $row['description'] ?></p>
                        </div>
                        <br>
                        <div style="text-align: right;width: 100%;padding: 20px;">
                          <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $_GET['teams_id'] . "'";
                          $stmt2 = $this->conn()->query($sql2);
                          while ($row2 = $stmt2->fetch()) { ?>
                            <img src="../images/<?php echo $row2['img'] ?>" width="30px" style="border-radius: 50%;">
                          <?php } ?>
                        </div>
                        <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcomment"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="tasklike">
                            <i class="fas fa-thumbs-up text-primary"></i> <span class="like-count"><?php echo $total_like; ?></span>
                          </button>

                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-12">
                <div class="" style="padding: 30px;box-shadow: unset;">
                  <div>
                    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                      <h4 style="margin: unset;font-weight: bold;color: #000;">IN WORK</h4>
                      <div style="border: 1px solid black;width: 20px;height: 20px;border-radius: 50%;display: grid;place-items: center;font-weight: bold;">
                        <?php
                        $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 2 AND teams_id = '" . $_GET['teams_id'] . "'";
                        $stmt = $this->conn()->query($sql);
                        $row = $stmt->fetch();
                        echo $row['totaltask'];
                        ?>
                      </div>
                    </div>
                    <div style="background-color: #bbd4e8;width: 100%;height: 8px;border-radius: 5px;"></div>
                    <br>
                    <?php $sql = "SELECT * FROM task WHERE status = 2 AND teams_id = '" . $_GET['teams_id'] . "'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) {

                      $sql3 = "SELECT *,COUNT(task_comment_id) AS total_comment FROM task_comment WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_comment = $row3['total_comment'];

                      $sql3 = "SELECT *,COUNT(task_like_id) AS total_like FROM task_like WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_like = $row3['total_like'];

                    ?>
                      <br>
                      <div style="background-color: #fff;border-radius: 20px;border: 2px solid black;">
                        <div style="padding: 20px;">
                          <h5 style="font-weight: bold;"><?php echo $row['title'] ?></h5>
                          <p><?php echo $row['description'] ?></p>
                        </div>
                        <br>
                        <div style="text-align: right;width: 100%;padding: 20px;">
                          <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $_GET['teams_id'] . "'";
                          $stmt2 = $this->conn()->query($sql2);
                          while ($row2 = $stmt2->fetch()) { ?>
                            <img src="../images/<?php echo $row2['img'] ?>" width="30px" style="border-radius: 50%;">
                          <?php } ?>
                        </div>
                        <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcomment"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="tasklike">
                            <i class="fas fa-thumbs-up text-primary"></i> <span class="like-count"><?php echo $total_like; ?></span>
                          </button>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-12">
                <div class="" style="padding: 30px;box-shadow: unset;">
                  <div>
                    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                      <h4 style="margin: unset;font-weight: bold;color: #000;">TASK DUE THIS WEEK</h4>
                      <div style="border: 1px solid black;width: 20px;height: 20px;border-radius: 50%;display: grid;place-items: center;font-weight: bold;">
                        <?php
                        $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 3 AND teams_id = '" . $_GET['teams_id'] . "'";
                        $stmt = $this->conn()->query($sql);
                        $row = $stmt->fetch();
                        echo $row['totaltask'];
                        ?>
                      </div>
                    </div>
                    <div style="background-color: red;width: 100%;height: 8px;border-radius: 5px;"></div>
                    <br>
                    <?php $sql = "SELECT * FROM task WHERE status = 3 AND teams_id = '" . $_GET['teams_id'] . "'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) {

                      $sql3 = "SELECT *,COUNT(task_comment_id) AS total_comment FROM task_comment WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_comment = $row3['total_comment'];

                      $sql3 = "SELECT *,COUNT(task_like_id) AS total_like FROM task_like WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_like = $row3['total_like'];

                    ?>
                      <br>
                      <div style="background-color: #fff;border-radius: 20px;border: 2px solid black;">
                        <div style="padding: 20px;">
                          <h5 style="font-weight: bold;"><?php echo $row['title'] ?></h5>
                          <p><?php echo $row['description'] ?></p>
                        </div>
                        <br>
                        <div style="text-align: right;width: 100%;padding: 20px;">
                          <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $_GET['teams_id'] . "'";
                          $stmt2 = $this->conn()->query($sql2);
                          while ($row2 = $stmt2->fetch()) { ?>
                            <img src="../images/<?php echo $row2['img'] ?>" width="30px" style="border-radius: 50%;">
                          <?php } ?>
                        </div>
                        <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcomment"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="tasklike">
                            <i class="fas fa-thumbs-up text-primary"></i> <span class="like-count"><?php echo $total_like; ?></span>
                          </button>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-12">
                <div class="" style="padding: 30px;box-shadow: unset;">
                  <div>
                    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                      <h4 style="margin: unset;font-weight: bold;color: #000;">COMPLETED</h4>
                      <div style="border: 1px solid black;width: 20px;height: 20px;border-radius: 50%;display: grid;place-items: center;font-weight: bold;">
                        <?php
                        $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 4 AND teams_id = '" . $_GET['teams_id'] . "'";
                        $stmt = $this->conn()->query($sql);
                        $row = $stmt->fetch();
                        echo $row['totaltask'];
                        ?>
                      </div>
                    </div>
                    <div style="background-color: green;width: 100%;height: 8px;border-radius: 5px;"></div>
                    <br>
                    <?php $sql = "SELECT * FROM task WHERE status = 4 AND teams_id = '" . $_GET['teams_id'] . "'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) {

                      $sql3 = "SELECT *,COUNT(task_comment_id) AS total_comment FROM task_comment WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_comment = $row3['total_comment'];

                      $sql3 = "SELECT *,COUNT(task_like_id) AS total_like FROM task_like WHERE task_id = '" . $row['task_id'] . "'";
                      $stmt3 = $this->conn()->query($sql3);
                      $row3 = $stmt3->fetch();
                      $total_like = $row3['total_like'];

                    ?>
                      <br>
                      <div style="background-color: #fff;border-radius: 20px;border: 2px solid black;">
                        <div style="padding: 20px;">
                          <h5 style="font-weight: bold;"><?php echo $row['title'] ?></h5>
                          <p><?php echo $row['description'] ?></p>
                        </div>
                        <br>
                        <div style="text-align: right;width: 100%;padding: 20px;">
                          <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $_GET['teams_id'] . "'";
                          $stmt2 = $this->conn()->query($sql2);
                          while ($row2 = $stmt2->fetch()) { ?>
                            <img src="../images/<?php echo $row2['img'] ?>" width="30px" style="border-radius: 50%;">
                          <?php } ?>
                        </div>
                        <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                          <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcomment"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>

                          <div style="font-weight: bold;"><i class="fas fa-check-square text-success"></i> DONE</div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <br>

          </section>
        </div>
      </div>
      <?php include 'footer.php'; ?>
      <?php include 'modal/monitorthesisModal.php'; ?>
      <script>
        // Task Comment Modal Show & Task ID Assignment
        $('.taskcomment').click(function() {
          // Show the modal for task comments
          $('#taskcomment').modal('show');

          // Set the task_id in the hidden input field
          $('#taskcomment_task_id').val($(this).val());

          // Get the task ID from the clicked button
          const taskId = $(this).val();

          // Send AJAX request to fetch comments
          $.ajax({
            url: '../controller/monitorthesisController.php',
            type: 'POST',
            data: {
              view_taskcomment: true,
              task_id: taskId
            },
            success: function(response) {
              // Inject the response (comments) into the modal's comments section
              $('#comments_section').html(response);
            },
            error: function() {
              alert('Failed to load comments. Please try again.');
            }
          });
        });


        $('.tasklike').click(function() {
          var task_id = $(this).val(); // Get the task ID from the button value
          var button = $(this); // Reference to the clicked button

          $.ajax({
            url: '../controller/monitorthesisController.php',
            type: 'POST',
            data: {
              tasklike: 'tasklike',
              task_id: task_id
            },
            success: function(data) {
              // Update the like count next to the button
              button.find('.like-count').text(data);
            },
            error: function() {
              alert('Failed to like this task. Please try again.');
            }
          });
        });
      </script>
    </body>

    </html>
<?php }
}
$data = new data();
$data->managedata(); ?>