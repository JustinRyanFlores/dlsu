<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $hectare = $_POST['hectare'];
                $stock = $_POST['stock'];

                $sql = "SELECT * FROM supplies WHERE name = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('Supplies Already Exist');</script>";
                    echo "<script>window.location.href='../admin/supplies.php';</script>";

                } else {

                    $sql = "INSERT INTO supplies (name,description,hectare,stock) VALUES (?,?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$name,$description,$hectare,$stock]);

                    $sql = "INSERT INTO supplies_history (name,description,hectare,stock) VALUES (?,?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$name,$description,$hectare,$stock]);
               
                    echo "<script type='text/javascript'>alert('Successfully Add Supplies');</script>";
                    echo "<script>window.location.href='../admin/supplies.php';</script>";

                }

            }

            if (isset($_POST['edit'])) {

                $supplies_id = $_POST['supplies_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $hectare = $_POST['hectare'];
                $stock = $_POST['stock'];

                $sql = "UPDATE supplies SET name = ?, description = ?, hectare = ?, stock = ? WHERE supplies_id = '".$supplies_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name,$description,$hectare,$stock]);

                $sql = "INSERT INTO supplies_history (name,description,hectare,stock) VALUES (?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name,$description,$hectare,$stock]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Supplies');</script>";
                echo "<script>window.location.href='../admin/supplies.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $supplies_id = $_POST['supplies_id'];

                    $sql = "UPDATE supplies SET archive = ? WHERE supplies_id = '".$supplies_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([1]);


                    echo "<script type='text/javascript'>alert('Successfully Archive Supplies');</script>";
                    echo "<script>window.location.href='../admin/supplies.php';</script>";
                
            }


            if (isset($_POST['deduct'])) {

                $supplies_id = $_POST['supplies_id'];
                $quantity = $_POST['quantity'];

                $sql = "SELECT * FROM supplies WHERE supplies_id = '".$supplies_id."'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $stock = $row['stock'] - $quantity; 
                $name = $row['name'];
                $description = $row['description'];
                $hectare = $row['hectare'];
             
                $sql = "UPDATE supplies SET stock = ? WHERE supplies_id = '".$supplies_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$stock]);

                $sql = "INSERT INTO supplies_history (name,description,hectare,stock,deduct) VALUES (?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name,$description,$hectare,$stock,$quantity]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Supplies');</script>";
                echo "<script>window.location.href='../admin/supplies.php';</script>";

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
