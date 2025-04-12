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
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .content-wrapper {
            min-height: 100vh;
            background-color: #f9f9f9;
            overflow-y: auto;
            padding: 20px;
        }
        .table th {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 16px;
            padding: 12px;
        }
        .table td {
            font-size: 15px;
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }
        .btn-table {
            font-size: 14px;
            padding: 6px 10px;
        }
        .status-badge {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending { background-color: #ffc107; color: black; }
        .status-approved { background-color: #28a745; color: white; }
        .status-declined { background-color: #dc3545; color: white; }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include 'profile.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $sql = "SELECT u.*, COALESCE(GROUP_CONCAT(s.section_name SEPARATOR ' | '), 'No Sections Assigned') AS assigned_sections
                                                        FROM users u
                                                        LEFT JOIN sections s ON u.id = s.adviser
                                                        WHERE u.type = 1
                                                        GROUP BY u.id";
                                                $stmt = $this->conn()->query($sql);
                                                $id = 1;
                                                while ($row = $stmt->fetch()) { 
                                                    $status_class = ($row['status'] == 0) ? "status-pending" 
                                                                : (($row['status'] == 1) ? "status-approved" 
                                                                : "status-declined");
                                                ?>
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo ucwords($row['firstname']) ?></td>
                                                        <td><?php echo ucwords($row['lastname']) ?></td>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td><?php echo ucwords($row['department']) ?></td>
                                                        <td>
                                                            <span class="badge <?php echo $status_class; ?> status-badge">
                                                                <?php 
                                                                echo ($row['status'] == 0) ? "Pending" 
                                                                    : (($row['status'] == 1) ? "Approved" 
                                                                    : "Declined");
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class='btn btn-sm btn-primary edit' 
                                                                data-edit_id='<?php echo $row['id'] ?>'
                                                                data-edit_firstname='<?php echo $row['firstname'] ?>'
                                                                data-edit_lastname='<?php echo $row['lastname'] ?>'
                                                                data-edit_email='<?php echo $row['email'] ?>'
                                                                data-edit_department='<?php echo $row['department'] ?>'
                                                                data-edit_status='<?php echo $row['status'] ?>'
                                                                data-edit_section='<?php echo $row['assigned_sections'] ?>'>
                                                                <i class="bi bi-pencil-square"></i> Edit
                                                            </button>
                                                            <button class='btn btn-sm btn-danger delete' 
                                                                data-delete_id='<?php echo $row['id'] ?>'>
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php $id++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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

            $('#edit_id').val(edit_id);
            $('#edit_firstname').val(edit_firstname);
            $('#edit_lastname').val(edit_lastname);
            $('#edit_email').val(edit_email);
            $('#edit_department').val(edit_department);
            $('#edit_status').val(edit_status);
            $('#edit_section').val(edit_section);
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            $('#delete').modal('show');
            var delete_id = $(this).data('delete_id');
            $('#delete_id').val(delete_id);
        });

        $(document).ready(function(){
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            
            $('#example1').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>