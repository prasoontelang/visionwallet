<?php
  session_start();

  $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
  if (mysqli_connect_errno($con))
      echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $input_recv = array();
  $input_recv = explode("#", $_POST['trans']);
  $merch_code = $input_recv[0];
  $amount = $input_recv[1];
  $query = "SELECT * FROM merchantinfo WHERE userid=$merch_code;";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  if ($row != NULL)
  {
      $_SESSION['trans'] = $_POST['trans'];
      $_SESSION['merchantid'] = $merch_code;
      $_SESSION['amount'] = $amount;
      $merch_name = $row['merchantname'];
      echo "Merchant: $merch_name\nAmount: $amount";
  }
  else
  {
      echo "false";
  }
?>
