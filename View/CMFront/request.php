<<<<<<< HEAD
<?php
include '../../controller/Requestcontroller.php';
include '../../model/Request.php';
var_dump($_POST); // Check the POST data being received

$error = "";
$requests = null;
$valid = 0;

// create an instance of the controller
$requestcontroller = new requestcontroller();

if (
  isset($_POST["userid"]) &&
  isset($_POST["reqtype"]) &&
  isset($_POST["reqdate"]) &&
  isset($_POST["servicestatus"])
) {
  if (
    !empty($_POST["userid"]) &&
    !empty($_POST['reqtype']) &&
    !empty($_POST["reqdate"]) &&
    !empty($_POST["servicestatus"])
  ) {
    $valid = 1; // Form validation passed
  }
}
if ($valid == 1) {
  // Form is valid, proceed with adding the user
  $request = new request(
    $_POST['userid'],
    $_POST['reqtype'],
    $_POST['reqdate'],
    $_POST['servicestatus']
  );
  $requestcontroller->createrequest($request);
  header('Location:request.php');
  exit();
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
              <li><a href="create.php">Create Yours</a></li>
              <li><a href="request.html" class="active">Make a Request</a></li>
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
          <h6>Request Here</h6>
          <h2>whether it be a feedback or request!</h2>
          <span>Home > <a href="#">Create:</a></span>
        </div>
      </div>
    </div>
  </div>

  <div class="item-details-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <!-- Your section heading content remains unchanged -->
          </div>
        </div>
        <div class="col-lg-12">
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                  <label for="userid">User ID:</label>
                  <input type="number" id="userid" name="userid" placeholder="Enter user id" required />
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                  <label for="reqtype">Request Type:</label>
                  <select id="reqtype" name="reqtype" required>
                    <option value="feedback">Feedback</option>
                    <option value="refund">Refund</option>
                  </select>
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                  <label for="reqdate">Request Date:</label>
                  <input type="date" id="reqdate" name="reqdate" />
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="servicestatus">Service Status:</label>
                  <select id="servicestatus" name="servicestatus">
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                  </select>
                </fieldset>
              </div>
            </div>
            <br>
            <input type="submit" value="Save">
          </form>
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

=======
<?php
include '../controller/Requestcontroller.php';
include '../model/Request.php';
$error = "";
$requests = null;
$valid = 0;

// create an instance of the controller
$requestcontroller = new requestcontroller();

if (
    isset($_POST["userid"]) &&
    isset($_POST["reqtype"]) &&
    isset($_POST["reqdate"]) &&
    isset($_POST["servicestatus"])
) {
    if (
        !empty($_POST["userid"]) &&
        !empty($_POST['reqtype']) &&
        !empty($_POST["reqdate"]) &&
        !empty($_POST["servicestatus"])
    ) {
            $valid = 1; // Form validation passed
    }
}
if ($valid == 1) {
    // Form is valid, proceed with adding the user
    $request = new request(
        $_POST['userid'],
        $_POST['reqtype'],
        $_POST['reqdate'],
        $_POST['servicestatus']
    );
    $requestcontroller->createrequest($request);
    header('Location:request.php');
    exit();
} 


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Liberty Template - Create NFT Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

<!--

TemplateMo 577 Liberty Market

https://templatemo.com/tm-577-liberty-market

-->
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
                        <li><a href="explore.html">Explore</a></li>
                        <li><a href="details.html">Item Details</a></li>
                        <li><a href="author.html">Author</a></li>
                        <li><a href="create.html">Create Yours</a></li>
                        <li><a href="request.html" class="active">Make a Request</a></li>
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
          <h6>Request Here</h6>
          <h2>whether it be a feedback or request!</h2>
          <span>Home > <a href="#">Create:</a></span>
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
            <h2>Fill out <em>Request form</em> Here.</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                  <tr>
                    <td><label for="userid">userid :</label></td>
                      <td>
                        <input type="number" id="userid" name="userid" placeholder="Enter user id" required/>
                        <span id="userid" style="color: red"></span>
                    </td>
                    </tr>
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                <tr>
                <td><label for="reqtype">Request Type:</label></td> <br>
                  <td>
                      <select id="reqtype" name="reqtype" required>
                        <option value="feedback">Feedback</option>
                        <option value="refund">Refund</option>
                      </select>
                      <span id="error" style="color: red"></span>
                    </td>
                  </tr>
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                  <tr>
                    <td><label for="reqdate">reqdate :</label></td>
                      <td>
                        <input type="date" id="reqdate" name="reqdate" />
                        <span id="error" style="color: red"></span>
                      </td>
                  </tr>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <tr>
                  <td><label for="servicestatus">servicestatus Type:</label></td> <br>
                      <td>
                        <select id="servicestatus" name="servicestatus">
                          <option value="ongoing">Ongoing</option>
                          <option value="completed">Completed</option>
                          <option value="cancelled">Cancelled</option>
                        </select>
                        <span id="error" style="color: red"></span>
                    </td>
                  </tr>
                </fieldset>
              </div>
            </div>
            <br>
            <td>
                  <input type="submit" value="Save">
                </td>
          </form>
        </div>
        <!--<div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>This Is <em>Your Item</em> Preview.</h2>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="left-image">
            <img src="assets/images/create-yours.jpg" alt="" style="border-radius: 20px;">
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <h4>Dolores Haze Westworld Eye</h4>
          <span class="author">
            <img src="assets/images/author-02.jpg" alt="" style="max-width: 50px; border-radius: 50%;">
            <h6>Kataleya Smithee<br><a href="#">@kataleey</a></h6>
          </span>
          <p>Lorem ipsum dolor sit amet, consectetu dipiscingei elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <div class="row">
            <div class="col-3">
              <span class="bid">
                Current Bid<br><strong>0.06 ETH</strong><br><em>($8055,35)</em>
              </span>
            </div>
            <div class="col-4">
              <span class="owner">
                Owner<br><strong>Alan Smithee</strong><br><em>(@asmithee)</em>
              </span>
            </div>
            <div class="col-5">
              <span class="ends">
                Ends In<br><strong>3D 05H 20M 58S</strong><br><em>(January 22nd, 2021)</em>
              </span>
            </div>-->
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
          Designed by <a title="HTML CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
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
>>>>>>> dec5554de1f437b414be2187aad53904b16b7634
</html>