<?php
session_start();
require_once 'database/connection.php';

if (isset($_POST['clear'])){
    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit();
}
if (isset($_POST['delete'])){
    $key=(string)$_POST['id'];
    unset($_SESSION['cart'][$key]);
    header('Location: cart.php');
    exit();
}
if (isset($_POST['decrease'])){
    $key = (string)$_POST['id'];

    if (array_key_exists($key,$_SESSION['cart'])){
        $query = 'SELECT price FROM products WHERE id=:id';
        $stmt =$connection->prepare($query);
        $stmt->bindParam(':id',$key, PDO::PARAM_INT);
        $stmt->execute();
        $product=$stmt->fetch();
        if($_SESSION['cart'][$key]['quantity'] > 1){
            $_SESSION['cart'][$key]['quantity']--;
            $_SESSION['cart'][$key]['total_price'] -=$product['price'];
            $_SESSION['cart'][$key]['total_price']=(float)$_SESSION['cart'][$key]['total_price'];
        }
    }

    header('Location: cart.php');
    exit();
}
$cart=$_SESSION['cart'] ?? [];

if (isset($_POST['add'])){
    $id=(int)$_POST['id'];
    try{
        $query='SELECT name,price FROM products WHERE id=:id';
        $stmt=$connection->prepare($query);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $product=$stmt->fetch();
        $key =(string)$id;

        if (array_key_exists($key,$cart)){
            $cart[$key]['quantity']++;
            $cart[$key]['total_price'] += $cart[$key]['price'];
            $cart[$key]['total_price'] =(float)$cart[$key]['total_price'];
        }else{
            $cart[$key] =[
                'name'      =>$product['name'],
                'price'     =>(float)$product['price'],
                'quantity'  =>(int)1,
                'total_price'=>(float)$product['price']
            ];
        }
        $_SESSION['cart']= $cart;
        header('Location: cart.php');
        exit();
    }catch (Exception $e){
        die($e->getMessage());
    }
}
$total_price = !empty($cart) ?array_sum(array_column($cart,'total_price')):0;

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
    <div class="container">
        <br/>
        <h4><a href="index.php">Products</a></h4>
        <p class="text-center">Cart</p>
        <hr/>
        <div class="row">
            <?php if(empty($cart)):?>
                <div class="alert alert-warning">
                    Please add some products first.
                </div>
            <?php endif;?>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <td>Sl.</td>
                    <td>Product Title</td>
                    <td>Quantity</td>
                    <td>Total Price</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php $i=1;
                foreach ($cart as $key => $product):?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $product['name'];?></td>
                        <td>BDT <?php echo number_format($product['price'],2);?></td>
                        <td>BDT <?php echo number_format($product['total_price'],2);?></td>
                        <td>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $key;?>">
                                <button type="submit"name="delete" class="btn btn-sm btn-danger mb-2">
                                    [x]
                                </button>
                            </form>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $key;?>">
                                <button type="submit" name="decrease" class="btn btn-sm btn-primary">
                                    [-]
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total Price</td>
                    <td>BDT <?php echo number_format($total_price,2);?></td>
                    <td class="mb-5">
                        <a href="checkout.php" class="btn btn-success">Checkout</a>
                        <form action="cart.php" method="post">
                            <button type="submit"name="clear"class="btn btn-sm btn-danger mt-2">
                                [x]
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
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
