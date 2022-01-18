<?php
session_start();

if (isset($_SESSION['username'])) {

    $pageTitle = 'Manage';
    include 'connection.php';
    include 'includes/functions/functions.php';
    $userid = isLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Change Name user in setting page
        $err = array();

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

        if (empty($name)) {
            $err[] = "<span class='form-error'>Please fill in the field.</span><br>";
        }
        if (strlen($name) < 8 && !empty($name)) {
            $err[] = "<span class='form-error'>User Name cant be less than 8 letters.</span><br>";
        }
        if (strlen($name) > 30) {
            $err[] = "<span class='form-error'>User Name cant be more than 30 letters.</span><br>";
        }

        if (empty($err)) {
            // if the name is exist in database
            $namestmt = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
            $namestmt->execute(array($name));
            $count = $namestmt->rowCount();

            if ($count > 0) {
                $err[] = "<span class='form-error'>This User Is Exist</span><br>";
                
            } else {
                $changename = $con->prepare("UPDATE users SET user_name = ? WHERE id = ?");
                $changename->execute(array($name,$userid));
            }
        }
        foreach ($err as $error) {
            echo $error;
        }
    }
} else {
    header("location:index");
}

?>