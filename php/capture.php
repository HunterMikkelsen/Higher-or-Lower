<?php
  session_start();
?>
<!DOCTYPE html>
<html>

<body>
  <?php
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
  //echo "Connected successfully<br>";
  
  $first = $_POST["FirstName"];
  $last = $_POST["LastName"];
  $Username = $_POST["Username"];
  $Password = $_POST["Password"];
  $Salt = bin2hex(random_bytes(4));
  $Password = $Password . $Salt;
  $hash = hash("Sha512", $Password);
  
  $_SESSION["first"] = $first;
  $_SESSION["last"] = $last;
  $_SESSION["username"] = $Username;

  $sql = "INSERT INTO LoginInfo (UserName, Password, Salt)
          VALUES ('$Username', '$hash', '$Salt')";

    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      $query = mysqli_query($conn, "SELECT PlayerId FROM LoginInfo WHERE UserName = '" . $Username . "'") or die (mysqli_error($conn));

      while($row = mysqli_fetch_array($query)){
        if(count($row['UserId']) < 2){
            $userId = $row['UserId'];
            $sql = "INSERT INTO Players (PlayerId, FirstName, LastName)
              VALUES ('$userId','$first', '$last')";
            header("Location: login.php");
        }
        else{
          echo "invalid";
        }
      }
    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $conn->close();
?>
</body>

</html>