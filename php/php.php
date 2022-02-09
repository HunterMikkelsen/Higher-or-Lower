<?php
// Start a session
session_start();

$Username = $_POST["Username"];
  $Password = $_POST["Password"];

  $servername = "sql112.epizy.com";
  $username = "epiz_30792688";
  $password = "fbui2g8VBo";
  $dbname = "epiz_30792688_GameDB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
?>
<!DOCTYPE html>
<html>
<body>
  <form action="capture.php" method="post">
  <p>First: <input type="text" name="FirstName"/></p>
  <p>Last: <input type="text" name="LastName"/></p>
  
  <input type="submit" value="Submit"/>
  </form>
  
</body>
</html>