<?php
session_start();

if (isset($_SESSION['username'])) {

    $pageTitle = 'Manage';
    include 'connection.php';
    include 'includes/functions/functions.php';
    $userid = isLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Change Email user in setting page
        $err = array();

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (empty($email)) {
            $err[] = "<span class='form-error'>Please fill in the field.</span><br>";
        }
        if (strlen($email) < 8 && !empty($email)) {
            $err[] = "<span class='form-error'>Email cant be less than 8 letters.</span><br>";
        }
        if (!empty($email) && !filter_var($email,FILTER_SANITIZE_EMAIL)) {
            $err[] = "<span class='form-error'>Please enter a valid Email.</span><br>";
        }
        if (empty($err)) {
            // if the name is exist in database
            $emailstmt = $con->prepare("SELECT user_email FROM users WHERE user_email = ?");
            $emailstmt->execute(array($email));
            $count = $emailstmt->rowCount();

            if ($count > 0) {
                $err[] = "<span class='form-error'>This Email Is Exist</span><br>";
                
            } else {
                $changeemail = $con->prepare("UPDATE users SET user_email = ? WHERE id = ?");
                $changeemail->execute(array($email,$userid));
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