<?php
  session_start();
 
  // remove all session variables
  session_unset();
  
  // destroy the session
  session_destroy();
  
?>
<!DOCTYPE html>
<html>
<body>
<p>Session variables reset</p>
<a href="testsession.php">Go back to testsession.php</a>
</body>
</html>