<?php
    session_start();
    include '../config/config.php';

    class products extends Connection{

        public function manageproducts(){

            if (isset($_POST['add'])) {

                $category_id = $_POST['category_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $pickuplocation = $_POST['pickuplocation'];
                $date_harvest = $_POST['date_harvest'];

                $img = $_FILES['img']['name'];
                $tmp = $_FILES['img']['tmp_name'];
                move_uploaded_file($tmp, '../images/'.$img);

                $sqlinsert = "INSERT INTO products (category_id,img,name,description,quantity,price,date_harvest,pickuplocation) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sqlinsert);
                $stmt->execute([$category_id,$img,$name,$description,$quantity,$price,$date_harvest,$pickuplocation]);

                $sql = "SELECT * FROM products ORDER BY products_id DESC LIMIT 1";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $products_id = $row['products_id'];

                $sql = "INSERT INTO products_history (products_id,description,price) VALUES (?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$products_id,'Add',$price]);

                echo "<script type='text/javascript'>alert('Successfully Add Product');</script>";
                echo "<script>window.location.href='../admin/products.php';</script>";
            }

            if (isset($_POST['edit'])) {
            
                $products_id = $_POST['products_id'];
                $category_id = $_POST['category_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $quantity = $_POST['quantity'];
               
                $pickuplocation = $_POST['pickuplocation'];
                $date_harvest = $_POST['date_harvest'];
         
                $img = $_FILES['img']['name'];
                $tmp = $_FILES['img']['tmp_name'];
                move_uploaded_file($tmp, '../images/'.$img);

                $sql = "SELECT * FROM products WHERE products_id = '".$products_id."'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $oldprice = $row['price'];

                $sql = "INSERT INTO products_history (products_id,description,price) VALUES (?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$products_id,'Edit',$oldprice]);


                $price = $_POST['price'];

                if ($img != '') {
                    
                    $sql = "UPDATE products SET category_id = ?, img = ?, name = ?, description = ?, quantity = ?, price = ?,date_harvest = ?, pickuplocation = ? WHERE products_id = '".$products_id."'";

                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$category_id,$img,$name,$description,$quantity,$price,$date_harvest,$pickuplocation]);
               
                }else{

                    $sqlinsert = "UPDATE products SET category_id = ?, name = ?, description = ?, quantity = ?, price = ?, date_harvest = ?, pickuplocation = ? WHERE products_id = '".$products_id."'";

                    $stmt = $this->conn()->prepare($sqlinsert);
                    $stmt->execute([$category_id,$name,$description,$quantity,$price,$date_harvest,$pickuplocation]);

                }

                
           
                echo "<script type='text/javascript'>alert('Successfully Edit Product');</script>";
                echo "<script>window.location.href='../admin/products.php';</script>";
                
            }

            if (isset($_POST['delete'])) {

                $products_id = $_POST['products_id'];

                $sql = "UPDATE products SET archive = ? WHERE products_id = '".$products_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([1]);
           
                echo "<script type='text/javascript'>alert('Successfully Archive Product');</script>";
                echo "<script>window.location.href='../admin/products.php';</script>";
                
            }

         

        }

    }

    $productsrun = new products();
    $productsrun->manageproducts();

?>
