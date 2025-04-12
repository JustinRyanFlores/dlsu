<?php
session_start();
include '../config/config.php';

class Controller extends Connection {

    public function manageController() {
        if (isset($_POST['setdeadline'])) {
            $teams_id = $_POST['teams_id'];
            $setdeadline_ids = $_POST['setdeadline_id'];
            $deadlines = $_POST['deadline'];

            for ($i = 0; $i < count($setdeadline_ids); $i++) {
                $sql = "UPDATE setdeadline SET deadline = ? WHERE setdeadline_id = ?";
                $stmt = $this->conn()->prepare($sql);

                if ($stmt) {
                    $stmt->execute([$deadlines[$i], $setdeadline_ids[$i]]);
                } else {
                    die("Error preparing statement: " . $this->conn()->error);
                }
            }

            // Redirect after success
            header("Location: ../admin/setdeadline.php?teams_id=" . $teams_id);
            exit();
        }

        if (isset($_POST['setreminder'])) {
            $teams_id = $_POST['teams_id'];
            $setdeadline_id = $_POST['setdeadline_id'];
            $notes = $_POST['notes'];

            $sql = "INSERT INTO reminder (teams_id,setdeadline_id,notes) VALUES (?,?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id,$setdeadline_id,$notes]);

            echo "<script type='text/javascript'>alert('Successfully Set Reminder');</script>";
            echo "<script>window.location.href='../admin/setdeadline.php?teams_id=".$teams_id."';</script>";

        }

        if (isset($_POST['changestatus'])) {

            $teams_id = $_POST['teams_id'];
            $setdeadline_id = $_POST['setdeadline_id'];
            $status = $_POST['status'];

            $sql = "UPDATE setdeadline SET status = ? WHERE setdeadline_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$status,$setdeadline_id]);
       
            echo "<script type='text/javascript'>alert('Successfully Change Status');</script>";
            echo "<script>window.location.href='../admin/setdeadline.php?teams_id=".$teams_id."';</script>";

        }

    }
}

$controller = new Controller();
$controller->manageController();
