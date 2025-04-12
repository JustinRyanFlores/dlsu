<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $variety = $_POST['variety'];
                $hectares = $_POST['hectares'];
                $row = $_POST['row'];
                $totalharvest = $_POST['totalharvest'];
                $description = $_POST['description'];

                $sql = "INSERT INTO reportharvest (variety,hectares,row,totalharvest,description) VALUES (?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$variety,$hectares,$row,$totalharvest,$description]);

                $sql = "SELECT * FROM reportharvest ORDER BY reportharvest_id DESC LIMIT 1";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $reportharvest_id = $row['reportharvest_id'];

                $sql = "INSERT INTO reportharvest_history (reportharvest_id,description) VALUES (?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$reportharvest_id,'Add']);
           
                echo "<script type='text/javascript'>alert('Successfully Add Report Harvest');</script>";
                echo "<script>window.location.href='../admin/reportharvest.php';</script>";
                
            }

            if (isset($_POST['edit'])) {

                $reportharvest_id = $_POST['reportharvest_id'];
                $variety = $_POST['variety'];
                $hectares = $_POST['hectares'];
                $row = $_POST['row'];
                $totalharvest = $_POST['totalharvest'];
                $description = $_POST['description'];

                $sql = "UPDATE reportharvest SET variety = ?, hectares = ?, row = ?, totalharvest = ?, description = ? WHERE reportharvest_id = '".$reportharvest_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$variety,$hectares,$row,$totalharvest,$description]);

                $sql = "INSERT INTO reportharvest_history (reportharvest_id,description) VALUES (?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$reportharvest_id,'Edit']);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Report Harvest');</script>";
                echo "<script>window.location.href='../admin/reportharvest.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $reportharvest_id = $_POST['reportharvest_id'];

                    $sql = "UPDATE reportharvest SET archive = ? WHERE reportharvest_id = '".$reportharvest_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([1]);

                    $sql = "INSERT INTO reportharvest_history (reportharvest_id,description) VALUES (?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$reportharvest_id,'Delete']);

                    echo "<script type='text/javascript'>alert('Successfully Archive Report Harvest');</script>";
                    echo "<script>window.location.href='../admin/reportharvest.php';</script>";
                
            }

            if (isset($_POST['new'])) {

                $variety = $_POST['variety'];
                $hectares = $_POST['hectares'];
                $row = $_POST['row'];
                $totalharvest = $_POST['totalharvest'];
                $description = $_POST['description'];

                $sql = "INSERT INTO reportharvest (variety,hectares,row,totalharvest,description) VALUES (?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$variety,$hectares,$row,$totalharvest,$description]);

                $sql = "SELECT * FROM reportharvest ORDER BY reportharvest_id DESC LIMIT 1";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $reportharvest_id = $row['reportharvest_id'];

                $sql = "INSERT INTO reportharvest_history (reportharvest_id,description) VALUES (?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$reportharvest_id,'Add']);
                
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
