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

        $oldpass = filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING);
        $newpass = password_hash($_POST['newpassword'],PASSWORD_DEFAULT); 
        $rnewpass = filter_var($_POST['rnewpassword'], FILTER_SANITIZE_STRING);

        if (empty($oldpass) || empty($newpass) || empty($rnewpass)) {
            $err[] = "<span class='form-error'>Please fill in all fields.</span><br>";
        }
        if ((strlen($newpass) < 8 || strlen($rnewpass) < 8) && !empty($oldpass) && !empty($newpass) && !empty($rnewpass)) {
            $err[] = "<span class='form-error'>Password cant be less than 8 letters.</span><br>";
        }
        if (strlen($rnewpass) > 40) {
            $err[] = "<span class='form-error'>Password cant be more than 40 letters.</span><br>";
        }
        if (empty($err)) {
            // select user pass to verify it
            $verifypass = $con->prepare("SELECT user_password FROM users WHERE id = ?");
            $verifypass->execute(array($userid));
            $fetchpass = $verifypass->fetch();

            // if password verify
            if (password_verify($oldpass,$fetchpass['user_password'])) {
                if (password_verify($rnewpass,$newpass)) {
                    $changepass = $con->prepare("UPDATE users SET user_password = ? WHERE id = ?");
                    $changepass->execute(array($newpass,$userid));
                }else {
                    $err[] = "<span class='form-error'>Your new password doesn't match.</span><br>";
                }
            } else {
                $err[] = "<span class='form-error'>Please write your old password true.</span><br>";
            }
            

            // if ($count > 0) {
            //     $err[] = "<span class='form-error'>This Email Is Exist</span><br>";
                
            // } else {
            //     $changeemail = $con->prepare("UPDATE users SET user_email = ? WHERE id = ?");
            //     $changeemail->execute(array($email,$userid));
            // }
        }
        foreach ($err as $error) {
            echo $error;
        }
    }
} else {
    header("location:index");
}

?>