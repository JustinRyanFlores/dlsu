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
            $sql = "UPDATE setdeadline SET notif = 0 WHERE notif = 1 AND teams_id = ? AND setdeadline_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$_GET['teams_id'], $_GET['setdeadline_id']]);
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
        <div>
          <?php 
          if (isset($_GET['teams_id'])) {
            $url = "viewtasklist.php?teams_id=".$_GET['teams_id'];
          } else {
            $url = "tasklist.php";
          }
          ?>
          <a href="<?php echo $url; ?>" class='btn btn-lg btn-flat' style="border: 2px solid black;font-style: normal;border-radius: 10px;color: #000;font-weight: bold;"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
        <br>
        <div class="row">
          <?php if(isset($_GET['file'])): ?>
            <div class="col-xs-7">
          <?php else: ?>
            <div class="col-xs-12">
          <?php endif; ?>
            <div class="box" style="border-top: unset;">
              <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th style="font-size: 23px;font-style: normal;">File</th>
                      <th style="font-size: 23px;font-style: normal;">Date Uploaded</th>
                    </thead>
                    <tbody>
                      <?php 

                      $sql = "SELECT * FROM setdeadline_file WHERE setdeadline_id = '".$_GET['setdeadline_id']."'";
                      $stmt = $this->conn()->query($sql);
                      while ($row = $stmt->fetch()) {

                       ?>
                        <tr>
                            <td>
                                  <?php 
                                  // Define the file path
                                  $filePath = "../uploads/" . $row['file'];
    
                                  // Get the file extension
                                  $fileExtension = pathinfo($row['file'], PATHINFO_EXTENSION); 
    
                                  // Check if the file is a PDF
                                  if (strtolower($fileExtension) === 'pdf') {
    
                                    if (isset($_GET['teams_id'])) {
                                      echo '<a href="tasklistfile.php?file=' . urlencode($filePath) . '&setdeadline_id=' . urlencode($_GET['setdeadline_id']) . '&teams_id=' . urlencode($_GET['teams_id']) . '">' . htmlspecialchars($row['file']) . '</a>';
                                    } else {
                                      echo '<a href="tasklistfile.php?file=' . urlencode($filePath) . '&setdeadline_id=' . urlencode($_GET['setdeadline_id']) . '">' . htmlspecialchars($row['file']) . '</a>';
                                    }
                                      
                                  } else {
                                      // Otherwise, provide a regular download link
                                      echo '<a href="' . htmlspecialchars($filePath) . '">' . htmlspecialchars($row['file']) . '</a>';
                                  }
                                  ?>
                              </td>
                              <td><?=$row['date']?></td>

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <?php if(isset($_GET['file'])): ?>
          <div class="col-xs-5">
            <div class="box">
              <div class="box-body">
                <iframe src="../uploads/<?php echo $_GET['file'] ?>" width="600" height="800" style="border: none;"></iframe>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>