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


if ($_SESSION["valid_login"] == false) {
  header("Location: login.php");
}
if (!isset($_SESSION['gameGUID'])) {
  //Set the unique gameId for the session
  $_SESSION['gameGUID'] = uniqid(true);
  $_SESSION["numberGuessed"] = false;
    //generate a random number between 1 and 100
    $_SESSION['minNumber'] = 1;
    $_SESSION['maxNumber'] = 100;
    $_SESSION['randomNumber'] = random_int($_SESSION['minNumber'], $_SESSION['maxNumber']);

    $_SESSION['gameStartTime'] = date("Y-m-d h:i");
  
  
  $_SESSION['playerGuesses'] = array();
}

if (isset($_POST['playerGuess'])) {
  //Process the players previous guess
  $guess = intval($_POST['playerGuess']);
  $message = "";

  //Add players guess to a list of guesses
  array_push($_SESSION['playerGuesses'], $guess);
  //Check if players guess is to high.
  if ($guess > $_SESSION['randomNumber']) {
    $message = "Lower!";
  }
  //Check if the player guess it to low.
  else if ($guess < $_SESSION['randomNumber']) {
    $message = "Higher!";
  }
  
  //Check if the player guessed the correct number.
  else if ($guess === $_SESSION['randomNumber']) {
    $message = "Congratulations! It took you " . count($_SESSION['playerGuesses']) . " guesses.";
    
    $GameGUID = $_SESSION['gameGUID'];
    $RandomNumber = $_SESSION['randomNumber'];
    $GamePlayedTime = $_SESSION['gameStartTime'];
    $PlayerId = $_SESSION['PlayerId'];
    $numGuesses = count($_SESSION['playerGuesses']);
    
    //SQL to insert the finished game into the DB by creating a new game.
    $sql = "INSERT INTO Games (GameGUID, RandomNumber, GamePlayed, PlayerId, NumGuesses)
          VALUES ('$GameGUID', '$RandomNumber', '$GamePlayedTime', '$PlayerId', '$numGuesses')";
    //Execute SQL to create and add a new game.
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //Reset the game.
    $_SESSION["numberGuessed"] = true;
    unset($_SESSION['randomNumber']);
    unset($_SESSION['gameGUID']);
    unset($_SESSION['numGuesses']);
?>
    <style type="text/css">
      #gameFinished {
        display: flex;
      }
    </style>
<?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Higher or Lower</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">

</head>

<html>

<body class="text-center bg-dark text-white">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="game.php">Higher or Lower</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="game.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Signout</a>
          </li>
        </ul>
        <li class="nav-item d-flex flex-row-reverse">
          <a class="nav-link disabled" tabindex="-1" aria-disabled="true"><?php echo strtoupper($_SESSION["Username"]); ?></a>
        </li>
      </div>
    </div>
  </nav>


  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card mx-auto mt-5">
          <h3 class="card-title mx-auto my-3 p-3">Guess a number between <?php echo $_SESSION['minNumber'] . '-' . $_SESSION['maxNumber']; ?></h4>
            <hr>
            <form action="game.php" method="post">
              <div class="row m-3">
                <div class="col-9 my-auto">
                  <div class="form-floating">
                    <input class="form-control" id="playerGuess" name="playerGuess" autocomplete="off" type="number" min="1" max="100" placeholder="1, 2, 3, etc." required />
                    <label for="playerGuess">Guess</label>
                  </div>
                </div>
                <div class="col-3 my-auto">
                  <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                </div>
              </div>
              <p><?php if (isset($message)) {
                    echo $message;
                  } ?></p>
              <div id="gameFinished" style="display: <?php if ($_SESSION["numberGuessed"]) {
                                                        echo "flex";
                                                      } else {
                                                        echo "none";
                                                      } ?>;" class="row m-3 justify-content-md-center">
                <div class="col-3">
                  <a class="btn btn-success" href="https://mikkhun.great-site.net/game.php">Play Again</a>
                </div>
                <div class="col-3">
                  <a class="btn btn-danger" href="https://mikkhun.great-site.net/login.php">Signout</a>
                </div>
              </div>
            </form>
        </div>
      </div>
      <div class="col">
        <div class="card mx-auto mt-5">
          <h3 class="card-title mx-auto my-3 p-3">Leaderboard</h3>
          <hr>
          <table class="table bg-dark text-white">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Guesses</th>
                <th scope="col">Date Played</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                //$conn = new mysqli($servername, $username, $password, $dbname);
                $results = mysqli_query($conn, "SELECT LI.UserName, G.NumGuesses, DATE_FORMAT(G.GamePlayed, '%a %b %Y %H:%i %p') AS GameTime FROM LoginInfo AS LI, Games AS G WHERE LI.PlayerId = G.PlayerId ORDER BY G.NumGuesses ASC LIMIT 10") or die(mysqli_error($conn));
                $rowNumber = 1;
                
                if (mysqli_num_rows($results) > 0) {
                  while ($row = mysqli_fetch_assoc($results)) {
                    echo '<tr>';
                    echo '<td>' . $rowNumber . '</td>';
                    echo '<td>' . $row['UserName'] . '</td>';
                    echo '<td>' . $row['NumGuesses'] . '</td>';
                    echo '<td>' . $row['GameTime'] . '</td>';
                    echo '</tr>\n';
                    $rowNumber = $rowNumber + 1;
                  }
                } else {
                  echo '<tr>';
                  echo '<td>' . "-" . '</td>';
                  echo '<td>' . "None" . '</td>';
                  echo '<td>' . "None" . '</td>';
                  echo '<td>' . "Never" . '</td>';
                  echo '</tr>';
                }
                ?>
              <tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>