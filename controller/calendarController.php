<?php
    session_start();
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['addcalendar'])) {

                $users_id = $_SESSION['id'];
                $title = $_POST['title'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $hectare = $_POST['hectare'];
                $type = $_POST['type'];
                $select2 = $_POST['select2'];
                $total = $_POST['total'];

                $sql = "SELECT * FROM schedule WHERE title = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$title]);
                
                if ($stmt->rowcount() > 0) {

                    echo "<script type='text/javascript'>alert('Schedule Already Exist');</script>";
                    echo "<script>window.location.href='../admin/schedule.php';</script>";

                } else {

                    $sql = "INSERT INTO schedule (title,start_date,end_date,hectare,type,select2,total) VALUES (?,?,?,?,?,?,?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$title,$start_date,$end_date,$hectare,$type,$select2,$total]);

                    $sql = "SELECT * FROM schedule ORDER BY schedule_id DESC LIMIT 1";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch();
                    $schedule_id = $row['schedule_id'];

                    $sql = "INSERT INTO schedule_history (schedule_id) VALUES (?)";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$schedule_id]);


                    echo "<script type='text/javascript'>alert('Successfully Add Schedule');</script>";
                    echo "<script>window.location.href='../admin/schedule.php';</script>";

                }

            }

            if (isset($_POST['editcalendar'])) {

                $schedule_id = $_POST['schedule_id'];
                $title = $_POST['title'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $hectare = $_POST['hectare'];
                $type = $_POST['type'];
                $select2 = $_POST['select2'];
                $total = $_POST['total'];

                $sql = "UPDATE schedule SET title = ?, start_date = ?, end_date = ?, hectare = ?, type = ?, select2 = ?, total = ? WHERE schedule_id = '".$schedule_id."'";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$title,$start_date,$end_date,$hectare,$type,$select2,$total]);

                $sql = "INSERT INTO schedule_history (schedule_id) VALUES (?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$schedule_id]);
           
                echo "<script type='text/javascript'>alert('Successfully Edit Schedule');</script>";
                echo "<script>window.location.href='../admin/schedule.php';</script>";

            }

            if (isset($_POST['delete'])) {

                    $schedule_id = $_POST['schedule_id'];

                    $sql = "DELETE FROM schedule WHERE schedule_id = '".$schedule_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([]);


                    echo "<script type='text/javascript'>alert('Successfully Archive Schedule');</script>";
                    echo "<script>window.location.href='../admin/schedule.php';</script>";
                
            }

            if (isset($_POST['deletecalendar'])) {

                    $schedule_id = $_POST['schedule_id'];

                    $sql = "DELETE FROM schedule WHERE schedule_id = '".$schedule_id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([]);


                    echo "<script type='text/javascript'>alert('Successfully Archive Schedule');</script>";
                    echo "<script>window.location.href='../admin/schedule.php';</script>";
                
            }

            

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
