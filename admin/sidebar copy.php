<style>
  .main-sidebar a {
    color: #3ea1db !important;
  }

  .title {
    font-size: 24px;
    margin-bottom: 40px;
    color: #3ea1db;
    font-weight: 600;
    letter-spacing: 3px;
  }
</style>
<aside class="main-sidebar" style="padding-top: unset;">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li style="background: #fff;color: #fff;text-align: center;padding: 20px;">
        <!-- <img src="../images/logo2.png" width="100%">
      <br><br> -->
        <img src="../images/thesishub_logo2.png" width="60%">
      </li>
      <p class="text-center title">THESIS TRACKER</p>
      <li><a href="dashboard.php"><i
            class="fa fa-<?= $_SESSION['type'] == 1 ? 'chalkboard-teacher' : 'tachometer-alt' ?>"></i>
          <span><?= $_SESSION['type'] == 1 ? 'CLASS OVERVIEW' : 'DASHBOARD' ?></span></a></li>
      <?php if ($_SESSION['type'] == 0): ?>
        <li><a href="users.php"><i class="fas fa-users"></i> <span>USERS</span></a></li>
      <?php endif; ?>

      <li><a href="about.php"><i class="fas fa-ellipsis-h"></i> <span>ABOUT</span></a></li>

      <?php if ($_SESSION['type'] != 0): ?>
        <li><a href="notifications.php" style="position: relative;">
            <i class="fas fa-bell"></i> <span>NOTIFICATIONS</span>
            <div style="position:absolute;right: 10px;top: 50%;transform: translateY(-50%);">

              <!-- adviser notif -->
              <?php if ($_SESSION['type'] == 1): ?>

                <?php $sql = "SELECT * FROM reminder_adviser WHERE notif = 1 AND adviser_id = '" . $_SESSION['id'] . "'";
                $stmt = $this->conn()->query($sql);
                if ($adviser = $stmt->fetch()): ?>
                  <div style="width: 7px;height: 7px;border-radius: 50%;background: red;box-shadow: 0px 0px 5px red;">
                  <?php endif ?>

                  <!-- student notif -->
                <?php elseif ($_SESSION['type'] == 2): ?>
                  <?php
                  $sql1 = "SELECT teams_id FROM teams_member WHERE users_id = ?";
                  $stmt1 = $this->conn()->prepare($sql1);
                  $stmt1->execute([$_SESSION['id']]);
                  $team_id = $stmt1->fetchColumn() ?: null;

                  if ($team_id !== null) {
                    $sql = "SELECT * FROM reminder WHERE notif = 1 AND teams_id = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$team_id]);
                    if ($student = $stmt->fetch()):
                      ?>
                      <div style="width: 7px; height: 7px; border-radius: 50%; background: red; box-shadow: 0px 0px 5px red;">
                      </div>
                    <?php
                    endif;
                  }
                  ?>

                <?php endif ?>


          </a></li>
      <?php endif; ?>

      <li>
        <a href="templates.php"><i class="fas fa-book"></i> <span>TEMPLATES</span></a>
      </li>

      <?php if ($_SESSION['type'] == 2): ?>
        <li>
          <a href="tasklist.php"><i class="fas fa-list"></i> <span>TASK LIST</span></a>
        </li>
      <?php endif; ?>
      <?php if ($_SESSION['type'] == 1): ?>
        <li>
          <a href="tasklist.php"><i class="fas fa-list"></i> <span>TASK LIST</span></a>
        </li>
      <?php endif; ?>
      <li>
        <a href="teams.php"><i class="fas fa-users"></i> <span>TEAMS</span></a>
      </li>
      <?php if ($_SESSION['type'] == 0): ?>
        <li>
          <a href="assignation.php"><i class="fas fa-user-check"></i> <span>ASSIGNATION</span></a>
        </li>
      <?php endif; ?>
      <li>
        <a href="../logout.php" onclick="return confirm('Are you sure you want to logout?');"><i
            class="fas fa-sign-out"></i> <span>LOGOUT</span></a>
      </li>
    </ul>


    <ul class="sidebar-menu" style="position: absolute;bottom: 0; width: 100%">
      <li>
        <?php
        $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
        $stmt = $this->conn()->query($sql);
        $row = $stmt->fetch();
        ?>
        <a href="#profile" data-toggle="modal" id="updateprofile" data-firstname="<?= $row['firstname'] ?>"
          data-users_id="<?= $row['id'] ?>" data-lastname="<?= $row['lastname'] ?>" data-email="<?= $row['email'] ?>"
          data-password="<?= $row['passwordtxt'] ?>" data-img="<?= $row['img'] ?>" data-section="<?= $row['section'] ?>"
          data-yrlvl="<?= $row['yr_lvl'] ?>">

          <img src="../images/<?php echo $row['img'] ?>" width="30px" height="30px" style="border-radius: 50%;">
          <?php
          if ($_SESSION['type'] == 1) {
            echo " Faculty:";
          } else if ($_SESSION['type'] == 2) {
            echo " Student:";
          } else if ($_SESSION['type'] == 0) {
            echo " Admin:";
          }
          ?>
          <span><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
        </a>
      </li>
    </ul>
    <?php include "profile.php" ?>
  </section>
</aside>