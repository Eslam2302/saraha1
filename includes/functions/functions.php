<?php 

// Get Tilte Name

function getTilte() {

    global $pageTitle;

    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }

}

// Login Token Function

function isLoggedIn(){
        
    global $con;

    if (isset($_COOKIE['SNID'])) {

        $stmt3 = $con->prepare("SELECT user_id FROM login_token WHERE token=:token");
        $stmt3->execute(array('token' => sha1($_COOKIE['SNID'])));
        $row3 = $stmt3->fetch();
        $user_id = $row3['user_id'];

        if (isset($_COOKIE['SNID_'])) {
            return $user_id;
        } else {
            $token = bin2hex(random_bytes(64));
            $stmt1 = $con->prepare("INSERT INTO login_token VALUES ('', :token, :user_id)");
            $stmt1->execute(array(
                'token' => sha1($token),
                'user_id' => $user_id
            ));
            $stmt2 = $con->prepare("DELETE FROM login_token WHERE token=:token");
            $stmt2->execute(array('token' => sha1($_COOKIE['SNID_'])));

            setcookie("SNID", $token,time() + 60 * 60 * 24 * 7, '/', NULL , NULL , TRUE);
            setcookie("SNID_", '1',time() + 60 * 60 * 24 * 3, '/', NULL , NULL , TRUE);

            return $user_id;
        }

    }
}