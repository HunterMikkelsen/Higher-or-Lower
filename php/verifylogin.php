<?php
  session_start();

  $Username = $_POST["Username"];
  $Password = $_POST["Password"];

  $servername = "sql112.epizy.com";
  $username = "epiz_30792688";
  $password = "fbui2g8VBo";
  $dbname = "epiz_30792688_GameDB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
    echo "Connected successfully<br>";
  }
  $_SESSION["valid_login"] = false;
  $result = mysqli_query($conn, "SELECT Password, Salt, PlayerId FROM LoginInfo WHERE Username = '$Username'") or die (mysqli_error($conn));
  if($result->num_rows > 0){
    $dbUserPasswordHash = "";
    $dbUserSalt = "";
    while ($row = mysqli_fetch_row($result)){
      $dbUserPasswordHash = $row[0];
      $dbUserSalt = $row[1];
      $dbPlayerId = $row[2];
    }
    $userPassword = $Password . $dbUserSalt;
    $userPassword = hash("sha512", $userPassword);
    echo "user password: " . $userPassword . "<br>";
    echo "db password: " . $dbUserPasswordHash;
    if(strcmp($userPassword, $dbUserPasswordhash) !== 0){
      $_SESSION["Username"] = $Username;
      $_SESSION["PlayerId"] = $dbPlayerId;
      $_SESSION["valid_login"] = true;
      header("Location: game.php");
    }
    else{
      echo "<p>Username or password is incorrect</p>";
      echo '<a href="login.php">Return to sign in</a>';
    }

  }
  else{
    echo "<p>Username not found</p>";
    echo '<a href="login.php"> Return to sign in</a>';
  }
  $conn->close();
?>