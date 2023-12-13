<?php

    include '../controller/blog.php';
    include '../model/blogM.php';

    $error = "";

    // create blog
    $blog = null;
    $valid=0;
    $blogs = new blogs();
    // create an instance of the controller
    if (
        isset($_POST["blogid"]) &&
        isset($_POST["postcat"]) &&
        isset($_POST["blogtitle"]) &&
        isset($_POST["descriptionb"])
    ) {
        if (
            !empty($_POST["blogid"]) &&
            !empty($_POST["postcat"]) &&
            !empty($_POST["blogtitle"]) &&
            !empty($_POST["descriptionb"]) 
        ) {
            
                $valid = 1; // Form validation passed
            
        }
         else {
            $error = "Missing information";
        }
    }

    if ($valid == 1) {
        // Form is valid, proceed with adding the user
        $blogM = new blogM(
            $_POST["blogid"],
            $_POST["postcat"],
            $_POST["blogtitle"],
            $_POST["descriptionb"]
        );
        $blogs->addblog($blogM);
        header('Location: listblog.php');
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>

    <div id="blog-section">
        <h2>Welcome to Your Blog Page!</h2>

        <h3>Create a Post</h3>
        <form onsubmit="addPost(); return false;">
            <label for="category">Post category:</label>
            <select id="category" required>
                <option value="technology">Technology</option>
                <option value="AI">AI</option>
                <option value="Culture">Culture</option>
                <!-- Add more categories as needed -->
            </select>
            <br>
           <p id="number"></p>
           <br>
           <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
            <br><label for="description">Description:</label>
            <textarea id="description" required></textarea>
            <br>
            <button type="submit">Post</button>
        </form>

        <h3>Search by Category</h3>
        <select id="searchCategory">
            <option value="all">All Categories</option>
            <option value="technology">Technology</option>
            <option value="AI">AI</option>
            <option value="Culture">Culture</option>
            <!-- Add more categories as needed -->
        </select>
        <button onclick="searchByCategory()">Search</button>

        <h3>Posts</h3>
        <ul id="posts-list"></ul>
    </div>

    <script>
        
        function addPost() {
            
            const category = document.getElementById('category').value;
            const postlike = document.getElementById('postlike').value;
            const description = document.getElementById('description').value;
            const postsList = document.getElementById('posts-list');
            const li = document.createElement('li');
            

            li.textContent = `[${category}] [Likes: ${likes}] - ${description}`;
            postsList.appendChild(li);
        }

        function searchByCategory() {
            const selectedCategory = document.getElementById('searchCategory').value;
            const postsList = document.getElementById('posts-list');
            // Update the posts list based on the selected category
            // You may need to fetch data from the server here
        }
    </script>

</body>
</html>