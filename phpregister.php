<?php

session_start();
$pageTitle = "Register";
include 'connection.php';

if (isset($_SESSION['username'])) {
    header('location: messages');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $userpass = password_hash($_POST['password1'],PASSWORD_DEFAULT);
    $repeatpass = $_POST['password2'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $err = array();
    if (empty($username) || empty($userpass) || empty($repeatpass) || empty($email)) {
        $err[] = "<span class='form-error'>Please fill in all fields.</span><br>";
    }
    if (strlen($username) < 8 && !empty($username)) {
        $err[] = "<span class='form-error'>User Name cant be less than 8 letters.</span><br>";
    }
    if (strlen($username) > 30) {
        $err[] = "<span class='form-error'>User Name cant be more than 30 letters.</span><br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
        $err[] =  "<span class='form-error'>Invalid email format !<br>ex: user@example.com</span><br>";
    }
    if (strlen($userpass) < 8 && !empty($userpass)) {
        $err[] = "<span class='form-error'>Password can't be less than 8 letters.</span><br>";
    }
    if (empty($err)) {

        $usernamestmt = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
        $usernamestmt->execute(array($username));
        $usercount = $usernamestmt->rowCount();

        if ($usercount == 1) {

            $err[] = "<span class='form-error'>Sorry This User Is Exist</span><br>";

        } else {
            
            if (password_verify($repeatpass,$userpass)) {

                $insertuserstmt = $con->prepare("INSERT INTO users
                (user_name,user_password,user_email,reg_date)
                VALUES(:zuser,:zpass, :zemail,now()) ");

                $insertuserstmt->execute(array(
                'zuser'     =>  $username,
                'zpass'     =>  $userpass,
                'zemail'    =>  $email,
                ));
            } else {
                $err[] = "<span class='form-error'>Password doesn't match</span><br>";
            }
        }
    }
    foreach ($err as $error){
        echo $error;
    }
}

?>