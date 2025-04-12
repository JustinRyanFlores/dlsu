<?php  
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 



$output = '';
if(isset($_POST["export"]))
{

    $sql = "SELECT * FROM customers_info INNER JOIN users ON customers_info.users_id=users.id INNER JOIN payments ON customers_info.customers_code=payments.customers_code WHERE customers_info.customers_info_status = 2  ";
          $stmt = $this->conn()->query($sql);

 if($stmt->rowcount() > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <th>Transaction ID</th>
                  <th>Customers</th>
                  <th>Payment Method</th>
                  <th>Amount</th>
                  <th>Address</th>
                  <th>Date</th>
                    </tr>
  ';
  while ($row = $stmt->fetch()) 
  {
   $output .= ';
    <tr>
      <td>'.$row["customers_code"].'</td>
      <td>'.$row["user_first_name"].'</td>
      <td>'.$row["payment_method"].'</td>
      <td>'.$row["amount"].'</td>
      <td>'.$row["address"].'</td>
      <td>'.$row["date_created"].'</td>
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}




             }
                        
                  }

                    $data = new data();
                    $data->managedata();

?>