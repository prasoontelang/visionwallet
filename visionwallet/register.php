<?php
   $name = $_POST['name'];
   $usernm = $_POST['usernm'];
   $passwd = $_POST['passwd'];
   $isMerch = $_POST['ismerchant'];
   $balance = $_POST['balance'];
   $con = mysqli_connect("localhost","root","PRASOONT","visionwallet");

   $query = "select MAX(userid) as id FROM userdata;";
   $result = mysqli_query($con, $query);
   $row = mysqli_fetch_array($result);

   $userid = $row['id'] + 1;

   $query = "INSERT INTO userdata VALUES (\"$usernm\", \"$passwd\",$isMerch,$userid);";
   mysqli_query($con, $query);

   if ($isMerch == 1)
   {
       $table = "merchantinfo";
   }
   else
   {
       $table = "customerinfo";
   }
   $query = "INSERT INTO $table VALUES($userid, $balance, \"$name\");";
   mysqli_query($con, $query);
   echo "Welcome $name!! Click <a href=\"login.html\">back</a> to continue";
?>
