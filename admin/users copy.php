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
              <!-- <div class="box-header with-border">
                 <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm custom-btn"><i class="fa fa-plus"></i> New Users</a> 
              </div> -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>List</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php $sql = "SELECT u.*, COALESCE(GROUP_CONCAT(s.section_name SEPARATOR ' | '), 'No Sections Assigned') AS assigned_sections
                                    FROM users u
                                    LEFT JOIN sections s ON u.id = s.adviser
                                    WHERE u.type = 1
                                    GROUP BY u.id;";
                    $stmt = $this->conn()->query($sql);
                    $id = 1;
                    while ($row = $stmt->fetch()) { ?>
                      <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo ucwords($row['firstname']) ?></td>
                        <td><?php echo ucwords($row['lastname']) ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo ucwords($row['department']) ?></td>
                        <td><?php 
                        if ($row['status'] == 0 ) {
                          echo "<p class='text-warning'>Pending</p>";
                        } else if ($row['status'] == 1 ) {
                          echo "<p class='text-success'>Approved</p>";
                        } else if ($row['status'] == 2 ) {
                          echo "<p class='text-danger'>Declined</p>";
                        }
                         ?></td>
                        <td class="text-center">
                          <button class='btn btn-table btn-primary edit' 
                          data-edit_id='<?php echo $row['id'] ?>'
                          data-edit_firstname='<?php echo $row['firstname'] ?>'
                          data-edit_lastname='<?php echo $row['lastname'] ?>'
                          data-edit_email='<?php echo $row['email'] ?>'
                          data-edit_department='<?php echo $row['department'] ?>'
                          data-edit_status='<?php echo $row['status'] ?>'
                          data-edit_section='<?php echo $row['assigned_sections'] ?>'
                          ><i class='fa fa-edit'></i> Edit</button>
                          <button class='btn btn-table btn-danger delete' 
                          data-delete_id='<?php echo $row['id'] ?>'
                          ><i class='fa fa-trash'></i> Delete</button>
                        </td>
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
  <?php include 'modal/usersModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_id = $(this).data('edit_id');
      var edit_firstname = $(this).data('edit_firstname');
      var edit_lastname = $(this).data('edit_lastname');
      var edit_email = $(this).data('edit_email');
      var edit_department = $(this).data('edit_department');
      var edit_status = $(this).data('edit_status');
      var edit_section = $(this).data('edit_section');

      $('#edit_id').val(edit_id)
      $('#edit_firstname').val(edit_firstname)
      $('#edit_lastname').val(edit_lastname)
      $('#edit_email').val(edit_email)
      $('#edit_department').val(edit_department)
      $('#edit_status').val(edit_status)
      $('#edit_section').val(edit_section)
     
        $('#addSection').off().on('click', function() {
            addSectionDropdown('');
        });
        function addSectionDropdown(selectedSection) {
            var sectionDropdown = `
                <div class="form-group section-group" style="margin-top: 20px">
                    <div class="col-sm-10">
                        <select class="form-control" name="sections[]">
                            <option value="" disabled>Select section</option>
                            <?php if($sections != NULL): ?>
                            <?php foreach ($sections as $row): ?>
                                <option value="<?= $row['section_name'] ?>"><?= $row['section_name'] ?></option>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No section available</option>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-danger btn-sm removeSection">x</button>
                    </div>
                </div>
            `;
        
            $('#addEditSection').append(sectionDropdown);
        
            // ✅ Select the existing section (if provided)
            $('#addEditSection select:last').val(selectedSection);
        
            // ✅ Remove section on click
            $('.removeSection').off().on('click', function() {
                $(this).closest('.section-group').remove();
            });
            
            // ✅ Refresh options when changing section
            $('.section-select').off().on('change', function() {
                refreshDropdownOptions();
            });
        }
        
        function refreshDropdownOptions() {
            let selectedValues = $('#addEditSection select').map((_, el) => $(el).val()).get();
            $('.section-select').each(function() {
                let currentValue = $(this).val();
                $(this).find('option').each(function() {
                    $(this).prop('disabled', selectedValues.includes($(this).val()) && $(this).val() !== currentValue);
                });
            });
        }
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();

      $('#delete').modal('show');
      var delete_id = $(this).data('delete_id');
      
      $('#delete_id').val(delete_id)
    });
  </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>