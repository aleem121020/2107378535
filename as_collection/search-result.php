<?php
session_start();
error_reporting(0);
include('includes/config.php');
$find="%{$_POST['product']}%";
$findresult="{$_POST['product']}";
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
						echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
      
      
    <title>AS Collection</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
    
    <meta name="keywords" content="">
    <meta name="description" content="">
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.svg" />
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="assets/css/plugins.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="assets/css/style-min.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
    </head>
<?php include 'header.php'?>

            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Search results</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a> <span class="main-title"><i class="icon anm anm-angle-right-l"></i>Search results</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">
                    <!-- Search Form -->
                    <div class="search-results-form mb-4 pb-4 mb-lg-5 pb-lg-5 border-bottom">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                <div class="page-title text-center mb-3">
                                    <h2 class="mb-2">Results for "<?php echo $findresult?>"</h2>
                                </div>
                                <!--Search form-->
                                <form action="search-result.php" method="post" name="search" class="searchForm">
                                    <div class="input-group">
                                        <input type="text" name="product" class="form-control" placeholder="Search..." required />                                   
                                        <button class="btn btn-primary" name="search" type="submit">Search</button>
                                    </div>
                                </form>
                                <!--End Search form-->

                            </div>
                        </div>
                    </div>
                    <!-- End Search Form -->

                    <div class="row">
                        <!--Sidebar-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar sidebar-bg filterbar">
                            <div class="closeFilter d-block d-lg-none"><i class="icon anm anm-times-r"></i></div>
                            <div class="sidebar-tags sidebar-sticky clearfix">
                                <!--Categories-->
                                <div class="sidebar-widget clearfix categories filterBox filter-widget">
                                    <div class="widget-title"><h2>Categories</h2></div>
                                    <div class="widget-content filterDD">
                                        <ul class="sidebar-categories scrollspy morelist clearfix">
                                            <?php
                                                $sql = "SELECT id, categoryName FROM category";
                                                $result = $con->query($sql);
                                                
                                                if ($result->num_rows > 0) {
                                                  // output data of each row
                                                  while($row = $result->fetch_assoc()) {
                                                    echo '<li class="lvl1 sub-level more-item"><a href="#;" class="site-nav">'.$row["categoryName"].'</a><ul class="sublinks">';
                                                    
                                                    $sql2 = "SELECT productName, id FROM products WHERE category=".$row["id"];
                                                    $result2 = $con->query($sql2);
                                                    
                                                    if ($result2->num_rows > 0) { 
                                                      while($row2 = $result2->fetch_assoc()) {
                                                        echo '<li class="lvl2"><a href="product-details.php?pid='.$row2['id'].'" class="site-nav">'.$row2["productName"].'</a></li>';
                                                      }
                                                    } else{
                                                        echo "<li class='lvl2'>No Product Found</li>";
                                                    }
                                                    
                                                    echo '</ul></li>';
                                                  }
                                                } else {
                                                  echo "<li class='lvl2'>No Result</li>";
                                                }
                                            ?>
                                            <!-- <li class="lvl1 sub-level more-item"><a href="#;" class="site-nav">category</a>
                                                <ul class="sublinks">
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                </ul>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <!--Categories-->
                               
                                <!--Banner-->
                                <div class="sidebar-widget static-banner p-0">
                                    <a href="#"><img class="rounded-0 blur-up lazyload" data-src="assets/images/banners/shop-banner.jpg" src="assets/images/banners/shop-banner.jpg" alt="image" width="274" height="367"></a>
                                </div>
                                <!--End Banner-->
                            </div>
                        </div>
                        <!--End Sidebar-->

                        <!--Products-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                           <!--Product Grid-->
                           <div class="grid-products grid-view-items">
                                <div class="row col-row product-options row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                                   
                                        <?php
                                            $ret=mysqli_query($con,"select * from products where productName like '$find'");
                                            $num=mysqli_num_rows($ret);
                                            if($num>0)
                                                {
                                                     while ($row=mysqli_fetch_array($ret)) 
                                                {?>
                                           
                                            <div class="item col-item">
                                                <div class="product-box">
                                                    <!-- Start Product Image -->
                                                    <div class="product-image">
                                                        <!-- Start Product Image -->
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>" class="product-img rounded-3">
                                                            <!-- Image -->
                                                            <img class="blur-up lazyload" data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="Product" title="<?php echo htmlentities($row['productName']);?>" width="625" height="808" />
                                                            <!-- End Image -->
                                                        </a>
                                                        <!-- End Product Image -->
                                                    </div>
                                                    <!-- Start Product Details -->
                                                    <div class="product-details text-center">
                                                        <!-- Product Name -->
                                                        <div class="product-name">
                                                            <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                        </div>
                                                        <!-- End Product Name -->
                                                        <!-- Product Price -->
                                                        <div class="product-price">
                                                            <span class="price">RS: <?php echo htmlentities($row['productPrice']);?>.00 &nbsp; <del class="old-price"> RS: <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00</del></span>
                                                        </div>
                                                        <!-- End Product Price -->
                                                        <div class="view-collection mt-md-2">
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"  class="btn btn-secondary btn-sm">Add Cart &nbsp; <i class="icon anm anm-cart-l"></i></a> <a href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist" class="btn btn-secondary btn-sm mt-2"> Wishlist &nbsp; <i class="icon anm anm-heart-l"></i></a>
                                                            <?php } else {?>
                                                                <a href="" style=" cursor: not-allowed;" onclick="event.preventDefault();" class="btn btn-secondary btn-sm">Out of Stock &nbsp; <i class="icon anm anm-cart-l"></i></a> <a href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist" class="btn btn-secondary btn-sm mt-2"> Wishlist &nbsp; <i class="icon anm anm-heart-l"></i></a>
                                                             <?php } ?>
                                                        </div>
                                                    </div>
                                                    <!-- End product details -->
                                                </div>
                                            </div>
                                            <?php }} else{ ?>
                                                <h4 style="min-width:300px; max-width:500px; width:auto; color: #888;">No Search Result Found! </h4>
                                            <?php } ?>

                                </div>

                                
                            </div>
                            <!--End Product Grid-->
                        </div>
                        <!--End Products-->
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

            <!--Footer-->
            <div class="footer">
                <div class="newsletterbg clearfix">
                    <div class="container">
                        <form action="#" method="post" class="footer-newsletter">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3 mb-md-0">
                                    <label class="h3 mb-1 clr-none">Sign Up Our Newsletter & Get 10% OFF</label>
                                    <p>Sign up to stay in the loop. Receive updates, access to exclusive deals, and more.</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <input type="email" class="form-control input-group-field newsletter-input" name="email" value="" placeholder="Enter your email address..." required />
                                        <button type="submit" class="input-group-btn btn btn-secondary newsletter-submit" name="commit">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer-top clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Informations</h4>
                                <ul>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="aboutus-style1.html">About us</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="privacy-policy.html">Privacy policy</a></li>
                                    <li><a href="#">Terms &amp; condition</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Quick Shop</h4>
                                <ul>
                                    <li><a href="#">Bags &amp; Accessories</a></li>
                                    <li><a href="#">Tools &amp; Parts</a></li>
                                    <li><a href="#">Vegetables</a></li>
                                    <li><a href="#">Jewelry</a></li>
                                    <li><a href="#">Cosmetics</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Customer Services</h4>
                                <ul>
                                    <li><a href="#">Request Personal Data</a></li>
                                    <li><a href="faqs-style1.html">FAQ's</a></li>
                                    <li><a href="contact-style1.html">Contact Us</a></li>
                                    <li><a href="#">Orders and Returns</a></li>
                                    <li><a href="#">Support Center</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-contact">
                                <h4 class="h4">Contact Us</h4>
                                <p class="address d-flex"><i class="icon anm anm-map-marker-al pt-1"></i> 55 Gallaxy Enque, 2568 steet, 23568 NY</p>
                                <p class="phone d-flex align-items-center"><i class="icon anm anm-phone-l"></i>  <b class="me-1 d-none">Phone:</b> <a href="tel:401234567890">(+40) 123 456 7890</a></p>
                                <p class="email d-flex align-items-center"><i class="icon anm anm-envelope-l"></i> <b class="me-1 d-none">Email:</b> <a href="mailto:info@example.com">info@example.com</a></p>
                                <ul class="list-inline social-icons mt-3">
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="icon anm anm-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="icon anm anm-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Pinterest"><i class="icon anm anm-pinterest-p"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="icon anm anm-linkedin-in"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="icon anm anm-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Youtube"><i class="icon anm anm-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>               
                    </div>
                </div>
                <div class="footer-bottom clearfix">
                    <div class="container">
                        <div class="d-flex-center flex-column justify-content-md-between flex-md-row-reverse">
                            <ul class="payment-icons d-flex-center mb-2 mb-md-0">
                                <li><i class="icon anm anm-cc-visa"></i></li>
                                <li><i class="icon anm anm-cc-mastercard"></i></li>
                                <li><i class="icon anm anm-cc-amex"></i></li>
                                <li><i class="icon anm anm-cc-paypal"></i></li>
                                <li><i class="icon anm anm-cc-discover"></i></li>
                                <li><i class="icon anm anm-cc-stripe"></i></li>
                                <li><i class="icon anm anm-cc-jcb"></i></li>
                            </ul>
                            <div class="copytext">&copy; 2023 Hema. All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Footer-->

            <!--Scoll Top-->
            <div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
            <!--End Scoll Top-->

            <!--MiniCart Drawer-->
            <div id="minicart-drawer" class="minicart-right-drawer offcanvas offcanvas-end" tabindex="-1">
                <!--MiniCart Empty-->
                <div id="cartEmpty" class="cartEmpty d-flex-justify-center flex-column text-center p-3 text-muted d-none">
                    <div class="minicart-header d-flex-center justify-content-between w-100">
                        <h4 class="fs-6">Your cart (0 Items)</h4>
                        <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                    </div>
                    <div class="cartEmpty-content mt-4">
                        <i class="icon anm anm-cart-l fs-1 text-muted"></i> 
                        <p class="my-3">No Products in the Cart</p>
                        <a href="index.php" class="btn btn-primary cart-btn">Continue shopping</a>
                    </div>
                </div>
                <!--End MiniCart Empty-->

                <!--MiniCart Content-->
                <div id="cart-drawer" class="block block-cart">
                    <div class="minicart-header">
                        <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                        <h4 class="fs-6">Your cart (2 Items)</h4>
                    </div>
                    <div class="minicart-content">
                        <ul class="m-0 clearfix">
                            <li class="item d-flex justify-content-center align-items-center">
                                <a class="product-image rounded-0" href="product-layout1.html">
                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/cart-product-img1.jpg" src="assets/images/products/cart-product-img1.jpg" alt="product" title="Product" width="120" height="170" />
                                </a>
                                <div class="product-details">
                                    <a class="product-title" href="product-layout1.html">Women Sandals</a>
                                    <div class="variant-cart my-2">Black / XL</div>
                                    <div class="priceRow">
                                        <div class="product-price">
                                            <span class="price">$54.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="qtyDetail text-center">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1" class="qty">
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                    <a href="#" class="edit-i remove"><i class="icon anm anm-pencil-ar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                    <a href="#" class="remove"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                </div>
                            </li>
                            <li class="item d-flex justify-content-center align-items-center">
                                <a class="product-image rounded-0" href="product-layout1.html">
                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/cart-product-img2.jpg" src="assets/images/products/cart-product-img2.jpg" alt="product" title="Product" width="120" height="170" />
                                </a>
                                <div class="product-details">
                                    <a class="product-title" href="product-layout1.html">Sleeve Round T-Shirt</a>
                                    <div class="variant-cart my-2">Yellow / M</div>
                                    <div class="priceRow">
                                        <div class="product-price">
                                            <span class="price old-price">$114.00</span><span class="price">$99.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="qtyDetail text-center">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1" class="qty">
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                    <a href="#" class="edit-i remove"><i class="icon anm anm-pencil-ar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                    <a href="#" class="remove"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="minicart-bottom">
                        <div class="shipinfo">
                            <div class="progress mb-2"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div></div>
                            <div class="freeShipMsg"><i class="icon anm anm-truck-l fs-6 me-2 align-middle"></i>Only <span class="money" data-currency-usd="$199.00" data-currency="USD">$199.00</span> away from <b>Free Shipping</b></div>
                            <div class="freeShipMsg d-none"><i class="icon anm anm-truck-l fs-6 me-2 align-middle"></i>Congrats! You are eligible for <b>Free Shipping</b></div>
                        </div>
                        <div class="subtotal clearfix my-3">
                            <div class="totalInfo clearfix mb-1 d-none"><span>Shipping:</span><span class="item product-price">$10.00</span></div>
                            <div class="totalInfo clearfix mb-1 d-none"><span>Tax:</span><span class="item product-price">$0.00</span></div>
                            <div class="totalInfo clearfix"><span>Total:</span><span class="item product-price">$163.00</span></div>

                        </div>
                        <div class="agree-check customCheckbox">
                            <input id="prTearm" name="tearm" type="checkbox" value="tearm" required />
                            <label for="prTearm"> I agree with the </label><a href="#" class="ms-1 text-link">Terms &amp; conditions</a>
                        </div>
                        <div class="minicart-action d-flex mt-3">
                            <a href="checkout-style1.html" class="proceed-to-checkout btn btn-primary w-50 me-1">Check Out</a>
                            <a href="cart-style1.html" class="cart-btn btn btn-secondary w-50 ms-1">View Cart</a>
                        </div>
                    </div>
                </div>
                <!--MiniCart Content-->
            </div>
            <!--End MiniCart Drawer-->

            <!-- Product Quickshop Modal-->
            <div class="quickshop-modal modal fade" id="quickshop_modal" tabindex="-1" aria-hidden="true">           
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <form method="post" action="#" id="product-form-quickshop" class="product-form align-items-center">
                                <!-- Product Info -->
                                <div class="row g-0 item mb-3">
                                    <a class="col-4 product-image" href="product-layout1.html"><img class="rounded-0 blur-up lazyload" data-src="assets/images/products/addtocart-modal.jpg" src="assets/images/products/addtocart-modal.jpg" alt="Product" title="Product" width="625" height="800" /></a>
                                    <div class="col-8 product-details">
                                        <div class="product-variant ps-3">

                                            <a class="product-title" href="product-layout1.html">Weave Hoodie Sweatshirt</a>
                                            <div class="priceRow mt-2 mb-3">
                                                <div class="product-price m-0"><span class="old-price">$114.00</span><span class="price">$99.00</span></div>
                                            </div>
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                                <input type="text" name="quantity" value="1" class="qty">
                                                <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Info -->
                                <!-- Swatches Color -->
                                <div class="variants-clr swatches-image clearfix mb-3 swatch-0 option1" data-option-index="0">
                                    <label class="label d-flex justify-content-center">Color:<span class="slVariant ms-1 fw-bold">Black</span></label>
                                    <ul class="swatches d-flex-justify-center pt-1 clearfix">
                                        <li class="swatch large radius available active"><img src="assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top" title="Blue" /></li>
                                        <li class="swatch large radius available"><img src="assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70"  data-bs-toggle="tooltip" data-bs-placement="top" title="Black" /></li>
                                        <li class="swatch large radius available"><img src="assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70"  data-bs-toggle="tooltip" data-bs-placement="top" title="Pink" /></li>
                                        <li class="swatch large radius available green"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Green"></span></li>
                                        <li class="swatch large radius soldout yellow"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Yellow"></span></li>
                                    </ul>
                                </div>
                                <!-- End Swatches Color -->
                                <!-- Swatches Size -->
                                <div class="variants-size swatches-size clearfix mb-4 swatch-1 option2" data-option-index="1">
                                    <label class="label d-flex justify-content-center">Size:<span class="slVariant ms-1 fw-bold">S</span></label>
                                    <ul class="size-swatches d-flex-justify-center pt-1 clearfix">
                                        <li class="swatch large radius soldout"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XS">XS</span></li>
                                        <li class="swatch large radius available active"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="S">S</span></li>
                                        <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="M">M</span></li>
                                        <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="L">L</span></li>
                                        <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XL">XL</span></li>
                                    </ul>
                                </div>
                                <!-- End Swatches Size -->
                                <!-- Product Action -->
                                <div class="product-form-submit d-flex-justify-center">
                                    <button type="submit" name="add" class="btn product-cart-submit me-2"><span>Add to cart</span></button>
                                    <button type="submit" name="sold" class="btn btn-secondary product-sold-out d-none" disabled="disabled">Sold out</button>
                                    <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout">Buy it now</button>
                                </div>
                                <!-- End Product Action -->
                                <div class="text-center mt-3"><a class="text-link" href="product-layout1.html">View More Details</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Quickshop Modal -->

            <!-- Product Addtocart Modal-->
            <div class="addtocart-modal modal fade" id="addtocart_modal" tabindex="-1" aria-hidden="true">           
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <form method="post" action="#" id="product-form-addtocart" class="product-form align-items-center">
                                <h3 class="title mb-3 text-success text-center">Added to cart Successfully!</h3>
                                <div class="row d-flex-center text-center">
                                    <div class="col-md-6">
                                        <!-- Product Image -->
                                        <a class="product-image" href="product-layout1.html"><img class="rounded-0 blur-up lazyload" data-src="assets/images/products/addtocart-modal.jpg" src="assets/images/products/addtocart-modal.jpg" alt="Product" title="Product" width="625" height="800" /></a>
                                        <!-- End Product Image -->
                                    </div>
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <!-- Product Info -->
                                        <div class="product-details">

                                            <a class="product-title" href="product-layout1.html">Cuff Beanie Cap</a>
                                            <p class="product-clr my-2 text-muted">Black / XL</p>
                                        </div>
                                        <div class="addcart-total rounded-5">
                                            <p class="product-items mb-2">There are <strong>1</strong> items in your cart</p>
                                            <p class="d-flex-justify-center">Total: <span class="price">$198.00</span></p>
                                        </div>
                                        <!-- End Product Info -->
                                        <!-- Product Action -->
                                        <div class="product-form-submit d-flex-justify-center">
                                            <a href="#" class="btn btn-outline-primary product-continue w-100">Continue Shopping</a>
                                            <a href="cart-style1.html" class="btn btn-secondary product-viewcart w-100 my-2 my-md-3">View Cart</a>
                                            <a href="checkout-style1.html" class="btn btn-primary product-checkout w-100">Proceed to checkout</a>
                                        </div>
                                        <!-- End Product Action -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Addtocart Modal -->

            <!-- Product Quickview Modal-->
            <div class="quickview-modal modal fade" id="quickview_modal" tabindex="-1" aria-hidden="true">           
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 mb-md-0">
                                    <!-- Model Thumbnail -->
                                    <div id="quickView" class="carousel slide">
                                        <!-- Image Slide carousel items -->
                                        <div class="carousel-inner">
                                            <div class="item carousel-item active" data-bs-slide-number="0">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2.jpg" src="assets/images/products/product2.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                            <div class="item carousel-item" data-bs-slide-number="1">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-1.jpg" src="assets/images/products/product2-1.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                            <div class="item carousel-item" data-bs-slide-number="2">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-2.jpg" src="assets/images/products/product2-2.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                            <div class="item carousel-item" data-bs-slide-number="3">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-3.jpg" src="assets/images/products/product2-3.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                            <div class="item carousel-item" data-bs-slide-number="4">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-4.jpg" src="assets/images/products/product2-4.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                            <div class="item carousel-item" data-bs-slide-number="5">
                                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-5.jpg" src="assets/images/products/product2-5.jpg" alt="product" title="Product" width="625" height="808" />
                                            </div>
                                        </div>
                                        <!-- End Image Slide carousel items -->
                                        <!-- Thumbnail image -->
                                        <div class="model-thumbnail-img">
                                            <!-- Thumbnail slide -->
                                            <div class="carousel-indicators list-inline">
                                                <div class="list-inline-item active" id="carousel-selector-0" data-bs-slide-to="0" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2.jpg" src="assets/images/products/product2.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                                <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-1.jpg" src="assets/images/products/product2-1.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                                <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-2.jpg" src="assets/images/products/product2-2.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                                <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-3.jpg" src="assets/images/products/product2-3.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                                <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-4.jpg" src="assets/images/products/product2-4.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                                <div class="list-inline-item" id="carousel-selector-5" data-bs-slide-to="5" data-bs-target="#quickView">
                                                    <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/product2-5.jpg" src="assets/images/products/product2-5.jpg" alt="product" title="Product" width="625" height="808" />
                                                </div>
                                            </div>
                                            <!-- End Thumbnail slide -->
                                            <!-- Carousel arrow button -->
                                            <a class="carousel-control-prev carousel-arrow rounded-1" href="#quickView" data-bs-target="#quickView" data-bs-slide="prev"><i class="icon anm anm-angle-left-r"></i></a>
                                            <a class="carousel-control-next carousel-arrow rounded-1" href="#quickView" data-bs-target="#quickView" data-bs-slide="next"><i class="icon anm anm-angle-right-r"></i></a>
                                            <!-- End Carousel arrow button -->
                                        </div>
                                        <!-- End Thumbnail image -->
                                    </div>
                                    <!-- End Model Thumbnail -->
                                    <div class="text-center mt-3"><a href="product-layout1.html" class="text-link">View More Details</a></div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="product-arrow d-flex justify-content-between">
                                        <h2 class="product-title">Product Quick View Popup</h2>
                                    </div>
                                    <div class="product-review d-flex mt-0 mb-2">
                                        <div class="rating"><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star-o"></i></div>
                                        <div class="reviews ms-2"><a href="#">6 Reviews</a></div>
                                    </div>
                                    <div class="product-info">
                                        <p class="product-vendor">Vendor:<span class="text"><a href="#">HVL</a></span></p>  
                                        <p class="product-sku">SKU:<span class="text">RF104</span></p>
                                    </div>
                                    <div class="pro-stockLbl my-2">
                                        <span class="d-flex-center stockLbl instock d-none"><span> In stock</span></span>
                                        <span class="d-flex-center stockLbl preorder d-none"><span> Pre-order Now</span></span>
                                        <span class="d-flex-center stockLbl outstock d-none"><span>Sold out</span></span>
                                    </div>
                                    <div class="product-price d-flex-center my-3">
                                        <span class="price old-price">$135.00</span><span class="price">$129.00</span>
                                    </div>
                                    <div class="sort-description">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</div>
                                    <form method="post" action="#" id="product_form--option" class="product-form">
                                        <div class="product-options d-flex-wrap">
                                            <div class="product-item swatches-image w-100 mb-3 swatch-0 option1" data-option-index="0">
                                                <label class="label d-flex align-items-center">Color:<span class="slVariant ms-1 fw-bold">Blue</span></label>
                                                <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                                                    <li class="swatch large radius available blue"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Blue"></span></li>
                                                    <li class="swatch large radius available black"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Black"></span></li>
                                                    <li class="swatch large radius available pink"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Pink"></span></li>
                                                    <li class="swatch large radius available green"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Green"></span></li>
                                                    <li class="swatch large radius soldout yellow"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Yellow"></span></li>
                                                </ul>
                                            </div>
                                            <div class="product-item swatches-size w-100 mb-3 swatch-1 option2" data-option-index="1">
                                                <label class="label d-flex align-items-center">Size:<span class="slVariant ms-1 fw-bold">S</span></label>
                                                <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                                    <li class="swatch large radius soldout"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XS">XS</span></li>
                                                    <li class="swatch large radius available active"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="S">S</span></li>
                                                    <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="M">M</span></li>
                                                    <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="L">L</span></li>
                                                    <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XL">XL</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-action d-flex-wrap w-100 pt-1 mb-3 clearfix">
                                                <div class="quantity">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r" aria-hidden="true"></i></a>
                                                        <input type="text" name="quantity" value="1" class="product-form__input qty">
                                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-l" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>                                
                                                <div class="addtocart ms-3 fl-1">
                                                    <button type="submit" name="add" class="btn product-cart-submit w-100"><span>Add to cart</span></button>
                                                    <button type="submit" name="sold" class="btn btn-secondary product-sold-out w-100 d-none" disabled="disabled"><span>Sold out</span></button>
                                                    <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout w-100 d-none"><span>Buy it now</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="wishlist-btn d-flex-center">
                                        <a class="add-wishlist d-flex-center me-3" href="wishlist-style1.html" title="Add to Wishlist"><i class="icon anm anm-heart-l me-1"></i> <span>Add to Wishlist</span></a>
                                        <a class="add-compare d-flex-center" href="compare-style1.html" title="Add to Compare"><i class="icon anm anm-random-r me-2"></i> <span>Add to Compare</span></a>
                                    </div>
                                    <!-- Social Sharing -->
                                    <div class="social-sharing share-icon d-flex-center mx-0 mt-3">
                                        <span class="sharing-lbl">Share :</span>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i class="icon anm anm-facebook-f"></i><span class="share-title d-none">Facebook</span></a>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i class="icon anm anm-twitter"></i><span class="share-title d-none">Tweet</span></a>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i class="icon anm anm-pinterest-p"></i> <span class="share-title d-none">Pin it</span></a>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i class="icon anm anm-linkedin-in"></i><span class="share-title d-none">Instagram</span></a>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i class="icon anm anm-envelope-l"></i><span class="share-title d-none">WhatsApp</span></a>
                                        <a href="#" class="d-flex-center btn btn-link btn--share share-email" data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i class="icon anm anm-whatsapp"></i><span class="share-title d-none">Email</span></a>
                                    </div>
                                    <!-- End Social Sharing -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Product Quickview Modal-->


            <!-- Including Jquery/Javascript -->
            <!-- Plugins JS -->
            <script src="assets/js/plugins.js"></script>
            <!-- Main JS -->
            <script src="assets/js/main.js"></script>

        </div>
        <!--End Page Wrapper-->
    </body>
</html>