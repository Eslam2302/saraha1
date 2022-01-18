<?php 
session_start();

    $pageTitle = 'Contact';
    include 'connection.php';
    include 'includes/functions/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $err = array();

        $name       = filter_var($_POST['name'], FILTER_SANITIZE_STRING) ;
        $email      = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
        $title      = filter_var($_POST['title'], FILTER_SANITIZE_STRING) ;
        $message    = filter_var($_POST['message'], FILTER_SANITIZE_STRING) ;

        if (empty($name) || empty($email) || empty($title) || empty($message)) {
            $err[] = "<span class='form-error'>Please fill in all fields.</span><br>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            $err[] =  "<span class='form-error'>Invalid email format !<br>ex: user@example.com</span><br>";
        }
        foreach($err as $error) {
            echo $error;
        }

        if (empty($err)) {
            $contactstmt = $con->prepare("INSERT INTO contact_us VALUES ('',?,?,?,?)");
            $contactstmt->execute(array($name,$email,$title,$message));
        }


    }