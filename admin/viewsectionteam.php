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
  <?php
  
    $sql = "SELECT * 
                        FROM teams t 
                        INNER JOIN teams_member tm ON t.teams_id = tm.teams_id
                        INNER JOIN users u ON tm.users_id = u.id
                        INNER JOIN sections s ON u.section = s.section_name 
                        WHERE s.department = '".$_GET['department']."'
                        AND s.adviser = '".$_GET['adviser_id']."' AND t.name = '".$_GET['team_name']."'";
          $stmt2 = $this->conn()->query($sql);
  ?>
    <div class="content-wrapper" style="height: 100vh; overflow-y: auto;">
        <section class="content">
            <a href="viewsection.php?section_name=<?=$_GET['section_name']?>&department=<?=$_GET['department']?>" class='btn btn-lg btn-flat' style="margin-bottom:20px;border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
            <div class="row">
                <div class="col-xs-7">
                    <div class="vst-head" style="border:2px solid lightgray; background-color: white; height: 50px;">
                        <h3>Improving Academic Performance</h3>
                    </div>
                    <div class="vst-head"  style="border:1px solid lightgray; background-color: <?php echo $_GET['department'] == 'Information Technology' ? '#54a2e8' : '#5ce1e6'?>; height: 50px; place-items:center;">
                        <h4><?php echo isset($_GET['department']) && $_GET['department'] == 'Information Technology' ? "Information Technology" : "Computer Science" ?></h4>
                    </div>
                    <div class="vst-head"  style="height: 50px; border:2px solid lightgray;background-color:white; ">
                        <h5>Team Overview for <?= $_GET['team_name']?></h5>
                    </div>
                    
                    <div>
                        <?php
                            $sql = "SELECT * FROM teams WHERE teams_id = '".$_GET['teams_id']."'";
                            $stmt_table = $this->conn()->query($sql);
                            $tables = $stmt_table->fetchAll()
                        ?>
                        <?php foreach($tables as $table): ?>
                        <table style="width:100%; margin-top:50px;">
                            <tr>
                                <th>3rd Year</th>
                                <th>Coordinator Approval</th>
                                <th>Date Uploaded</th>
                                <th>Defense Fee</th>
                                <th>Date Uploaded</th>
                            </tr>
                            
                               
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        <?php if($table['coor_approval'] != NULL): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['file' => $table['coor_approval']])) ?>">
                                            <?= htmlspecialchars($table['coor_approval'], ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                        <?php else: ?>
                                        ~
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center"><?= $table['ca_upload_date'] != NULL ? date("d F Y", strtotime($table['ca_upload_date'])) : '~' ?></td>
                                    <td class="text-center">
                                        <?php if($table['defense_fee'] != NULL): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['file' => $table['defense_fee']])) ?>">
                                            <?= htmlspecialchars($table['defense_fee'], ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                        <?php else: ?>
                                        ~
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center"><?= $table['df_upload_date'] != NULL ? date("d F Y", strtotime($table['df_upload_date'])) : '~' ?></td>
                                </tr>
                        </table>
                        <table style="width:100%; margin-top:50px;">
                            
                            <tr>
                                <th>4th Year</th>
                                <th>Coordinator Approval</th>
                                <th>Date Uploaded</th>
                                <th>Defense Fee</th>
                                <th>Date Uploaded</th>
                            </tr>
                            
                               
                                 <tr>
                                     <td></td>
                                    <td class="text-center">
                                        <?php if($table['coor_approval4'] != NULL): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['file' => $table['coor_approval4']])) ?>">
                                            <?= htmlspecialchars($table['coor_approval4'], ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                        <?php else: ?>
                                        ~
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center"><?= $table['ca_upload_date4'] != NULL ? date("d F Y", strtotime($table['ca_upload_date4'])) : '~' ?></td>
                                    <td class="text-center">
                                        <?php if($table['defense_fee4'] != NULL): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['file' => $table['defense_fee4']])) ?>">
                                            <?= htmlspecialchars($table['defense_fee4'], ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                        <?php else: ?>
                                        ~
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center"><?= $table['df_upload_date4'] != NULL ? date("d F Y", strtotime($table['df_upload_date4'])) : '~' ?></td>
                                </tr>
                        </table>
                        <?php endforeach ?>
                    </div>
                    <div>
                        <?php
                            $sql = "SELECT * 
                                    FROM teams t 
                                    INNER JOIN users u ON t.adviser_id = u.id
                                    WHERE t.teams_id = '".$_GET['teams_id']."'";
                            $stmt2 = $this->conn()->query($sql);
                            $row1 = $stmt2->fetch();
                            
                            $fullname = $row1['firstname']." ".$row1['lastname'];
                        ?>
                        
                        <h4>Adviser: <?=ucwords($fullname)?></h4>
                        <?php if($fullname == NULL): ?>
                            <img src="../images/<?=$row1['img'] == NULL? "default.png" : $row1['img'] ?>" style="border-radius:50%; margin-left: 20px;" width="70px" height="70px">
                        <?php else: ?>
                            No adviser
                        <?php endif ?>
                    </div>
                    <div>
                        <?php
                            $sql = "SELECT * 
                                    FROM teams_member tm
                                    INNER JOIN users u ON u.id = tm.users_id
                                    WHERE tm.teams_id = '".$_GET['teams_id']."'";
                            $stmt = $this->conn()->query($sql);
                            $rows = $stmt->fetchAll();
                        ?>
                        <h4>Group Members:</h4>
                        <?php foreach ($rows as $row): ?>
                        <div class="col-lg-2 col-12" style="margin-right: 50px;">
                            <div class="small-box-req" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); background-color:white !important;color:#fff;border-radius: 30px;padding: 30px 0px;height: 300px;width:150px;">
                              <div class="inner" style="text-align: center;">
                                  <img src="../images/<?= $row['img'] ?>" width="35px" height="35px" style="border-radius: 50%;">
                                  <p style="color:#000;font-weight: bold;font-size: 18px;margin: 10px 0px;"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                                  <p style="color:#000;font-weight: normal;font-size: 18px;margin: 0;"><?php echo $row['section'] == NULL ? 'No section yet.' : $row['section']; ?></p>
                                  <?php if($row['individual_grade'] == NULL || $row['individual_grade'] == 0): ?>
                                    <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to add grade">Grade: in Progress</p>
                                  <?php else: ?>
                                   <p style="color:#000;font-weight: normal;font-size: 16px;margin: 10px 0px;" title="click details to change grade">Grade: <?php echo $row['individual_grade']; ?></p>
                                  <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                
                <div class="col-xs-5">
                    <?php if (isset($_GET['file'])):?>
                        <iframe src="../uploads/<?=$_GET['file']?>" width="100%" height="600" style="border: none; background: white;"></iframe>
                    <?php else: ?>
                        <div style="width:100%; height:600; font-size: 80px; text-align:center;">
                            <p>No image selected</p>
                        </div>
                    <?php endif?>
                </div>
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