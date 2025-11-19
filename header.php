<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("configs/config.php");
require_once("helpers/helper.php");
require_once("libraries/library.php");
require_once("models/model.php");
require_once("controllers/controller.php");
?>


<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>Educavo - Education HTML Template</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="<?=$base_url?>/assets/images/fav.png">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/font-awesome.min.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/animate.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/owl.carousel.css">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/slick.css">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/off-canvas.css">
        <!-- linea-font css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/fonts/linea-fonts.css">
        <!-- flaticon css  -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/fonts/flaticon.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/magnific-popup.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="<?=$base_url?>/assets/css/rsmenu-main.css">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/rs-spacing.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/style.css"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="<?=$base_url?>/assets/css/responsive.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .mb-2{
                margin-bottom: 0 !important;
            }
        </style>
    </head>
    <body class="home-style3">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'>
                    <img src="<?=$base_url?>/assets/images/pre-logo.png" alt="">
                </div>
            </div>
        </div>
        <!--Preloader area End here-->

        <!--Full width header Start-->
        <div class="full-width-header header-style2 ">
            <!--Header Start-->
            <header id="rs-header" class="rs-header">
                <!-- Topbar Area Start -->
                <div class="topbar-area d-none">
                    <div class="container">
                        <div class="row y-middle">
                            <div class="col-md-6">
                                <ul class="topbar-contact">
                                    <li>
                                        <i class="flaticon-email"></i>
                                        <a href="mailto:support@rstheme.com">support@rstheme.com</a>
                                    </li>
                                    <li>
                                        <i class="flaticon-call"></i>
                                        <a href="tel:+0885898745">(+088) 589-8745</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 text-right">
                                <ul class="topbar-right">
                                    <li class="login-register">
                                        <i class="fa fa-sign-in"></i>
                                        <a href="login.html">Login</a>/<a href="register.html">Register</a>
                                    </li>
                                    <li class="btn-part">
                                        <a class="apply-btn" href="#">Apply Now</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Topbar Area End -->

                <!-- Menu Start -->
                <div class="menu-area menu-sticky">
                    <div class="container-fluid">
                        <div class="row y-middle">
                            <div class="col-lg-4">
                                <div class="logo-cat-wrap">
                                    <div class="logo-part pr-90">
                                        <a href="index.html">
                                            <img src="<?=$base_url?>/assets/images/logo.png" alt="">
                                        </a>
                                    </div>
                                    <div class="categories-btn">
                                       <button type="button" class="cat-btn"><i class="fa fa-th"></i>Categories</button>
                                        <div class="cat-menu-inner">
                                            <ul id="cat-menu">
                                                <li><a href="<?=$base_url?>/chapter">chapters</a></li>
                                                <li><a href="<?=$base_url?>/lecture">Lecture</a></li>
                                                <li><a href="#">Category 3</a></li>
                                                <li><a href="#">Category 4</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 text-center">
                                <div class="rs-menu-area">
                                    <div class="main-menu pr-90 md-pr-15">
                                        <div class="mobile-menu">
                                            <a class="rs-menu-toggle">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                        </div>
                                        <nav class="rs-menu">
                                           <ul class="nav-menu">
                                              <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="index.php">Home</a>
                                                  <ul class="mega-menu"> 
                                                      <li class="mega-menu-container">
                                                          <div class="mega-menu-innner">
                                                              <div class="single-megamenu">
                                                                  <ul class="sub-menu">
                                                                      <li><a href="index.html">Main Demo</a> </li>
                                                                      <li><a href="index2.html">Online Course</a> </li>
                                                                      <li><a href="index3.html">University 01</a> </li>
                                                                      <li class="active"><a href="index4.html">E-Learning</a> </li>
                                                                      <li><a href="index5.html">Distance Learning</a> </li>
                                                                  </ul>
                                                              </div>
                                                              <div class="single-megamenu">
                                                                  <ul class="sub-menu last-sub-menu">
                                                                      <li><a href="index6.html">Personal Demo</a> </li>
                                                                      <li><a href="index7.html">Online Training</a> </li>
                                                                      <li><a href="index8.html">Online Learning</a> </li>
                                                                      <li><a href="index9.html">Kitchen Coach</a> </li>
                                                                      <li><a href="index10.html">University 02</a> </li>
                                                                  </ul>
                                                              </div>  
                                                              <div class="single-megamenu">
                                                                  <ul class="sub-menu last-sub-menu">
                                                                      <li><a href="index11.html">Kindergarten 01</a> </li>
                                                                      <li><a href="index12.html">Freelancing Course</a> </li>
                                                                      <li><a href="index13.html">Gym Coach</a> </li>
                                                                      <li><a href="index14.html">Courses Archive</a> </li>
                                                                      <li><a href="index15.html">Courses Hub</a> </li>
                                                                  </ul>
                                                              </div> 
                                                          </div>
                                                      </li>
                                                  </ul> <!-- //.mega-menu -->
                                              </li>
                                               <li class="menu-item-has-children">
                                                   <a href="#">About</a>
                                                   <ul class="sub-menu">
                                                       <li><a href="about.html">About One</a> </li>
                                                       <li><a href="about2.html">About Two</a> </li>
                                                   </ul>
                                               </li>

                                               <li class="menu-item-has-children">
                                                   <a href="#">Courses</a>
                                                   <ul class="sub-menu">
                                                    
                                                       <li><a href="<?php echo $base_url ?>/Courses/biology?subject_id=1&paper_id=1">Biology 1st Papper</a> </li>
                                                       <li><a href="<?php echo $base_url ?>/Courses/biology?subject_id=1&paper_id=2">Biology 2nd Papper</a> </li>
                   
                                                   </ul>
                                               </li>

                                               <li class="menu-item-has-children">
                                                   <a href="#">Pages</a>
                                                   <ul class="sub-menu">
                                                       <li class="menu-item-has-children right">
                                                           <a href="#">Team</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="team.html">Team One</a></li>
                                                               <li><a href="team2.html">Team Two</a></li>
                                                               <li><a href="team-single.html">Team Single</a></li>
                                                           </ul>
                                                       </li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Event</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="events-style1.html">Event One</a></li>
                                                               <li><a href="events-style2.html">Event Two</a></li>
                                                               <li><a href="events-style3.html">Event Three</a></li>
                                                           </ul>
                                                       </li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Gallery</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="gallery-style1.html">Gallery One</a></li>
                                                               <li><a href="gallery-style2.html">Gallery Two</a></li>
                                                               <li><a href="gallery-style3.html">Gallery Three</a></li>
                                                           </ul>
                                                       </li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Shop</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="shop.html">Shop</a></li>
                                                               <li><a href="shop-single.html">Shop Single</a></li>
                                                               <li><a href="cart.html">Cart</a></li>
                                                               <li><a href="checkout.html">Checkout</a></li>
                                                           </ul>
                                                       </li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Others</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="faq.html">FAQ</a></li>
                                                               <li><a href="error.html">404 Page</a></li>
                                                               <li><a href="login.html">Login</a></li>
                                                               <li><a href="register.html">Register</a></li>
                                                           </ul>
                                                       </li>
                                                   </ul>
                                               </li>

                                               <li class="menu-item-has-children">
                                                   <a href="#">Blog</a>
                                                   <ul class="sub-menu responsive-left">
                                                       <li><a href="blog.html">Blog</a></li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Blog Sidebar</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="blog-left.html">Blog Left Sidebar</a></li>
                                                               <li><a href="blog-right.html">Blog Right Sidebar</a></li>
                                                           </ul>
                                                       </li>
                                                       <li class="menu-item-has-children">
                                                           <a href="#">Single Post</a>
                                                           <ul class="sub-menu right">
                                                               <li><a href="blog-post-left.html">Post Left Sidebar</a></li>
                                                               <li><a href="blog-post-right.html">Post Right Sidebar</a></li>
                                                               <li><a href="blog-single.html">Full Width Post</a></li>
                                                           </ul>
                                                       </li>
                                                   </ul>
                                               </li>

                                               <li class="menu-item-has-children">
                                                   <a href="#">Contact</a>
                                                   <ul class="sub-menu responsive-left">
                                                      <li><a href="contact.html">Contact RRRR</a> </li>
                                                      <li><a href="contact2.html">Contact Two</a> </li>
                                                      <li><a href="contact3.html">Contact Three</a> </li>
                                                      <li><a href="contact4.html">Contact Four</a> </li>
                                                   </ul>
                                               </li>
                                           </ul> <!-- //.nav-menu -->
                                        </nav>                                         
                                    </div> <!-- //.main-menu -->
                                    <div class="expand-btn-inner">
                                        <ul>
                                            <li>
                                                <a class="hidden-xs rs-search short-border" data-target=".search-modal" data-toggle="modal" href="#">
                                                    <i class="flaticon-search"></i>
                                                </a>
                                            </li>
                                            <li class="icon-bar cart-inner no-border mini-cart-active">
                                                <a class="cart-icon">
                                                    <!-- <span class="cart-count">2</span> -->
                                                    <i class="flaticon-bag"></i>
                                                </a>
                                                <div class="woocommerce-mini-cart text-left">
                                                    <div class="cart-bottom-part">
                                                        <ul class="cart-icon-product-list">
                                                            <li class="display-flex">
                                                                <div class="icon-cart">
                                                                    <a href="#"><i class="fa fa-times"></i></a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <a href="cart.html">Law Book</a><br>
                                                                    <span class="quantity">1 × $30.00</span>
                                                                </div>
                                                                <div class="product-image">
                                                                    <a href="cart.html"><img src="<?=$base_url?>/assets/images/shop/1.jpg" alt="Product Image"></a>
                                                                </div>
                                                            </li>
                                                            <li class="display-flex">
                                                                <div class="icon-cart">
                                                                    <a href="#"><i class="fa fa-times"></i></a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <a href="cart.html">Spirit Level</a><br>
                                                                    <span class="quantity">1 × $30.00</span>
                                                                </div>
                                                                <div class="product-image">
                                                                    <a href="cart.html"><img src="<?=$base_url?>/assets/images/shop/2.jpg" alt="Product Image"></a>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                        <div class="total-price text-center">
                                                            <span class="subtotal">Subtotal:</span>
                                                            <span class="current-price">$85.00</span>
                                                        </div>

                                                        <div class="cart-btn text-center">
                                                            <a class="crt-btn btn1" href="cart.html">View Cart</a>
                                                            <a class="crt-btn btn2" href="checkout.html">Check Out</a>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>
                                        </ul>
                                        <a id="nav-expander" class="nav-expander style4">
                                          <span class="dot1"></span>
                                          <span class="dot2"></span>
                                          <span class="dot3"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu End -->

                <!-- Canvas Menu start -->
                <nav class="right_menu_togle hidden-md">
                    <div class="close-btn">
                        <div id="nav-close">
                            <div class="line">
                                <span class="line1"></span><span class="line2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="canvas-logo">
                        <a href="index.html"><img src="<?=$base_url?>/assets/images/logo-dark.png" alt="logo"></a>
                    </div>
                    <div class="offcanvas-text">
                        <p>We denounce with righteous indige nationality and dislike men who are so beguiled and demo  by the charms of pleasure of the moment data com so blinded by desire.</p>
                    </div>
                    <div class="offcanvas-gallery">
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/1.jpg"><img src="<?=$base_url?>/assets/images/gallery/1.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/2.jpg"><img src="<?=$base_url?>/assets/images/gallery/2.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/3.jpg"><img src="<?=$base_url?>/assets/images/gallery/3.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/4.jpg"><img src="<?=$base_url?>/assets/images/gallery/4.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/5.jpg"><img src="<?=$base_url?>/assets/images/gallery/5.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="<?=$base_url?>/assets/images/gallery/6.jpg"><img src="<?=$base_url?>/assets/images/gallery/6.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="map-img">
                        <img src="<?=$base_url?>/assets/images/map.jpg" alt="">
                    </div>
                    <div class="canvas-contact">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Canvas Menu end -->
            </header>
            <!--Header End-->
        </div>
        <!--Full width header End-->

		<!-- Main content Start -->
        <!-- <div class="main-content"> -->