<?php
session_start();
include '../../Controller/ThreadController.php';
include_once '../../Model/threadModel.php';

$threadController = new ThreadController();
$threadsPerPage = 5; // Adjust as needed
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $threadsPerPage;

// Get the filter value from the query parameter
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Validate that the filter is one of the allowed options
$allowedFilters = ['created_at', 'posts', 'views'];
if (!in_array($filter, $allowedFilters)) {
  $filter = ''; // Reset to default if an invalid filter is provided
}

// Calculate total pages
$totalThreads = $threadController->getTotalThreadsCount();
$totalPages = ceil($totalThreads / $threadsPerPage);

// Fetch threads for the current page with the specified filter
$threads = $filter ? $threadController->getAllThreads($offset, $threadsPerPage, $filter) : $threadController->getAllThreads($offset, $threadsPerPage);

$recentThreads = $threadController->getRecentThreads();

$error = "";
$thread = null;

// Check if the user is logged in (adjust as needed)
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page or take appropriate action
  header('Location: login.php');
  exit();
}

// Check if a thread_id is provided in the URL
if (isset($_GET['thread_id'])) {
  $thread_id = $_GET['thread_id'];

  // Increment views when the user views the thread
  $threadController->incrementThreadViews($thread_id);

  // Fetch the thread details
  $thread = $threadController->getThreadById($thread_id);
  header("Location: threadDetail.php?thread_id=$thread_id");
}

// Check if the form for creating a new thread is submitted
if (isset($_POST["title"]) && isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
  if (!empty($_POST['title']) && !empty($_SESSION['user_id']) && !empty($_SESSION['username'])) {
    // Generate the created_at timestamp (assuming you want the current time)
    $created_at = date('Y-m-d H:i:s');

    $usernameFromSession = $_SESSION['username'];

    // Create the Thread object with the username
    $thread = new Thread($_POST['title'], $_SESSION['user_id'], $created_at, $usernameFromSession);

    $threadController = new ThreadController();
    $threadController->addThread($thread);

    header('Location: explore.php'); // Redirect to the list of threads page
  } else {
    $error = "Missing information";
  }
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

  <title>Liberty NFT Marketplace - Explore Listing Page</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="css/threads.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!--

TemplateMo 577 Liberty Market

https://templatemo.com/tm-577-liberty-market

-->
</head>

<body>
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
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
              <li><a href="explore.php" class="active">Explore</a></li>
              <li><a href="products.php">Item Details</a></li>
              <li><a href="author.html">Author</a></li>
              <li><a href="request.php">Customer service</a></li>
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
  
    
  
          
        

  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Weekly Culture Trend</h6>
          <h2>Discover The Art Movement From This Culture</h2>
          <span>Home > <a href="#">Explore</a></span>
        </div>
      </div>
    </div>
    <div class="featured-explore">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="owl-features owl-carousel">
              <div class="item">
                <div class="thumb">
                  <img src="assets/images/featured-01.jpg" alt="" style="border-radius: 20px;">
                  <div class="hover-effect">
                    <div class="content">
                      <h4>Triple Mutant Ape Bored</h4>
                      <span class="author">
                        <img src="assets/images/author.jpg" alt=""
                          style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                        <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                      </span>
                    </div>
                  </div>
                </div>
              </div>


              <div class="item">
                <div class="thumb">
                  <img src="assets/images/featured-04.jpg" alt="" style="border-radius: 20px;">
                  <div class="hover-effect">
                    <div class="content">
                      <h4>Crypto Aurora Guy</h4>
                      <span class="author">
                        <img src="assets/images/author.jpg" alt=""
                          style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                        <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Discover <em>Threads</em>.</h2>
          </div>
        </div>
        <div class="col-lg-7">
          <form id="search-form" name="gs" method="" role="search" action="#">
            <div class="row">

              <div class="col-lg-3">

              </div>
              <div class="col-lg-3">
                <fieldset>
                  <select name="filter" class="form-select" aria-label="Default select example" id="chooseCategory"
                    onchange="this.form.submit()">
                    <option value="created_at" <?php echo ($filter === 'created_at') ? 'selected' : ''; ?>>Latest</option>
                    <option value="posts" <?php echo ($filter === 'posts') ? 'selected' : ''; ?>>Posts</option>
                    <option value="views" <?php echo ($filter === 'views') ? 'selected' : ''; ?>>Views</option>
                  </select>
                </fieldset>
              </div>

              <div class="col-lg-2">
                <button class="main-button" data-bs-toggle="modal" data-bs-target="#addThreadModal">Add a
                  Thread</button>
              </div>

            </div>
          </form>
        </div>

        <!--Thread container-->

        <div class="col-lg-12">
          <div class="item">
            <div class="row">
              <div class="col-lg-12">
                <span class="banner">Threads</span>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-lg-9 mb-3" style="">
                    <div class="row text-left mb-5">
                      <script>
                        function clearFilter() {
                          // Reset the filter value and submit the form
                          document.getElementById('filterForm').reset();
                          document.getElementById('filterForm').submit();
                        }

                        function myFunction() {
                          document.getElementById("myDropdown").classList.toggle("show");
                        }

                        function filterFunction() {
                          var input, filter, ul, li, a, i;
                          input = document.getElementById("myInput");
                          filter = input.value.toUpperCase();
                          div = document.getElementById("myDropdown");
                          a = div.getElementsByTagName("a");
                          for (i = 0; i < a.length; i++) {
                            txtValue = a[i].textContent || a[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                              a[i].style.display = "";
                            } else {
                              a[i].style.display = "none";
                            }
                          }
                        }

                      </script>

                    </div>
                    <?php foreach ($threads as $thread): ?>
                      <div
                        class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
                        <div class="row align-items-center">
                          <div class="col-md-8 mb-3 mb-sm-0">
                            <h5>
                              <a href="create.php?thread_id=<?php echo $thread['thread_id']; ?>"
                                class="text-primary">
                                <?php echo $thread['title']; ?>
                              </a>
                            </h5>
                            <p class="text-sm">
                              <span class="op-6">Posted</span>
                              <a class="text-secondary" href="#">
                                <?php echo $threadController->timeAgo($thread['created_at']); ?>
                              </a>
                              <span class="op-6">ago by</span>
                              <a class="text-secondary" href="#">
                                <?php echo $thread['username']; ?>
                              </a>
                            </p>
                          </div>
                          <div class="col-md-4 op-7">
                            <div class="row text-center op-7">
                              <div class="col px-1">
                                <i class="ion-ios-chatboxes-outline icon-1x"></i>
                                <span class="d-block text-secondary">
                                  <?php echo $threadController->getPostCountByThread($thread['thread_id']); ?>
                                  posts
                                </span>
                              </div>
                              <div class="col px-1">
                                <i class="ion-ios-eye-outline icon-1x"></i>
                                <span class="d-block text-secondary">
                                  <?php echo $thread['views']; ?> Views
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-12">
                    <div
                      style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
                    </div>
                    <div
                      data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}"
                      data-toggle="sticky" class="sticky" style="top: 85px;">

                      <div class="sticky-inner">

                        <div class="bg-black-opacity mb-3">
                          <h4 class="px-3 py-4 op-5 m-0 text-white">Active Topics</h4>
                          <hr class="m-0">

                          <?php foreach ($recentThreads as $thread): ?>
                            <div class="pos-relative px-3 py-3">
                              <h6 class="text-primary text-sm">
                                <a href="viewThread.php?thread_id=<?php echo $thread['thread_id']; ?>"
                                  class="text-primary">
                                  <?php echo $thread['title']; ?>
                                </a>
                              </h6>
                              <p class="text-sm">
                                <span class="op-6 text-white">Posted</span>
                                <a class="text-plum" href="#">
                                  <?php echo $threadController->timeAgo($thread['created_at']); ?>
                                </a>
                                <span class="op-6 text-white">ago by</span>
                                <a class="text-plum" href="#">
                                  <?php echo $thread['username']; ?>
                                </a>
                              </p>
                            </div>
                            <hr class="m-0">
                          <?php endforeach; ?>

                        </div>
                        <hr class="m-0">
                      </div>


                      <div class="card bg-black-opacity text-sm">
                        <h4 class="px-3 py-4 op-5 m-0 roboto-bold text-primary">Stats</h4>
                        <hr class="my-0">
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                          <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right">
                            <a class="d-block lead font-weight-bold text-primary" href="#">
                              <?php echo $threadController->getTotalTopicsCount(); ?>
                            </a> Topics
                          </div>
                          <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0">
                            <a class="d-block lead font-weight-bold text-primary" href="#">
                              <?php echo $threadController->getTotalPostsCount(); ?>
                            </a> Posts
                          </div>
                        </div>
                        <div class="row d-flex flex-row op-7">
                          <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0">
                            <a class="d-block lead font-weight-bold text-primary" href="#">
                              <?php echo $threadController->getTotalMembersCount(); ?>
                            </a> Members
                          </div>
                          <div class="col-sm-6 flex-ew text-center py-3 mx-0">
                            <a class="d-block lead font-weight-bold text-primary" href="#">
                              <?php echo $threadController->getNewestMember(); ?>
                            </a> last uploader
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-lg-12">

                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($currentPage == $i) ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                          </a>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </nav>

                  <div class="main-button">

                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>






  <div class="top-seller">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Our Top Sellers This Week.</h2>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>1.</h4>
                <img src="assets/images/author.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>NFT Top Artist<br><a href="#">8.6 ETH or $12,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>2.</h4>
                <img src="assets/images/author-02.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>George Brandon<br><a href="#">4.8 ETH or $14,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>3.</h4>
                <img src="assets/images/author-03.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Johnny Mayson<br><a href="#">6.2 ETH or $26,000</a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>4.</h4>
                <img src="assets/images/author.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Liberty Artist<br><a href="#">4.5 ETH or $11,600</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>5.</h4>
                <img src="assets/images/author-02.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Ronald Martino<br><a href="#">7.2 ETH or $14,500</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>6.</h4>
                <img src="assets/images/author-03.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Anthony Brown<br><a href="#">8.6 ETH or $7,400</a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>7.</h4>
                <img src="assets/images/author.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Liberty Artist<br><a href="#">9.8 ETH or $14,200</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>8.</h4>
                <img src="assets/images/author-02.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Ronald Martino<br><a href="#">6.5 ETH or $15,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>9.</h4>
                <img src="assets/images/author-03.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>David Walker<br><a href="#">2.5 ETH or $12,000</a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>10.</h4>
                <img src="assets/images/author.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Liberty Artist<br><a href="#">8.8 ETH or $16,800</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>11.</h4>
                <img src="assets/images/author-02.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Anthony Brown<br><a href="#">7.5 ETH or $15,400</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>12.</h4>
                <img src="assets/images/author-03.jpg" alt=""
                  style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>David Walker<br><a href="#">5.2 ETH or $12,300</a></h6>
              </div>
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
  
  <!-- Adding a thread pop up        -->
  <script>
    document.getElementById('addThreadButton').addEventListener('click', function (event) {
      // Prevent the default form submission
      event.preventDefault();

      // Open the modal manually
      var addThreadModal = new bootstrap.Modal(document.getElementById('addThreadModal'));
      addThreadModal.show();
    });
  </script>



  <div class="modal fade" id="addThreadModal" tabindex="-1" aria-labelledby="addThreadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addThreadModalLabel">Add a Thread</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="mb-3">
              <label for="threadTitle" class="form-label">Thread Title</label>
              <input type="text" class="form-control" id="threadTitle" name="title" required>
            </div>
            <!-- Add more form fields as needed -->
            <button type="submit" class="btn btn-primary">Create Thread</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>