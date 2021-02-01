<?php
$notCount = empty($_SESSION['notifications']) ? 0 : count($_SESSION['notifications']);
$badgeColor = $notCount ? "#FA3E3E" : "#777";
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">Gallery Admin</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    <li><a href="../index.php">Home Page</a></li>

    <!-- notifications dropdown -->
    <li class="dropdown">
      <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="display: flex;align-items: center;">
        <i class="fa fa-fw fa-bell" style="font-size: 1.3em;"></i>
        <?php echo "<span id='notificationsBadge' class='badge' style='background-color: $badgeColor; font-size: 0.8em'>{$notCount}</span>" ?>
      </a>

      <ul id="notificationsDropdown" class="dropdown-menu" aria-labelledby="notifications" style="width: 300px;">
        <?php
        if (empty($_SESSION['notifications']))
          echo "<li><a href='#'>No new notifications</a></li>";
        else {
          foreach ($_SESSION['notifications'] as $notification) {
            echo "<li><a href='#' style='display: flex;align-items: center;justify-content: space-between;'>$notification<i class='fa fa-fw fa-circle' style='font-size: 0.75em; color: #FA3E3E'></i></a></li>";
          }
        }
        ?>

      </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo User::findById($_SESSION['user_id'])->username ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </li>
      </ul>
    </li>
  </ul>
  <?php include("includes/sidebar.php") ?>
  <!-- /.navbar-collapse -->
</nav>