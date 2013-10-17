<?php
  session_start();
  $userid = $_SESSION['userid'];
  $query = "SELECT balance FROM customerinfo WHERE userid=$userid;";
  $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  $bal = $row['balance'];
  echo "$bal";
?>
