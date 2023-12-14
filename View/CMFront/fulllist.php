<?php
include '../../Controller/productcontrol.php';
$c = new productC();
$tab = $c->listproducts();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>AMETHYST - Explore Listing Page</title>

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
                    <a href="explore.html" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                    <li><a href="index.php"  >HOME</a></li>
                        <li><a href="products.php"class="active">PRODUCTS</a></li>
                        <li><a href="customerservice.php">CUSTOMER SERVICE</a></li>
                        <li><a href="blogs.php">BLOGS</a></li>
                        <li><a href="forum.php">FORUM</a></li>
                        <li><a href="login.php">LOGIN</a></li>
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
          <h6>AMETHYST SELECTION</h6>
          <h2>Discover Some Top Artworks</h2>
          <span>Home > <a href="#">Products</a></span>
        </div>
      </div>
    </div>
    
  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>View <em>full list of products</em></h2>
            <a href="fulllist.php">full list</a>
          </div>
        </div>
      </div> 
    </div>
  </div>

    <style>
    img{
        width: 100px;
    }
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
    <?php
$limit = 5;
$query = "SELECT count(*) FROM product";
$db = Config::getConnexion();
$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results / $limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$starting_limit = ($page - 1) * $limit;
$show = "SELECT * FROM product ORDER BY id ASC LIMIT :limit OFFSET :offset";

$r = $db->prepare($show);
$r->bindParam(':limit', $limit, PDO::PARAM_INT);
$r->bindParam(':offset', $starting_limit, PDO::PARAM_INT);
$r->execute();

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
            <th scope="col">quantity</th>
            <th scope="col">category</th>
            <th scope="col">region</th>
            <th scope="col">description</th>
            <th scope="col">product image</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        while ($res = $r->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
                <td>' . $res['id'] . '</td>
                <td>' . $res['name'] . '</td>
                <td>' . $res['price'] . '</td>
                <td>' . $res['quantity'] . '</td>
                <td>' . $res['category'] . '</td>
                <td>' . $res['region'] . '</td>
                <td>' . $res['description'] . '</td>
                <td> <img src='.$res['img'].' > </td>
               
            </tr>';
        }
        ?>
    </tbody>
</table>

<?php
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="?page=' . $i . '" class="links">' . $i . '</a>';
}
?>

  

    
<div class="heading">
      <h4>List of Products
        <form class="filterForm" method="POST" action="sort.php">
          <input type="text" id="filter" name="filter" autofocus="true" placeholder="filter keyword" tabindex="0" value="<?= $filter ?? '' ?>"/>
          <input type="submit" name="btnFilter" id="btnFilter" value="Go"/>
          <input type="submit" name="btnClear" id="btnClear" value="Clear Filters"/>
        </form>
      </h4>
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
</html>