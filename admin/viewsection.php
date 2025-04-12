<?php 
  session_start();
  
    if(!isset($_SESSION['id'])){
        header('location:../login.php');
        exit;
    }
  include '../config/config.php';
    class data extends Connection { 
      public function managedata(){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <?php include 'profile.php'; ?>
  <?php include 'sidebar.php'; ?>
  <?php if ($_SESSION['type'] == 1): ?>

    <div class="content-wrapper" style="height: 100vh; overflow-y: auto;">
        <section class="content">
            <a href="dashboard.php" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
            <div class="row">
                <div class="col-lg-3 col-12">
                </div>
                <div class="col-lg-6 col-12 d-flex flex-column h-100 text-center">
                    <div class="" style="border:2px solid lightgray; background-color: white; background-image:url(<?php echo $_GET['department'] == 'Information Technology' ? '../images/it_logo.jpg' : '../images/cs_logo.png'?>)<?php echo $_GET['department'] == 'Information Technology' ? ',linear-gradient(to bottom, white, #dcdcdc)' : ''?>; background-size: contain; background-repeat: no-repeat; background-position: center; width: 100%; height: 100px">
                    </div>
                    <div class=""  style="border:1px solid lightgray; background-color: white;">
                        <p style="margin: 5px 0px;"><?php echo isset($_GET['department']) && $_GET['department'] == 'Information Technology' ? "Information Technology" : "Computer Science" ?></p>
                    </div>
                    <div class=""  style="border:2px solid lightgray; background-color: <?php echo $_GET['department'] == 'Information Technology' ? '#54a2e8' : '#5ce1e6'?>">
                        <p style="margin: 5px 0px;">Class Overview for <?= $_GET['section_name']?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                </div>
                <?php 

                $colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33A8', '#33FFF6', '#FFF633', '#A833FF']; // Array of colors
                $colorIndex = 0;
                
                $department = $_GET['department'] ?? '';  // Ensure parameter exists
                $section = $_GET['section_name'] ?? '';  // Ensure parameter exists
                
                // Secure SQL query using prepared statements
                $sql = "SELECT 
                            *
                        FROM teams t 
                        INNER JOIN teams_member tm ON t.teams_id = tm.teams_id
                        INNER JOIN users u ON tm.users_id = u.id
                        INNER JOIN sections s ON u.section = s.section_name
                        WHERE s.department = :department AND s.section_name = :section
                        GROUP BY t.name, t.teams_id, s.department"; // Ensure GROUP BY includes all selected columns
                
                $stmt = $this->conn()->prepare($sql);
                $stmt->bindParam(':department', $department, PDO::PARAM_STR);
                $stmt->bindParam(':section', $section, PDO::PARAM_STR);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {  // Check if there are results
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                        // Count total members in each team
                        $sql2 = "SELECT COUNT(teams_member_id) AS total FROM teams_member WHERE teams_id = :teams_id";
                        $stmt2 = $this->conn()->prepare($sql2);
                        $stmt2->bindParam(':teams_id', $row['teams_id'], PDO::PARAM_INT);
                        $stmt2->execute();
                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        $total = $row2['total'] ?? 0;
                
                        $generateColor = $colors[$colorIndex];
                        $colorIndex = ($colorIndex + 1) % count($colors);
                        
                        $sql3 = "SELECT * FROM sections s INNER JOIN users u ON u.id = s.adviser WHERE s.adviser = :adviser_id";
                        $stmt3 = $this->conn()->prepare($sql3);
                        $stmt3->bindParam(':adviser_id', $row['adviser'], PDO::PARAM_INT);
                        $stmt3->execute();
                        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                        
                        $adviser = ucwords($row3['firstname']." ".$row3['lastname']);
                ?>
                        <div class="grp-box col-lg-4 col-12" style="margin-top: 20px;">
                            <a href="viewsectionteam.php?department=<?= htmlspecialchars($row['department']) ?>&team_name=<?= htmlspecialchars($row['name']) ?>&teams_id=<?= htmlspecialchars($row['teams_id']) ?>&section_name=<?= htmlspecialchars($_GET['section_name'] ?? '') ?>&adviser_id=<?= htmlspecialchars($row['adviser']) ?>">
                                <div class="small-box" style="box-shadow: 5px 5px 10px rgb(0, 0, 0, .5);background-color:white !important;color:#000;border-radius: 30px;height: 350px;padding: 30px;">
                                    <div class="" style="display: flex;width: 100%;">
                                        <div style="height: 300px;width: 20px;background: <?= $generateColor; ?>;border-radius: 10px;"></div>
                                        <div style="width: 100%;margin-left: 20px;">
                                            <div style="display: flex;justify-content: space-between;">
                                                <h4 style="margin: unset;"><?= htmlspecialchars($row['name']); ?></h4>
                                                <i class="fas fa-ellipsis-v" style="font-size: 24px;color:#000;cursor: pointer;"></i>
                                            </div>
                                            <div style="height: 230px;">
                                                <h4 style="text-align: left;"><?=$row['thesis_title'] == NULL ? "No title yet." : $row['thesis_title']?></h4>
                                            </div>
                                            <div style="display: flex;justify-content: space-between;">
                                                <div style="display: flex;place-items: center;">
                                                    <i class="fas fa-users" style="font-size: 16px;color:#000; font-size: 13px;"></i>
                                                    <p style="margin: unset;font-size: 16px;margin-left: 10px; font-size: 13px;"><?= $total . ($total >= 2 ? ' MEMBERS' : ' MEMBER') ?></p>
                                                </div>
                                                <div style="display: flex; place-items: center;">
                                                    <i class="fas fa-user-check" style="font-size: 16px;color:#000; font-size: 13px;"></i>
                                                    <div>
                                                    <p style="margin: unset;font-size: 16px;margin-left: 10px; font-size: 13px;"><?=$adviser == NULL ? 'No assigned RT yet.' : $adviser?></p>
                                                    <p style="margin: unset;font-size: 16px;margin-left: 10px; font-size: 13px;">RESEARCH TEACHER</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='grp-box col-lg-4 col-12' style='margin-top: 20px; place-items:center; width:100%;'>
                            <p style='text-align:center; font-weight:semi-bold; font-size:30px'>No groups in this class</p>
                          </div>";
                }
                ?>

                 
            </div>
        </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php endif ?>
</body>
</html>
<?php
        } 
    } 
    
    $data = new data(); 
    $data->managedata(); 
?>