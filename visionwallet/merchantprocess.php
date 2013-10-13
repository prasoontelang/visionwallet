<html>
<head>
  <style>
     #disp
     {
         font-size:25px;
         color:#FFFFFF;
     }
  </style>
</head>
<body bgcolor="#339999">
<?php
  session_start();
  if (!isset($_SESSION['merchant']))
  {
    header("location:login.html");
  }
  else
  {
    $tccode = $_POST['tccID'];
    $merch_id = $_SESSION['merchant'];
    $con = mysqli_connect("localhost","root","PRASOONT","visionwallet");
    if (mysqli_connect_errno($con))
        echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $query = "SELECT * FROM checktcc WHERE merchantid=$merch_id AND tcc=$tccode";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if ($row != NULL)
    {
      $amount = $row['amount'];
      $cust_id = $row['userid'];
  
      //Retrieving merchant balance
      $query = "SELECT balance FROM merchantinfo WHERE userid=$merch_id;";
      $new_result = mysqli_query($con, $query);
      $new_row = mysqli_fetch_array($new_result);
      $old_amount = $new_row['balance'];

      //Updating the new balance amount
      $new_amount = $old_amount + $amount;
      $query = "UPDATE merchantinfo SET balance=$new_amount WHERE userid=$merch_id;";
      mysqli_query($con, $query);
  
      //Deleting the tcc entry
      $query = "DELETE FROM checktcc WHERE merchantid=$merch_id AND tcc=$tccode;";
      mysqli_query($con, $query);
  
      //Updated amount displayed
      $query = "SELECT balance FROM merchantinfo WHERE userid=$merch_id;";
      $new_row = mysqli_query($con, $query);
      $result = mysqli_fetch_array($new_row);
      $new_balance = $result['balance'];
      $echoStr = "<table border=\"0\">";
      $echoStr .= "<tr><td><span id=\"disp\">Amount credited</span></td><td><span id=\"disp\">Rs. $amount</span></td></tr>";
      $echoStr .= "<tr><td><span id=\"disp\">Old balance</span></td><td><span id=\"disp\">Rs. $old_amount</span></td></tr>";
      $echoStr .= "<tr><td><span id=\"disp\">New balance</span></td><td><span id=\"disp\">Rs. $new_balance</span></td></tr>";
      $echoStr .= "</table><br/>";
      $echoStr .= "<button type=\"button\" onclick=\"location.href='merchant.php'\">Go back</button>";
      echo $echoStr;
    }
    else
    {
      echo "fail";
    }
  }
?>
</body>
</html>
