<?php
require_once('db_connect.php');
session_start();
$idproduct= $_POST['idproduct'];
$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
        product.categories_id, product.quantity, product.price, product.active, product.status,product.discount,product.dateadded,product.description FROM product
        WHERE product.product_id = $idproduct";
$query = $connect->query($sql);
if($query->num_rows > 0) {   
$result = $query->fetch_assoc();
$imageUrl = substr($result['product_image'], 3);
$imageUrl = '../../'.$imageUrl;
$productImage = "<img class='img-round' src='".$imageUrl."' style='height:150px; width:150px;'  />"; 
}
if(!isset($_SESSION['shopping_cart'])){
    $item_array = array();
    $_SESSION["shopping_cart"]= $item_array; 
}
if(isset($_SESSION['userId'])) {
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
}elseif(!isset($_SESSION['userId'])){
echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('Login first !');
                 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/login-register.php\"); 
                </SCRIPT>";
}
$nb = count($_SESSION['shopping_cart']);
?>
<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:02:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Product</title>
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
                                               <li><a href="#">Euro ???</a></li>
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
                                    <form action="#" class="search-box-inner">
                                        <input type="text" placeholder="Search our catalog">
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
    
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
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
                <div class="col-12">
                    <div class="account-dashboard">
                        <div class="row">
                            <div class="col-md-12 col-lg-10">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">                                    
                                    <div class="tab-pane active">
                                        <h3>Editing : <?php echo $result['product_name'];?></h3>
                                         <div class="login">
                                            <div class="login-form-container">
                                                <div class="account-login-form">
                                                    <form action="updateproductdetails.php" method="GET" enctype="multipart/form-data">
                                                        
                                                        <div class="account-input-box">                                                            
                                                            <label>Product name</label>
                                                            <input type="text" name="name" placeholder="<?php echo $result['product_name'] ?>">
                                                            <label>Product price</label>
                                                            <input type="text" name="price" placeholder="<?php echo $result['price'] ?>">
                                                            <label>Discount</label>
                                                            <input type="text" name="discount" placeholder="<?php echo $result['discount'] ?>">
                                                             <label>Quantity</label>
                                                            <input type="text" name="quantity" placeholder="<?php echo $result['quantity'] ?>">
                                                            <input type="hidden" name="productid" value="<?php echo $result['product_id'] ?>">
                                                            <label>descripton</label>
                                                            <textarea id="description" name="description" style="width: 100%;" placeholder="<?php echo $result['description'] ?>"></textarea> 
                                                            <label>Brand :</label>
                                                            <select class="form-control" id="brandName" name="brandName">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php 
                                                            $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                                                    $result = $connect->query($sql);

                                                                    while($row = $result->fetch_array()) {
                                                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                    } // while
                                                                    
                                                            ?>
                                                          </select>
                                                          <label>Category :</label>
                                                          <select type="text" class="form-control" id="categoryName" placeholder="Product Name" name="categoryName" >
                                                        <option value="">~~SELECT~~</option>
                                                        <?php 
                                                        $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                                                $result = $connect->query($sql);

                                                                while($row = $result->fetch_array()) {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                } // while
                                                                
                                                        ?>
                                                      </select>
                                                      <label>Gender :</label>
                                                      <select type="text" class="form-control" id="genderName" name="genderName" >
                                                        <option value="">~~SELECT~~</option>
                                                        <?php 
                                                        $sql = "SELECT id, gender FROM gender";
                                                                $result = $connect->query($sql);

                                                                while($row = $result->fetch_array()) {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                } // while
                                                                
                                                        ?>
                                                      </select>
                                                      <label>Size :</label>
                                                      <select type="text" class="form-control" id="sizeName" name="sizeName" >
                                                            <option value="">Product size :</option>
                                                            <?php 
                                                            $sql = "SELECT id, size FROM size";
                                                                    $result = $connect->query($sql);

                                                                    while($row = $result->fetch_array()) {
                                                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                    } // while
                                                                    
                                                            ?>
                                                          </select>
                                                        </div>                                                        
                                                        <div class="button-box">
                                                            <button class="btn default-btn" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                          
                                            
                                    

                                    
                                
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Account details </h3>
                                        <div class="login">
                                            <div class="login-form-container">
                                                <div class="account-login-form">
                                                    <form action="updatedetails.php" method="post">
                                                        <label>Social title</label>
                                                        <div class="input-radio">
                                                            <span class="custom-radio"><input type="radio" value="Male" name="id_gender"> Male</span>
                                                            <span class="custom-radio"><input type="radio" value="Female" name="id_gender"> Female</span>
                                                        </div>
                                                        <div class="account-input-box">
                                                            <label>First Name</label>
                                                            <input type="text" name="firstname" placeholder="<?php echo $result['firstname'] ?>">
                                                            <label>Last Name</label>
                                                            <input type="text" name="lastname" placeholder="<?php echo $result['lastname'] ?>">
                                                            <label>Email</label>
                                                            <input type="text" name="useremail" placeholder="<?php echo $result['email'] ?>">
                                                            <label>Phone number</label>
                                                            <input type="text" name="phonenumber" placeholder="<?php echo $result['phonenumber'] ?>">
                                                            <label>Password</label>
                                                            <input type="password" name="userpassword" placeholder="new password">
                                                             <label>Old Password</label>
                                                            <input type="password" name="useroldpassword" placeholder="old password">
                                                            <input type="hidden" name="userid" value="<?php echo $result['user_id'] ?>">
                                                            <label>Birthdate</label>
                                                            <input type="date" placeholder="Birthdate" name="birthday">
                                                        </div>
                                                        <div class="example">
                                                          (E.g.: 05/31/1970)
                                                        </div>
                                                        <div class="custom-checkbox">
                                                            <input type="checkbox" value="1" name="optin">
                                                            <label>Receive offers from our partners</label>
                                                        </div>
                                                        <div class="custom-checkbox">
                                                            <input type="checkbox" value="1" name="newsletter">
                                                            <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                        </div>
                                                        <div class="button-box">
                                                            <button class="btn default-btn" type="submit">Save</button>
                                                        </div>
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


<!-- Mirrored from demo.devitems.com/boyka-v2/boyka/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2019 16:02:35 GMT -->
</html>