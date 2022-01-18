<?php
session_start();
if (isset($_SESSION['username'])) {

    $pageTitle = 'Messages';
    include 'connection.php';
    include 'includes/functions/functions.php';
    $userid = isLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $err = array();
        
        $img            = $_FILES['image'];
        $imgNewName     = null;                     // To define this var in execute insert stmt

        $imgName        = $_FILES['image']['name'];
        $imgTmpname     = $_FILES['image']['tmp_name'];
        $imgSize        = $_FILES['image']['size'];
        $imgType        = $_FILES['image']['type'];
        $imgExt         = explode('.', $imgName);
        $imgPostExt     = strtolower(end($imgExt));
        $imgAllowedExt  = array('jpg','jpeg','png');

        if (!empty($imgName)) {
            if (in_array($imgPostExt,$imgAllowedExt)) {
                if ($imgSize < 2621440) {
                    $imgNewName     = uniqid("",true).".".$imgPostExt;
                    $imgdestination = "photos/".$imgNewName;
                    move_uploaded_file($imgTmpname,$imgdestination);

                    // INSERT Img 
                    $imgstmt = $con->prepare("UPDATE users SET user_img = ? Where id = ?");
                    $imgstmt->execute(array($imgNewName,$userid));

                } else {
                    $err[] = '<span class="form-error">This File Is too Big</span><br>';
                }
            } else {
                $err[] = '<span class="form-error">You Can Not Upload This Type</span><br>';
            }
        } else {
            $err[] = '<span class="form-error">Please chosse a valid image</span><br>';
        }

        foreach ($err as $error) {
            echo $error;
        }
    }

} else {
    header("location:index");
}