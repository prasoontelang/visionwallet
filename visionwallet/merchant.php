<html>
<head>
<title>Merchant page</title>
<style>
  h2 { color:white; }
  #disp
  {
    color:white;
  }
</style>
  <!--script>
    tccode = document.getElementById("tccID");
    function progress()
    {
      var tccode = document.getElementById("tccID");
      if (tccode.value == "")
      {
          alert("TCC Code cannot be empty");
      }
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function()
      {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          res = xmlhttp.responseText;
          if (res == "fail")
          {
             alert("Invalid TCC");
          }
          else
          {
             var bal = document.getElementById("bal");
             bal.value = res;
             tccode.value="";
          }
        }
      }
      xmlhttp.open("POST", "merchantprocess.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-url-encoded");
      xmlhttp.send("tccID=" + tccode.value);
     }
  </script-->
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
     $con = mysqli_connect("localhost","root","PRASOONT","visionwallet");
     if (mysqli_connect_errno($con))
         echo "Failed to connect to MySQL: " . mysqli_connect_error();

     $merch_id = $_SESSION['merchant'];
     $query = "SELECT * FROM merchantinfo WHERE userid=$merch_id;";
     $result = mysqli_query($con, $query);
     $row = mysqli_fetch_array($result);
     $merch_name = $row['merchantname'];
     echo"<h2>Welcome $merch_name</h2>";
  }
?>
  <form action="merchantprocess.php" method="POST">
  <table border="0">
      <tr>
        <td colspan="2"><input type="text" id="tccID" name="tccID" placeholder="Enter TCC" style="font-size:25px;"/></td>
      </tr>
      <tr>
  <!--Enter TCC: <input type="text" id="tccID" name="tccID"/><button type="button" onclick="progress()">Confirm TCC!</button><br/-->
        <?php
          $merch_bal = $row['balance'];
          echo "<td><span id=\"disp\">Available amount: Rs. $merch_bal</span></td>";
        ?>
        <td><input type="submit" style="float:right;" value="Confirm"/></td>
      </tr>
    </table>
  </form>
  <form action="logout.php" method="POST">
      <br/><br/><br/><br/><br/>
      <center><input type="submit" value="Logout"/></center>
  </form>
</body>
</html>
