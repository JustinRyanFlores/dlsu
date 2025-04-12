<?php 
    include '../gmail.php';
    include '../config/config.php';
    class data extends Connection{
        public function managdata(){
            $user_email_address = $_SESSION['user_email_address'];
            $sql = "SELECT id FROM users WHERE user_email_address = '".$user_email_address."'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $users_id = $row['id'];

            $sql = "SELECT * FROM cart INNER JOIN products ON cart.products_id=products.products_id WHERE cart.users_id = '".$users_id."'";
            $stmtmycart = $this->conn()->query($sql); 
            while ($row = $stmtmycart->fetch()) { ?>
                <tr class="border">
                    <td class="p-2"><a href="cart.php" class="nav-link"><img src="../images/<?php echo $row['products_img'] ?>" width="50px"></a></td>
                    <td class="p-2"><a href="cart.php" class="nav-link"><?php echo $row['products_name'] ?></a></td>
                    <td class="p-2"><a href="cart.php" class="nav-link"><?php echo $row['products_qty'] ?></a></td>
                </tr>
<?php      } 

        }
    }
    $datarun = new data();
    $datarun->managdata();
 ?>






                                    










