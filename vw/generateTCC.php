<?php
  session_start();
     
  $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
  if (mysqli_connect_errno($con))
      echo "Failed to connect to MySQL:" . mysqli_connect_error();
  if (isset($_SESSION['merchantid']))
  {
     $merch_id = $_SESSION['merchantid'];
     $cust_id = $_SESSION['userid'];
     $rand_no = rand(1000,9999);
     $amt_detail = $_SESSION['amount'];

     settype($merch_id, integer);
     settype($cust_id, integer);
     settype($amt_detail, integer);

     $query = "SELECT balance FROM customerinfo WHERE userid=$cust_id;";
     $row = mysqli_query($con, $query);
     $result = mysqli_fetch_array($row);
     $new_balance = $result['balance'] - $amt_detail;
     $query = "UPDATE customerinfo SET balance=$new_balance WHERE userid=$cust_id;";
     mysqli_query($con, $query);

     $query = "INSERT INTO checktcc VALUES($cust_id, $merch_id, $rand_no, $amt_detail);";
     mysqli_query($con, $query);
     echo "The TCC Code is: $rand_no.\nSay the TCC code to merchant.";
  }
?>
