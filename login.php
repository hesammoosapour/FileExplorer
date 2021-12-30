<?php include_once 'Include/header.php';?>

<?php
session_start(); /* Starts the session */

/* Check Login form submitted */
if(isset($_POST['submit_login_form'])){
    /* Define username  */
    $logins = array('hesam' ,'guest');

    /* Check and assign submitted Username and Password to new variable */
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';

    /* Check Username and Password existence in defined array */
    if (in_array($Username,$logins)){
        /* Success: Set session variables and redirect to Protected page  */
        $_SESSION['Username'] = $Username;

        header("location: upload.php");
        exit;
    } else {
        /*Unsuccessful attempt: Set error message */
        echo $msg="<span style='color:red'>Invalid Login Details</span>";

    }
}
?>
<br><br>
<a href="logout.php">Click here</a> to Logout.

