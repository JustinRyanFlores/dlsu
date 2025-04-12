<?php
    
    include '../config/config.php';
    session_start();
    class controller extends Connection{

        public function managecontroller(){


            if (isset($_POST['save'])) {

                $id = $_SESSION['id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $section = $_POST['section'];
                $yr_lvl = $_POST['yr_lvl'];

                $img = $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);
                            
                if ($img == '') {
                    $sql = "UPDATE users SET firstname = ?, lastname = ?, section = ?, yr_lvl = ?, email = ?, password = ?, passwordtxt = ? WHERE id = '".$id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$firstname,$lastname,$section,$yr_lvl,$email,$password,$_POST['password']]);
            
                } else {
                    $sql = "UPDATE users SET img = ?, firstname = ?, lastname = ?, section = ?, yr_lvl = ?, email = ?, password = ?, passwordtxt = ? WHERE id = '".$id."'";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$img,$firstname,$lastname,$section,$yr_lvl,$email,$password,$_POST['password']]);
                }
                    
            }
            echo "<script>alert('Profile updated successfully');window.location.href='../admin/dashboard.php';</script>";

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
