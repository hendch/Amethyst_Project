<?php
session_start();
include '../../Controller/postController.php';

$post_id = $_GET['post_id'];

$postController = new PostController();
$post = $postController->getPostById($post_id);

// Check if the user is logged in (adjust as needed)
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
    header("Location: details.php?post_id=$post_id");
    exit();
  }

  // Check if the form is for adding a reply
  // Process form submission for adding a reply
  if (isset($_POST['reply_text'], $_POST['comment_id'])) {
    $user_id = $_SESSION['user_id'];
    $reply_text = $_POST['reply_text'];
    $created_at = date('Y-m-d H:i:s');

    // Ensure $comment_id is an integer
    $comment_id = (int) $_POST['comment_id'];

    // Create the Reply object
    $reply = new Reply($user_id, $comment_id, $_SESSION['username'], $reply_text, $created_at);

    // Add the reply using the PostController
    $postController->addReply($reply);

    // Redirect to the same page to avoid form resubmission
    header("Location: details.php?post_id=$post_id");
    exit();
  }

}

$comments = $postController->getComments($post_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="templatemo">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet">
  <title>Liberty Template - NFT Item Detail Page</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <style>
    .custom-container {
      background-color: rgba(0, 0, 0, 0.7);
      /* Black with 70% opacity */
      padding: 50px;
      border-radius: 10px;
      color: white;
      margin-bottom: 15px;
      /* Text color inside the container */
    }

    hr {
      margin-top: 20px;
      margin-bottom: 20px;
      border: 0;
      border-top: 1px solid #FFFFFF;
    }
    #comment_text {
      background-color: white;
    border-color: black;
    width: 100%;
    margin: 5px;
    border-radius: 5px;

  }

    a {
      color: #7453fc;
      text-decoration: none;
    }

    .blog-comment::before,
    .blog-comment::after,
    .blog-comment-form::before,
    .blog-comment-form::after {
      content: "";
      display: table;
      clear: both;
    }

    .blog-comment {

      padding-left: 15%;
      padding-right: 15%;
    }

    .post-comment {}

    .blog-comment ul {
      list-style-type: none;
      padding: 0;
    }

    .reply-button {
      position: absolute;
      bottom: 0;
      right: 0;
      margin: 8px;
      /* Adjust the margin as needed */
    }

    .show-replies-button {
      position: absolute;
      bottom: 0;
      right: 0;
      margin: 8px;
      /* Adjust the margin as needed */
    }

    .reply-button a {
      color: #7453fc;
      text-decoration: none;
    }


    .blog-comment img {
      opacity: 1;
      filter: Alpha(opacity=100);
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      -o-border-radius: 4px;
      border-radius: 4px;
    }

    .blog-comment img.avatar {
      position: relative;
      float: left;
      margin-left: 0;
      margin-top: 0;
      width: 65px;
      height: 65px;
    }

    .blog-comment .post-comments {
      border: 0px solid #eee;
      margin-bottom: 20px;
      margin-left: 85px;
      margin-right: 0px;
      padding: 10px 20px;
      width: 600px;
      position: relative;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      -o-border-radius: 4px;
      border-radius: 4px;
      background: rgba(0, 0, 0, 0.7);
      color: #6b6e80;
      position: relative;
    }

    .blog-comment .meta {
      font-size: 13px;
      color: #aaaaaa;
      padding-bottom: 8px;
      margin-bottom: 10px !important;
      border-bottom: 1px solid #eee;
    }


    .blog-comment ul.comments ul {
      list-style-type: none;
      padding: 0;
      margin-left: 85px;
    }

    .blog-comment-form {
      padding-left: 15%;
      padding-right: 15%;
      padding-top: 40px;
    }

    .blog-comment h3,
    .blog-comment-form h3 {
      margin-bottom: 40px;
      font-size: 26px;
      line-height: 30px;
      font-weight: 800;
    }
  </style>
</head>

<body>
  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->
  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="../assets/images/logo.png" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.html">Home</a></li>
              <li><a href="explore.php">Explore</a></li>
              <li><a href="details.html" class="active">Item Details</a></li>
              <li><a href="author.html">Author</a></li>
              <li><a href="create.html">Create Yours</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  <div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Thread</h6>
          <h2>View Thread Details</h2>
          <span>Home > <a href="#">Thread Details</a></span>
          <div class="buttons">
            <div class="main-button">
              <a href="explore.php">Explore Our Threads</a>
            </div>
            <div class="border-button">
              <a href="create.php">Create Your Thread</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="item-details-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>View Details <em>For Item</em> Here.</h2>
          </div>
        </div>

        <div class="col-lg-12 align-self-center">
          <div class="custom-container">
            <h2>
              <?php echo $post['title']; ?>
            </h2>
             <br><strong>
                    <?php echo $postController->timeAgo($post['created_at']); ?>
            <br>
            <span class="author">
              <img src="../assets/images/author-02.jpg" alt="" style="max-width: 50px; border-radius: 50%;">
              <h5><a href="#">
                  <?php echo $post['username']; ?>
                </a></h5>
            </span>
            <p>
              <?php echo $post['content']; ?>
            </p>
            <div class="row">
              <div class="col-3">
                <span class="bid">
                  <br><strong>
                    <?php echo $postController->timeAgo($post['created_at']); ?>
                </span>
              </div>
            </div>

            <!-- Move the form here so that it's inside the custom-container -->
            <form id="commentForm" action="details.php?post_id=<?php echo $post_id; ?>" method="post">
              <div class="row">
                <div class="col-lg-12">
                  <fieldset>
                    <label for="comment_text">add comment</label>
                    <input class="form-control" type="comment_text" name="comment_text" id="comment_text"
                      placeholder="write your comment here" style=""autocomplete="on" required>
                  </fieldset>
                </div>
              </div>

              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" name="Add COmment" class="orange-button">comment</button>
                </fieldset>
              </div>
            </form>

          </div>
        </div>


      </div>

    </div>

  </div>



  <div class="create-nft">
    <div class="container bootstrap snippets bootdey">
      <div class="row">
        <div class="col-md-12">
          <div class="blog-comment">
            <h3 class="">Comments</h3>
            <hr />
            <?php foreach ($comments as $comment): ?>
              <?php if (isset($comment['username'], $comment['created_at'], $comment['comment_text'])): ?>
                <?php $replies = $postController->getReplies($comment['comment_id']); ?>
                <!-- Main Comments Section -->
                <ul class="comments">
                  <li class="clearfix">
                    <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
                    <div class="post-comments">
                      <p class="meta">
                        <a href="#">
                          <?php echo $comment['username']; ?>
                        </a> <span style="float: right;">
                          <?php echo $postController->timeAgo($comment['created_at']); ?>
                        </span>
                      </p>
                      <p>
                        <?php echo $comment['comment_text']; ?>
                      </p>

                      <!-- "Reply" button and input field -->
                      <div class="reply-section">
                        <div class="reply-button">
                          <a href="javascript:void(0)" onclick="toggleReplyInput(this)"><small>Reply</small></a>
                        </div>
                        <div class="reply-form-container" style="display: none;">
                          <form class="reply-form" method="post" action="details.php?post_id=<?php echo $post_id; ?>">
                            <div class="form-group">
                              <textarea class="form-control" name="reply_text" placeholder="Type your reply..." rows="1"
                                style="resize: none;"></textarea>
                            </div>
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <button type="submit" class="btn btn-success rounded-pill mt-2"
                              style="background-color: #7453fc;">Submit</button>
                          </form>
                        </div>
                      </div>

                      <!-- "Show Replies" button -->
                      <?php if (count($replies) > 0): ?>
                        <div class="show-reply-button">
                          <a href="javascript:void(0)" onclick="toggleReplies(this)"><small>Show Replies</small></a>
                        </div>
                      <?php endif; ?>

                    </div>

                    <!-- Replies container -->
                    <ul class="replies" style="display: none;">
                      <?php foreach ($replies as $index => $reply): ?>
                        <?php if (isset($reply['username'], $reply['created_at'], $reply['reply_text'])): ?>
                          <li class="clearfix reply-item">
                            <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
                            <div class="post-comments">
                              <p class="meta">
                                <a href="#">
                                  <?php echo $reply['username']; ?>
                                </a><span style="float: right;">
                                  <?php echo $postController->timeAgo($reply['created_at']); ?>
                                </span>
                              </p>
                              <p>
                                <?php echo $reply['reply_text']; ?>
                              </p>
                            </div>
                          </li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                </ul>

              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- display reply field -->
    <script>
      function toggleReplyInput(button) {
        const replyFormContainer = button.closest('.reply-section').querySelector('.reply-form-container');
        replyFormContainer.style.display = replyFormContainer.style.display === 'none' ? 'block' : 'none';
      }


      function submitReply(button) {
        const input = button.closest('.reply-input').querySelector('input');
        const replyText = input.value.trim();
        if (replyText !== '') {
          // Add your logic to submit the reply (e.g., using AJAX)
          console.log('Reply submitted:', replyText);
          input.value = ''; // Clear the input field
        }
      }

      function toggleReplies(button) {
        const repliesContainer = button.closest('.comments').querySelector('.replies');
        repliesContainer.style.display = repliesContainer.style.display === 'none' ? 'block' : 'none';
      }
    </script>


    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Create Your NFT & Put It On The Market.</h2>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="main-button">
            <a href="create.html">Create Your NFT Now</a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="item first-item">
            <div class="number">
              <h6>1</h6>
            </div>
            <div class="icon">
              <img src="../assets/images/icon-02.png" alt="">
            </div>
            <h4>Set Up Your Wallet</h4>
            <p>There are 5 different HTML pages included in this NFT <a href="https://templatemo.com/page/1"
                target="_blank" rel="nofollow">website template</a>. You can edit or modify any section on any page as
              you required.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="item second-item">
            <div class="number">
              <h6>2</h6>
            </div>
            <div class="icon">
              <img src="../assets/images/icon-04.png" alt="">
            </div>
            <h4>Add Your Digital NFT</h4>
            <p>If you would like to support our TemplateMo website, please visit <a rel="nofollow"
                href="https://templatemo.com/contact" target="_parent">our contact page</a> to make a PayPal
              contribution. Thank you.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="item">
            <div class="icon">
              <img src="../assets/images/icon-06.png" alt="">
            </div>
            <h4>Sell Your NFT &amp; Make Profit</h4>
            <p>NFT means Non-Fungible Token that are used in digital cryptocurrency markets. There are many different
              kinds of NFTs in the industry.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2022 <a href="#">Liberty</a> NFT Marketplace Co., Ltd. All rights reserved. &nbsp;&nbsp;
            Designed by <a title="HTML CSS Templates" rel="sponsored" href="https://templatemo.com"
              target="_blank">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->

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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>