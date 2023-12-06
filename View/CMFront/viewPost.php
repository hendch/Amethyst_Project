<?php
session_start(); // Make sure to start the session

include '../../Controller/PostController.php';

$post_id = $_GET['post_id'];

$postController = new PostController();
$post = $postController->getPostById($post_id);

// Check if the user is logged in 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or take appropriate action
    header('Location: login.php');
    exit();
}

// Process form submission for adding a comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is for adding a comment
    if (isset($_POST['comment_text'])) {
        $user_id = $_SESSION['user_id'];
        $comment_text = $_POST['comment_text'];
        $created_at = date('Y-m-d H:i:s');

        // Make sure $post_id is set
        $post_id = $_GET['post_id'];

        // Create the Comment object
        $comment = new Comment($user_id, $_SESSION['username'], $post_id, $comment_text, $created_at);

        // Add the comment using the PostController
        $postController->addComment($comment);

        // Redirect to the same page to avoid form resubmission
        header("Location: viewPost.php?post_id=$post_id");
        exit();
    }

    // Check if the form is for adding a reply
   // Process form submission for adding a reply
if (isset($_POST['reply_text'], $_POST['comment_id'])) {
    $user_id = $_SESSION['user_id'];
    $reply_text = $_POST['reply_text'];
    $created_at = date('Y-m-d H:i:s');
    
    // Ensure $comment_id is an integer
    $comment_id = (int)$_POST['comment_id'];

    // Create the Reply object
    $reply = new Reply($user_id, $comment_id, $_SESSION['username'], $reply_text, $created_at);

    // Add the reply using the PostController
    $postController->addReply($reply);

    // Redirect to the same page to avoid form resubmission
    header("Location: viewPost.php?post_id=$post_id");
    exit();
}

}

$comments = $postController->getComments($post_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <style>
        .comment-container {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comment-header {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .comment-text {
            margin-bottom: 10px;
        }

        .reply-container {
            margin-left: 20px;
        }

        .reply-button {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            margin-top: 5px;
        }

        .reply-form {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1><?php echo $post['title']; ?></h1>
<p>User: <?php echo $post['username']; ?></p>
<p>Time: <?php echo $postController->timeAgo($post['created_at']); ?></p>
<p><?php echo $post['content']; ?></p>

<h2>Comments</h2>
<!-- Inside the loop for displaying comments -->
<!-- Inside the loop for displaying comments -->
<!-- Inside the loop for displaying comments -->
<?php foreach ($comments as $comment) : ?>
    <div class="comment-container">
        <?php if (isset($comment['username'], $comment['created_at'], $comment['comment_text'])) : ?>
            <p class="comment-header">
                <span>User: <?php echo $comment['username']; ?></span>
                <span>Time: <?php echo $postController->timeAgo($comment['created_at']); ?></span>
            </p>
            <p class="comment-text"><?php echo $comment['comment_text']; ?></p>
        <?php endif; ?>

        <!-- Reply Button -->
        <div class="reply-button" onclick="toggleReply('<?php echo $comment['comment_id']; ?>')">Reply</div>

        <!-- Reply Container -->
        <!-- Reply Container -->
<div id="replyContainer_<?php echo $comment['comment_id']; ?>" class="reply-container">
    <form id="commentForm" action="viewPost.php?post_id=<?php echo $post_id; ?>" method="post" class="reply-form">
        <label for="reply_text">Add Reply:</label>
        <textarea id="reply_text" name="reply_text" required></textarea>
        <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
        <br>
        <input type="submit" value="Add Reply">
    </form>

    <!-- Display Replies with Indentation -->
    <?php $replies = $postController->getReplies($comment['comment_id']); ?>
    <?php if (!empty($replies)) : ?>
        <?php foreach ($replies as $reply) : ?>
            <div class="reply-container" style="margin-left: 20px;">
                <?php if (isset($reply['username'], $reply['created_at'], $reply['reply_text'])) : ?>
                    <p class="comment-header">
                        <span>User: <?php echo $reply['username']; ?></span>
                        <span>Time: <?php echo $postController->timeAgo($reply['created_at']); ?></span>
                    </p>
                    <p class="comment-text"><?php echo $reply['reply_text']; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
    </div>
<?php endforeach; ?>




<!-- Form to add a new comment -->
<form id="commentForm" action="viewPost.php?post_id=<?php echo $post_id; ?>" method="post">
    <label for="comment_text">Add Comment:</label>
    <textarea id="comment_text" name="comment_text" required></textarea>
    <br>
    <input type="submit" value="Add Comment">
</form>

<script>
    function toggleReply(commentId) {
        var replyForm = document.querySelector('#replyContainer_' + commentId + ' .reply-form');
        replyForm.style.display = (replyForm.style.display === 'block') ? 'none' : 'block';
    }
</script>
<script>
    function validateComment() {
        var commentText = document.getElementById('comment_text').value.toLowerCase(); // Get the comment text and convert to lowercase

        // Array of bad words to check
        var badWords = ['badword1', 'badword2', 'badword3'];

        // Check if any bad words are present in the comment text
        var containsBadWord = badWords.some(function (word) {
            return commentText.includes(word);
        });

        // If a bad word is found, display an alert and prevent form submission
        if (containsBadWord) {
            alert('Please avoid using inappropriate language.');
            return false; // Returning false will prevent the form from being submitted
        }

        // If no bad words are found, allow form submission
        return true;
    }

    // Attach the function to the form's onsubmit event
    document.getElementById('commentForm').onsubmit = validateComment;
</script>



</body>
</html>
