<?php
include '../../Controller/productcontrol.php';

$product = new productC();
$product->deleteproduct($_GET['deleteid']);
header('location: displayproduct.php');
?>
