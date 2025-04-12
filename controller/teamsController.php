<?php
session_start();
include '../config/config.php';

class controller extends Connection
{

    public function managecontroller()
    {

        if (isset($_POST['add'])) {

            $users_id = $_SESSION['id'];
            $name = $_POST['name'];

            $sql = "INSERT INTO teams (name,users_id) VALUES (?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$name, $users_id]);

            $sql = "SELECT * FROM teams WHERE users_id = '" . $users_id . "'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $teams_id = $row['teams_id'];

            $sql = "INSERT INTO teams_member (teams_id,users_id) VALUES (?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id, $users_id]);

            $names = [
                "Finding Group Members",
                "Title Proposal",
                "Chapter 1",
                "Chapter 2",
                "Chapter 3",
                "Proposal Defense",
                "Ethical Research Committee",
                "Chapter 4",
                "Chapter 5",
                "Full Paper",
                "Final Defense",
            ];


            $sql = "INSERT INTO setdeadline (name, teams_id) VALUES (?, ?)";
            $stmt = $this->conn()->prepare($sql);

            foreach ($names as $name) {
                $stmt->execute([$name, $teams_id]);
            }


            echo "<script type='text/javascript'>alert('Successfully Add Group Name');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }


        if (isset($_POST['assignadviser'])) {

            $users_id = $_SESSION['id'];
            $teams_id = $_POST['teams_id'];
            $adviser_id = $_POST['adviser_id'];

            $sql = "SELECT * FROM teams WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id]);
            if ($stmt->rowcount() > 0) {
                $row = $stmt->fetch();

                $sql = "UPDATE teams SET adviser_id = ?, adviser_status = ? WHERE teams_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$adviser_id, 0, $teams_id]);

                $sql = "UPDATE teams_member SET adviser_id = ? WHERE teams_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$adviser_id, $teams_id]);

                $groupname = $row['name'];
                $adviser_id = $_POST['adviser_id'];

                $notes = "You have been added to the group (" . $groupname . ")";
                $sql = "INSERT INTO reminder_adviser (users_id,adviser_id,notes) VALUES (?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$users_id, $adviser_id, $notes]);
            }

            echo "<script type='text/javascript'>alert('Successfully Assign Adviser Request');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['addmember'])) {

            $users_id = $_SESSION['id'];

            $sql = "SELECT * FROM teams WHERE users_id = '" . $users_id . "'";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $teams_id = $row['teams_id'];
            $adviser_id = $row['adviser_id'];

            $users_id = $_POST['users_id'];

            $sql = "INSERT INTO teams_member (adviser_id,teams_id,users_id) VALUES (?,?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$adviser_id, $teams_id, $users_id]);

            echo "<script type='text/javascript'>alert('Successfully Add Member');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['edit'])) {

            $teams_id = $_POST['teams_id'];
            $name = $_POST['name'];
            $thesis = $_POST['thesis_title'];

            $sql = "UPDATE teams SET name = ?, thesis_title = ? WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$name, $thesis, $teams_id]);

            echo "<script type='text/javascript'>alert('Successfully Edit Teams');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['fca'])) {
            $teams_id = $_POST['teams_id'];
            $date = date("Y-m-d");
            if (isset($_FILES['fca_file']) && $_FILES['fca_file']['error'] === UPLOAD_ERR_OK) {
                $allowedMimeTypes = ['application/pdf'];
                $fileTmpPath = $_FILES['fca_file']['tmp_name'];
                $fileName = $_FILES['fca_file']['name'];
                $fileSize = $_FILES['fca_file']['size'];
                $fileMimeType = mime_content_type($fileTmpPath);
                $uploadDir = '../uploads/';
                $maxFileSize = 2 * 1024 * 1024; //2mb limit


                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    echo "<script>alert('Error: Only PDF are allowed.'); window.location.href='../admin/teams.php';</script>";
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    die("Error: Only .pdf files are allowed.");
                }

                if ($fileSize > $maxFileSize) {
                    echo "<script>alert('Error: File size must be less than 2MB.'); window.location.href='../admin/teams.php';</script>";
                }

                $newFileName = "Form-Coordinator-Approval" . '.' . $fileExtension;

                if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {

                    $sql = "UPDATE teams SET coor_approval = ?, ca_upload_date = ? WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$newFileName, $date, $teams_id]);
                } else {
                    echo "<script>alert('Error: File could not be moved.'); window.location.href='../admin/teams.php';</script>";
                }
            } elseif (isset($_FILES['fca_file4']) && $_FILES['fca_file4']['error'] === UPLOAD_ERR_OK) {
                $allowedMimeTypes = ['application/pdf'];
                $fileTmpPath = $_FILES['fca_file4']['tmp_name'];
                $fileName = $_FILES['fca_file4']['name'];
                $fileSize = $_FILES['fca_file4']['size'];
                $fileMimeType = mime_content_type($fileTmpPath);
                $uploadDir = '../uploads/';
                $maxFileSize = 2 * 1024 * 1024; //2mb limit


                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    echo "<script>alert('Error: Only PDF are allowed.'); window.location.href='../admin/teams.php';</script>";
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    die("Error: Only .pdf files are allowed.");
                }

                if ($fileSize > $maxFileSize) {
                    echo "<script>alert('Error: File size must be less than 2MB.'); window.location.href='../admin/teams.php';</script>";
                }

                $newFileName = "Form-Coordinator-Approval-4th-year" . '.' . $fileExtension;

                if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {

                    $sql = "UPDATE teams SET coor_approval4 = ?, ca_upload_date4 = ? WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$newFileName, $date, $teams_id]);
                } else {
                    echo "<script>alert('Error: File could not be moved.'); window.location.href='../admin/teams.php';</script>";
                }
            } else {
                echo "<script>alert('Error uploading file.'); window.location.href='../admin/teams.php';</script>";
            }

            echo "<script>alert('Successfully uploaded Form Coordinator Approval');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['df'])) {
            $teams_id = $_POST['df_teams_id'];
            $date = date("Y-m-d");
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $allowedMimeTypes = ['application/pdf'];
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileMimeType = mime_content_type($fileTmpPath);
                $uploadDir = '../uploads/';
                $maxFileSize = 2 * 1024 * 1024; //2mb limit

                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    echo "<script>alert('Error: Only PDF are allowed.'); window.location.href='../admin/teams.php';</script>";
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    die("Error: Only .pdf files are allowed.");
                }

                if ($fileSize > $maxFileSize) {
                    echo "<script>alert('Error: File size must be less than 2MB.'); window.location.href='../admin/teams.php';</script>";
                }

                $newFileName = "Defense-fee" . '.' . $fileExtension;

                if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {

                    $sql = "UPDATE teams SET defense_fee = ?, df_upload_date = ? WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$newFileName,  $date, $teams_id]);
                } else {
                    echo "<script>alert('Error: File could not be moved.'); window.location.href='../admin/teams.php';</script>";
                }
            } elseif (isset($_FILES['file4']) && $_FILES['file4']['error'] === UPLOAD_ERR_OK) {
                $allowedMimeTypes = ['application/pdf'];
                $fileTmpPath = $_FILES['file4']['tmp_name'];
                $fileName = $_FILES['file4']['name'];
                $fileSize = $_FILES['file4']['size'];
                $fileMimeType = mime_content_type($fileTmpPath);
                $uploadDir = '../uploads/';
                $maxFileSize = 2 * 1024 * 1024; //2mb limit

                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    echo "<script>alert('Error: Only PDF are allowed.'); window.location.href='../admin/teams.php';</script>";
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    die("Error: Only .pdf files are allowed.");
                }

                if ($fileSize > $maxFileSize) {
                    echo "<script>alert('Error: File size must be less than 2MB.'); window.location.href='../admin/teams.php';</script>";
                }

                $newFileName = "Defense-fee-4th-year" . '.' . $fileExtension;

                if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {

                    $sql = "UPDATE teams SET defense_fee4 = ?, df_upload_date4 = ? WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$newFileName,  $date, $teams_id]);
                } else {
                    echo "<script>alert('Error: File could not be moved.'); window.location.href='../admin/teams.php';</script>";
                }
            } else {
                echo "<script>alert('Error uploading file.'); window.location.href='../admin/teams.php';</script>";
            }

            echo "<script>alert('Successfully uploaded Defense Fee');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['panelist'])) {

            $teams_id = $_POST['teams_id'];
            $fullname = $_POST['fullname'];

            $sql = "INSERT INTO panelist (fullname,teams_id) VALUES (?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$fullname, $teams_id]);

            echo "<script type='text/javascript'>alert('Successfully Add Panelist');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

         // Edit Panelist
         if (isset($_POST['edit_panelist'])) {
            $panelist_id = $_POST['panelist_id'];
            $fullname = $_POST['fullname'];

            $sql = "UPDATE panelist SET fullname = ? WHERE panelist_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$fullname, $panelist_id]);

            echo "<script type='text/javascript'>alert('Successfully Updated Panelist');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        // Delete Panelist
        if (isset($_POST['delete_panelist'])) {
            $panelist_id = $_POST['panelist_id'];

            $sql = "DELETE FROM panelist WHERE panelist_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$panelist_id]);

            echo "<script type='text/javascript'>alert('Successfully Deleted Panelist');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }


        if (isset($_POST['delete'])) {

            $teams_member_id = $_POST['teams_member_id'];
            $leader_id = $_SESSION['id'];

            $sql = "SELECT * FROM teams WHERE users_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$leader_id]);
            if ($stmt->rowcount() > 0) {

                $sql = "SELECT * FROM teams_member WHERE teams_member_id = '" . $teams_member_id . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $teams_id = $row['teams_id'];

                $sql = "SELECT *,COUNT(teams_member_id) AS totalmembers FROM teams_member WHERE teams_id = '" . $teams_id . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $teams_id = $row['teams_id'];

                if ($row['totalmembers'] > 1) {

                    $sql2 = "SELECT * FROM teams_member WHERE teams_id = '" . $teams_id . "' ORDER BY teams_member_id DESC LIMIT 1";
                    $stmt2 = $this->conn()->query($sql2);
                    $row2 = $stmt2->fetch();
                    $new_leader_id = $row2['users_id'];

                    //$sql = "UPDATE teams SET users_id = ? WHERE teams_id = '" . $teams_id . "'";
                    //$stmt = $this->conn()->prepare($sql);
                    //$stmt->execute([$new_leader_id]);

                    $sql = "DELETE FROM teams_member WHERE teams_member_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$teams_member_id]);
                } else {

                    $sql = "DELETE FROM teams_member WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$teams_id]);

                    $sql = "DELETE FROM teams WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$teams_id]);

                    $sql = "DELETE FROM setdeadline WHERE teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$teams_id]);
                }
            } else {

                $sql = "DELETE FROM teams_member WHERE teams_member_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$teams_member_id]);
            }



            echo "<script type='text/javascript'>alert('Successfully Delete Member');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['deleteteams'])) {

            $teams_id = $_POST['teams_id'];

            $sql = "DELETE FROM teams WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id]);

            $sql = "DELETE FROM teams_member WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id]);

            $sql = "DELETE FROM setdeadline WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id]);

            $sql = "DELETE FROM task WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id]);

            echo "<script type='text/javascript'>alert('Successfully Delete Teams');</script>";

            echo "<script>window.location.href='../admin/teams.php';</script>";
        }



        if (isset($_POST['changestatus'])) {

            $teams_id = $_POST['teams_id'];
            $status = $_POST['status'];
            $grade = $_POST['grade'];
            $comment = isset($_POST['redefense_comment']) ? $_POST['redefense_comment'] : null; // Check if comment is provided

            // Update query to include the comments column
            $sql = "UPDATE teams SET status = ?, grade = ?, comments = ? WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$status, $grade, $comment, $teams_id]);

            echo "<script type='text/javascript'>alert('Successfully Changed Status');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }

        if (isset($_POST['changestatus2'])) {

            $teams_id = $_POST['teams_id'];
            $status = $_POST['status'];


            $sql = "SELECT * FROM totalgroups WHERE id = 1";
            $stmt = $this->conn()->query($sql);
            $row = $stmt->fetch();
            $total = $row['total'] + 1;

            $sql = "UPDATE totalgroups SET total = ? WHERE id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$total, 1]);


            $sql = "SELECT * FROM teams WHERE adviser_id = ? AND adviser_status = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$_SESSION['id'], 1]);
            if ($stmt->rowcount() > 0) {
            } else {




                $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
                $stmt = $this->conn()->query($sql);
                $row = $stmt->fetch();
                $department = $row['department'];

                if ($department == 'Information Technology') {

                    $sql = "SELECT * FROM totalgroups WHERE id = 2";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch();
                    $total = $row['total'] + 1;

                    $sql = "UPDATE totalgroups SET total = ? WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$total, 2]);
                } else if ($department == 'Computer SCIENCE') {

                    $sql = "SELECT * FROM totalgroups WHERE id = 3";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch();
                    $total = $row['total'] + 1;

                    $sql = "UPDATE totalgroups SET total = ? WHERE id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$total, 3]);
                }
            }

            $sql = "UPDATE teams SET adviser_status = ?, date_response = ? WHERE teams_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$status, date("Y-m-d"), $teams_id]);


            echo "<script type='text/javascript'>alert('Successfully Change Status');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }


        if (isset($_POST['admincomment'])) {


            $comment = $_POST['comment'];
            $teams_id = $_POST['teams_id'];

            $sql = "INSERT INTO admin_comment (teams_id,comment) VALUES (?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$teams_id, $comment]);

            echo "<script type='text/javascript'>alert('Successfully Add Comment');</script>";
            echo "<script>window.location.href='../admin/teams.php';</script>";
        }
    }
}

$controllerrun = new controller();
$controllerrun->managecontroller();
