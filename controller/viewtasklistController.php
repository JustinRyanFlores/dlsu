<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['edit'])) {

                $teams_id = $_POST['teams_id'];
                $comment = $_POST['comment'];
                $setdeadline_id = $_POST['setdeadline_id'];
                $sql = "INSERT INTO comment (teams_id,setdeadline_id,comment) VALUES (?,?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$teams_id,$setdeadline_id,$comment]);

                echo "<script type='text/javascript'>alert('Successfully Comment');</script>";
                echo "<script>window.location.href='../admin/viewtasklist.php?teams_id=".$teams_id."';</script>";

            }


            if (isset($_POST['add'])) {

                $teams_id = $_POST['teams_id'];
                $name = $_POST['name'];
                $sql = "INSERT INTO setdeadline (teams_id,name) VALUES (?,?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$teams_id,$name]);

                echo "<script type='text/javascript'>alert('Successfully Add Task');</script>";
                echo "<script>window.location.href='../admin/viewtasklist.php?teams_id=".$teams_id."';</script>";

            }

            if (isset($_POST['edit2'])) {

                $setdeadline_id = $_POST['setdeadline_id'];
                $teams_id = $_POST['teams_id'];
                $name = $_POST['name'];
                $status = $_POST['status'];
                $deadline = $_POST['deadline'];
                $notes = $_POST['notes'];

                $sql = "UPDATE setdeadline SET name = ?, status = ? WHERE setdeadline_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$name,$status,$setdeadline_id]);
                
                if(!empty($deadline)) {
                    $sql = "UPDATE setdeadline SET deadline = ? WHERE setdeadline_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$deadline,$setdeadline_id]);
                }
                
                if(!empty($notes)) {
                    $sql = "SELECT notes FROM reminder WHERE setdeadline_id = ? AND teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$setdeadline_id,$teams_id]);
                    $selected_note = $stmt->fetch();
                    
                    if($selected_note != NULL){
                        $sql = "UPDATE reminder SET notes = ?, notif = '1' WHERE setdeadline_id = ? AND teams_id = ?";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$notes,$setdeadline_id,$teams_id]);
                    } else {
                        $sql = "INSERT INTO reminder (teams_id, setdeadline_id, notes) VALUES (?, ?, ?)";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$teams_id,$setdeadline_id,$notes]);
                    }
                }

                echo "<script type='text/javascript'>alert('Successfully Edit Task');</script>";
                echo "<script>window.location.href='../admin/viewtasklist.php?teams_id=".$teams_id."';</script>";

            }

            if (isset($_POST['delete'])) {

                $setdeadline_id = $_POST['setdeadline_id'];
                $teams_id = $_POST['teams_id'];

                $sql = "DELETE FROM setdeadline WHERE setdeadline_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$setdeadline_id]);

                echo "<script type='text/javascript'>alert('Successfully Remove Task');</script>";
                echo "<script>window.location.href='../admin/viewtasklist.php?teams_id=".$teams_id."';</script>";

            }



        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
