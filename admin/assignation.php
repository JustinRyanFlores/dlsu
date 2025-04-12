<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('location:../logout.php');
  exit;
}

include '../config/config.php';
class data extends Connection
{
  public function managedata()
  {
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

            <?php if ($_SESSION['type'] != 1): ?>
              <div class="container-fluid p-3 bg-light rounded shadow-sm">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th style="font-size: 23px;font-style: normal;">Class</th>
                        <th style="font-size: 23px;font-style: normal;">Research Teacher</th>
                        <th style="font-size: 23px;font-style: normal;">Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT s.section_name, CONCAT(u.firstname,' ',u.lastname) AS adviser_name, s.adviser FROM sections s LEFT JOIN users u ON s.adviser = u.id ORDER BY s.section_name DESC";
                        $stmt = $this->conn()->query($sql);
                        while ($row = $stmt->fetch()):
                        ?>
                          <tr>
                            <td style="font-size: 23px;font-style: normal;"><?php echo $row['section_name'] ?></td>
                            <td style="font-size: 23px;font-style: normal;"><?= empty($row['adviser_name']) ? "<p class='text-danger'>Not assigned yet.</p>" :  ucwords($row['adviser_name']) ?></td>
                            <td class="text-center" style="font-size: 23px;font-style: normal;">
                              <?php if (empty($row['adviser_name'])): ?>
                                <button class="btn btn-primary assign" style="width:100%;"
                                  data-section="<?= $row['section_name'] ?>">Assign adviser</button>
                              <?php else: ?>
                                <button class="btn btn-warning change" style="width:100%;"
                                  data-chng-section="<?= $row['section_name'] ?>"
                                  data-chng-rt="<?= $row['adviser'] ?>">Change adviser</button>
                              <?php endif ?>
                            </td>
                          </tr>
                        <?php endwhile ?>
                      </tbody>
                    </table>
                  </div>


                  <div class="col-md-6 mb-3">
                    <table id="example2" class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="font-size: 23px; font-style: normal; text-align: center;">Count of Assigned Sections</th>
                          <th style="font-size: 23px; font-style: normal; text-align: center;">Faculty Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT 
                              u.firstname, 
                              u.lastname, 
                              COUNT(s.adviser) AS section_count 
                              FROM 
                              users u 
                              LEFT JOIN sections s ON s.adviser = u.id 
                              WHERE u.type = '1' 
                              GROUP BY s.adviser, u.firstname, u.lastname";
                        $stmt = $this->conn()->query($sql);
                        while ($row = $stmt->fetch()):
                          $faculty_name = ucwords($row['firstname'] . " " . $row['lastname']);
                        ?>
                          <tr>
                            <td style="font-size: 23px; font-style: normal; text-align: center;"><?= $row['section_count'] ?></td>
                            <td style="font-size: 23px; font-style: normal; text-align: center;"><?= $faculty_name ?></td>
                          </tr>
                        <?php endwhile ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endif; ?>

        </div>
        </section>
      </div>
      </div>
      <?php include 'footer.php'; ?>
      <?php include 'modal/assignationModal.php'; ?>
      <script>
        $(document).on('click', '.assign', function(e) {
          e.preventDefault();
          $('#assign').modal('show');
          var section = $(this).data('section');

          $('#section').val(section)
        });

        $(document).on('click', '.change', function(e) {
          e.preventDefault();
          $('#change').modal('show');
          var section = $(this).data('chng-section');
          var rt = $(this).data('chng-rt');

          $('#chng-section').val(section)
          $('#chng-rt').val(rt)
        });
      </script>
    </body>

    </html>
<?php }
}
$data = new data();
$data->managedata(); ?>