<?php include("includes/header.php"); ?>

<?php

Session::logout();
header("Location: index.php");

?>