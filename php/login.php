<?php
  session_start();
  // remove all session variables
  session_unset();
  // destroy the session
  session_destroy();
?>

<!DOCTYPE html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">
  <title>Login</title>
</head>
<html>

<body class="text-center bg-dark text-white">
  <h1 class="card-title mx-auto my-3 p-3">Higher Or Lower</h1>
  <div class="card col-md-4 mx-auto mt-3 shadow-sm mb-5 bg-body rounded">
    <div class="form-group">
      <form action="verifylogin.php" method="post">
        <div class="form-group">
          <input class="form-control mx-auto rounded w-50" autocomplete="off" type="text" name="Username" placeholder="Username"
            required="required" />
        </div>
        <div class="form-group">
          <input class="form-control col-xs-2 mx-auto rounded w-50" autocomplete="off" type="password" name="Password" placeholder="Password"
            required="required" />
        </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col">
        <input class="btn btn-primary mx-4 mt-2" style="width: 150px;" type="submit" value="Submit" />
      </div>
    </div>
    </form>
    <div class="text-center p-2">
      Need an account?
      <a href="signup.php">Sign up</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
  </script>

<!--TODO: Handle User verification in login page
 TODO: Have a popup telling the user what went wrong
 TODO: Add a progress bar for logging in (style).
 TODO: Setup a nav bar sitewide

</body>

</html>