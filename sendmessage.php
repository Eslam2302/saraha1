<?php 
session_start();
if (isset($_SESSION['username'])) {

    $pageTitle = 'Profile';
    include 'connection.php';
    include 'includes/functions/functions.php';
    $userid = isLoggedIn();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING) ;
        $err = array();

        if (empty($message)) {
            $err[] = '<span class="form-error">Please write a valid message.<br></span>';
        }
        if (!filter_var($message, FILTER_SANITIZE_STRING) && !empty($message)) {
            $err[] = '<span class="form-error">Please write a valid message without tags.<br></span>';
        }
        foreach ($err as $error) {
            echo $error;
        }
        if (empty($err)) {
            $guestid    = $_GET['u']; 

            $messagestmt = $con->prepare("INSERT INTO messages VALUES ('', ?, ? , ?,NOW())");
            $messagestmt->execute(array($message,$userid,$guestid));
        }

        


    }

} else {
    header('location:index');
}

?>
