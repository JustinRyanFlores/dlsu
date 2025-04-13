<?php
session_start();
include '../config/config.php';

class controller extends Connection
{

    public function managecontroller()
    {

        if (isset($_POST['taskcomment'])) {

            $users_id = $_SESSION['id'];
            $comment = $_POST['comment'];
            $task_id = $_POST['task_id'];
            $teams_id = $_POST['teams_id'];

            $sql = "INSERT INTO task_comment (task_id,users_id,comment) VALUES (?,?,?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$task_id, $users_id, $comment]);

            echo "<script type='text/javascript'>alert('Successfully Comment');</script>";
            echo "<script>window.location.href='../admin/monitorthesis.php?teams_id=" . $teams_id . "';</script>";
        }
        if (isset($_POST['taskcommentdashboard'])) {

            $users_id = $_SESSION['id'];
            $comment = $_POST['comment'];
            $task_id = $_POST['task_id'];

            $sql = "INSERT INTO task_comment (task_id, users_id, comment) VALUES (?, ?, ?)";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$task_id, $users_id, $comment]);

            echo "<script type='text/javascript'>alert('Successfully Commented');</script>";
            echo "<script>window.location.href='../admin/dashboard.php';</script>";
        }


        if (isset($_POST['view_taskcomment'])) {
            $task_id = $_POST['task_id'];

            // Fetch comments along with adviser's first name
            $sql = "SELECT task_comment.comment, users.firstname 
                    FROM task_comment
                    JOIN users ON task_comment.users_id = users.id
                    WHERE task_comment.task_id = ?";

            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$task_id]);

            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $comments_html = '';
            if ($comments) {
                foreach ($comments as $comment) {
                    $comments_html .= '<p><strong>' . htmlspecialchars($comment['firstname']) . ':</strong> ' . htmlspecialchars($comment['comment']) . '</p>';
                }
            } else {
                $comments_html .= '<p>No comments found for this task.</p>';
            }

            echo $comments_html;
            exit;
        }

        if (isset($_POST['view_taskcommentdashboard'])) {
            $task_id = $_POST['task_id'];

            // Fetch comments along with adviser's first name
            $sql = "SELECT task_comment.comment, users.firstname 
                    FROM task_comment
                    JOIN users ON task_comment.users_id = users.id
                    WHERE task_comment.task_id = ?";

            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$task_id]);

            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $comments_html = '';
            if ($comments) {
                foreach ($comments as $comment) {
                    $comments_html .= '<p><strong>' . htmlspecialchars($comment['firstname']) . ':</strong> ' . htmlspecialchars($comment['comment']) . '</p>';
                }
            } else {
                $comments_html .= '<p>No comments found for this task.</p>';
            }

            echo $comments_html;
            exit;
        }

        if (isset($_POST['tasklike'])) {

            $users_id = $_SESSION['id'];
            $task_id = $_POST['task_id'];

            // Check if the user has already liked the task
            $sql = "SELECT * FROM task_like WHERE task_id = ? AND users_id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$task_id, $users_id]);

            if ($stmt->rowCount() > 0) {
                // Unlike the task by deleting the record
                $sql = "DELETE FROM task_like WHERE task_id = ? AND users_id = ?";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$task_id, $users_id]);
            } else {
                // Like the task by inserting the record
                $sql = "INSERT INTO task_like (task_id, users_id) VALUES (?, ?)";
                $stmt = $this->conn()->prepare($sql);
                $stmt->execute([$task_id, $users_id]);
            }

            $sql3 = "SELECT COUNT(task_like_id) AS total_like FROM task_like WHERE task_id = ?";
            $stmt3 = $this->conn()->prepare($sql3);
            $stmt3->execute([$task_id]);
            $row3 = $stmt3->fetch();

            echo $row3['total_like'];
        }
    }
}

$controllerrun = new controller();
$controllerrun->managecontroller();
