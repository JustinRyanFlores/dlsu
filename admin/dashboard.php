<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('location:../login.php');
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

    <head><?php include 'head.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
        <?php include 'profile.php'; ?>
        <?php include 'sidebar.php'; ?>
        <?php if ($_SESSION['type'] == 1): ?>
          <?php
          $sql_cs = "SELECT *, s.yr_lvl, s.department AS section_department, CONCAT(u.firstname,' ',u.lastname) AS research_teacher FROM sections s LEFT JOIN users u ON u.id = s.adviser WHERE s.department = 'Computer SCIENCE'";
          $stmt_cs = $this->conn()->prepare($sql_cs);
          $stmt_cs->execute();
          $sections_cs = $stmt_cs->fetchAll();
          ?>
          <div class="content-wrapper"
            style="
        height: 100vh;
        overflow-y: auto;">
            <section class="content">
              <div class="row">
                <div class="col-lg-6 col-12 d-flex flex-column h-100 text-center">
                  <div class="" style="border:2px solid lightgray; background-color: white; background-image:url('../images/cs_logo.png'); background-size: contain; background-repeat: no-repeat; background-position: center; width: 100%; height: 100px">
                  </div>
                  <div class="" style="border:1px solid lightgray; background-color: white; padding:5px;">
                    <span style="margin: 5px 0px; font-size: 15px; font-weight: bold;">Computer Science</span>
                  </div>
                  <div class="input-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding:5px; width:100%;border:1px solid lightgray; background-color: white;">
                    <label class="me-2">Filter:</label>
                    <select class="form-control" id="filterCS" style="width:25%;">
                      <option value="all">ALL</option>
                      <option value="3RD">3rd yr</option>
                      <option value="4TH">4th yr</option>
                    </select>
                  </div>
                  <div class="class-list" style="display: flex; border:2px solid lightgray; background-color: white;">
                    <?php if ($sections_cs): ?>
                      <?php foreach ($sections_cs as $cs_row): ?>
                        <a href="viewsection.php?section_name=<?= $cs_row['section_name'] ?>&department=<?= urlencode($cs_row['department']) ?>" style="color:black">
                          <div class="small-box cs" data-year-cs="<?= $cs_row['yr_lvl'] ?>">
                            <?= $cs_row['section_name'] ?>
                            <?php if ($cs_row['adviser'] != NULL): ?>
                              <img src="../images/<?= $cs_row['img'] ?>" style="border-radius:50%;" width="70px" height="70px">
                              <p style="font-weight: normal"><?= ucwords($cs_row['research_teacher']) ?></p>
                              <p style="font-weight: normal">Research Teacher</p>
                            <?php else: ?>
                              <p style="font-weight: normal">No assigned Research Teacher yet.</p>
                            <?php endif ?>
                          </div>
                        </a>
                      <?php endforeach ?>
                    <?php else: ?>
                      <p>No sections found.</p>
                    <?php endif; ?>
                  </div>
                </div>
                <?php
                $sql_it = "SELECT *, s.yr_lvl, s.department AS section_department, CONCAT(u.firstname,' ',u.lastname) AS research_teacher FROM sections s LEFT JOIN users u ON u.id = s.adviser WHERE s.department = 'Information Technology'";
                $stmt_it = $this->conn()->prepare($sql_it);
                $stmt_it->execute();
                $sections_it = $stmt_it->fetchAll();
                ?>
                <div class="col-lg-6 col-12 d-flex flex-column h-100 text-center">
                  <div class="" style="border:2px solid lightgray; background-color: white; background-image:url('../images/it_logo.jpg'),linear-gradient(to bottom, white, #dcdcdc); background-size: contain; background-repeat: no-repeat; background-position: center; width: 100%; height: 100px">
                  </div>
                  <div class="" style="border:1px solid lightgray; background-color: white;">
                    <p style="margin: 5px 0px; font-size: 15px; font-weight: bold;">Information Technology</p>
                  </div>
                  <div class="input-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding:5px; width:100%;border:1px solid lightgray; background-color: white;">
                    <label class="me-2">Filter:</label>
                    <select class="form-control" id="filterIT" style="width:25%;">
                      <option value="all">ALL</option>
                      <option value="3RD">3rd yr</option>
                      <option value="4TH">4th yr</option>
                    </select>
                  </div>
                  <div class="class-list" style="display: flex; border:2px solid lightgray; background-color: white;">
                    <?php if ($sections_it): ?>
                      <?php foreach ($sections_it as $it_row): ?>
                        <a href="viewsection.php?section_name=<?= $it_row['section_name'] ?>&department=<?= urlencode($it_row['section_department']) ?>" style="color:black">
                          <div class="small-box it" data-year-it="<?= $it_row['yr_lvl'] ?>">
                            <?= $it_row['section_name'] ?>
                            <?php if ($it_row['adviser'] != NULL): ?>
                              <img src="../images/<?= $it_row['img'] ?>" style="border-radius:50%;" width="70px" height="70px">
                              <p style="font-weight: normal"><?= ucwords($it_row['research_teacher']) ?></p>
                              <p style="font-weight: normal">Research Teacher</p>
                            <?php else: ?>
                              <p style="font-weight: normal">No assigned Research Teacher yet.</p>
                            <?php endif ?>
                          </div>
                        </a>
                      <?php endforeach ?>
                    <?php else: ?>
                      <p>No sections found.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </section>
          </div>
        <?php endif; ?>
        <?php if ($_SESSION['type'] == 0): ?>
          <div class="content-wrapper" style="height: 100vh;background-color: #f9f9f9;overflow-y: auto;">
            <section class="content">
              <h3 style="text-align: center;font-style: normal; color: #3ea1db; font-weight: 600; letter-spacing: 3px;">REPORT SUMMARY</h3>
              <div class="row">

                <div class="col-lg-6 col-12" style="display: flex; justify-content: center; min-height: 80vh;">

                  <table class="table table-bordered" style="" id="cs_table">
                    <thead>
                      <tr>
                        <th colspan="6" style="font-style: normal;text-align: center; height: 100px; background-color: white; background-image:url('../images/cs_logo.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"></th>
                      </tr>
                      <tr>
                        <th colspan="6" style="font-style: normal;text-align: center;">CS Department</th>
                      </tr>
                      <tr>
                        <th style="font-style: normal;">Group Name</th>
                        <th style="font-style: normal;">Memebers</th>
                        <th style="font-style: normal;">Adviser</th>
                        <th style="font-style: normal;">Panelists</th>
                        <th style="font-style: normal;">Remark</th>
                        <th style="font-style: normal;">Group Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT 
                            *, teams.status AS team_status
                        FROM 
                            teams 
                        INNER JOIN 
                            users 
                            ON 
                            teams.adviser_id=users.id 
                        AND users.department='Information Technology'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) {
                      ?>
                        <tr>
                          <td><?php echo ucwords($row['name']) ?></td>
                          <td style="padding: unset;">
                            <table class="table table-bordered" style="padding: unset;margin: unset;">
                              <tr>
                                <th>Name</th>
                                <th>Grade</th>
                              </tr>

                              <?php $sql3 = "SELECT * FROM teams_member 
                        INNER JOIN users ON teams_member.users_id = users.id 
                        WHERE teams_member.teams_id = '" . $row['teams_id'] . "'";
                              $stmt3 = $this->conn()->query($sql3);
                              while ($row3 = $stmt3->fetch()) { ?>
                                <tr>
                                  <td><?php echo ucwords($row3['firstname']) ?> <?php echo ucwords($row3['lastname']) ?></td>
                                  <td><?php echo ($row3['individual_grade'] == NULL) ? "~" : number_format($row3['individual_grade'], 2) ?></td>
                                </tr>
                              <?php } ?>
                            </table>
                          </td>
                          <td>
                            <?php echo ucwords($row['firstname']); ?>
                          </td>
                          <td style="padding: unset;">
                            <?php $sql4 = "SELECT * FROM panelist WHERE teams_id='" . $row['teams_id'] . "'";
                            $stmt4 = $this->conn()->query($sql4);
                            while ($row4 = $stmt4->fetch()) { ?>
                              <table class="table" style="padding: unset;margin: unset;">
                                <tr>
                                  <td><?php echo ucwords($row4['fullname']) ?></td>
                                </tr>
                              </table>
                            <?php } ?>
                          </td>
                          <td>
                            <?php
                            if ($row['team_status'] == 1) {
                              echo "Passed";
                            } else if ($row['team_status'] == 2) {
                              echo "Redefense";
                            } else if ($row['team_status'] == 3) {
                              echo "Failed";
                            } else if ($row['team_status'] == 0) {
                              echo "Pending";
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo ($row['grade'] == NULL) ? "~" : "| " . number_format($row['grade'], 2) ?>
                          </td>
                        </tr>
                      <?php $id++;
                      } ?>
                    </tbody>
                  </table>

                </div>

                <div class="col-lg-6 col-12" style="display: flex; justify-content: center; min-height: 80vh; border-left: none;">

                  <table class="table table-bordered" style="" id="it_table">
                    <thead>
                      <tr>
                        <th colspan="6" style="font-style: normal;text-align: center; height: 100px; background-image:url('../images/it_logo.jpg'), linear-gradient(to bottom, white, #dcdcdc); background-size: contain; background-repeat: no-repeat; background-position: center;"></th>
                      </tr>
                      <tr>
                        <th colspan="6" style="font-style: normal;text-align: center;">IT Department</th>
                      </tr>
                      <tr>
                        <th style="font-style: normal;">Group Name</th>
                        <th style="font-style: normal;">Members</th>
                        <th style="font-style: normal;">Adviser</th>
                        <th style="font-style: normal;">Panelists</th>
                        <th style="font-style: normal;">Remark</th>
                        <th style="font-style: normal;">Group Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT 
                        *, teams.status AS team_status
                        FROM 
                            teams 
                        INNER JOIN 
                            users
                            ON 
                            teams.adviser_id=users.id 
                        AND 
                            users.department='Computer SCIENCE'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) {

                      ?>
                        <tr>
                          <td><?php echo ucwords($row['name']) ?></td>
                          <td style="padding: unset;">
                            <table class="table table-bordered" style="padding: unset;margin: unset;">
                              <tr>
                                <th>Name</th>
                                <th>Grade</th>
                              </tr>
                              <?php $sql3 = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_member.teams_id='" . $row['teams_id'] . "'";
                              $stmt3 = $this->conn()->query($sql3);
                              while ($row3 = $stmt3->fetch()) { ?>
                                <tr>
                                  <td><?php echo ucwords($row3['firstname']) ?> <?php echo ucwords($row3['lastname']) ?></td>
                                  <td><?php echo ($row3['individual_grade'] == NULL) ? "~" : number_format($row3['individual_grade'], 2) ?></td>
                                </tr>
                              <?php } ?>
                            </table>
                          </td>
                          <td>
                            <?php echo ucwords($row['firstname']); ?>
                          </td>
                          <td style="padding: unset;">
                            <?php $sql4 = "SELECT * FROM panelist WHERE teams_id='" . $row['teams_id'] . "'";
                            $stmt4 = $this->conn()->query($sql4);
                            while ($row4 = $stmt4->fetch()) { ?>
                              <table class="table" style="padding: unset;margin: unset;">
                                <tr>
                                  <td><?php echo ucwords($row4['fullname']) ?></td>
                                </tr>
                              </table>
                            <?php } ?>
                          </td>
                          <td>
                            <?php
                            if ($row['team_status'] == 1) {
                              echo "Passed";
                            } else if ($row['team_status'] == 2) {
                              echo "Redefense";
                            } else if ($row['team_status'] == 3) {
                              echo "Failed";
                            } else if ($row['team_status'] == 0) {
                              echo "Pending";
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo ($row['grade'] == NULL) ? "~" : number_format($row['grade'], 2) ?>
                          </td>
                        </tr>
                      <?php $id++;
                      } ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </section>
          </div>
        <?php endif; ?>



        <?php if ($_SESSION['type'] == 2): ?>

          <?php
          $sql = "SELECT * FROM teams_member WHERE users_id = '" . $_SESSION['id'] . "'";
          $stmt = $this->conn()->prepare($sql);
          $stmt->execute([]);
          if ($stmt->rowcount() > 0) {
            $row = $stmt->fetch();
            $teams_id = $row['teams_id'];
          } else {
            $teams_id = 0;
          }
          ?>
          <div class="content-wrapper" style="height: 100vh; background-color: #f9f9f9;overflow-y: auto;">
            <section class="content">

              <?php
              $sql = "SELECT * FROM teams_member WHERE users_id = '" . $_SESSION['id'] . "'";
              $stmt = $this->conn()->prepare($sql);
              $stmt->execute([]);
              if ($stmt->rowcount() > 0) { ?>
                <div style="display: flex; justify-content: space-between;">
                  <div style="display: flex; align-items: center;">
                    <a href="studentdeadlines.php">
                      <button class="btn btn-primary"><i class="fas fa-calendar-alt"> </i> Deadlines</button>
                    </a>
                  </div>

                  <div style="text-align: center; padding: 5px 30px;border-radius: 50px;justify-content: center;align-content: center;">
                    <?php $sql = "SELECT * FROM teams WHERE teams_id = '" . $teams_id . "'";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch(); ?>

                    <div><i class="fas fa-users"></i> <span class="fw-bold">Group:</span>
                      <h4 style="font-weight: bold;"><u> <?php echo $row['name'] ?></u>
                    </div>
                  </div>
                </div>
              <?php } ?>

              <div style="display: flex; justify-content: space-around; background-color: rgb(112, 230, 241); padding: 10px 20px; border-radius: 10px;">
                <?php $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE teams_id = '" . $teams_id . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch(); ?>

                <h4 style="font-weight: bold;">Total Task/s: <?php echo $row['totaltask'] ?></h4>

                <?php $sql = "SELECT *,COUNT(task_id) AS totaltaskcompleted FROM task WHERE teams_id = '" . $teams_id . "' AND status = 4";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch(); ?>
                <h4 style="font-weight: bold;">Completed Task/s: <?php echo $row['totaltaskcompleted'] ?></h4>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                  <div class="" style="padding: 30px;box-shadow: unset;">
                    <div>
                      <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                        <h4 style="margin: unset;font-weight: bold;color: #000;">TO DO</h4>
                        <div style="border: 1px solid black;width: 20px;height: 20px;border-radius: 50%;display: grid;place-items: center;font-weight: bold;">
                          <?php
                          $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 1 AND teams_id = '" . $teams_id . "'";
                          $stmt = $this->conn()->query($sql);
                          $row = $stmt->fetch();
                          echo $row['totaltask'];
                          ?>
                        </div>
                      </div>
                      <div style="background-color: #000;width: 100%;height: 8px;border-radius: 5px;"></div>
                      <br>
                      <?php $sql = "SELECT * FROM task WHERE status = 1 AND teams_id = '" . $teams_id . "'";
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
                          <div style="text-align: right; width: 100%; padding: 20px;">
                            <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $teams_id . "'";
                            $stmt2 = $this->conn()->query($sql2);
                            while ($row2 = $stmt2->fetch()) { ?>
                              <img title="<?php echo ucwords($row2['firstname']) . " " . ucwords($row2['lastname']) ?>" src="../images/<?php echo $row2['img'] ?>" width="30px" height="30px" style="border-radius: 50%;">
                            <?php } ?>
                          </div>
                          <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                            <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcommentdashboard"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
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
                          $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 2 AND teams_id = '" . $teams_id . "'";
                          $stmt = $this->conn()->query($sql);
                          $row = $stmt->fetch();
                          echo $row['totaltask'];
                          ?>
                        </div>
                      </div>
                      <div style="background-color: #bbd4e8;width: 100%;height: 8px;border-radius: 5px;"></div>
                      <br>
                      <?php $sql = "SELECT * FROM task WHERE status = 2 AND teams_id = '" . $teams_id . "'";
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
                            <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $teams_id . "'";
                            $stmt2 = $this->conn()->query($sql2);
                            while ($row2 = $stmt2->fetch()) { ?>
                              <img title="<?php echo ucwords($row2['firstname']) . " " . ucwords($row2['lastname']) ?>" src="../images/<?php echo $row2['img'] ?>" width="30px" height="30px" style="border-radius: 50%;">
                            <?php } ?>
                          </div>
                          <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                            <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcommentdashboard"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
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
                          $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 3 AND teams_id = '" . $teams_id . "'";
                          $stmt = $this->conn()->query($sql);
                          $row = $stmt->fetch();
                          echo $row['totaltask'];
                          ?>
                        </div>
                      </div>
                      <div style="background-color: red;width: 100%;height: 8px;border-radius: 5px;"></div>
                      <br>
                      <?php $sql = "SELECT * FROM task WHERE status = 3 AND teams_id = '" . $teams_id . "'";
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
                            <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $teams_id . "'";
                            $stmt2 = $this->conn()->query($sql2);
                            while ($row2 = $stmt2->fetch()) { ?>
                              <img title="<?php echo ucwords($row2['firstname']) . " " . ucwords($row2['lastname']) ?>" src="../images/<?php echo $row2['img'] ?>" width="30px" height="30px" style="border-radius: 50%;">
                            <?php } ?>
                          </div>
                          <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                            <button value="<?php echo $row['task_id'] ?>" style="cursor: pointer;border: unset;background: unset;" class="taskcommentdashboard"><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></button>
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
                          $sql = "SELECT *,COUNT(task_id) AS totaltask FROM task WHERE status = 4 AND teams_id = '" . $teams_id . "'";
                          $stmt = $this->conn()->query($sql);
                          $row = $stmt->fetch();
                          echo $row['totaltask'];
                          ?>
                        </div>
                      </div>
                      <div style="background-color: green;width: 100%;height: 8px;border-radius: 5px;"></div>
                      <br>
                      <?php $sql = "SELECT * FROM task WHERE status = 4 AND teams_id = '" . $teams_id . "'";
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
                            <?php $sql2 = "SELECT * FROM task_member INNER JOIN users ON task_member.users_id=users.id WHERE task_member.task_id='" . $row['task_id'] . "' AND task_member.teams_id='" . $teams_id . "'";
                            $stmt2 = $this->conn()->query($sql2);
                            while ($row2 = $stmt2->fetch()) { ?>
                              <img title="<?php echo ucwords($row2['firstname']) . " " . ucwords($row2['lastname']) ?>" src="../images/<?php echo $row2['img'] ?>" width="30px" height="30px" style="border-radius: 50%;">
                            <?php } ?>
                          </div>
                          <div style="display: flex;justify-content: space-between;border-top: 2px solid black;padding: 20px;">
                            <div><i class="fas fa-comments text-primary"></i> <?php echo $total_comment; ?></div>

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
        <?php endif; ?>
      </div>
      <?php include 'footer.php'; ?>
      <?php include 'modal/monitorthesisModal.php'; ?>

      <!-- DataTables CSS -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

      <!-- DataTables JS -->
      <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

      <!-- DataTables Buttons -->
      <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

      <!-- PDFMake for PDF Export -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>



      <script>
        $(document).ready(function() {
          // Task Comment Dashboard Modal Show & Task ID Assignment
          $('.taskcommentdashboard').click(function() {
            // Show the modal for task comments
            $('#taskcommentdashboard').modal('show');

            // Set the task_id in the hidden input field
            $('#taskcommentdashboard_task_id').val($(this).val());

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
                $('#comments_section_dashboard').html(response);
              },
              error: function() {
                alert('Failed to load comments. Please try again.');
              }
            });
          });

          // Task Like Button Click & Update Like Count
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
        });



        $(document).ready(function() {
          $('#cs_table').DataTable({
            responsive: true,
            paging: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            searching: true,
            ordering: true,
            info: true,
            dom: 'lBfrtip',
            buttons: [{
                extend: 'pdf',
                text: 'PDF',
                title: 'CS Department Report',
                pageSize: 'A4',
              },
              {
                extend: 'print',
                text: 'Print',
                title: 'CS Department Report',
                exportOptions: {
                  columns: ':visible', // Export only visible columns
                  stripHtml: false // Keep table formatting (important!)
                },
                customize: function(win) {
                  $(win.document.body)
                    .css('font-size', '12px') // Adjust font size
                    .find('table')
                    .addClass('table-bordered') // Add Bootstrap table border
                    .css('width', '100%'); // Ensure table width is correct

                  // Ensure nested tables are styled correctly
                  $(win.document.body).find('table table').addClass('table table-bordered');
                }
              }
            ]
          });

          $('#it_table').DataTable({
            responsive: true,
            paging: true, // Enable pagination
            pageLength: 5, // Number of rows per page
            lengthMenu: [5, 10, 25, 50], // Options for rows per page
            searching: true, // Enable the search box
            ordering: true, // Enable sorting on columns
            info: true, // Display "Showing X to Y of Z entries"
            dom: 'lBfrtip', // Remove buttons, keep pagination, search, and table layout
            buttons: [{
                extend: 'pdf',
                text: 'PDF',
                title: 'IT Department Report',
                pageSize: 'A4',
              },
              {
                extend: 'print',
                text: 'Print',
                title: 'IT Department Report',
                exportOptions: {
                  columns: ':visible', // Export only visible columns
                  stripHtml: false // Keep table formatting (important!)
                },
                customize: function(win) {
                  $(win.document.body)
                    .css('font-size', '12px') // Adjust font size
                    .find('table')
                    .addClass('table-bordered') // Add Bootstrap table border
                    .css('width', '100%'); // Ensure table width is correct

                  // Ensure nested tables are styled correctly
                  $(win.document.body).find('table table').addClass('table table-bordered');
                }
              }
            ]
          });
        });


        //filtering cs
        document.getElementById("filterCS").addEventListener("change", function() {
          let selectedYear = this.value; // Get selected value
          let sections = document.querySelectorAll(".cs"); // Get all sections

          sections.forEach(section => {
            let sectionYear = section.getAttribute("data-year-cs"); // Read data-year attribute

            if (selectedYear === "all" || sectionYear === selectedYear) {
              section.parentElement.style.display = "block"; // Show section
            } else {
              section.parentElement.style.display = "none"; // Hide section
            }
          });
        });

        //filtering it
        document.getElementById("filterIT").addEventListener("change", function() {
          let selectedYear = this.value; // Get selected value
          let sections = document.querySelectorAll(".it"); // Get all sections

          sections.forEach(section => {
            let sectionYear = section.getAttribute("data-year-it"); // Read data-year attribute

            if (selectedYear === "all" || sectionYear === selectedYear) {
              section.parentElement.style.display = "block"; // Show section
            } else {
              section.parentElement.style.display = "none"; // Hide section
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