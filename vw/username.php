<?php
    session_start();
    $userid = $_SESSION['userid'];
    $query = "SELECT customername FROM customerinfo WHERE userid=$userid;";
    $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
    if (mysqli_connect_errno($con))
       echo "Failed to connect to MySQL";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if ($row != NULL)
    {
       $usernm = $row['customername'];
       echo "$usernm";
    }
?>
