<?php
  session_start();
  $usernm = $_POST["usernm"];
  $passwd = $_POST["passwd"];
  $con = mysqli_connect("localhost", "root", "PRASOONT", "visionwallet");
    if (mysqli_connect_errno($con))
      echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $quer = "SELECT userid,ismerchant FROM userdata WHERE username='$usernm' AND password='$passwd';";
  $result = mysqli_query($con, $quer);
  $row = mysqli_fetch_array($result);
  
  if ($row != NULL)
  {
    session_start();
    $_SESSION['ismerchant'] = $row['ismerchant'];
    $typeoflogin = $row['ismerchant'];
    $userid = $row['userid'];
    $_SESSION['userid'] = $userid;
    settype($typeoflogin, "integer");
    if ($typeoflogin == 1)
    {
        echo "merchant";
    }
    else if ($typeoflogin == 0)
    {
        echo "customer";
    }
  }
  else
  {
      $str = "fail";
      echo $str;
  }
  mysqli_close($con);
?>
