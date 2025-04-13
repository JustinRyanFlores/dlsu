<?php
session_start();
include '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class controller extends Connection
{

    public function managecontroller()
    {
        if (isset($_POST['add'])) {
            $current_user_id = $_SESSION['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_ids = $_POST['users_id'];
            $setdeadline_id = $_POST['setdeadline_id'];
            $status = $_POST['status'];

            if (empty($user_ids) || !is_array($user_ids)) {
                echo "<script>alert('Error: Please select at least one member.'); window.history.back();</script>";
                exit;
            }

            $sql = "SELECT teams_id FROM teams_member WHERE users_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$current_user_id]);
            $row = $stmt->fetch();

            if (!$row) {
                echo "<script>alert('Error: No team associated with the logged-in user.'); window.history.back();</script>";
                exit;
            }

            $teams_id = $row['teams_id'];

            $sql = "INSERT INTO task (teams_id, setdeadline_id, title, description, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id, $setdeadline_id, $title, $description, $status]);

            $sql = "SELECT task_id FROM task ORDER BY task_id DESC LIMIT 1";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();

            if (!$row) {
                echo "<script>alert('Error: Task creation failed.'); window.history.back();</script>";
                exit;
            }

            $task_id = $row['task_id'];

            foreach ($user_ids as $user_id) {
                $sql = "INSERT INTO task_member (task_id, teams_id, users_id) VALUES (?, ?, ?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$task_id, $teams_id, $user_id]);
            }

            echo "<script>alert('Successfully added task!'); window.location.href='../admin/tasklist.php';</script>";
        }




        if (isset($_POST['uploadfile'])) {

            $setdeadline_id = $_POST['setdeadline_id'];

            $file = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $file);

            $sql = "SELECT * FROM setdeadline WHERE setdeadline_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$setdeadline_id]);
            $row = $stmt->fetch();
            $teams_id = $row['teams_id'];


            $sql = "INSERT INTO setdeadline_file (setdeadline_id, teams_id, file) VALUES (?, ?, ?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$setdeadline_id, $teams_id, $file]);

            //<adding notification>
            //selecting team users_id
            $sql = "SELECT * FROM teams_member WHERE users_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$_SESSION['id']]);
            if ($stmt->rowcount() > 0) {
                $row = $stmt->fetch();
                $teams_id = $row['teams_id'];
            } else {
                $teams_id = 0;
            }
            //selecting team name
            $sql = "SELECT * FROM teams WHERE teams_id = '$teams_id'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $groupname = $row['name'];
            $adviser_id = $row['adviser_id'];
            $users_id = $_SESSION['id'];
            // Get the deadline name using setdeadline_id
            $sql = "SELECT name FROM setdeadline WHERE setdeadline_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$setdeadline_id]);
            $row = $stmt->fetch();
            $file_title = $row['name'];

            $notes = "$file is uploaded by the group ($groupname) in $file_title";

            $sql = "INSERT INTO reminder_adviser (users_id,adviser_id,notes) VALUES (?,?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$users_id, $adviser_id, $notes]);

            $sql = "UPDATE setdeadline SET notif = 1 WHERE notif = 0 AND teams_id = ? AND setdeadline_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id, $setdeadline_id]);
            //</adding notification>

            echo "<script type='text/javascript'>alert('Successfully added file!');</script>";
            echo "<script>window.location.href='../admin/tasklist.php';</script>";
        }
    }
}

$controllerrun = new controller();
$controllerrun->managecontroller();
