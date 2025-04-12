<?php
session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['change_grade'])) {
                $grade = $_POST['grade'];
                $users_id = $_POST['user_id'];
                
                $sql = "UPDATE teams_member SET individual_grade = ? WHERE users_id = ?";
                $stmt = $this->conn()->prepare($sql);
                
                if($stmt->execute([$grade, $users_id])){
                    echo "<script type='text/javascript'>alert('Grade Updated Successfully'); window.history.back();</script>";
                } else {
                    echo "<script type='text/javascript'>alert('ERROR: Updating grade unsuccessfull'); window.history.back();</script>";
                }
            }
        }
        
    }
    $controllerrun = new controller();
    $controllerrun->managecontroller();
?>