<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
include '../config/config.php';

// Set response type to JSON
header('Content-Type: application/json');

class Login extends Connection
{
    public function loginUser()
    {
        // Get JSON input
        $data = json_decode(file_get_contents('php://input'), true);
        $response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input fields
            if (empty($data['email']) || empty($data['password'])) {
                $response['message'] = 'Email and password are required.';
                echo json_encode($response);
                exit();
            }

            // Sanitize input
            $email = htmlspecialchars(trim($data['email']));
            $password = htmlspecialchars(trim($data['password']));

            try {
                // Prepare and execute query
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$email]);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();

                    // Verify password
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['type'] = $row['type'];

                        if ($row['type'] == 2) {
                            $redirect = '../admin/dashboard.php';
                        } elseif ($row['type'] == 1) {
                            if ($row['status'] == 0) {
                                $response['message'] = 'Your account needs approval from an admin.';
                                echo json_encode($response);
                                exit();
                            } else {
                                $redirect = '../admin/dashboard.php';
                            }
                        } else {
                            $redirect = '../admin/dashboard.php';
                        }

                        // Return success response with redirect link
                        $response['status'] = 'success';
                        $response['message'] = 'Login successful. Redirecting...';
                        $response['redirect'] = $redirect;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['message'] = 'Invalid password. Please try again.';
                    }
                } else {
                    $response['message'] = 'Invalid email or password.';
                }
            } catch (Exception $e) {
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        }

        echo json_encode($response);
        exit();
    }
}

// Instantiate and call login function
$loginRun = new Login();
$loginRun->loginUser();

?>
