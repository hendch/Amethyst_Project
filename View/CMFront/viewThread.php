<?php
session_start(); // Make sure to start the session
include '../../Controller/ThreadController.php';
include '../../Controller/PostController.php';


$thread_id = $_GET['thread_id'];
$threadController = new ThreadController();
$postController = new PostController();
$thread = $threadController->getThreadById($thread_id);
// Check if the user is logged in (adjust as needed)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or take appropriate action
    header('Location: login.php');
    exit();
}
// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content']) && isset($_POST['title'])) {
    // Assuming you have a valid user_id and thread_id from the session and URL
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = date('Y-m-d H:i:s');

    // Create the Post object
    $post = new Post($user_id, $thread_id, $title, $content, $created_at);

    // Add the post using the PostController
    $postController->addPost($post);

    // Redirect to the same page to avoid form resubmission
    header("Location: viewThread.php?thread_id=$thread_id");
    exit();
}
$posts = $threadController->getPosts($thread_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Thread</title>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 40%;
            margin-bottom: 10px;
            padding: 10px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 2px 16px;
        }

        .add-post-form {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <!-- Add Post Form -->
    <div class="add-post-form">
        <h2>Create a New Post</h2>
        <form action="viewThread.php?thread_id=<?php echo $thread_id; ?>" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <br>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required autocomplete="off"></textarea>
            <br>
            <input type="submit" value="Add Post">
        </form>
    </div>
    <h1>
        <?php echo $thread->getTitle(); ?>
    </h1>
    <p>Uploader:
        <?php echo $thread->getUsername(); ?>
    </p>
    <p>Time:
        <?php echo $threadController->timeAgo($thread->getCreatedAt()); ?>
    </p>
    <!-- Inside the loop where you display posts -->
    <!-- viewThread.php -->
    <!-- Inside the loop where you display posts -->
    <?php foreach ($posts as $post): ?>
        <a href="viewPost.php?post_id=<?php echo $post['post_id']; ?>">
            <div class="card">
                <div class="container">
                    <h3>
                        <?php echo $post['title']; ?>
                    </h3>
                    <p>
                        <span>User:
                            <?php echo $post['username']; ?>
                        </span>
                        <span>/Time:
                            <?php echo $threadController->timeAgo($post['created_at']); ?>
                        </span>
                        <span>/Comment:
                            <?php echo $postController->getCommentCountByPost($post['post_id']); ?>
                        </span>
                    </p>
                    <p>
                        <?php echo $post['content']; ?>
                    </p>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</body>

</html>