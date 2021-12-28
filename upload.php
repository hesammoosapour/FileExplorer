
<?php
session_start(); /* Starts the session */

echo "Welcome " . $_SESSION['Username'] . " To Your Panel";

?>
<br><br>
<a href="logout.php">Click here</a> to Logout.

