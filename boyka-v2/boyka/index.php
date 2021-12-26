<?php
require_once('db_connect.php');
session_start();
if(isset($_SESSION['userId']) && $_SESSION['userId']==1) {
header('Location: http://localhost/stock/dashboard.php');
}
if(isset($_SESSION['userId'])) {
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
}

$sql2 = "SELECT product.product_id, product.product_name, product.product_image,
        product.categories_id, product.quantity, product.price, product.active, product.status, 
        categories.categories_name,product.description,product.discount,product.gender_id,gender.gender,product.discount FROM product  join categories  on categories.categories_id = product.categories_id join gender on gender.id=product.gender_id WHERE product.brand_id!=20 and product.brand_id is not null order by dateadded desc limit 2";
$query2 = $connect->query($sql2);
$output = array('data' => array());
if($query2->num_rows > 0) {
while($row = $query2->fetch_array()) {
$imageUrl = substr($row[2], 3);
$imageUrl = '../../'.$imageUrl;
$productImage = $imageUrl;
$output['data'][] = array( 
$row[1],
$productImage,
$row[3],
$row[5],
$row[6],
$row[8],
$row[10],
$row[0],
$row[9],
$row[4],
$row[12]
);
}
}

$sql3 = "SELECT product.product_id, product.product_name, product.product_image,
        product.categories_id, product.quantity, product.price, product.active, product.status, 
        categories.categories_name,product.description,product.discount,product.gender_id,gender.gender,product.discount  FROM product  join categories  on categories.categories_id = product.categories_id join gender on gender.id=product.gender_id WHERE product.discount!=0 and product.active=1 order by dateadded desc limit 5";
$query3 = $connect->query($sql3);
$output2 = array('data' => array());
if($query3->num_rows > 0) {
while($row = $query3->fetch_array()) {
$imageUrl = substr($row[2], 3);
$imageUrl = '../../'.$imageUrl;
$productImage = $imageUrl;
$output2['data'][] = array( 
$row[1],
$productImage,
$row[3],
$row[5],
$row[6],
$row[8],
$row[10],
$row[0],
$row[9],
$row[4],
$row[12],
$row[13]
);
}
}
if(!isset($_SESSION['shopping_cart'])){
    $item_array = array();
    $_SESSION["shopping_cart"]= $item_array; 
}
$nb=count($_SESSION["shopping_cart"]);
if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"], 
                     'item_picture'         =>     $_POST["hidden_picture"], 
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array; 
                 echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('Product added !');
                 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct=".$_GET["id"]."\"); 
                </SCRIPT>";
           }  
           else  
           {  
                echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('Product already added !');
                 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct=".$_GET["id"]."\"); 
                </SCRIPT>";  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],
                'item_picture'          =>    $_POST["hidden_picture"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 } 
 if(isset($_GET["action"]))  
 { 
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('Item removed !');
                 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct=".$_GET["id"]."\"); 
                </SCRIPT>";
                }
           }  
      }  
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:01:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hot declutter - home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- CSS 
    ========================= -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Font CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

<!-- Main Wrapper Start -->
<div class="main-wrapper">
    <!-- header-area start -->
    <div class="header-area">
        <!-- header-top start -->
        <div class="header-top bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 order-2 order-lg-1">
                        <div class="top-left-wrap">
                            <ul class="phone-email-wrap">
                                <li><i class="fa fa-phone"></i> (08)123 456 7890</li>
                                <li><i class="fa fa-envelope-open-o"></i> support@hotdeclutter.com</li>
                            </ul>
                            <ul class="link-top">
                                <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" title="Rss"><i class="fa fa-rss"></i></a></li>
                                <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 order-1 order-lg-2">
                        <div class="top-selector-wrapper">
                            <ul class="single-top-selector">
                                <!-- Currency Start -->
                                <li class="currency list-inline-item">
                                    <div class="btn-group">
                                        <button class="dropdown-toggle"> USD $ <i class="fa fa-angle-down"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                               <li><a href="#">Euro €</a></li>
                                               <li><a href="#" class="current">USD $</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Currency End -->
                                <!-- Language Start -->
                                <li class="language list-inline-item">
                                    <div class="btn-group">
                                        <button class="dropdown-toggle"><img src="assets/images/icon/la-1.jpg" alt="">  English <i class="fa fa-angle-down"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                               <li><a href="#"><img src="assets/images/icon/la-1.jpg" alt=""> English</a></li>
                                                <li><a href="#"><img src="assets/images/icon/la-2.jpg" alt=""> French</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Language End -->
                                <!-- Sanguage Start -->
                                 <?php
                                 if(isset($_SESSION['userId'])):                                 
                                 ?>

                                <li class="setting-top list-inline-item">
                                    <div class="btn-group">
                                        

                                        <button class="dropdown-toggle"><i class="fa fa-user-circle-o"></i> <?php echo $result['username']; ?> <i class="fa fa-angle-down"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="my-account.php">My account</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="logout.php">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php 
                            if(!isset($_SESSION['userId'])):
                            ?>
                            <li class="setting-top list-inline-item">
                                    <div class="btn-group">
                                        

                                        <button class="dropdown-toggle"><i class="fa fa-user-circle-o"></i> Settings <i class="fa fa-angle-down"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="login-register.php">Login</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                                <!-- Sanguage End -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header-top end -->
        <!-- Header-bottom start -->
        <div class="header-bottom-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-4">
                        <!-- logo start -->
                        <div class="logo">
                            <a href="index.html"><img src="logo.png" style="width: 20% ; height: 20%;" alt=""></a>
                        </div>
                        <!-- logo end -->
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <!-- main-menu-area start -->
                        <div class="main-menu-area">
                            <nav class="main-navigation">
                                <ul>
                                    <li  class="active"><a href="index.php">Home  <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.php">Home Page</a></li>                                            
                                        </ul>
                                    </li>
                                    <li><a href="shop.php">Shop <i class="fa fa-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li><a href="#">Shop Pages</a>
                                                <ul>                                                   
                                                    <li><a href="shop.php">Products list</a></li>
                                                </ul>
                                            </li>                                           
                                        </ul>
                                    </li>                                    
                                    <li><a href="blog.html">Blog  <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-col-3.html">Blog Grid 3 Layout</a></li>
                                            <li><a href="blog-details-right-sidebar.html">Blog Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contactus.php">Contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- main-menu-area End -->
                    </div>
                    <div class="col-lg-3 col-8">
                        <div class="header-bottom-right">
                            <div class="block-search">
                                <div class="trigger-search"><i class="fa fa-search"></i> <span>Search</span></div>
                                <div class="search-box main-search-active">
                                    <form action="shopfiltered.php" class="search-box-inner" method="POST">
                                        <input type="text" name="search" placeholder="Search our catalog">
                                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="shoping-cart">
                                <div class="btn-group">
                                    <!-- Mini Cart Button start -->
                                   <button class="dropdown-toggle"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $nb; ?>)</button>
                                    <!-- Mini Cart button end -->
                                    
                                    <!-- Mini Cart wrap start -->
                                    <div class="dropdown-menu mini-cart-wrap">
                                        <div class="shopping-cart-content">
                                            <ul class="mini-cart-content">
                                                <!-- Mini-Cart-item start -->
                                                <?php   
                                                  if(!empty($_SESSION["shopping_cart"]))  
                                                  {  
                                                       $total = 0;  
                                                       foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                                       {  
                                                  ?> 
                                                <li class="mini-cart-item">
                                                    <div class="mini-cart-product-img">
                                                        <a href="#"><?php echo $values["item_picture"]; ?></a>
                                                        <span class="product-quantity"><?php echo $values["item_quantity"]; ?>x</span>
                                                    </div>
                                                    <div class="mini-cart-product-desc">
                                                        <h3><a href="#"><?php echo $values["item_name"]; ?></a></h3>
                                                        <div class="price-box">
                                                            <span class="new-price"><?php echo $values["item_price"]; ?>DT</span>
                                                        </div>
                                                        <div class="size">
                                                            Size: S
                                                        </div>
                                                    </div>
                                                    <div class="remove-from-cart">
                                                        <a href="productdetails.php?action=delete&id=<?php echo $values["item_id"]; ?>" title="Remove"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </li>
                                                    <?php  
                                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                                                     }  
                                                     ?>
                                                <!-- Mini-Cart-item end -->
                                                
                                                <!-- Mini-Cart-item start -->
                                                
                                                <!-- Mini-Cart-item end -->
                                                
                                                <li>
                                                    <!-- shopping-cart-total start -->
                                                    <div class="shopping-cart-total">
                                                        <h4>Sub-Total : <span><?php echo number_format($total, 2); ?> DT</span></h4>
                                                        <h4>Total : <span><?php echo number_format($total, 2); ?> DT</span></h4>
                                                    </div>
                                                    <!-- shopping-cart-total end -->
                                                     <?php  
                                                      }  
                                                      ?> 
                                                    <!-- shopping-cart-total end -->
                                                </li>
                                                
                                                <li>   
                                                    <!-- shopping-cart-btn start -->
                                                    <div class="shopping-cart-btn">
                                                        <a href="checkout.html">Checkout</a>
                                                    </div>
                                                    <!-- shopping-cart-btn end -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Mini Cart wrap End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- mobile-menu start -->
                        <div class="mobile-menu d-block d-lg-none"></div>
                        <!-- mobile-menu end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header-bottom end -->
    </div>
    <!-- Header-area end -->
    
    <!-- Hero Slider start -->
    
    <div class="hero-slider hero-slider-one">
        <?php foreach ($output['data'] as $key => $value) { ?>
        <div class="single-slide" style="background-image: url(<?php echo $output['data'][$key][1] ?>)">
            <!-- Hero Content One Start -->
            <div class="hero-content-one container">
                <div class="row">
                    <div class="col"> 
                        <div class="slider-text-info text-white">
                            <h1><?php echo $output['data'][$key][5] ?> </h1>
                            <h1>Amazing For <?php echo $output['data'][0][10] ?>'s</h1>
                            <p><?php echo $output['data'][$key][8] ?> </p>
                            <a href="shop.html" class="btn slider-btn uppercase"><span><i class="fa fa-plus"></i> Shop Now</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Content One End -->
        </div>
            <?php } ?>    
    </div>

    
    <!-- Hero Slider end -->
    
    <!-- Categories List Post area start-->
   
    <!-- Categories List Post area -->
    
    <!-- Product Area Start -->
    <?php
    if (sizeof($output2['data'])>=5):
    ?>
    <div class="product-area section-pt section-pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-2">
                        <h2> New Arrivals </h2>
                        <p>Most Trendy 2018 Clother</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper">
                <div class="row product-slider">
                    <?php foreach ($output2['data'] as $key => $value) { ?>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img style="width: auto; height: auto;" src="<?php echo $output2['data'][$key][1];?>" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-<?php echo $output2['data'][$key][11];?>%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html"><?php echo $output2['data'][$key][0];?></a></h3>
                                <div class="price-box">
                                    <?php $price1= $output2['data'][$key][3] - $output2['data'][$key][3]*$output2['data'][$key][11]/100;?>
                                    <span class="new-price"><?php echo $price1;?>DT</span>
                                    <span class="old-price"><?php echo $output2['data'][$key][3];?>DT</span>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    <?php } ?>                     
                        <!-- single-product-wrap end -->
                    </div>
                </div>
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
<?php endif; ?>
    <!-- Product Area End -->
    
    <!-- Banner area start -->
    <div class="banner-area">
        <div class="container-fluid plr-40">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.php"><img src="assets/images/banner/bg5.jpg" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- single-banner start -->
                            <div class="single-banner  mt--30">
                                <a href="shop.php"><img src="assets/images/banner/bg6.jpg" alt=""></a>
                            </div>
                            <!-- single-banner end -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- single-banner start -->
                            <div class="single-banner  mt--30">
                                <a href="shop.php"><img src="assets/images/banner/bg7.jpg" alt=""></a>
                            </div>
                            <!-- single-banner end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-banner start -->
                            <div class="single-banner mt--30">
                                <a href="shop.php"><img src="assets/images/banner/bg8.jpg" alt=""></a>
                            </div>
                            <!-- single-banner end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner area end -->
    
    <!-- Product Area Start -->
    
    <!-- Product Area End -->
    
    <!-- Banner area start -->
    <div class="banner-area-two">
        <div class="container-fluid plr-40">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- single-banner start -->
                    <div class="single-banner-two mt--30">
                        <a href="shop.php"><img src="assets/images/banner/bg1.jpg" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- single-banner start -->
                    <div class="single-banner-two mt--30">
                        <a href="shop.php"><img src="assets/images/banner/bg2.jpg" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Banner area end -->
    
    <!-- Client Testimonials Area Start -->
    <div class="client-testimonials-area text-black  section-ptb">
        <div class="container">
           <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-2">
                        <h2>Client Testimonials</h2>
                        <p>What they say</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 ml-auto mr-auto">
                    <div class="testimonial-slider">
                        <!-- testimonial-content start -->
                        <div class="testimonial-content text-center">
                            <p class="des_testimonial">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="assets/images/comment/com-author.png" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content end -->
                        <!-- testimonial-content start -->
                        <div class="testimonial-content text-center">
                            <p class="des_testimonial">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="assets/images/comment/com-author.png" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content end -->
                        <!-- testimonial-content start -->
                        <div class="testimonial-content text-center">
                            <p class="des_testimonial">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="assets/images/comment/com-author.png" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content start -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Client Testimonials Area End -->
    
    <!-- Latest Blog Posts Area start -->
    <div class="latest-blog-post-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="border-t-one section-ptb">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- section-title start -->
                                <div class="section-title section-bg-3">
                                    <h2>Latest Blog Posts </h2>
                                    <p>There are latest blog posts</p>
                                </div>
                                <!-- section-title end -->
                            </div>
                        </div>
                        <div class="row latest-blog-slider">
                            <div class="col-lg-4">
                                <!-- single-latest-blog start -->
                                <div class="single-latest-blog mt--30">
                                    <div class="latest-blog-image">
                                        <a href="blog-details.html">
                                            <img src="assets/images/blog/1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="latest-blog-content">
                                        <h4><a href="blog-details.html">Work with customizer</a></h4>
                                        <div class="post_meta">
                                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 05, 2018</span>
                                            <span class="meta_author"><span></span>Demo Name</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                                    </div>
                                </div>
                                <!-- single-latest-blog end -->
                            </div>
                            <div class="col-lg-4">
                               <!-- single-latest-blog start -->
                                <div class="single-latest-blog mt--30">
                                    <div class="latest-blog-image">
                                        <a href="blog-details.html">
                                            <img src="assets/images/blog/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="latest-blog-content">
                                        <h4><a href="blog-details.html">Go to New Horizonts</a></h4>
                                        <div class="post_meta">
                                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>may 17, 2018</span>
                                            <span class="meta_author"><span></span>Demo Name</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                                    </div>
                                </div>
                                <!-- single-latest-blog end -->
                            </div>
                            <div class="col-lg-4">
                               <!-- single-latest-blog start -->
                                <div class="single-latest-blog mt--30">
                                    <div class="latest-blog-image">
                                        <a href="blog-details.html">
                                            <img src="assets/images/blog/3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="latest-blog-content">
                                        <h4><a href="blog-details.html">What is Bootstrap?</a></h4>
                                        <div class="post_meta">
                                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>june 11, 2018</span>
                                            <span class="meta_author"><span></span>Demo Name</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                                    </div>
                                </div>
                                <!-- single-latest-blog end -->
                            </div>
                            <div class="col-lg-4">
                                <!-- single-latest-blog start -->
                                <div class="single-latest-blog mt--30">
                                    <div class="latest-blog-image">
                                        <a href="blog-details.html">
                                            <img src="assets/images/blog/4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="latest-blog-content">
                                        <h4><a href="blog-details.html">Try comfort work </a></h4>
                                        <div class="post_meta">
                                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 13, 2018</span>
                                            <span class="meta_author"><span></span>Demo Name</span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                                    </div>
                                </div>
                                <!-- single-latest-blog end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Blog Posts Area End -->
    
    <!-- Our Brand Area Start -->
    <div class="our-brand-area  section-pb">
        <div class="container">
            <div class="row our-brand-active text-center">
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/3.png" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/4.png" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/5.png" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="assets/images/brand/6.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Brand Area End -->
    
    <!-- Footer Aare Start -->
    <footer class="footer-area">
       <!-- footer-top start -->
       <div class="footer-top pt--50 section-pb">
           <div class="container">
               <div class="row">
                   <div class="col-lg-4 col-md-6">
                        <!-- footer-info-area start -->
                        <div class="footer-info-area">
                            <div class="footer-logo">
                                <a href="#"><img src="assets/images/logo/logo_footer.png" alt=""></a>
                            </div>
                            <div class="desc_footer">
                                <p><i class="fa fa-home"></i> <span> 123 Main Street, Anytown, CA 12345 - USA.</span> </p>
                                <p><i class="fa fa-phone"></i> <span>  (0) 800 456 789</span> </p>
                                <p><i class="fa fa-envelope-open-o"></i> <span> Contact@posthemes.com</span> </p>
                                <div class="link-follow-footer">
                                    <ul class="footer-social-share">
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- footer-info-area end -->
                   </div>
                   <div class="col-lg-4 col-md-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Products</h3>
                                    </div>
                                    <div class="desc_footer">
                                        <ul>
                                            <li><a href="#">Prices drop</a></li>
                                            <li><a href="#"> New products</a></li>
                                            <li><a href="#"> Best sales</a></li>
                                            <li><a href="#">  Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Our company</h3>
                                    </div>
                                    <div class="desc_footer">
                                        <ul>
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="#">About us</a></li>
                                            <li><a href="#">Contact us</a></li>
                                            <li><a href="#">Sitemap</a></li>
                                            <li><a href="#">Stores</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                        </div>
                   </div>
                   <div class="col-lg-4 col-md-12">
                        <!-- footer-info-area start -->
                        <div class="footer-info-area">
                            <div class="footer-title">
                                <h3>Join Our Newsletter Now </h3>
                            </div>
                            <div class="desc_footer">
                                <div class="input-newsletter">
                                   <input name="email" class="input_text" value="" placeholder="Your email address" type="text">
                                   <button class="btn-newsletter"><i class="fa fa-paper-plane-o"></i></button>
                                </div>
                                <p>Get E-mail updates about our latest shop and special offers.</p>
                            </div>
                        </div>
                        <!-- footer-info-area end -->
                   </div>
               </div>
           </div>
        </div>
        <!-- footer-top end -->
        <!-- footer-buttom start -->
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="copy-right">
                            <p>Copyright 2018 <a href="#">Boyka Themes</a>. All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="payment">
                            <img src="assets/images/icon/1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-buttom start -->
    </footer>
    <!-- Footer Aare End -->

    <!-- Modal Algemeen Uitgelicht start -->
    <div class="modal fade modal-wrapper" id="exampleModalCenter" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area row">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                           <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <img src="assets/images/product/1.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="assets/images/product/2.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="assets/images/product/3.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="assets/images/product/5.jpg" alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">										
                                    <div class="sm-image"><img src="assets/images/product/1.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="assets/images/product/2.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="assets/images/product/3.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="assets/images/product/4.jpg" alt="product image thumb"></div>
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6">
                            <div class="product-details-view-content">
                                <div class="product-info">
                                    <h2>Healthy Melt</h2>
                                    <div class="price-box">
                                        <span class="old-price">$70.00</span>
                                        <span class="new-price">$76.00</span>
                                        <span class="discount discount-percentage">Save 5%</span>
                                    </div>
                                    <p>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.</p>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Size</label>
                                            <select class="form-control-select" >
                                                <option value="1" title="S" selected="selected">S</option>
                                                <option value="2" title="M">M</option>
                                                <option value="3" title="L">L</option>
                                            </select>
                                        </div>
                                        <div class="produt-variants-color">
                                            <label>Color</label>
                                            <ul class="color-list">
                                                <li><a href="#" class="orange-color active"></a></li>
                                                <li><a href="#" class="paste-color"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <!-- Modal Algemeen Uitgelicht end -->
    
    
</div>
<!-- Main Wrapper End -->

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="assets/js/ajax-mail.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>


</body>


<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:01:31 GMT -->
</html>