<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
?>
<?php 

            $colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33A8', '#33FFF6', '#FFF633', '#A833FF']; // Array of colors
            $colorIndex = 0;


            if ($_SESSION['type'] == 1) {

              if (isset($_POST['selectdepartment'])) {

                $sql = "SELECT * FROM teams LEFT JOIN users ON teams.users_id=users.id WHERE users.department='".$_POST['selectdepartment']."' AND teams.adviser_id='".$_SESSION['id']."' AND teams.adviser_status = '1'";

              } else {

                $search = $_POST['search'];
                if ($search == "" || !isset($search) || !isset($_POST['selectdepartment']) || $_POST['selectdepartment'] == "") {
                  $sql = "SELECT * FROM teams LEFT JOIN users ON teams.users_id=users.id WHERE teams.adviser_id='".$_SESSION['id']."' AND teams.adviser_status = '1'";
                } else {
                  $sql = "SELECT * FROM teams LEFT JOIN users ON teams.users_id=users.id WHERE name LIKE '%$search%' AND teams.adviser_id='".$_SESSION['id']."'  AND teams.adviser_status = '1' LIMIT 5";
                }

              }

            } else {

              if (isset($_POST['selectdepartment'])) {

                $sql = "SELECT * FROM teams INNER JOIN users ON teams.users_id=users.id WHERE users.department='".$_POST['selectdepartment']."'";

              } else {

                $search = $_POST['search'];
                if ($search == "" OR !isset($search)) {
                  $sql = "SELECT * FROM teams INNER JOIN users ON teams.users_id=users.id";
                } else {
                  $sql = "SELECT * FROM teams INNER JOIN users ON teams.users_id=users.id WHERE name LIKE '%$search%' LIMIT 5";
                }

              }

            }

            
            

            
            $stmt = $this->conn()->query($sql);
            while ($row = $stmt->fetch()) {

              $sql2 = "SELECT *,COUNT(teams_member_id) AS total FROM teams_member WHERE teams_id='".$row['teams_id']."'";
            $stmt2 = $this->conn()->query($sql2);
            $row2 = $stmt2->fetch();
            $total = $row2['total'];

            $generateColor = $colors[$colorIndex];
            $colorIndex = ($colorIndex + 1) % count($colors);
             ?>
             <style>
              .grp-box:hover {
                transform: scale(1.02);
              }
              .small-box:hover {
                transform: scale(1.02);
              }
             </style>
              <div class="grp-box col-lg-4 col-12">
                <!--<a href="viewgroup.php?teams_id=<?php echo $row['teams_id'] ?>">-->
                  <div class="small-box" style="box-shadow: 5px 5px 10px rgb(0, 0, 0, .5);background-color:white !important;color:#000;border-radius: 30px;height: 350px;padding: 30px;">
                    <div class="" style="display: flex;width: 100%;">
                      <div style="height: 300px;width: 20px;background: <?php echo $generateColor; ?>;border-radius: 10px;">
                      </div>
                      <div style="width: 100%;margin-left: 20px;">
                        <div style="display: flex;justify-content: space-between;">
                          <h4 style="margin: unset;"><?php echo $row['name']; ?></h4>
                          <i class="fas fa-ellipsis-v" style="font-size: 24px;color:#000;cursor: pointer;"></i>
                        </div>
                        
                        <div style="height: 230px;">
                            
                            <div style="display:flex; flex-direction: column; width: 100%;">
                                <div style="margin-top:20px;">
                                    <a href="managegroupmembersdetails.php?teams_id=<?php echo $row['teams_id'] ?>">
                                      <div class="small-box" style="border: 2px solid #000;color:#000;border-radius: 5px;height: 50%;width: 100%;padding: 10px;">
                                        <div style="display:flex; justify-content:left; align-items:center;">
                                          <img src="../images/Manage Group Icon.png" style="margin-right:10px;" width="30px">
                                          <p style="font-size: 14px; margin:0;">Manage Group Members</p>
                                        </div>
                                      </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="monitorthesis.php?teams_id=<?php echo $row['teams_id'] ?>">
                                      <div class="small-box" style="border: 2px solid #000;color:#000;border-radius: 5px;height: 50%;width: 100%;padding: 10px;">
                                        <div style="display: flex; justify-content:left; align-items:center;">
                                          <img src="../images/Monitor Thesis Icon.png" style="margin-right:10px;" width="30px">
                                          <p style="margin: unset; font-size: 14px;">Monitor Thesis</p>
                                        </div>
                                      </div>
                                    </a>
                                </div>
                            </div>
                          
                        </div>
                        
                        <div style="display: flex;justify-content: space-between;">
                          <div style="display: flex;place-items: center;">
                            <i class="fas fa-users" style="font-size: 16px;color:#000;"></i>
                            <p style="margin: unset;font-size: 16px;margin-left: 10px;"><?php echo $total; ?>
                              <?php 
                              if ($total >= 2) {
                                echo 'MEMBERS';
                              } else {
                                echo 'MEMBER';
                              }
                              ?>
                            </p>
                          </div>
                          <div style="display: flex;place-items: center;">
                            <i class="fas fa-user-check" style="font-size: 16px;color:#000;"></i>
                            <p style="margin: unset;font-size: 16px;margin-left: 10px;">ADVISER
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <!--</a>-->
              </div>  
            <?php } ?>


      <?php } } $data = new data(); $data->managedata(); ?>