<?php
include '../controller/categorycontrol.php';

$category = new categoryC();
$category->deletecategory($_GET['deletecatid']);
header('location: displaycategory.php');
?>
