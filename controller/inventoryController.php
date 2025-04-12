<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['id'];
                $name = $_POST['name'];

                $sql = "SELECT * FROM inventory WHERE name = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('Inventory Already Exist');</script>";
                    echo "<script>window.location.href='../admin/inventory.php';</script>";

                } else {

                    $sql = "INSERT INTO inventory (name) VALUES (?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$name]);
               
                    echo "<script type='text/javascript'>alert('Successfully Add Inventory');</script>";
                    echo "<script>window.location.href='../admin/inventory.php';</script>";

                }

            }

            if (isset($_POST['edit'])) {

                $inventory_id = $_POST['inventory_id'];
                $name = $_POST['name'];

                $sql = "UPDATE inventory SET name = ? WHERE inventory_id = '".$inventory_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Inventory');</script>";
                echo "<script>window.location.href='../admin/inventory.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $inventory_id = $_POST['inventory_id'];

                    $sql = "UPDATE inventory SET archive = ? WHERE inventory_id = '".$inventory_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([1]);

                    echo "<script type='text/javascript'>alert('Successfully Archive Inventory');</script>";
                    echo "<script>window.location.href='../admin/inventory.php';</script>";
            }

            if (isset($_POST['use'])) {

                $inventory_id = $_POST['inventory_id'];
                $name = $_POST['name'];
                $dateused = $_POST['dateused'];
                $datereturned = $_POST['datereturned'];
                $hectare = $_POST['hectare'];
                $damage = $_POST['damage'];

                $sql = "INSERT INTO inventory_history (inventory_id,name,dateused,datereturned,hectare,damage) VALUES (?,?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$inventory_id,$name,$dateused,$datereturned,$hectare,$damage]);
           
                echo "<script type='text/javascript'>alert('Successfully Use Inventory');</script>";
                echo "<script>window.location.href='../admin/inventory.php';</script>";

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
