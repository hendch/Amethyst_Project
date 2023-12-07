<?php
include '../controller/Requestcontroller.php';

$requestcontroller = new requestcontroller();
$requestcontroller->delete_request($_GET['deleteuserid']);
header('location:tables-data.php');
?>