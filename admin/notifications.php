<?php 
  session_start();
  
  if(!isset($_SESSION['id'])){
        header('location:../logout.php');
        exit;
    }
  
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
    if($_SESSION['type'] == 1){
        $sql = "UPDATE reminder_adviser SET notif = 0 WHERE notif = 1 AND adviser_id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$_SESSION['id']]);
    } elseif($_SESSION['type'] == 2) {
        $sql1 = "SELECT teams_id FROM teams_member WHERE users_id = ?";
        $stmt1 = $this->conn()->prepare($sql1);
        $stmt1->execute([$_SESSION['id']]);
        $team_id = $stmt1->fetchColumn() ?: null;
        
        $sql = "UPDATE reminder SET notif = 0 WHERE notif = 1 AND teams_id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$team_id]);
    }
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
                  <?php if($_SESSION['type'] == 1): ?>
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th style="font-size: 23px;font-style: normal;">Notes</th>
                        <th style="font-size: 23px;font-style: normal;">Date</th>
                      </thead>
                      <tbody>
                        <?php $sql = "SELECT * FROM reminder_adviser WHERE adviser_id = '".$_SESSION['id']."'";
                        $stmt = $this->conn()->query($sql);
                        while ($row = $stmt->fetch()) { ?>
                          <tr>
                            <td style="font-size: 23px;font-style: normal;">
                                <?php 
                                    if(str_contains($row['notes'], 'uploaded')):
                                        
                                    $sql1 = "SELECT * FROM teams WHERE adviser_id = ?";
                                    $stmt1 = $this->conn()->prepare($sql1);
                                    $stmt1->execute([$_SESSION['id']]);
                                    $row1 = $stmt1->fetch();
                                    $teams_id = $row1['teams_id'];
                                    
                                ?>
                                    <a href="viewtasklist.php?teams_id=<?= $teams_id ?>"><?= $row['notes'] ?></a>
                                <?php else: ?>
                                    <a href="teams.php"><?php echo $row['notes'] ?></a>
                                <?php endif ?>
                            </td>
                            <td><?=$row['date']?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php endif; ?>

                  <?php if($_SESSION['type'] == 2): ?>
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th style="font-size: 23px;font-style: normal;">Title</th>
                        <th style="font-size: 23px;font-style: normal;">Reminder</th>
                        <th style="font-size: 23px;font-style: normal;">Date</th>
                      </thead>
                      <tbody>
                         
                             <?php 
                                $sql = "SELECT teams_id FROM teams_member WHERE users_id = ?";
                                $stmt = $this->conn()->prepare($sql);
                                $stmt->execute([$_SESSION['id']]);
                                $row = $stmt->fetch();
                                $teams_id = $row['teams_id'];
        
                                $sql2 = "SELECT r.notes, sdl.name, r.date FROM reminder r LEFT JOIN setdeadline sdl ON r.setdeadline_id=sdl.setdeadline_id WHERE r.teams_id = ? ORDER BY r.date DESC";
                                $stmt2 = $this->conn()->prepare($sql2);
                                $stmt2->execute([$teams_id]);
                                while ($row2 = $stmt2->fetch()): 
                            ?>
                             <tr>
                                <td style="font-size: 23px;font-style: normal;"> <a href="tasklist.php"><?= ucwords($row2['name']) ?></a></td>
                                <td style="font-size: 20px;font-style: normal;"><?= $row2['notes'] ?></td>
                                <td style="font-size: 20px;font-style: normal;"><?= date("d F Y", strtotime($row2['date'])) ?></td>
                             </tr>
                            <?php endwhile ?>
                         
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
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>