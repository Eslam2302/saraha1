<?php 

session_start();

include 'init.php';

if (isset($_COOKIE['SNID'])) {
    $stmt2 = $con->prepare("DELETE FROM login_token WHERE token=:token");
    $stmt2->execute(array('token' => sha1($_COOKIE['SNID'])));
}
setcookie("SNID", '1',time()-3600);
setcookie("SNID_", '1',time()-3600);

session_unset();

session_destroy();

header('location: index');

exit();
