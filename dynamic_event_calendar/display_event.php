<?php
	session_start();
  include '../config/config.php';
  class data extends Connection{ 
      public function managedata(){ 

	$sql = "SELECT schedule_id,title,start_date,end_date,hectare,type,select2,total FROM schedule";


$stmt = $this->conn()->query($sql);
$stmt->execute([]);
 
if($stmt->rowcount() > 0) 
{
	$data_arr=array();
    $i=1;
	while($row = $stmt->fetch())
	{	
	$data_arr[$i]['schedule_id'] = $row['schedule_id'];
	$data_arr[$i]['title'] = $row['title'];
	$data_arr[$i]['hectare'] = $row['hectare'];
	$data_arr[$i]['type'] = $row['type'];
	$data_arr[$i]['select2'] = $row['select2'];
	$data_arr[$i]['total'] = $row['total'];
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($row['start_date']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($row['end_date']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>

<?php } }

  $data = new data();
  $data->managedata();
            
?>