<?php
include '../controller/blog.php';

// Check if 'deleteid' is set in the URL
if (isset($_GET['deleteid'])) {
    $blogid = $_GET['deleteid'];

    // create an instance of the controller
    $blogs = new blogs();

    // Perform the delete operation
    $blogs->deleteblog($blogid);

    // Redirect to the blog list page after deletion
    header('Location: listblog.php');
    exit;
} else {
    // Handle case where 'deleteid' is not set in the URL
    echo "Invalid request";
}
?>

