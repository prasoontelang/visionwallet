<?php
  session_start();
  $userid = $_SESSION['userid'];
  $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
  $query = "SELECT merchantid, tcc, amount FROM checktcc WHERE customerid=$userid;";

  $echostr = "<table border = \"1\"><tr><th>Merchant Name</th><th>TCC Code</th><th>Amount</th></tr>";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  if ($row == NULL)
  {
     echo "No active TCCs";
  }
  else
  {
    while ($row != NULL)
    {
       $merchantid = $row['merchantid'];
       $tccID = $row['tcc'];
       $amount = $row['amount'];
       $query_merchant = "SELECT merchantname FROM merchantinfo WHERE userid=$merchantid;";
       $result_merchant = mysqli_query($con, $query_merchant);
       $row_merchant = mysqli_fetch_array($result_merchant);
       $merchantname = $row_merchant['merchantname'];
       $echostr .= "<tr><td>$merchantname</td><td>$tccID</td><td>$amount</td></tr>";
       $row = mysqli_fetch_array($result);
    }
    $echostr .= "</table>";
    echo $echostr;
  }
?>
