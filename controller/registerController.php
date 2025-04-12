<?php
    include '../config/config.php';

    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['register'])) {

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $passwordtxt = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
                $department = $_POST['department'];
                $type = $_POST['type'];
                $cys = isset($_POST['cys']) ? strtoupper($_POST['cys']) : null;
                $yr_lvl = isset($_POST['yr_lvl']) ? strtoupper($_POST['yr_lvl']) : null;

                if ($_POST['password'] != $_POST['confirmpassword']) {
                 
                    echo "<script type='text/javascript'>alert('Password Not Match');</script>";
                    echo "<script>window.location.href='../register.php';</script>";
                
                } else {

                    $sql = "SELECT * FROM users WHERE email = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$email]);
                    
                    if ($stmt->rowCount() > 0) {

                        echo "<script type='text/javascript'>alert('Account Already Exist');</script>";
                        echo "<script>window.location.href='../register.php';</script>";

                    } else {
                        if($_POST['type'] == 1){

                            $sql = "INSERT INTO users (firstname,lastname,middlename,email,password,passwordtxt,department,type) VALUES (?,?,?,?,?,?,?,?)";
                            $stmt = $this->conn()->prepare($sql);
                            $stmt->execute([$firstname,$lastname,$middlename,$email,$password,$passwordtxt,$department,$type]);
                            
                            echo "<script type='text/javascript'>alert('Adviser Successfully Register');</script>";
                            echo "<script>window.location.href='../login.php';</script>";
                        } else {
                            $sql = "INSERT INTO users (firstname,lastname,middlename,section,yr_lvl,email,password,passwordtxt,department,type) VALUES (?,?,?,?,?,?,?,?,?,?)";
                            $stmt = $this->conn()->prepare($sql);
                            
                            if ($stmt->execute([$firstname,$lastname,$middlename,$cys,$yr_lvl,$email,$password,$passwordtxt,$department,$type])){
                                $sql = "SELECT section_name FROM sections WHERE section_name = ?";
                                $stmt = $this->conn()->prepare($sql);
                                $stmt->execute([$cys]);
                                if ($stmt->rowCount() == 0){
                                    $sql = "INSERT INTO sections (department, section_name, yr_lvl, adviser) VALUES (?, ?, ?, null)";
                                    $stmt = $this->conn()->prepare($sql);
                                    $stmt->execute([$department,$cys,$yr_lvl]);
                                }
                            }
                            echo "<script type='text/javascript'>alert('Student Successfully Register');</script>";
                            echo "<script>window.location.href='../login.php';</script>";
                        }
                    }

                }

                

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
