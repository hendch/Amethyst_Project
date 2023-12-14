<?php

require_once '../controller/blog.php'; // Adjust the path if needed
require_once '../model/blogM.php'; // Adjust the path if needed
require_once '../config.php'; // Adjust the path if needed

function displayBlog($blog)
{
    // Add your HTML/CSS formatting to display the blog details
    echo '<h2>' . $blog['blogtitle'] . '</h2>';
    echo '<p>Post Category: ' . $blog['postcat'] . '</p>';
    echo '<p>Description: ' . $blog['descriptionb'] . '</p>';
}

// Assuming you have a blog ID in your URL like showblog.php?id=1
if (isset($_GET['id'])) {
    $blogid = $_GET['id'];

    $blogs = new blogs();
    $blog = $blogs->showblog($blogid);

    if ($blog) {
        displayblog($blog);
    } else {
        echo 'Blog not found';
    }
} else {
    echo 'Invalid blog ID';
}
?>