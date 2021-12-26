<?php
require_once('db_connect.php');
session_start();
if(!isset($_SESSION['shopping_cart'])){
    $item_array = array();
    $_SESSION["shopping_cart"]= $item_array; 
}
if(isset($_SESSION['userId'])) {
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
}
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
$sql2 = "SELECT * FROM product WHERE active=1 ";
if($_POST){
    if(isset($_POST['search']) and !empty($_POST['search'])){
        $search=$_POST['search'];
        $sql2.="AND product_name like '%".$search."%'";
    }
}
if ($_GET){
if(isset($_GET['price']) and !empty($_GET['price'])){
    $sql2.=" AND ".$_GET['price']."";
}
if(isset($_GET['gender']) and !empty($_GET['gender'])){
    $sql2.=" AND gender_id = ".$_GET['gender']."";
}
if(isset($_GET['cat']) and !empty($_GET['cat'])){
    $sql2.=" AND categories_id = ".$_GET['cat']."";
}
if(isset($_GET['size']) and !empty($_GET['size'])){
    $sql2.=" AND size_id = ".$_GET['size']."";
}
if(isset($_GET['size']) and !empty($_GET['size'])){
    $sql2.=" AND size_id = ".$_GET['size']."";
}
}
var_dump($sql2);
$query2 = $connect->query($sql2);
$output = array('data' => array());
if($query2->num_rows > 0) {
while($row = $query2->fetch_array()) {
$imageUrl = substr($row[2], 3);
$imageUrl = '../../'.$imageUrl;
$productImage = "<img class='img-round' src='".$imageUrl."' style='height:150px; width:150px;'  />";
$image = "<img class='img-round' src='".$imageUrl."' style='height:80px; width:102px;'  />";
$output['data'][] = array( 
$row[1],
$productImage,
$row[3],
$row[5],
$row[6],
$row[8],
$row[11],
$row[13],
$row[0],
$row[14],
$image
);
}
}else{

}
if(isset($_SESSION['userId'])) {
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
}
$sql3="SELECT * from categories where categories_active =1";
$sql4="SELECT * from gender";
$sql5="SELECT * from size";
$result1 = $connect->query($sql3);
$result2 = $connect->query($sql4);
$result3 = $connect->query($sql5);
$output1 = array('data' => array());
$output2 = array('data' => array());
$output3 = array('data' => array());
if($result1->num_rows > 0) {
while($row = $result1->fetch_array()) {
$catid = $row[0];
$catname=$row[1];
$output1['data'][] = array(      
        // image
        $catid,
        // product name
        $catname
);
}
} 
if($result2->num_rows > 0) {
while($row = $result2->fetch_array()) {
$genderid = $row[0];
$gender=$row[1];
$output2['data'][] = array(      
        // image
        $genderid,
        // product name
        $gender
);
}
} 
if($result3->num_rows > 0) {
while($row = $result3->fetch_array()) {
$sizeid = $row[0];
$size=$row[1];
$output3['data'][] = array(      
        // image
        $sizeid,
        // product name
        $size
);
}
} 
$nb = count($_SESSION["shopping_cart"]);

?>



<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:01:54 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop</title>
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
                                    <li  class="active"><a href="index.html">Home  <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.php">Home Page</a></li>                                            
                                        </ul>
                                    </li>
                                    <li><a href="shop.html">Shop <i class="fa fa-angle-down"></i></a>
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
                                    <li><a href="contact-us.html">Contact us</a></li>
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
    
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Categories</h2>
                        </div>
                        <!-- category-sub-menu start -->
                        <div class="category-sub-menu">
                            <ul>
                                <?php  
                          foreach ($output1['data'] as $key => $value)
                          { ?> 
                                <li class="has-sub"><a href="# "><?php echo $output1['data'][$key][1]; ?></a>
                                    <ul>
                                        <?php  
                          foreach ($output2['data'] as $key => $value)
                          { ?> 
                                        <li><a href="#"><?php echo $output2['data'][$key][1] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div>
                    <!--sidebar-categores-box end  -->
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Filter By</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <button class="btn-clear-all">Clear all</button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Price</h5>
                            <div class="price-checkbox">
                                <form action="#">
                                    <ul> 
                                        <li><input type="radio" name="price-filter" checked="checked"><a href="#">10.00DT - 15.00DT</a></li>
                                        <li><input type="radio" name="price-filter"><a href="#">16.00DT - 25.00DT </a></li>
                                        <li><input type="radio" name="price-filter"><a href="#">26.00DT - 35.00DT</a></li>
                                        <li><input type="radio" name="price-filter"><a href="#">36.00DT - 45.00DT (1)</a></li>
                                        <li><input type="radio" name="price-filter"><a href="#"> 46.00DT - 55.00DT (5)</a></li>
                                        <li><input type="radio" name="price-filter"><a href="#"> 56.00DT - 100.00DT (1)</a></li>
                                        <li><input type="radio" name="price-filter"><a href="#"> >>>100DT (2) </a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Size</h5>
                            <div class="size-checkbox">
                                <form action="#">
                                    <ul>
                                        <?php  
                                        foreach ($output3['data'] as $key => $value)
                                            { ?> 
                                        <li><input type="checkbox" name="product-size"><a href="#"><?php echo $output3['data'][$key][1]; ?></a>
                                            <?php } ?>
                                        </li>                    
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->                        
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->                     
                        <!-- filter-sub-area end -->
                    </div>
                    <!--sidebar-categores-box end  -->

                    <!-- shop-banner start -->
                    <div class="shop-banner">
                        <div class="single-banner">
                            <a href="shop.php"><img src="assets/images/banner/advertising-s1.jpg" alt=""></a>
                        </div>
                    </div>
                    <!-- shop-banner end -->
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar mt-95">
                        <div class="shop-bar-inner">
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <ul class="nav shop-item-filter-list" role="tablist">
                                    <li class="active"><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                    <li><a data-toggle="tab"  href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <!-- shop-item-filter-list end -->
                            </div>
                            <div class="toolbar-amount">
                                <span>Showing 1 to 9 of 15</span>
                            </div>
                        </div>
                        <!-- product-select-box start -->
                        <div class="product-select-box">
                            <div class="product-short">
                                <p>Sort By:</p>
                                <select class="nice-select">                                    
                                    <option value="sales">Name (A - Z)</option>
                                    <option value="sales">Name (Z - A)</option>
                                    <option value="dateadded">Date added</option>
                                    <option value="rating">Price (Low &gt; High)</option>
                                </select>
                            </div>
                        </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane active">
                                <div class="shop-product-area">
                                    <div class="row">
                                        <?php  
                                        foreach ($output['data'] as $key => $value)
                                            { ?> 
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mt-30">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-details.html"><?php echo $output['data'][$key][1]; ?></a>
                                                    <?php if (strtotime($output['data'][$key][7]) > strtotime('-5 days')): ?>
                                                    <span class="label-product label-new">new</span>
                                                    <?php endif; ?>
                                                    <?php if ($output['data'][$key][9] > 0): ?>
                                                    <span class="label-product label-sale">-<?php echo $output['data'][$key][9]; ?>%</span>
                                                <?php endif; ?>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="product-details.html"><?php echo $output['data'][$key][0]; ?></a></h3>
                                                    <div class="price-box">
                                                        <?php 
                                                        if($output['data'][$key][9]>0){
                                                        $price1= $output['data'][$key][4] - $output['data'][$key][4]*$output['data'][$key][9]/100;
                                                        ?>
                                                        <span class="new-price"><?php echo $price1;?> DT</span>
                                                        <span class="old-price"><?php echo $output['data'][$key][4];?> DT</span>
                                                        <?php }else{?>                                                        
                                                        <span class="new-price"><?php echo $output['data'][$key][4];?> DT</span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="product-action">
                                                       <form action="productdetails.php?action=add&id=<?php echo $output['data'][$key][8]; ?>" method ="POST">
                                                        <input name="quantity" type="hidden" value="1" style="width: 21% ; height: 21%;">
                                                        <input type="hidden" name="idprod" value="<?php echo $output['data'][$key][8];?>">
                                                        <input type="hidden" name="hidden_name" value="<?php echo $output['data'][$key][0]; ?>" /> 
                                                        <input type="hidden" name="hidden_picture" value="<?php echo $output['data'][$key][10]; ?>" />
                                                        <?php if($output['data'][$key][9]>0){?>
                                                        <input type="hidden" name="hidden_price" value="<?php echo $price1; ?>" />                           
                                                        <?php }else{?>
                                                        <input type="hidden" name="hidden_price" value="<?php echo $output['data'][$key][4]; ?>" />
                                                        <?php } ?>
                                                        <button class="add-to-cart" value="Add to Cart" name="add_to_cart" type="submit"><i class="fa fa-plus"></i> Add to cart</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                       <?php 
                                   }
                                       ?>
                                    </div>
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane">
                                <div class="row">
                                    <div class="col">
                                        <?php  
                                        foreach ($output['data'] as $key => $value)
                                            { ?> 
                                        <div class="row product-layout-list">                                            
                                            <div class="col-lg-4 col-md-5">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <a href="product-details.html"><?php echo $output['data'][$key][1]; ?></a>
                                                        <?php if (strtotime($output['data'][$key][7]) > strtotime('-5 days')): ?>
                                                    <span class="label-product label-new">new</span>
                                                    <?php endif; ?>
                                                        <?php if ($output['data'][$key][9] > 0): ?>
                                                    <span class="label-product label-sale">-<?php echo $output['data'][$key][9]; ?>%</span>
                                                <?php endif; ?>                                                        
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="product_desc">
                                                    <!-- single-product-wrap start -->
                                                    <div class="product-content-list">
                                                        <h3><a href="product-details.html"><?php echo $output['data'][$key][0]; ?></a></h3>              
                                                        <div class="price-box">
                                                        <?php 
                                                        if($output['data'][$key][9]>0){
                                                        $price1= $output['data'][$key][4] - $output['data'][$key][4]*$output['data'][$key][9]/100;
                                                        ?>
                                                        <span class="new-price"><?php echo $price1;?> DT</span>
                                                        <span class="old-price"><?php echo $output['data'][$key][4];?> DT</span>
                                                        <?php }else{?>                                                        
                                                        <span class="new-price"><?php echo $output['data'][$key][4];?> DT</span>
                                                        <?php } ?>
                                                    </div>
                                                        <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                                        <p><?php echo $output['data'][$key][6];?></p>
                                                    </div>
                                                    <!-- single-product-wrap end -->
                                                </div>
                                            </div>
                                        </div>
                                         <?php 
                                         }
                                       ?>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- paginatoin-area start -->
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <p>Showing 1-12 of 13 item(s)</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                              <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- paginatoin-area end -->
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    
    
    <!-- Footer Aare Start -->
    <footer class="footer-area mt--100">
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
<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var cat = get_filter('cat');
        var gender = get_filter('gender');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, cat:cat, gender:gender},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    

});
</script>
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


<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:01:56 GMT -->
</html>