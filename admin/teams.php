<?php
ini_set('display_errors', 0);  
error_reporting(0);  
session_start();
include '../config/config.php';

if (!isset($_SESSION['id'])) {
  header('location:../logout.php');
  exit;
}

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
          <?php if ($_SESSION['type'] == 2): ?>
            <section class="content">
              <div>
                <?php

                $sql = "SELECT *,teams.name AS teams_name,teams.teams_id AS teams_teams_id FROM teams_member INNER JOIN teams ON teams_member.teams_id=teams.teams_id INNER JOIN users ON teams.adviser_id=users.id WHERE teams_member.users_id= '" . $_SESSION['id'] . "'";
                $stmt2 = $this->conn()->query($sql);
                $row4 = @$stmt2->fetch();



                $sql = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id INNER JOIN teams ON teams.teams_id = teams_member.teams_id WHERE teams_member.users_id='" . $_SESSION['id'] . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();

                if ($stmt->rowcount() <= 0) { ?>
                  <br>
                  <div style="text-align: center;">
                    <img src="../images/createteam.png" width="40%">
                    <br><br>
                    <div>
                      <a href="dashboard.php" class="btn btn-success btn-sm" style="font-size: 25px;padding: 17px 15px;width: 180px;font-weight: bold;border-radius: 20px;">CANCEL</a>
                      &nbsp;
                      <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm" style="font-size: 25px;padding: 17px 15px;width: 180px;font-weight: bold;border-radius: 20px;">CREATE TEAM</a>
                    </div>
                    <br>
                    <h3>Or wait for someone to add you!</h3>
                  </div>
                <?php } else {
                  $name = $row['firstname'] . " " . $row['lastname']; ?>

                  <div>
                    <?php
                    if ($row4['adviser_status'] == 0) {
                      echo "<span class='badge btn-primary'>Request Adviser Pending</span>";
                    } else if ($row4['adviser_status'] == 1) {
                      echo "<span class='badge btn-success'>Your Request Adviser has been APPROVED:</span> 
                        <img src='../images/" . $row4['img'] . "' 
                        title='" . $row4['firstname'] . " " . $row4['lastname'] . "' 
                        width='35px' height='35px' 
                        style='border-radius: 50%;'>";
                    } else if ($row4['adviser_status'] == 2) {
                      echo "<span class='badge btn-danger'>Your Request Adviser has been DECLINED Please change adviser request</span>";
                    }
                    ?>
                  </div>
                  <div>
                    <h4>Thesis Title: <b><?= $row4['thesis_title'] ?></b></h4>
                  </div>
                  <div style="text-align: right;">
                    <a href="#edit" data-toggle="modal" class="edit"
                      data-edit_teams_id="<?php echo $row4['teams_teams_id'] ?>"
                      data-edit_name="<?php echo $row4['teams_name'] ?>"
                      data-edit_thesis="<?php echo $row['thesis_title'] ?>"
                      data-edit_user_id="<?php echo $row['id'] ?>"
                      style="text-align: right;font-size: 23px;color: #00bf63;font-weight: bold;color: #000;font-style: normal;"><?php echo $row4['teams_name']; ?> - Edit</a>
                  </div>
                <?php } ?>
              </div>
              <br>
              <?php if ($stmt->rowcount() > 0) { ?>

                <?php
                $sql = "SELECT * FROM teams_member WHERE users_id= '" . $_SESSION['id'] . "'";
                $stmt = $this->conn()->query($sql);
                $row3 = $stmt->fetch();
                $teams_id = $row3['teams_id'];

                $sql = "SELECT * FROM teams WHERE users_id= '" . $_SESSION['id'] . "'";
                $stmt5 = $this->conn()->query($sql);
                ?>
                <?php $row7 = $stmt5->fetch(); ?>
                <?php if ($stmt5->rowcount() > 0): ?>
                  <?php if ($row7['adviser_status'] != 1): ?>
                    <a href="#assignadviser" data-toggle="modal" class="btn btn-success assignadviser btn-sm" data-assignadviser_teams_id="<?php echo $row7['teams_id'] ?>" style="font-size: 25px;padding: 17px 15px;width: 220px;font-weight: bold;border-radius: 20px;">ASSIGN ADVISER</a>
                    <br><br>
                  <?php endif; ?>
                <?php else: ?>
                  <!--<a href="#assignadviser" data-toggle="modal" class="btn btn-success assignadviser btn-sm" data-assignadviser_teams_id="<?php echo $row7['teams_id'] ?>" style="font-size: 25px;padding: 17px 15px;width: 220px;font-weight: bold;border-radius: 20px;">ASSIGN ADVISER</a>-->
                  <!--<br><br>-->
                <?php endif; ?>
                <div class="row">
                  <?php
                  $sql = "SELECT *,teams_member.users_id AS teams_member_users_id, teams.users_id AS team_lead FROM teams_member INNER JOIN users ON teams_member.users_id=users.id LEFT JOIN teams ON teams_member.users_id = teams.users_id WHERE teams_member.teams_id='" . $row4['teams_teams_id'] . "'";
                  $stmt = $this->conn()->query($sql);
                  while ($row = $stmt->fetch()) { ?>
                    <div class="col-lg-2 col-12">
                      <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: 350px;">
                        <div class="inner" style="text-align: center;">
                          <p style="color:black; text-align:left; margin-top:-30px; margin-left:10px;">
                            <?php if ($row['teams_member_users_id'] == $row['team_lead']): ?>
                              <i class="fa fa-star text-warning"></i>
                            <?php endif ?>
                          </p>
                          <img src="../images/<?= $row['img'] ?>" width="35px" height="35px" style="border-radius: 50%;">
                          <p style="color:#000;font-weight: bold;font-size: 23px;margin: 10px 0px;"><?php echo ucwords($row['firstname']); ?> <?php echo ucwords($row['lastname']); ?></p>
                          <p style="color:#000;font-weight: normal;font-size: 18px;margin: 0;"><?php echo $row['section']; ?></p>
                          <?php if ($row['individual_grade'] == NULL || $row['individual_grade'] == 0): ?>
                            <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to add grade">Grade: in Progress</p>
                          <?php else: ?>
                            <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to change grade">Grade: <?php echo number_format($row['individual_grade'], 2); ?></p>
                          <?php endif ?>
                          <a href="details.php?users_id=<?php echo $row['users_id'] ?>&teams_id=<?php echo $row['teams_id'] ?>" class="btn" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;margin: auto;width: 100px;">DETAILS</a>
                          <?php if ($stmt5->rowcount() > 0): ?>
                            <button class="btn delete" data-delete_teams_member_id="<?php echo $row['teams_member_id'] ?>" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;width: 100px;margin: 5px auto;"><?= $row['teams_member_users_id'] == $_SESSION['id'] ? 'LEAVE' : 'REMOVE' ?></button>
                          <?php else: ?>
                            <?php if ($row['teams_member_users_id'] == $_SESSION['id']): ?>
                              <button class="btn delete" data-delete_teams_member_id="<?php echo $row['teams_member_id'] ?>" style="border: 2px solid black;border-radius: 8px;color: #000;display: block;width: 100px;margin: 5px auto;">LEAVE</button>
                            <?php endif; ?>
                          <?php endif; ?>



                          <?php
                          $sql = "SELECT * FROM teams WHERE teams_id= '" . $row4['teams_teams_id'] . "'";
                          $stmt6 = $this->conn()->query($sql);
                          $row6 = $stmt6->fetch();

                          if ($row6['status'] == 1) {
                            echo "<span class='badge btn-success'>GRADED</span>";
                          }

                          ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php
                  $sql7 = "SELECT users_id FROM teams WHERE users_id =" . $_SESSION['id'];
                  $stmt7 = $this->conn()->query($sql7);
                  $row7 = $stmt7->fetch();

                  if ($stmt7->rowcount() > 0):
                  ?>
                    <div class="col-lg-2 col-12">
                      <div data-target="#addmember" data-toggle="modal" class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color: #e7e9ec6e !important;color:#fff;border-radius: 30px;padding: 30px 0px;cursor: pointer;height: 350px;display: grid;place-items: center;">
                        <div class="inner" style="text-align: center;">
                          <i class="fa fa-plus" style="font-size: 35px;color:#000;"></i>
                          <p style="color:#000;font-weight: bold;font-size: 23px;margin: 30px 0px;">ADD GROUP MEMBER</p>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>

                </div>
                <div style="display:flex; width:100%;">
                  <?php

                  ?>
                  <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: auto; width:40%;margin:50px;">
                    <h3 class="text-primary">3rd Year</h3>
                    <div class="inner" style="display:flex; flex-direction:column; align-items: center; gap: 10px; text-align: center;">
                      <h4 style="font-weight:bold; color:black;">Form Coordinator Approval</h4>
                      <?php if ($row4['coor_approval'] != NULL): ?>
                        <iframe src="../uploads/<?= $row4['coor_approval'] ?>" width="100%" height="600" style="border: none; background: white;"></iframe>
                      <?php else: ?>
                        <h2 class="text-black">File not found.</h2>
                      <?php endif ?>
                      <button class="btn btn-primary fca" style="width:auto;"
                        href="#fca" data-toggle="modal"
                        data-teams_id="<?php echo $row4['teams_teams_id'] ?>">Upload File</button>
                    </div>
                  </div>
                  <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: auto; width:40%;margin:50px;">
                    <h3 class="text-primary">3rd Year</h3>
                    <div class="inner" style="display:flex; flex-direction:column; align-items: center; gap: 10px; text-align: center;">
                      <h4 style="font-weight:bold; color:black;">Defense Fee</h4>
                      <?php if ($row4['defense_fee'] != NULL): ?>
                        <iframe src="../uploads/<?= $row4['defense_fee'] ?>" width="100%" height="600" style="border: none; background: white;"></iframe>
                      <?php else: ?>
                        <h2 class="text-black">File not found.</h2>
                      <?php endif ?>
                      <button class="btn btn-primary df" style="width:auto;"
                        href="#df" data-toggle="modal"
                        data-df_teams_id="<?php echo $row4['teams_teams_id'] ?>">Upload File</button>
                    </div>
                  </div>
                </div>

                <div style="display:flex; width:100%;">
                  <?php
                  $sql = "SELECT * FROM users WHERE id =" . $_SESSION['id'];
                  $stmt = $this->conn()->query($sql);
                  $row = $stmt->fetch();

                  if ($row['yr_lvl'] == "4TH"):
                  ?>
                    <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: auto; width:40%;margin:50px;">
                      <h3 class="text-primary">4th Year</h3>
                      <div class="inner" style="display:flex; flex-direction:column; align-items: center; gap: 10px; text-align: center;">
                        <h4 style="font-weight:bold; color:black;">Form Coordinator Approval</h4>
                        <?php if ($row4['coor_approval4'] != NULL): ?>
                          <iframe src="../uploads/<?= $row4['coor_approval4'] ?>" width="100%" height="600" style="border: none; background: white;"></iframe>
                        <?php else: ?>
                          <h2 class="text-black">File not found.</h2>
                        <?php endif ?>
                        <button class="btn btn-primary fca4" style="width:auto;"
                          href="#fca4" data-toggle="modal"
                          data-teams_id="<?php echo $row4['teams_teams_id'] ?>">Upload File</button>
                      </div>
                    </div>
                    <div class="small-box" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: auto; width:40%;margin:50px;">
                      <h3 class="text-primary">4th Year</h3>
                      <div class="inner" style="display:flex; flex-direction:column; align-items: center; gap: 10px; text-align: center;">
                        <h4 style="font-weight:bold; color:black;">Defense Fee</h4>
                        <?php if ($row4['defense_fee4'] != NULL): ?>
                          <iframe src="../uploads/<?= $row4['defense_fee4'] ?>" width="100%" height="600" style="border: none; background: white;"></iframe>
                        <?php else: ?>
                          <h2 class="text-black">File not found.</h2>
                        <?php endif ?>
                        <button class="btn btn-primary df4" style="width:auto;"
                          href="#df4" data-toggle="modal"
                          data-df_teams_id="<?php echo $row4['teams_teams_id'] ?>">Upload File</button>
                      </div>
                    </div>
                  <?php endif ?>
                </div>
              <?php } ?>

            </section>
          <?php endif; ?>
          <?php if ($_SESSION['type'] == 0): ?>
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box" style="border-top: unset;">
                    <div class="box-body table-responsive">
                      <table id="example1" class="table table-bordered">
                        <thead>
                          <th>List</th>
                          <th>Teams</th>
                          <th>Adviser</th>
                          <th>Status</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php $sql = "SELECT * FROM teams JOIN users ON teams.adviser_id = users.id";
                          $stmt = $this->conn()->query($sql);
                          $id = 1;
                          while ($row = $stmt->fetch()) { ?>
                            <tr>
                              <td><?php echo $id; ?></td>
                              <td><?php echo ucwords($row['name']) ?></td>
                              <td><?php echo ucwords($row['firstname'] . " " . $row['lastname']) ?></td>
                              <td class="text-center">

                                <?php
                                if ($row['status'] == 0) {
                                  echo "<span class='badge btn-primary' style='width: 100%;'>ONGOING</span>";
                                } else if ($row['status'] == 1) {
                                  echo "<span class='badge btn-success' style='width: 100%;'>COMPLETED</span>";
                                } else if ($row['status'] == 2) {
                                  echo "<span class='badge btn-danger' style='width: 100%;'>PAST DUE</span>";
                                }
                                ?>


                              </td>
                              <td class="text-center">
                                <?php if ($_SESSION['type'] == 1): ?>
                                  <a href="viewtasklist.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-success btn-sm btn-table'>VIEW TASK LIST</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['type'] == 0): ?>
                                  <a href="#" class='btn btn-success btn-sm admincomment btn-table w-25' data-admincomment_teams_id='<?php echo $row['teams_id'] ?>'>COMMENTS</a>
                                  <a href="viewmembers.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-warning btn-sm btn-table'>VIEW MEMBERS</a>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php $id++;
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          <?php endif; ?>



          <?php if ($_SESSION['type'] == 1): ?>
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box" style="border-top: unset;">
                    <div class="box-body table-responsive">
                      <table id="example1" class="table table-bordered">
                        <thead>
                          <th style="font-size: 23px;font-style: normal;">Teams</th>
                          <th style="font-size: 23px;font-style: normal;">Panelists</th>
                          <th style="font-size: 23px;font-style: normal;">Status</th>
                          <th style="font-size: 23px;font-style: normal;">Date Response</th>
                          <th style="font-size: 23px;font-style: normal;">Group Status</th>
                          <th style="font-size: 23px;font-style: normal;">Grades</th>
                          <th style="font-size: 23px;font-style: normal;">Comments</th> <!-- Added Comments Column -->
                          <th style="font-size: 23px;font-style: normal;">Action</th>
                        </thead>
                        <tbody>
                          <?php
                          if ($_SESSION['type'] == 1) {
                            $sql = "SELECT * FROM teams WHERE adviser_id = '" . $_SESSION['id'] . "'";
                          } else {
                            $sql = "SELECT * FROM teams";
                          }
                          $stmt = $this->conn()->query($sql);
                          $id = 1;
                          while ($row = $stmt->fetch()) { ?>
                            <tr>
                              <td style="font-size: 23px;font-style: normal;"><?php echo ucwords($row['name']) ?></td>
                              <td style="font-size: 14px; font-style: normal;">
                                <?php
                                $teamId = $row['teams_id'];
                                $panelQuery = $this->conn()->prepare("SELECT * FROM panelist WHERE teams_id = ?");
                                $panelQuery->execute([$teamId]);
                                $panelists = $panelQuery->fetchAll(PDO::FETCH_ASSOC);

                                if (!empty($panelists)) {
                                  foreach ($panelists as $panelist): ?>
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 5px; flex-wrap: wrap;">
                                      <span style="word-break: break-word; max-width: 150px;">
                                        <?php echo ucwords($panelist['fullname']); ?>
                                      </span>
                                      <div>
                                        <button class="btn btn-warning btn-sm edit-panelist"
                                          data-panelist_id="<?php echo $panelist['panelist_id']; ?>"
                                          data-panelist_fullname="<?php echo htmlspecialchars($panelist['fullname']); ?>"
                                          data-panelist_teams_id="<?php echo $panelist['teams_id']; ?>">
                                          <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-panelist"
                                          data-panelist_id="<?php echo $panelist['panelist_id']; ?>"
                                          data-panelist_fullname="<?php echo htmlspecialchars($panelist['fullname']); ?>">
                                          <i class="fa fa-trash"></i>
                                        </button>
                                      </div>
                                    </div>
                                <?php endforeach;
                                } else {
                                  echo '<span style="color: gray;">No panelists</span>';
                                }
                                ?>
                              </td>

                              <td class="text-center" style="font-size: 23px;font-style: normal;">
                                <?php

                                if ($row['adviser_status'] == 0) {
                                  echo "<span class='badge btn-primary' style='padding: 10px 20px; width: 100%;'>Request Adviser</span>";
                                } else if ($row['adviser_status'] == 1) {
                                  echo "<span class='badge btn-success' style='padding: 10px 20px; width: 100%;'>Accepted</span>";
                                } else if ($row['adviser_status'] == 2) {
                                  echo "<span class='badge btn-danger' style='padding: 10px 20px; width: 100%;'>Declined</span>";
                                }
                                ?>
                              </td>
                              <td style="font-size: 23px;font-style: normal;"><?= date("M. d, Y", strtotime($row['date_response'])) ?></td>
                              <td class="text-center" style="font-size: 23px;font-style: normal;">
                                <?php
                                if ($row['status'] == 0) {
                                  echo "<span>~</span>";
                                } else if ($row['status'] == 1) {
                                  echo "<span class='badge btn-success' style='padding: 10px 20px; width: 100%;'>Passed</span>";
                                } else if ($row['status'] == 2) {
                                  echo "<span class='badge btn-danger' style='padding: 10px 20px; width: 100%;'>Redefense</span>";
                                } else if ($row['status'] == 3) {
                                  echo "<span class='badge btn-danger' style='padding: 10px 20px; width: 100%;'>Failed</span>";
                                }
                                ?>
                              </td>
                              <td style="font-size: 23px;font-style: normal;">
                                <?php if ($row['grade'] == NULL): ?>
                                  ~
                                <?php else: ?>
                                  <?= number_format($row['grade'], 2) ?>
                                <?php endif ?>
                              </td>
                              <td style="font-size: 14px; font-style: italic;"> <!-- Added Comments Column -->
                                <?php if ($row['comments'] == NULL || $row['comments'] == ''): ?>
                                  No Comments
                                <?php else: ?>
                                  <?= htmlspecialchars($row['comments']) ?>
                                <?php endif ?>
                              </td>
                              <td style="font-size: 23px;font-style: normal; width: 10% ;">

                                <?php if ($_SESSION['type'] == 1): ?>


                                  <?php if ($row['adviser_status'] == 1): ?>

                                    <button class='btn btn-primary btn-sm changestatus btn-table'
                                      data-changestatus_teams_id='<?php echo $row['teams_id'] ?>'>Change Group Status</button>
                                    <button class='btn btn-danger btn-sm deleteteams btn-table'>REMOVE</button>

                                  <?php else: ?>
                                    <button class='btn btn-primary btn-sm changestatus2 btn-table'
                                      data-changestatus2_teams_id='<?php echo $row['teams_id'] ?>'>EDIT</button>
                                  <?php endif; ?>
                                  <?php if ($row['adviser_status'] == 1): ?>
                                    <a href="viewmembers.php?teams_id=<?php echo $row['teams_id'] ?>" class='btn btn-warning btn-sm btn-table'>VIEW</a>
                                    <a href="#" class='btn btn-success btn-sm panelist btn-table' data-panelist_teams_id='<?php echo $row['teams_id'] ?>'>CREATE PANELIST</a>
                                  <?php endif; ?>

                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php $id++;
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          <?php endif; ?>



          <?php if ($_SESSION['type'] == 1 or $_SESSION['type'] == 0): ?>
            <div style="width: 100%;display: flex;padding: 10px;justify-content: space-between;">
              <div class="form-control" style="display: flex;place-items: center;max-width: 500px;">
                <input type="text" class="search" style="width: 100%;height: 100%;box-shadow: none;outline: none;border: none;">
                <i class="fas fa-search"></i>
              </div>
              <div style="text-align: right;font-size: 18px; padding: 15px;">
                <span class="totalgroups"><i class="fas fa-users"></i></span>
                <span class="totaladviser" style="margin:5px;"></span>
                <span class="totalstudents"></span>
                <span>
                  <select id="selectdepartment" class="p-5">
                    <option value="" selected disabled>Select Department</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Computer SCIENCE">Computer Science</option>
                  </select>
                </span>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($_SESSION['type'] == 1 or $_SESSION['type'] == 0): ?>
            <section class="content">
              <div class="row searchgroup">

              </div>
            </section>
          <?php endif; ?>



        </div>
      </div>
      <?php include 'footer.php'; ?>
      <?php include 'modal/teamsModal.php'; ?>
      <script>
        $(document).on('click', '.edit', function(e) {
          e.preventDefault();
          $('#edit').modal('show');
          var edit_teams_id = $(this).data('edit_teams_id');
          var edit_name = $(this).data('edit_name');
          var edit_thesis = $(this).data('edit_thesis');

          $('#edit_teams_id').val(edit_teams_id);
          $('#edit_name').val(edit_name);
          $('#edit_thesis').val(edit_thesis);
        });

        $(document).on('click', '.fca', function(e) {
          e.preventDefault();
          $('#fca').modal('show');
          var teams_id = $(this).data('teams_id');

          $('#teams_id').val(teams_id);
        });

        $(document).on('click', '.fca4', function(e) {
          e.preventDefault();
          $('#fca4').modal('show');
          var teams_id = $(this).data('teams_id');

          $('#teams_id4').val(teams_id);
        });

        $(document).on('click', '.df', function(e) {
          e.preventDefault();
          $('#df').modal('show');
          var df_teams_id = $(this).data('df_teams_id');

          $('#df_teams_id').val(df_teams_id);
        });

        $(document).on('click', '.df4', function(e) {
          e.preventDefault();
          $('#df4').modal('show');
          var df_teams_id = $(this).data('df_teams_id');

          $('#df_teams_id4').val(df_teams_id);
        });

        $(document).on('click', '.panelist', function(e) {
          e.preventDefault();
          $('#panelist').modal('show');
          var panelist_teams_id = $(this).data('panelist_teams_id');

          $('#panelist_teams_id').val(panelist_teams_id)
        });

        $(document).on('click', '.edit-panelist', function() {
          const panelistId = $(this).data('panelist_id');
          const fullname = $(this).data('panelist_fullname');
          const teamsId = $(this).data('panelist_teams_id');

          $('#edit_panelist_id').val(panelistId); // Set the panelist ID
          $('#edit_fullname').val(fullname); // Set the full name
          $('#panelist_teams_id').val(teamsId); // Set the team ID (if needed)
          $('#editPanelist').modal('show'); // Show the Edit Panelist modal
        });

        $(document).on('click', '.delete-panelist', function() {
          const panelistId = $(this).data('panelist_id');
          const fullname = $(this).data('panelist_fullname');

          $('#delete_panelist_id').val(panelistId); // Set the panelist ID
          $('#delete_panelist_name').text(fullname); // Set the full name in the confirmation message
          $('#deletePanelist').modal('show'); // Show the Delete Panelist modal
        });

        $(document).on('click', '.assignadviser', function(e) {
          e.preventDefault();
          $('#assignadviser').modal('show');
          var assignadviser_teams_id = $(this).data('assignadviser_teams_id');

          $('#assignadviser_teams_id').val(assignadviser_teams_id)
        });



        $(document).on('click', '.admincomment', function(e) {
          e.preventDefault();
          $('#admincomment').modal('show');
          var admincomment_teams_id = $(this).data('admincomment_teams_id');

          $('#admincomment_teams_id').val(admincomment_teams_id)
        });

        $(document).on('click', '.changestatus', function(e) {
          e.preventDefault();
          $('#changestatus').modal('show');
          var changestatus_teams_id = $(this).data('changestatus_teams_id');
          $('#changestatus_teams_id').val(changestatus_teams_id)
        });

        $(document).on('click', '.changestatus2', function(e) {
          e.preventDefault();
          $('#changestatus2').modal('show');
          var changestatus2_teams_id = $(this).data('changestatus2_teams_id');
          $('#changestatus2_teams_id').val(changestatus2_teams_id)
        });

        $(document).on('click', '.delete', function(e) {
          e.preventDefault();
          $('#delete').modal('show');
          var delete_teams_member_id = $(this).data('delete_teams_member_id');
          $('#delete_teams_member_id').val(delete_teams_member_id)
        });

        $(document).on('click', '.deleteteams', function(e) {
          e.preventDefault();
          $('#delete').modal('show');
          var deleteteams_teams_id = $(this).data('deleteteams_teams_id');
          var deleteteams_mem_name = $(this).data('deleteteams_mem_name');
          console.log('member: ', deleteteams_mem_name);
          $('#deleteteams_teams_id').val(deleteteams_teams_id);
          $('#deleteteams_mem_name').text(deleteteams_mem_name);
        });

        function searchTeams(query) {
          $.ajax({
            url: 'searchgroup.php',
            type: 'POST',
            data: {
              search: query
            },
            success: function(data) {
              $('.searchgroup').html(data);
            },
          });
        }

        // Initial fetch when the page loads
        $(document).ready(function() {
          searchTeams(''); // Fetch all teams on load

          let debounceTimer;
          $('.search').on('keyup', function() {
            const query = $(this).val();
            clearTimeout(debounceTimer); // Clear the previous timer
            debounceTimer = setTimeout(function() {
              searchTeams(query); // Fetch results after a delay
            }, 300); // Adjust the delay as needed
          });

          $('#selectdepartment').on('change', function() {
            const selectdepartment = $(this).val();

            $.ajax({
              url: 'totalstudents.php',
              type: 'POST',
              data: {
                selectdepartment: selectdepartment
              },
              success: function(data) {
                $('.totalstudents').html(data);
              },
            });

            $.ajax({
              url: 'totaladviser.php',
              type: 'POST',
              data: {
                selectdepartment: selectdepartment
              },
              success: function(data) {
                $('.totaladviser').html(data);
              },
            });

            $.ajax({
              url: 'totalgroups.php',
              type: 'POST',
              data: {
                selectdepartment: selectdepartment
              },
              success: function(data) {
                $('.totalgroups').html(data);
              },
            });

            $.ajax({
              url: 'searchgroup.php',
              type: 'POST',
              data: {
                selectdepartment: selectdepartment
              },
              success: function(data) {
                $('.searchgroup').html(data);
              },
            });


          });



        });
      </script>
    </body>

    </html>
<?php }
}
$data = new data();
$data->managedata(); ?>
