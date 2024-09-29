<?php 
session_start();
error_reporting(0);
include('includes/config.php');
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
$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
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
<?php include 'header.php';?>

<!-- Body Container -->
<div id="page-content" >
    <!--Page Header-->
    <div class="page-header text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <!--Breadcrumbs-->
                    <?php
                        $ret=mysqli_query($con,"select category.categoryName as catname,subcategory.subcategory as subcatname,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
                        while ($rw=mysqli_fetch_array($ret)) {

                        ?>
                    <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['catname']);?></span>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['subcatname']);?></span>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['pname']);?></span>
                    </div>
                    <?php }?>
                    <!--End Breadcrumbs-->
                </div>
            </div>
        </div>
    </div>
    <!--End Page Header-->

    <!--Main Content-->
    <div class="container">
        <!--Product Content-->
        <div class="product-single">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 product-layout-img mb-4 mb-md-0">
                    <!-- Product Horizontal -->

                    <!-- ================== Image Start =================== -->

                    <?php $ret=mysqli_query($con,"select * from products where id='$pid'");
                        $row=mysqli_fetch_array($ret)
                    ?>
                    <div class="product-details-img product-horizontal-style">
                        <!-- Product Main -->
                        <div class="zoompro-wrap">
                            <!-- Product Image -->
                            <div class="zoompro-span"><img id="zoompro" class="zoompro" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="product" width="625"
                                    height="500" /></div>
                            <!-- End Product Image -->
                            <!-- Product Label -->
                            <div class="product-labels"><span class="lbl pr-label1">New</span><span
                                    class="lbl on-sale">Sale</span></div>
                            <!-- End Product Label -->

                        </div>
                        <!-- End Product Main -->

                        <!-- Product Thumb -->
                        <div class="product-thumb product-horizontal-thumb mt-3">
                            <div id="gallery" class="product-thumb-horizontal">

                            <?php 
                                $ret=mysqli_query($con,"select * from products where id='$pid'");
                                while($row=mysqli_fetch_array($ret)) 
                                {
                                    for($imgno = 1; $imgno <= 3; $imgno++) {
                                        $imgVar = 'productImage' . $imgno;
                                        if(!empty($row[$imgVar])) {
                                            ?>
                                            <a data-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                class="slick-slide slick-cloned active">
                                                <img class="blur-up lazyload" data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>" alt="product" width="625"
                                                    height="808" />
                                            </a>
                                            <?php 
                                        }
                                    }
                                }
                                ?>
                                
                            </div>
                        </div>
                        <!-- End Product Thumb -->

                    </div>



                    <!-- ===================== Image End ==================  -->


                    <!-- End Product Horizontal -->
                </div>
                <?php $ret=mysqli_query($con,"select * from products where id='$pid'");
                        $row=mysqli_fetch_array($ret)
                ?>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 product-layout-info">
                    <!-- Product Details -->
                    <div class="product-single-meta">
                        <h2 class="product-main-title"><?php echo htmlentities($row['productName']);?></h2>
                        <!-- Product Reviews -->
                        <div class="product-review d-flex-center mb-3">
                            <div class="reviewStar d-flex-center"><i class="icon anm anm-star"></i><i
                                    class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                    class="icon anm anm-star"></i><i class="icon anm anm-star"></i></div>
                        </div>
                        <!-- End Product Reviews -->
                        <!-- Product Info -->
                        <div class="product-info">
                            <p class="product-stock d-flex">Availability:
                                <span class="pro-stockLbl ps-0">
                                    <span class="d-flex-center stockLbl instock text-uppercase"><?php echo htmlentities($row['productAvailability']);?></span>
                                </span>
                            </p>
                            <p class="product-vendor">Product Brand:<span class="text"><a href="#"><?php echo htmlentities($row['productCompany']);?></a></span></p>
                            <p class="product-type">Shiping Charge:<span class="text">
                                <?php if($row['shippingCharge']==0)
                                    {
                                        echo "Free";
                                    }
                                    else
                                    {
                                        echo htmlentities($row['shippingCharge']);
                                    }
                                ?>
                            </span></p>
                        </div>
                        <!-- End Product Info -->
                        <!-- Product Price -->
                        <div class="product-price d-flex-center my-3">
                            <span class="price old-price">RS: <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00</span><span class="price">RS: <?php echo htmlentities($row['productPrice']);?>.00</span>
                        </div>
                        <!-- End Product Price -->
                        <hr>
                        <!-- Sort Description -->
                        <div class="sort-description">
                        <?php 
                            $description = $row['productDescription'];
                            $words = explode(' ', $description, 36);
                            if(count($words) > 35){
                                array_pop($words);
                                array_push($words, '...');
                                $description = implode(' ', $words);
                            }
                            echo $description;
                            ?>
                        </div>
                        <!-- End Sort Description -->
                        <hr>
                        <!-- Countdown -->
                        <h3 class="text-uppercase mb-0">Hurry up! Sales Ends In</h3>
                        <?php
                            $currentDate = date('Y/m/d'); 
                            $next10Days = date('Y/m/d', strtotime($currentDate . ' + 10 days'));
                            $formattedDate = date('Y/m/d', strtotime($next10Days));
                            ?>
                        <div class="product-countdown d-flex-center text-center my-3" data-countdown="<?php echo $formattedDate;?>"></div>
                        <!-- End Countdown -->
                    </div>
                    <!-- End Product Details -->

                    <!-- Product Form -->
                    <form method="post" action="#" class="product-form product-form-border hidedropdown">
                        <!-- Product Action -->
                        <div class="product-action w-100 d-flex-wrap my-3 my-md-4">
                            <!-- Product Quantity -->
                            <div class="product-form-quantity d-flex-center">
                                <div class="qtyField" style="height:0;">
                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                    <?php
                                        $id=intval($_GET['id']);
                                        if(isset($_SESSION['cart'][$id])){
                                    ?>
                                    <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="product-form-input qty" />
                                <?php } else {?>
                                    <input type="text" value="1" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="product-form-input qty" />
                                <?php } ?>
                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                </div>
                            </div>
                            <!-- End Product Quantity -->
                            <!-- Product Add -->
                            
                            <div class="product-form-submit addcart fl-1 ms-3">
                            <?php if($row['productAvailability']=='In Stock'){?>
                                <a href="index.php?page=product&action=add&id=<?php echo $row['id'];?>" type="submit" name="add" class="btn btn-secondary product-form-cart-submit">
                                    <span>Add to cart</span>
                                </a>
                            <?php } else {?>
                                <button type="submit" style=" cursor: not-allowed;" onclick="event.preventDefault();" class="btn btn-secondary product-form-cart-submit"> <span>Out of Stock</span> </button>
                            <?php } ?>
                            </div>
                            
                            <!-- Product Add -->
                            <!-- Product Buy -->
                            <div class="product-form-submit buyit fl-1 ms-3">
                            <?php if($row['productAvailability']=='In Stock'){?>
                                <a href="index.php?page=product&action=add&id=<?php echo $row['id'];?>" type="submit" class="btn btn-primary proceed-to-checkout"><span>Buy it now</span></a>
                                <?php } ?>
                            </div>
                            <!-- End Product Buy -->
                        </div>
                        <!-- End Product Action -->

                        <!-- Product Info link -->
                        <p class="infolinks d-flex-center justify-content-between">
                            <a class="text-link wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><i
                                    class="icon anm anm-heart-l me-2"></i> <span>Add to Wishlist</span></a>
                            <a href="#shippingInfo-modal" class="text-link shippingInfo" data-bs-toggle="modal"
                                data-bs-target="#shippingInfo_modal"><i class="icon anm anm-paper-l-plane me-2"></i>
                                <span>Delivery &amp; Returns</span></a>
                            <a href="#productInquiry-modal" class="text-link emaillink me-0" data-bs-toggle="modal"
                                data-bs-target="#productInquiry_modal"><i class="icon anm anm-question-cil me-2"></i>
                                <span>Enquiry</span></a>
                        </p>
                        <!-- End Product Info link -->
                    </form>
                    <!-- End Product Form -->

                    <!-- Social Sharing -->
                    <div class="social-sharing d-flex-center mt-2 lh-lg">
                        <span class="sharing-lbl fw-600">Share :</span>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"><i
                                class="icon anm anm-facebook-f"></i><span class="share-title">Facebook</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"><i
                                class="icon anm anm-twitter"></i><span class="share-title">Tweet</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"><i
                                class="icon anm anm-pinterest-p"></i> <span class="share-title">Pin it</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"><i
                                class="icon anm anm-linkedin-in"></i><span class="share-title">Linkedin</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-email"><i
                                class="icon anm anm-envelope-l"></i><span class="share-title">Email</span></a>
                    </div>
                    <!-- End Social Sharing -->
                </div>
            </div>
        </div>
        <!--Product Content-->


        <!--Product Tabs-->
        <div class="tabs-listing section pb-0">
            <ul class="product-tabs style2 list-unstyled d-flex-wrap d-flex-justify-center d-none d-md-flex">
                <li rel="description" class="active"><a class="tablink">Description</a></li>
            </ul>

            <div class="tab-container">
                <!--Description-->
                <h3 class="tabs-ac-style d-md-none active" rel="description">Description</h3>
                <div id="description" class="tab-content">
                    <div class="product-description">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <?php echo $row['productDescription'];?>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <img data-src="assets/images/content/product-detail-img.jpg"
                                    src="assets/images/content/product-detail-img.jpg" alt="image" width="600"
                                    height="600" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Description-->


            </div>
        </div>
        <!--End Product Tabs-->
    </div>
    <!--End Main Content-->

    <!--Related Products-->
    <section class="section product-slider pb-0">
        <div class="container">
            <div class="section-header">
                <p class="mb-1 mt-0">Discover Similar</p>
                <h2>Related Products</h2>
            </div>

            <!--Product Grid-->
            <div class="product-slider-4items gp10 arwOut5 grid-products">

                <?php
                $ret=mysqli_query($con,"select * from products where id='$pid'");
                $row=mysqli_fetch_array($ret);
                $cid=$row['category'];
                $subcid=$row['subCategory']; 
                // $ret=mysqli_query($con,"select * from products where category='$cid'");
                $qry=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid'");
                $num=mysqli_num_rows($qry);
                if($num>0)
                    {
                        while($row=mysqli_fetch_array($qry))
                    {?>

                <div class="item col-item">
                    <div class="product-box">
                        <!-- Start Product Image -->
                        <div class="product-image">
                            <!-- Start Product Image -->
                            <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"
                                class="product-img rounded-3">
                                <!-- Image -->
                                <img class="blur-up lazyload"
                                    data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    alt="Product" title="<?php echo htmlentities($row['productName']);?>" width="625"
                                    height="808" />
                                <!-- End Image -->
                            </a>
                            <!-- End Product Image -->
                        </div>
                        <!-- Start Product Details -->
                        <div class="product-details text-center">
                            <!-- Product Name -->
                            <div class="product-name">
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                    <?php echo htmlentities($row['productName']);?>
                                </a>
                            </div>
                            <!-- End Product Name -->
                            <!-- Product Price -->
                            <div class="product-price">
                                <span class="price">RS:
                                    <?php echo htmlentities($row['productPrice']);?>.00 &nbsp; <del class="old-price">
                                        RS:
                                        <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00
                                    </del>
                                </span>
                            </div>
                            <!-- End Product Price -->
                            <div class="view-collection mt-md-2">
                                <?php if($row['productAvailability']=='In Stock'){?>
                                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                    class="btn btn-secondary btn-sm">Add Cart &nbsp; <i
                                        class="icon anm anm-cart-l"></i></a> <a
                                    href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                    title="Wishlist" class="btn btn-secondary btn-sm "> Wishlist &nbsp; <i
                                        class="icon anm anm-heart-l"></i></a>
                                <?php } else {?>
                                <a href="" style=" cursor: not-allowed;" onclick="event.preventDefault();"
                                    class="btn btn-secondary btn-sm">Out of Stock &nbsp; <i
                                        class="icon anm anm-cart-l"></i></a> <a
                                    href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                    title="Wishlist" class="btn btn-secondary btn-sm "> Wishlist &nbsp; <i
                                        class="icon anm anm-heart-l"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- End product details -->
                    </div>
                </div>
                <?php }} else{ ?>
                <h4 style="min-width:300px; max-width:500px; width:auto; color: #888;">No Product Found In This Category
                </h4>
                <?php } ?>

            </div>
            <!--End Product Grid-->
        </div>
    </section>
    <!--End Related Products-->

    
</div>
</div>
<!-- End Body Container -->


<?php include 'footer.php'?>
<script src="assets/js/vendor/photoswipe.min.js"></script>
            <script>
                $(function () {
                    var $pswp = $('.pswp')[0],
                            image = [],
                            getItems = function () {
                                var items = [];
                                $('.lightboximages a').each(function () {
                                    var $href = $(this).attr('href'),
                                            $size = $(this).data('size').split('x'),
                                            item = {
                                                src: $href,
                                                w: $size[0],
                                                h: $size[1]
                                            };
                                    items.push(item);
                                });
                                return items;
                            };
                    var items = getItems();

                    $.each(items, function (index, value) {
                        image[index] = new Image();
                        image[index].src = value['src'];
                    });
                    $('.prlightbox').on('click', function (event) {
                        event.preventDefault();

                        var $index = $(".active-thumb").parent().attr('data-slick-index');
                        $index++;
                        $index = $index - 1;

                        var options = {
                            index: $index,
                            bgOpacity: 0.7,
                            showHideOpacity: true
                        };
                        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                        lightBox.init();
                    });
                });
            </script>

            <!-- Elevatezoom Zoom -->
            <script src="assets/js/vendor/jquery.elevatezoom.js"></script>
            <script>
                $(document).ready(function () {
                    /* Product Zoom */
                    function product_zoom() {
                        $(".zoompro").elevateZoom({
                            gallery: "gallery",
                            galleryActiveClass: "active",
                            zoomWindowWidth: 300,
                            zoomWindowHeight: 100,
                            scrollZoom: false,
                            zoomType: "inner",
                            cursor: "crosshair"
                        });
                    }
                    product_zoom();
                });
            </script>