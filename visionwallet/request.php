<html>
<style>
  #disp 
  { 
    color:white; 
    font-size:25px;
  }
</style>
<body bgcolor="#339999">
<?php
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header('location:login.html');
  }
  else
  {
    $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
    if (mysqli_connect_errno($con))
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    $input_recv = array();
    $input_recv = explode("#", $_POST['trans']);
    $merch_code = $input_recv[0];
    $billamount = $input_recv[1];
    $query = "SELECT * FROM merchantinfo WHERE userid=$merch_code;";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $outputStr = "<table border = \"0\"><tr><td><span id=\"disp\">Details</span></td></tr>";
    if ($row != NULL)
    {
       $merch_name = $row['merchantname'];
       $outputStr .= "<tr><td><span id=\"disp\"><u>Merchant Name</u>:</span></td><td> <span id=\"disp\">$merch_name</span></td></tr>";
       $outputStr .= "<tr><td><span id=\"disp\"><u>Amount to pay</u>:</span></td><td> <span id=\"disp\">Rs. $billamount</span></td></tr>";
       $outputStr .= "</table>";
       echo $outputStr;
       $_SESSION['merchantid'] = $merch_code;
       $_SESSION['amount'] = $billamount;
    }
    else
    {
       echo "<center><span id=\"disp\">Invalid merchant id</span></center>";
    }
  }
?>
  <form action="generateTCC.php" method="POST">
    <input type="Submit" value="Confirm">
    <button type="button" onclick="location.href='payment.php'">Go Back</button>
  </form>
</body>
</html>
