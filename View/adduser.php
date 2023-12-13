<?php

include 'C:\xampp\htdocs\WorkshopProject\Front Office\Controller\User.php';
include 'C:\xampp\htdocs\WorkshopProject\Front Office\Model\userm.php';

$error = "";

//create client
$User = null;
$valid = 0;
$Users = new Users();

if (
    isset($_POST["Fname"]) &&
    isset($_POST["Lname"]) &&
    isset($_POST["phone"]) &&
    isset($_POST["email"]) &&
    isset($_POST["username"])
) {
    if (
        !empty($_POST["Fname"]) &&
        !empty($_POST["Lname"]) &&
        !empty($_POST["phone"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["username"])
    ) {
        /* $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $namePattern = '/^[A-Za-z]+$/';

        if (!preg_match($emailPattern, $_POST["email"])) {
            $error = 'Invalid email format';
        } elseif (!preg_match($namePattern, $_POST["Fname"]) || !preg_match($namePattern, $_POST["Lname"])) {
            $error = 'Invalid name format';
        } elseif (!preg_match($namePattern, $_POST["Lname"]) || !preg_match($namePattern, $_POST["Lname"])) {
            $error = 'Invalid Last name format';
        } else {
            $valid = 1; // Form validation passed
        } 
        $valid=1;
    } else {
        $error = "Missing information";*/
        $valid=1;
    }
}

if ($valid == 1) {
    // Form is valid, proceed with adding the user
    $User = new User(
        $_POST["Fname"],
        $_POST["Lname"],
        $_POST["phone"],
        $_POST["email"],
        $_POST["username"] 
    );
    $Users->adduser($User);
    //header('Location: listuser.php');
    exit;
}
?>
