<?php
include '../controller/blog.php';
include '../model/blogM.php'; // Update the model name to match the class name
$error = "";
$blogs = new blogs(); // Assuming this is correctly named as per your actual controller class

if (isset($_GET['updateid'])) {
    $blogid = $_GET['updateid'];
    $blogM = $blogs->showblog($blogid);

    if ($blogM) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = 1;

            if (
                !empty($_POST["blogtitle"]) &&
                !empty($_POST["postcat"]) &&
                !empty($_POST["descriptionb"])
                // Add any additional validation here...
            ) {
                // Your validation logic here...

                // Sanitize user inputs
                $blogtitle = htmlspecialchars($_POST["blogtitle"]);
                $postcat = htmlspecialchars($_POST["postcat"]);
                $descriptionb = htmlspecialchars($_POST["descriptionb"]);
                // Sanitize other inputs...

                if ($valid == 1) {
                    $blogToUpdate = new blog(
                        $blogM->getblogid(),
                        $postcat,
                        $blogtitle,
                        $descriptionb
                    );

                    $blogs->updateblog($blogToUpdate, $blogid);
                    header('Location: listblog.php');
                    exit;
                }
            } else {
                $error = "Missing information";
            }
        }
    } else {
        echo "Blog not found.";
    }
} else {
    echo "Invalid request. Please provide a blog to update.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog</title>
</head>

<body>
    <h2>Update Blog Information</h2>
    <?php
    if (isset($blogM)) {
    ?>
        <form method="POST">
            <!-- Blog Title Input -->
            <label for="blogtitle">Blog Title:</label>
            <input type="text" id="blogtitle" name="blogtitle" value="<?php echo $blogM->getblogtitle(); ?>"><br>

            <!-- Category Input -->
            <label for="postcat">Blog Category:</label>
            <input type="text" id="postcat" name="postcat" value="<?php echo $blogM->getpostcat(); ?>"><br>

            <!-- Description Input -->
            <label for="descriptionb">Description:</label>
            <input type="text" id="descriptionb" name="descriptionb" value="<?php echo $blogM->getdescriptionb(); ?>"><br>

            <!-- Add other inputs as needed -->

            <input type="submit" value="Update Blog">
        </form>
    <?php
    } else {
        echo "Blog not found.";
    }
    ?>
</body>

</html