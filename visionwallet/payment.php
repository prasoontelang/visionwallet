<html>
<style>
  h2 { color:#FFFFFF; }
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
    $con = mysqli_connect("localhost","root","PRASOONT","visionwallet");
    if (mysqli_connect_errno($con))
      echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $table_ch = 'customerinfo';
    $user_id = 'userid';
    $acc_name = 'customername';

    $user_id_value = $_SESSION['userid'];
    $query = "SELECT * from $table_ch where $user_id=$user_id_value";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);
    $acc_holder = $row[$acc_name];
    $balance = $row['balance'];
    echo "<h2>Welcome $acc_holder</h2><br/>";
  }
?>
<form action="request.php" method="POST">
<table border="0">
<tr>
  <td colspan="2"><input type="text" style="font-size:25px;" id="trans" name="trans" placeholder="code#amount"/></td>
</tr>
<tr>
<?php
    echo "<td><span style=\"color:white;\">Amount available $balance</span></td>";
?>
  <td><input type="submit" style="float:right;" value="Process"/></td>
</tr>
</table>
</form>
<form action="logout.php" method="GET">
   <br/><br/><br/><br/><br/><br/><br/>
   <center><input type="submit" value="Logout"/></center>
</form>
</body>
</html>
