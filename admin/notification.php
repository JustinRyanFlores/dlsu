<?php 
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
      $sql = "SELECT * FROM notification ORDER BY notification_id DESC";
      $stmt = $this->conn()->query($sql);
      $id = 1;
      while ($row = $stmt->fetch()) { ?>
        <div class="notification-item">
            <p style="margin: unset;"><?php echo $row['description'] ?></p>
            <small><?php echo date('F j, Y', strtotime($row['date_created'])); ?></small>
        </div>
      <?php } ?>
<?php } } $data = new data(); $data->managedata(); ?>