<?php


include '../Controller/productcontrol.php';
include '../model/product.php';
$error = "";

    $id= $_GET['updateid'];
    // create an instance of the controller
    $productC = new productC();
    $product= $productC->showproduct($id);
    
    
    $valid=0;
    if (isset($_POST["name"]) &&
        isset($_POST["price"]) &&
        isset($_POST["quantity"]) &&
        isset($_POST["category"]) &&
        isset($_POST["region"]) &&
        isset($_POST["description"])){
        if (
            !empty($_POST["name"]) &&
            !empty($_POST["price"]) &&
            !empty($_POST["quantity"]) &&
            !empty($_POST["category"]) &&
            !empty($_POST["region"]) &&
            !empty($_POST["description"])
        ) {
            $img=$_FILES['file'];
    
            $imagefilename=$img['name'];
            $imagefileerror=$img['error'];
            $imagefiletemp=$img['tmp_name'];
            $filename_seperate=explode('.',$imagefilename);
            $file_extension=strtolower($filename_seperate[1]);
            $extension=array('jpeg','jpg','png');
            if(in_array($file_extension,$extension)){
                $upload_image='uploads/'.$imagefilename;
                move_uploaded_file($imagefiletemp,$upload_image);
                $valid = 1; // Form validation passed
            }
            
        } else{
            $error = "Missing information";
        }
    } 
    if ($valid==1){
       
        
        $product = new product(
            $_POST["name"], 
            $_POST["price"], 
            $_POST["quantity"], 
            $_POST["category"], 
            $_POST["region"], 
            $_POST["description"],
            $upload_image,
        );
        $productC->updateproduct($product,$id);
        header('Location:displayproduct.php'); 
        
        //var_dump($product);
        
        exit;
    }/*
   if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $category=$_POST['category'];
    $region=$_POST['region'];
    $description=$_POST['description'];
    $img=$_FILES['file'];
    
    $imagefilename=$img['name'];
    $imagefileerror=$img['error'];
    $imagefiletemp=$img['tmp_name'];
    $filename_seperate=explode('.',$imagefilename);
    $file_extension=strtolower($filename_seperate[1]);
    $extension=array('jpeg','jpg','png');
    if(in_array($file_extension,$extension)){
        $upload_image='uploads/'.$imagefilename;
        move_uploaded_file($imagefiletemp,$upload_image);
        $sql = "UPDATE `product` SET name=$name, price=$price, quantity=$quantity, category=$category, region=$region, description=$description, img=$img WHERE id=$id";
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if($stmt){
            header('Location:productlist.php');
        }
    }


}*/
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
  

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>PRODUCTS</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="productlist.php">product list</a></li>
            
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>AUCTIONED PRODUCTS</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href=tables-basic.html">product list</a></li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">UI Elements</a></li>
                            <li class="active">PRODUCTS</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
                                     <form  method="post" enctype="multipart/form-data">
                                        <!-- Price Input -->
                                            <label for="name">name:</label>
                                        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" >

                                        <br>

                                        <label for="price">Price:</label>
                                        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" >

                                        <br>

                                        <!-- Quantity Input -->
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>">

                                        <br>

                                        <!-- Category Input -->
                                        <label for="category">Category:</label>
                                        <?php
                                        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $query = "SELECT * FROM category";
                                        $result = $pdo->query($query);
                                        $tab = $result->fetchAll();
                                        ?>
                                        <select id="category" name="category">
                                        <option value="Category">Category</option>
                                        <?php foreach ($tab as $category): ?>
                                            <option value="<?php echo $category["catid"]; ?>"><?php echo $category["catname"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <br>

                                    <!-- Region Input -->
                                    <label for="region">Region:</label>
                                    <input type="text" id="region" name="region" value="<?php echo $product['region']; ?>">

                                    <br>
                                    <label for="description">description:</label>
                                    <input type="text" id="description" name="description" value="<?php echo $product['description']; ?>" >
                                    <br>
                                    <label>product picture</label>
                                    <input type="file" name="file" class="form-control" required="" accept="*/image">
                                    <br>
        
                                    <!-- Submit Button -->
                                    <button type="submit" class ="btn btn-primary" name="submit">update </button>
                                    </form>
                                    </div>
       <!-- <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="buttons">

                    

                            <div class="card">
                                <div class="card-body">
                                    <a class="btn btn-primary" href="addproduct.php" role="button">add product</a>
                                    <a class="btn btn-primary" href="displayproduct.php" role="button">view product</a>
                                    
                                    
                                </div>
                                

                               
                            </div>
                            
                          
                           
                            <div class="col-md-6">

                                <div class="card">
                                    <div class="card-header">
                                        <strong>CATEGORY </strong>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-outline-primary">add category</button>
                                        <button type="button" class="btn btn-outline-secondary">delete category</button>
                                       
                                    </div>
                                </div>


                                
                                </div>
                            </div> <!-- .buttons -->

                        </div><!-- .row -->
                    </div><!-- .animated -->
                </div><!-- .content -->


            </div><!-- /#right-panel -->

            <!-- Right Panel -->
            

            <script src="vendors/jquery/dist/jquery.min.js"></script>
            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="assets/js/main.js"></script>


</body>

</html>
