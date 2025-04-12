<?php 
  session_start();
  
  if(!isset($_SESSION['id'])){
        header('location:../logout.php');
        exit;
    }
  
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
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
            <div class="box">
              <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th>List</th>
                      <th>Files</th>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM setdeadline_file WHERE setdeadline_id = '".$_GET['setdeadline_id']."'";
                      $stmt = $this->conn()->query($sql);
                      $id = 1;
                      while ($row = $stmt->fetch()) { ?>
                        <tr>
                          <td><?php echo $id; ?></td>
                          <td><a href="../uploads/<?php echo $row['file'] ?>" target="_blank"><?php echo $row['file'] ?></td>
                        </tr>
                      <?php $id++; } ?>
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
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>