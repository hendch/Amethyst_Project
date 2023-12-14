<?php
include_once __DIR__ . '/../controller/blog.php';

// Include the blog class
include_once __DIR__ . '/../model/blogM.php';

// Initialize variables
$error = "";
$successMessage = "";
$valid = false;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set and not empty
    if (
        isset($_POST["postcat"]) &&
        isset($_POST["blogtitle"]) &&
        isset($_POST["descriptionb"]) &&
        !empty($_POST["postcat"]) &&
        !empty($_POST["blogtitle"]) &&
        !empty($_POST["descriptionb"])
    ) {
        $valid = true; // Form validation passed
    } else {
        $error = "Missing information";
    }

    // If the form is valid, proceed with adding the blog
    if ($valid) {
        // Create an instance of the blog class
        $blog = new blog(
            null, 
            $_POST["postcat"],
            $_POST["blogtitle"],
            $_POST["descriptionb"]
        );

        // Create an instance of the blogs class (controller)
        $blogsController = new blogs();

        // Call the addblog method of the blogs class with the blog instance
        $blogsController->addblog($blog);

        // Set success message
        $successMessage = "Blog added successfully";

        // Clear the form fields
        $_POST["postcat"] = $_POST["blogtitle"] = $_POST["descriptionb"] = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <!-- Add your CSS stylesheets or include them as needed -->
</head>

<body>
    <div id="blog-section">
        <h2>Welcome to Your Blog Page!</h2>

        <!-- Display success message if set -->
        <?php if (!empty($successMessage)) : ?>
            <p style="color: green;"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <!-- Display error message if set -->
        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <h3>Create a Post</h3>
        <form method="post">
            <label for="postcat">Post category:</label>
            <input type="text" id="postcat" name="postcat" value="<?php echo isset($_POST['postcat']) ? htmlspecialchars($_POST['postcat']) : ''; ?>" required>
            <br>
            <label for="blogtitle">Title:</label>
            <input type="text" id="blogtitle" name="blogtitle" value="<?php echo isset($_POST['blogtitle']) ? htmlspecialchars($_POST['blogtitle']) : ''; ?>" required>
            <br>
            <label for="descriptionb">Description:</label>
            <textarea id="descriptionb" name="descriptionb" required><?php echo isset($_POST['descriptionb']) ? htmlspecialchars($_POST['descriptionb']) : ''; ?></textarea>
            <br>
            <button type="submit">Post</button>
        </form>
    </div>

    <!-- Add your JavaScript files or include them as needed -->
</body>

</html>
