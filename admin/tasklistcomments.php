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
                    <th style="font-size: 23px;font-style: normal;">Comments</th>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = "SELECT * FROM comment WHERE setdeadline_id = '".$_GET['setdeadline_id']."'";
                    $stmt = $this->conn()->query($sql);
                    while ($row = $stmt->fetch()) { ?>
                      <tr>
                        <td style="font-size: 23px;font-style: normal;"><?php echo $row['comment'] ?></td>
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
  <?php include 'modal/templatesModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_templates_id = $(this).data('edit_templates_id');
      var edit_title = $(this).data('edit_title');
      var edit_notes = $(this).data('edit_notes');
      var edit_report = $(this).data('edit_report');

      $('#edit_templates_id').val(edit_templates_id)
      $('#edit_title').val(edit_title)
      $('#edit_notes').val(edit_notes)
      $('#edit_report').val(edit_report)
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();

      $('#delete').modal('show');
      var delete_templates_id = $(this).data('delete_templates_id');
      
      $('#delete_templates_id').val(delete_templates_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>