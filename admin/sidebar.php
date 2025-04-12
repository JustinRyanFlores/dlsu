<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Floating Sidebar */
        .main-sidebar {
            position: fixed;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 240px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.15);
            padding: 15px;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        /* Sidebar Hover Effect */
        .main-sidebar:hover {
            width: 250px;
        }

        /* Sidebar Logo */
        .sidebar-logo {
            text-align: center;
            padding: 10px 0;
        }

        .sidebar-logo img {
            width: 80%;
            max-width: 120px;
        }

        /* Sidebar Title */
        .title {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            color: #1d4e89;
            /* Dark Blue Title */
            margin-bottom: 15px;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;

        }

        .sidebar-menu li {
            display: block;
            margin-bottom: 10px;

        }

        /* Sidebar Links */
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            font-size: 18px;
            font-weight: 500;
            color: #1d4e89;
            /* Dark Blue Title */
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        /* Sidebar Icons */
        .sidebar-menu i {
            font-size: 18px;
            min-width: 25px;
            text-align: center;
            margin-right: 12px;
            color: #1d4e89;
            /* Dark Blue Icons */
            transition: color 0.3s ease;
        }

        /* Hover & Active States */
        /* Hover State */
        .sidebar-menu a:hover {
            background: darkblue;
            /* Regular dark blue on hover */
            color: white;
        }

        .sidebar-menu a:hover i {
            color: white;
            /* Make icons white on hover */
        }

        /* Active State */
        .sidebar-menu a.active {
            background: #0b3d91;
            /* Darker blue for active state */
            color: white;
        }

        .sidebar-menu a.active i {
            color: white;
            /* Make icons white when active */
        }


        /* Profile Section */
        .sidebar-profile {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s ease;
            color: #1d4e89;
            /* Dark Blue Text */
            white-space: nowrap;
            overflow: hidden;
            text-decoration: none;
        }

        .sidebar-profile:hover {
            background: #e0e0e0;
        }

        /* Profile Image */
        .sidebar-profile img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            /* Ensures the image covers the area while maintaining its aspect ratio */
            border: 2px solid #1d4e89;
            /* Dark Blue Border */
        }

        /* Profile Info */
        .sidebar-profile .profile-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            margin-left: 10px;
        }

        .sidebar-profile .profile-info .name {
            font-weight: 600;
            font-size: 14px;
            color: #1d4e89;
            /* Dark Blue Name */
        }

        .sidebar-profile .profile-info .role {
            font-size: 12px;
            color: #1d4e89;
            /* Dark Blue Role */
        }

        /* Mobile Optimization */
        @media (max-width: 768px) {
            .main-sidebar {
                left: 0;
                width: 200px;
                border-radius: 0;
                box-shadow: none;
            }

            .sidebar-menu a {
                font-size: 14px;
                padding: 8px 10px;
            }

            .sidebar-profile {
                flex-direction: column;
                text-align: center;
                padding: 8px;
            }

            .sidebar-profile .profile-info {
                margin-top: 5px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- Logo Section -->
            <div class="sidebar-logo">
                <img src="../images/thesishub_logo2.png" alt="Thesis Hub Logo">
            </div>

            <p class="title">THESIS TRACKER</p>
            <hr class="my-4">

            <!-- Navigation Menu -->
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> <span>DASHBOARD</span></a></li>

                <?php if ($_SESSION['type'] == 0): ?>
                    <li><a href="users.php"><i class="fa-solid fa-users"></i> <span>USERS</span></a></li>
                <?php endif; ?>

                <li><a href="about.php"><i class="fa-solid fa-circle-info"></i> <span>ABOUT</span></a></li>

                <?php if ($_SESSION['type'] != 0): ?>
                    <li><a href="notifications.php"><i class="fa-solid fa-bell"></i> <span>NOTIFICATIONS</span></a></li>
                <?php endif; ?>

                <li><a href="templates.php"><i class="fa-solid fa-book"></i> <span>TEMPLATES</span></a></li>

                <?php if ($_SESSION['type'] == 1 || $_SESSION['type'] == 2): ?>
                    <li><a href="tasklist.php"><i class="fa-solid fa-list-check"></i> <span>TASK LIST</span></a></li>
                <?php endif; ?>

                <li><a href="teams.php"><i class="fa-solid fa-people-group"></i> <span>TEAMS</span></a></li>

                <?php if ($_SESSION['type'] == 0): ?>
                    <li><a href="assignation.php"><i class="fa-solid fa-user-check"></i> <span>ASSIGNATION</span></a></li>
                <?php endif; ?>

                <li><a href="../logout.php" onclick="return confirm('Are you sure you want to logout?');">
                        <i class="fa-solid fa-right-from-bracket"></i> <span>LOGOUT</span>
                    </a></li>
            </ul>

            <!-- Profile Section -->
            <ul class="sidebar-menu">
                <li>
                    <?php
                    $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
                    $stmt = $this->conn()->query($sql);
                    $row = $stmt->fetch();
                    ?>
                    <a href="#profile" data-toggle="modal" class="sidebar-profile" id="updateprofile"
                        data-firstname="<?= $row['firstname'] ?>" data-users_id="<?= $row['id'] ?>"
                        data-lastname="<?= $row['lastname'] ?>" data-email="<?= $row['email'] ?>"
                        data-password="<?= $row['passwordtxt'] ?>" data-img="<?= $row['img'] ?>"
                        data-section="<?= $row['section'] ?>" data-yrlvl="<?= $row['yr_lvl'] ?>">
                        <img src="../images/<?php echo $row['img']; ?>" alt="User Profile" style>
                        <div class="profile-info mt-5">
                            <span class="name"><?php echo $row['firstname'] . " " . $row['lastname']; ?></span>
                            <span
                                class="role"><?php echo ($_SESSION['type'] == 1) ? "Faculty" : ($_SESSION['type'] == 2 ? "Student" : "Admin"); ?></span>
                        </div>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

</body>

</html>