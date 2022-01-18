<?php

session_start();
$pageTitle = "Login";
include 'connection.php';

if (isset($_SESSION['username'])) {
    header('location: messages');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $username  =   filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $userpass  =   filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $err = array();
    


    if (empty($username) || empty($userpass)) {
        $err[] = "<span class='form-error'>Please fill in all fields</span>";
    } else {

        // Check if user exist in Data Base and password verifyed  

        $usernamestmt = $con->prepare("SELECT user_name , id FROM users WHERE user_name = ?");
        $usernamestmt->execute(array($username));
        $fetchusername = $usernamestmt->fetch();
        $usercount = $usernamestmt->rowCount();

        if ($usercount > 0) {

            $userpasswordstmt = $con->prepare("SELECT user_password FROM users WHERE user_name=?");
            $userpasswordstmt->execute(array($username));
            $fetchuserpassword = $userpasswordstmt->fetch();
            if (password_verify($userpass,$fetchuserpassword['user_password'])) {

                // Set Login Cookie for 7 Days

                $userid =  $fetchusername['id'];
                $token = bin2hex(random_bytes(64));
                $inserttokenstmt = $con->prepare("INSERT INTO login_token VALUES ('', :token, :user_id)");
                $inserttokenstmt->execute(array(
                    'token' => sha1($token),
                    'user_id' => $userid
                ));
                setcookie("SNID", $token,time() + 60 * 60 * 24 * 7, '/', NULL , NULL , TRUE);
                setcookie("SNID_", '1',time() + 60 * 60 * 24 * 3, '/', NULL , NULL , TRUE);
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $fetchusername['id'];
                exit();

            } else {
                $err[] = "<span class='form-error'>False password</span>";
            }

        } else {
            $err[] = "<span class='form-error'>Sorry This user isn't registerd</span>";
        }
    }

    foreach ($err as $error) {
        echo  $error;
    }

}

include 'includes/templates/footer.php';
 
?>
