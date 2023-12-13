<?php
include 'C:\xampp\htdocs\WorkshopProject\Front Office\Controller\User.php';

$User = new Users();

if (isset($_GET["deletePhoneNumber"])) {
    $phoneNumberToDelete = $_GET["deletePhoneNumber"];
    $User->deleteuser($phoneNumberToDelete);
    header('Location:\WorkshopProject\Backoffice\sufee-admin-dashboard-master\tables-data.php');
} else {
    echo "Invalid request. Please provide a user to delete.";
}
?>
