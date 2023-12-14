<?php
session_start();
include '../../Controller/ThreadController.php';
include '../../Controller/postController.php';
include_once '../../Model/threadModel.php';

$thread_id = $_GET['thread_id'];
$threadController = new ThreadController();
$postController = new PostController();
$thread = $threadController->getThreadById($thread_id);

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content']) && isset($_POST['title'])) {
  $user_id = $_SESSION['user_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $created_at = date('Y-m-d H:i:s');


  $post = new Post($user_id, $thread_id, $title, $content, $created_at);
  $postController->addPost($post);

  header("Location: create.php?thread_id=$thread_id");
  exit();
}

$posts = $threadController->getPosts($thread_id);


$filterDate = isset($_GET['filterDate']) ? $_GET['filterDate'] : '';

if (!empty($filterDate)) {
  $posts = $postController->getPostsByDate($thread_id, $filterDate);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="author" content="templatemo">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet">

  <title>Liberty Template - Create NFT Page</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <!--

TemplateMo 577 Liberty Market

https://templatemo.com/tm-577-liberty-market

-->
  <!--Calendar-->
  <!-- Your existing jQuery and jQuery UI inclusion -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- Existing script for datepicker -->
  <!-- Updated script for datepicker -->
  <script>
    $(function () {
      $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText, inst) {
          window.location.href = 'create.php?thread_id=<?php echo $thread_id; ?>&filterDate=' + dateText;
        },
        beforeShowDay: function (date) {
          var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
          return [datesWithPosts.indexOf(formattedDate) !== -1, ""];
        }
      });

      // Highlight dates with posts
      <?php
      $datesWithPosts = $postController->getDatesWithPosts($thread_id);
      ?>
      var datesWithPosts = <?php echo json_encode($datesWithPosts); ?>;
    });

    // Function to remove the filter
    function removeFilter() {
      window.location.href = 'viewThread.php?thread_id=<?php echo $thread_id; ?>';
    }
  </script>
  <!--css for calendar-->
  <style>
    /* Add these styles to your existing styles */
    .ui-datepicker {
      background-color: #fff;
      /* Set background color */
      border: 1px solid #ccc;
      /* Set border color */
    }

    .ui-datepicker-header {
      background-color: #7453fc;
      color: #fff;
    }

    .ui-datepicker-title {
      color: #fff;
    }

    .ui-datepicker-prev,
    .ui-datepicker-next {
      color: #fff;
    }

    .ui-datepicker-calendar {
      border: 1px solid #ccc;
    }

    .ui-datepicker-calendar th {
      background-color: #7453fc;
      color: #fff;
    }

    .ui-datepicker-calendar td {
      border: 1px solid #ccc;
    }

    .ui-datepicker-calendar a {
      color: darkgrey;
    }

    .ui-datepicker-calendar a:hover {
      background-color: #7453fc;
      color: #fff;
    }


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

    .ui-datepicker {
      z-index: 9999 !important;
    }

    .highlight {
      background-color: black !important;
      color: #000000 !important;
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
              <img src="assets/images/logo.png" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.html">Home</a></li>
              <li><a href="explore.php">Explore</a></li>
              <li><a href="details.html">Item Details</a></li>
              <li><a href="author.html">Author</a></li>
              <li><a href="create.php" class="active">Create Yours</a></li>
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
          <h6>Welcome to</h6>
          <h2>
            <?php echo $thread->getTitle(); ?>
          </h2>
          <div class="buttons">
            <div class="main-button">
              <a href="explore.php">Explore Our threads</a>
            </div>
            <div class="border-button">
              <a href="create.html">Create Your NFT</a>
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
            <h2>Create <em>Your post</em> Here.</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="contact" action="create.php?thread_id=<?php echo $thread_id; ?>" method="post">
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                  <label for="title">Title</label>
                  <input type="title" name="title" id="title" placeholder="Name of your post here" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                  <label for="description">Content</label>
                  <input type="description" name="content" id="content" placeholder="Give us your idea"
                    autocomplete="on" required>
                </fieldset>
              </div>




              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" name="Add Post" class="orange-button">Confirm</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>These are <em>the posts</em> of
              <?php echo $thread->getTitle(); ?>
            </h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="current-bid">
            <div class="row">
              <div class="col-lg-6">
                <div class="mini-heading">

                </div>
              </div>
              <div class="col-lg-6">

                <fieldset>
                  <select name="Category" class="form-select" aria-label="Default select example" id="chooseCategory"
                    onchange="this.form.click()">
                    <option selected>Sort By: Latest</option>
                    <option name="option1" value="old">Sort By: Oldest</option>
                    <option value="low">Sort By: Lowest</option>
                  </select>
                  <p>Search for a post by Date: <input type="" id="datepicker"></p>

                </fieldset>

              </div>

              <?php foreach ($posts as $post): ?>
                <div class="col-lg-4 col-md-6">
                  <a href="details.php?post_id=<?php echo $post['post_id']; ?>">

                    <div class="item">
                      <div class="left-img">
                        <img src="../assets/images/current-01.jpg" alt="">
                      </div>
                      <div class="right-content">
                        <h4>
                          <?php echo $post['title']; ?>
                        </h4>
                        <a>
                          <?php echo $post['username']; ?>
                        </a>
                        <div class="line-dec"></div>
                        <p>
                          <?php echo $post['content']; ?>
                        </p>
                        <span class="date">
                          <?php echo $threadController->timeAgo($post['created_at']); ?> ago
                        </span>
                        <br>
                        <span class="date">
                          <?php echo $postController->getCommentCountByPost($post['post_id']); ?> comments
                        </span>
                      </div>
                    </div>
                </div>
                </a>
              <?php endforeach; ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2022 <a href="#">Liberty</a> NFT Marketplace Co., Ltd. All rights reserved.
            &nbsp;&nbsp;
            Designed by <a title="HTML CSS Templates" rel="sponsored" href="https://templatemo.com"
              target="_blank">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>

  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>