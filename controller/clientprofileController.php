<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['id'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $cellphonenumber = $_POST['cellphonenumber'];

                $sql = "SELECT * FROM farmers_info WHERE name = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('Farmers Info Already Exist');</script>";
                    echo "<script>window.location.href='../admin/clientprofile.php';</script>";

                } else {

                    $sql = "INSERT INTO farmers_info (name,address,cellphonenumber) VALUES (?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$name,$address,$cellphonenumber]);
               
                    echo "<script type='text/javascript'>alert('Successfully Add Farmers Info');</script>";
                    echo "<script>window.location.href='../admin/clientprofile.php';</script>";

                }

            }

            if (isset($_POST['edit'])) {

                $farmers_info_id = $_POST['farmers_info_id'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $cellphonenumber = $_POST['cellphonenumber'];

                $sql = "UPDATE farmers_info SET name = ?, address = ?, cellphonenumber = ? WHERE farmers_info_id = '".$farmers_info_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name,$address,$cellphonenumber]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Farmers Info');</script>";
                echo "<script>window.location.href='../admin/clientprofile.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $farmers_info_id = $_POST['farmers_info_id'];

                    $sql = "UPDATE farmers_info SET archive = ? WHERE farmers_info_id = '".$farmers_info_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([1]);


                    echo "<script type='text/javascript'>alert('Successfully Archive Farmers Info');</script>";
                    echo "<script>window.location.href='../admin/clientprofile.php';</script>";
                
            }

            if (isset($_POST['approval'])) {

                $id = $_POST['id'];

                $sql = "UPDATE users SET status = ? WHERE id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([1,$id]);
           
                echo "<script type='text/javascript'>alert('Successfully Approved Client Profile');</script>";
                echo "<script>window.location.href='../admin/clientprofile.php';</script>";

            }

            if (isset($_POST['deleteusers'])) {

                    $id = $_POST['id'];

                    $sql = "UPDATE users SET archive = ? WHERE id = '".$id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([1]);


                    echo "<script type='text/javascript'>alert('Successfully Archive Client Profile');</script>";
                    echo "<script>window.location.href='../admin/clientprofile.php';</script>";
                
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
