<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['add'])) {

                $users_id = $_SESSION['id'];
                $title = $_POST['title'];
                $notes = $_POST['notes'];
                $report = $_POST['report'];

                $file = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/".$file);


                $sql = "INSERT INTO templates (users_id,title,notes,report,file) VALUES (?,?,?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$users_id,$title,$notes,$report,$file]);

                echo "<script type='text/javascript'>alert('Successfully Add Template');</script>";
                echo "<script>window.location.href='../admin/templates.php';</script>";

            }


            if (isset($_POST['edit'])) {

                $templates_id = $_POST['templates_id'];
                $title = $_POST['title'];
                $notes = $_POST['notes'];
                $report = $_POST['report'];

                $file = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/".$file);

                if ($file == "") {

                    $sql = "UPDATE templates SET title = ?, notes = ?, report = ? WHERE templates_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$title,$notes,$report,$templates_id]);

                } else {

                    $sql = "UPDATE templates SET title = ?, notes = ?, report = ?, file = ? WHERE templates_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$title,$notes,$report,$file,$templates_id]);

                }

                echo "<script type='text/javascript'>alert('Successfully Edit Template');</script>";
                echo "<script>window.location.href='../admin/templates.php';</script>";

            }

            if (isset($_POST['delete'])) {

                $templates_id = $_POST['templates_id'];

                $sql = "DELETE FROM templates WHERE templates_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$templates_id]);

                echo "<script type='text/javascript'>alert('Successfully Delete Template');</script>";
                echo "<script>window.location.href='../admin/templates.php';</script>";
                
            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
