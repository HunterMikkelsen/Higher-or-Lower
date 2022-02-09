<?php
  session_start();
?>

<!DOCTYPE html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">
  <title>Sign up</title>
</head>
<html>
<html>

<body class="text-center bg-dark text-white">
  <div class="card col-md-4 mx-auto mt-3 p-3 shadow-sm p-3 mb-5 bg-body rounded">
    <div class="signup-form">
      <h2>Sign up</h2>
      <p>Fill out the form below to create an account!</p>
      <hr>
      <form action="capture.php" method="post">
        <div class="container">
          <div class="form-group">
            <div class="row">
              <div class="col">
                <input class="form-control mx-auto rounded" autocomplete="off" type="text" name="Username" placeholder="Username"
                  required="required" />
              </div>
              <div class="col">
                <input class="form-control col-xs-2 mx-auto rounded" autocomplete="off" type="password" name="Password"
                  placeholder="Password" required="required" />
              </div>
            </div>
          </div>
          <!--
          <div class="form-group">
            <input class="form-control mx-auto rounded" type="text" name="FirstName" placeholder="First Name"
              required="required" />
          </div>
          <div class="form-group">
            <input class="form-control col-xs-2 mx-auto rounded" type="text" name="LastName" placeholder="Last Name"
              required="required" />
          </div>-->
          <div class="form-group">
            <div class="row">
              <div class="col">
                <input class="btn btn-primary mx-4 mt-2 col-4" type="submit" value="Submit" />
              </div>
            </div>
          </div> 
        </div>
      </form>
      <div class="text-center">
      Already have an account?
      <a href="login.php">Sign in</a>
      </div>
    </div>
  </div>
</body>

</html>