<?php
include '../controller/blog.php';
$blogs = new blogs();
$blogs->deleteblog($_GET["deleteid"]);
header('Location:listblog.php');
