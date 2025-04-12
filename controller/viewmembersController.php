<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['delete'])) {

                $teams_member_id = $_POST['teams_member_id'];
                $teams_id = $_POST['teams_id'];

                $sql = "DELETE FROM teams_member WHERE teams_member_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$teams_member_id]);

                echo "<script type='text/javascript'>alert('Successfully Delete Member');</script>";
                echo "<script>window.location.href='../admin/viewmembers.php?teams_id=".$teams_id."';</script>";
                
            }

         


         

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
