<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['assign']) || isset($_POST['change'])) {
                $section = $_POST['section'];
                $rt = $_POST['rt'];
                try {
                    $sql = "UPDATE sections set adviser = ? WHERE section_name = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$rt,$section]);
                    
                    echo "<script>alert('Update successful!'); window.location.href='../admin/assignation.php';</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Error updating section: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
                }
            }
            

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
