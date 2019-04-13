<?php
require_once 'database/connection.php';
$query='SELECT id,name,slug,image,price FROM products';
$stmt=$connection->prepare($query);
$stmt->execute();
$products=$stmt->fetchAll();

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Customer Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
<!-- header start -->
<header>
    <div class="header-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-2">
                    <div class="logo"><a href="#"><img src="img/logo1.png" alt="" />
                        </a></div>
                </div>
                <div class="col-xl-9 col-lg-10">
                    <div class="hire-btn d-none d-lg-block float-right">
                        <a href="#">Hire-us</a>
                    </div>
                    <div class="main-menu float-right">
                        <nav id="mobile-menu-active">
                            <ul>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Portfolio</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Clients</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
<!-- slider-area start -->
<div class="slider-area">
    <img src="" alt="" />
    <div class="slider-active">
        <div class="single-active d-flex align-items-center justify-content-center text-center"
             style="background-image:url(img/slider1.jpg)">
            <div class="slider-inner">
                <h2>We are Monu<br>Creative Agency</h2>
                <p>We create Awesome and Powerful Websits for business!</p>
                <a class="btn"href="#">Purchase Now</a>
            </div>
        </div>
        <div class="single-active d-flex align-items-center justify-content-center text-center"
             style="background-image:url(img/slider1.jpg)">
            <div class="slider-inner">
                <div class="slider-icon">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.google.com/"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-viber"></i></a>
                </div>
                <h2>We are Monu<br>Creative Agency</h2>
                <p>We create Awesome and Powerful Websits for business!</p>
                <a class="btn"href="#">Purchase Now</a>
            </div>
        </div>
        <div class="single-active d-flex align-items-center justify-content-center text-center"
             style="background-image:url(img/slider1.jpg)">
            <div class="slider-inner">
                <div class="slider-icon">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-viber"></i></a>
                </div>
                <h2>We are Monu<br>Creative Agency</h2>
                <p>We create Awesome and Powerful Websits for business!</p>
                <a class="btn"href="#">Purchase Now</a>
            </div>
        </div>
    </div>
</div>
<main role="main">

    <section class="jumbotron text-center mt-2">
        <div class="container">
            <h1 class="jumbotron-heading">Welcome to our store!</h1>
            <p class="lead text-muted">Browse our products and buy easily.</p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <?php foreach($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 src="<?php echo $product['image']; ?>" alt="">

                            <div class="card-body">
                                <p class="card-text"><?php echo $product['name']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form action="cart.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $product['id'];?>">
                                            <button type="submit" class="btn btn-success btn-block" name="add">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                    <span class="text-muted">BTD <?php echo $product['price'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>

</main>

<footer class="black-bg">
    <div class="footer-area pt-70 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget mb-60">
                        <h3>Contact Us</h3>
                        <ul class="contact-list">
                            <li>1 (800) 686-6688</li>
                            <li>info.mulidesign@gmail.com</li>
                            <li>40 Baria Sreet 133/2 </li>
                            <li>Network City,Bangladesh</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget clearfix mb-30">
                        <h3>Usefull links</h3>
                        <ul class="footer-link">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Single Services</a></li>
                            <li><a href="#">Work</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget mb-30">
                        <h3>Blog & News</h3>
                        <ul>
                            <li>
                                <div class="news-thumb">
                                    <a href="#"><img src="img/block/blog1.jpg" alt="" /></a>
                                </div>
                                <div class="news-title">
                                    <h4><a href="#">How to Improve Your Sales Volume</a></h4>
                                    <span>20 January 2019</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="footer-blog">
                            <li>
                                <div class="news-thumb">
                                    <a href="#"><img src="img/block/blog2.jpg" alt="" /></a>
                                </div>
                                <div class="news-title">
                                    <h4><a href="#">How to Improve Your Sales Volume</a></h4>
                                    <span>20 January 2019</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-border">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="copyright-text">
                            <p>copyright @2019 Mugli.All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="footer-menu  text-center text-md-right">
                        <div class="col-xl-6 col-lg-6 col-md-6">
					 <span>
					  <ul>
					  	<li><a href="#">Privacy </a></li>
					  	<li><a href="#">Contact</a></li>
					  	<li><a href="#">Support</a></li>
					  </ul>
					 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>










<script src="js/vendor/modernizr-3.6.0.min.js"></script>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.meanmenu.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>