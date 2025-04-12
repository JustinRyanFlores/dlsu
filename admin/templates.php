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
          <div class="col-xs-7">
            <div class="box">
              <?php if($_SESSION['type'] == 0): ?>
                <div class="box-header with-border">
                   <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm tcustom-btn"><i class="fa fa-plus"></i> New Template</a> 
                </div>
              <?php endif; ?>
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>List</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Notes</th>
                    <th>Report</th>
                    <?php if($_SESSION['type'] == 0): ?>
                    <th>Action</th>
                    <?php endif; ?>
                  </thead>
                  <tbody>
                    <?php $sql = "SELECT * FROM templates";
                    $stmt = $this->conn()->query($sql);
                    $id = 1;
                    while ($row = $stmt->fetch()) { ?>
                      <tr>
                        <td><?php echo $id; ?></td>
                        <td title="<?php echo ucwords($row['title']); ?>"><?php echo ucwords($row['title']); ?></td>
                        <td>
                            <?php 
                              $filePath = "../uploads/" . $row['file'];

                              // if (strtolower($fileExtension) === 'pdf') {
                                  // If it's a PDF, provide a link to view it
                                  echo '<a href="templates.php?file=' . urlencode($filePath) . '">' . $row['file'] . '</a>';
                              //} //else {
                              //     // Otherwise, provide a regular download link
                              //     echo '<a href="' . $filePath . '">' . $row['file'] . '</a>';
                              // }
                              ?>
                        </td>
                        <td><?php echo $row['notes'] ?></td>
                        <td><?php echo $row['report'] ?></td>
                        <?php if($_SESSION['type'] == 0): ?>
                          <td>
                            <button class='btn btn-primary btn-sm edit btn-table' 
                            data-edit_templates_id='<?php echo $row['templates_id'] ?>'
                            data-edit_title='<?php echo $row['title'] ?>'
                            data-edit_notes='<?php echo $row['notes'] ?>'
                            data-edit_report='<?php echo $row['report'] ?>'
                            ><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-table' 
                            data-delete_templates_id='<?php echo $row['templates_id'] ?>'
                            ><i class='fa fa-trash'></i> Delete</button>
                          </td>
                          <?php endif; ?>
                      </tr>
                    <?php $id++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            <div class="col-xs-5">
              <div class="box">
                <div class="box-body">
                  <?php if(empty($_GET['file'])){
                      $_GET['file'] = "";
                  } ?>
                  <iframe src="https://docs.google.com/viewer?url=<?php echo urlencode('https://dlsu-thesistracker.site/dlsu-d/uploads/' . $_GET['file']); ?>&embedded=true" width="100%" height="800" style="border: none; background: white;"></iframe>
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