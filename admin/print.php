<?php
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 
        $sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' ";
        $stmtstaff = $this->conn()->query($sql);
        $row = $stmtstaff->fetch();
        $name = $row['firstname']." ".$row['lastname'];
?>
<style>
  table{
    border-collapse: collapse;
    
    width: 100%;
  }
  .table,.table th,.table td{
    border: 1px solid black;
    padding: 5px;
  }

</style>
  <div>
    <div style="text-align: center;">
      <img src="../images/logo.png" width="130px">
    </div>
    <h2 style="text-align: center;">MaSPotato</h2>
    <br>
    <table>
      <thead>
        <th align="left">Name: <?php echo $name; ?></th>
        <th align="right">Date: <?php echo date('F j, Y'); ?></th>
      </thead>
    </table>
    <br><br>
    <h2 style="text-align: center;">Product Report History</h2>
    <table class="table">
      <thead>
        <th>#</th>
        <th>Image</th>
        <th>Variety</th>
        <th>Products Name</th>
        <th>Quantity</th>
        <th>Old Price</th>
        <th>Total</th>
        <th>Date Harvest</th>
        <th>Pickup</th>
        <th>Date Created</th>
      </thead>
      <tbody>
      <?php
      $id = 1;
      $sql = "SELECT *,ph.date AS ph_date, ph.price AS ph_price FROM products p INNER JOIN category c ON c.category_id = p.category_id INNER JOIN products_history ph ON p.products_id = ph.products_id";
      $stmt = $this->conn()->query($sql);
      while ($row = $stmt->fetch()) { ?>
        <tr>
          <td align="center"><?php echo $id; ?></td>
          <td><img src="../images/<?php echo $row['img'] ?>" width="100px"></td>
          <td><?php echo $row['category'] ?></td>
          <td><?php echo $row['name'] ?></td>
          <td><?php echo $row['quantity'] ?></td>
          <td>₱<?php echo $row['ph_price'] ?></td>
          <td>₱<?php echo $row['quantity'] * $row['ph_price']; ?></td>
          <td><?php echo $row['date_harvest'] ?></td>
          <td><?php echo $row['pickuplocation'] ?></td>
          <td><?php echo $row['ph_date'] ?></td>
        </tr>
      <?php $id++; } ?>
    </tbody>
  </table>
</div>

<script>
  window.print();
  window.onafterprint = window.close; 
</script>
<?php } } $data = new data(); $data->managedata(); ?>