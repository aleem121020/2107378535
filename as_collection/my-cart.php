<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart hasbeen Updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
	
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);
    $_SESSION['order_data'] = $value;
    $grandtotal = $_POST['grandtotal'];
    $_SESSION['grandtotal_data'] = $grandtotal;

    // foreach($value as $qty=> $val34){
    // mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
    // header('location:payment-method.php');
    // }
    header('Location: pay.php');
}
}

// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
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
                                <div class="page-title"><h1>My Cart</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>My Cart</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">  
                <form  method="post" class="cart-table table-bottom-brd">   
                    <div class="row">
                        <!--Cart Content-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                           
                            <!--Cart Form-->
                            
                            <?php
                                if(!empty($_SESSION['cart'])){
                            ?>
                                <table class="table align-middle">
                                    <thead class="cart-row cart-header position-relative">
                                        <tr>
                                            <th class="action">Remove</th>
                                            <th colspan="2" class="text-start">Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                            <?php
                                $pdtid=array();
                                $sql = "SELECT * FROM products WHERE id IN(";
                                foreach($_SESSION['cart'] as $id => $value){
                                $sql .=$id. ",";
                                }
                                $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                                $query = mysqli_query($con,$sql);
                                $totalprice=0;
                                $totalqunty=0;
                                if(!empty($query)){
                                while($row = mysqli_fetch_array($query)){
                                    $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                                    $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice'];
                                    $shipingcharge = $row['shippingCharge'];
                                    $totalprice += $subtotal;
                                    $tax = $totalprice*18/100;
                                    $_SESSION['qnty']=$totalqunty+=$quantity;

                                    array_push($pdtid,$row['id']);
                                //print_r($_SESSION['pid'])=$pdtid;exit;
                                ?>
                                        <tr class="cart-row cart-flex position-relative">
                                            <td class="cart-delete text-center"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
                                            <td class="cart-image cart-flex-item">
                                                <img class="cart-image rounded-0 blur-up lazyload" data-src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="Sunset Sleep Scarf Top" width="120" height="170" />
                                            </td>
                                            <td class="cart-meta small-text-left cart-flex-item">
                                                <a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>"><?php echo $row['productName']; $_SESSION['sid']=$pd; ?></a>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center">
                                                <span class="money"><?php echo "RS: "." ".$row['productPrice']; ?>.00</span>
                                            </td>
                                            <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                                <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                                        <input class="cart-qty-input qty" type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" />
                                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                                    </div>
                                                </div>
                                                <a href="#" title="Remove" class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center small-hide">
                                                <span class="money fw-500">RS: <?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']);?></span>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    
                                    <?php } }
                                    $_SESSION['pid']=$pdtid;
                                     ?>
                                     <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-start"><a href="index.php" class="btn btn-outline-secondary btn-sm cart-continue"><i class="icon anm anm-angle-left-r me-2 d-none"></i> Continue shopping</a></td>
                                            <td colspan="3" class="text-end">
                                                <button type="submit" name="submit" class="btn btn-secondary btn-sm cart-continue ms-2"><i class="icon anm anm-sync-ar me-2 d-none"></i> Update Cart</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table> 

                                <!-- </form> -->

                                <!-- ============================= -->
                             

                        </div>
                        <!--End Cart Content-->
                       
                        <!-- <form class="checkout-form mt-5" method="post" > -->
                            <div class="row">
                        <?php
                        $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        
                            <!--End Cart Form-->
                                    <div class="block mb-3 shipping-address mb-4">
                                    <div class="block-content">
                                        <h3 class="title mb-3 text-uppercase">Billing Address</h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <label for="fullname" class="form-label ">Full Name <span class="required">*</span></label>
                                                    <input name="fullname" value="<?php echo $row['name'];?>" id="fullname" type="text" required="" placeholder="Full Name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <label for="address-1" class="form-label ">Address <span class="required">*</span></label>
                                                    <input name="billingaddress" value="<?php echo $row['billingAddress'];?>" id="billingaddress" type="text" required="" placeholder="Billing address" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="bilingstate" value="<?php echo $row['billingState'];?>" id="bilingstate" type="text" required="" placeholder="Billing State" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="billingcity" value="<?php echo $row['billingCity'];?>" id="billingcity" type="text" required="" placeholder="Billing City" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="billingpincode" value="<?php echo $row['billingPincode'];?>" id="billingpincode" type="text" required="" placeholder="Billing Pincode" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-secondary btn-sm cart-continue ms-2"><i class="icon anm anm-sync-ar me-2 d-none"></i> Update Billing Address</button>
                                           
                                        </fieldset>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        
                            <!--End Cart Form-->
                                    <div class="block mb-3 shipping-address mb-4">
                                    <div class="block-content">
                                        <h3 class="title mb-3 text-uppercase">Shipping Address</h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <label for="fullname" class="form-label ">Full Name <span class="required">*</span></label>
                                                    <input name="fullname" value="<?php echo $row['name'];?>" id="fullname" type="text" required="" placeholder="Full Name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <label for="address-1" class="form-label ">Address <span class="required">*</span></label>
                                                    <input name="shippingaddress" value="<?php echo $row['shippingAddress'];?>" id="shippingaddress" type="text" required="" placeholder="Shipping address" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="shippingstate" value="<?php echo $row['shippingState'];?>" id="shippingstate" type="text" required="" placeholder="Shipping State" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="shippingcity" value="<?php echo $row['shippingCity'];?>" id="shippingcity" type="text" required="" placeholder="Shipping City" class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input name="shippingpincode" value="<?php echo $row['shippingPincode'];?>" id="shippingpincode" type="text" required="" placeholder="Shipping Pincode" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" name="shipupdate" class="btn btn-secondary btn-sm cart-continue ms-2"><i class="icon anm anm-sync-ar me-2 d-none"></i> Update Shipping Address</button>
                                           
                                        </fieldset>
                                    </div>
                                </div>
                        </div>
                        <?php } ?>
                        <!--Cart Sidebar-->

                   
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                            <div class="cart-info sidebar-sticky">
                                <div class="cart-order-detail cart-col">
                                    <div class="row g-0 border-bottom pb-2">
                                        <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                        <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                        <?php echo $_SESSION['tp']="$totalprice". ".00"; ?>
                                        <input type="hidden" name="subtotal" value="<?php echo $totalprice; ?>">
                                        </span>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                        <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                        <?php echo $tax; ?>
                                        <input type="hidden" name="tax" value="<?php echo $tax; ?>">
                                        </span>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                        <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                        <span class="money">
                                            RS: <?php echo $shipingcharge; ?>.00
                                            <input type="hidden" name="shipping" value="<?php echo $shipingcharge; ?>">
                                        </span>
                                        </span>
                                    </div>
                                    <div class="row g-0 pt-2">
                                        <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                        <span class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary">
                                            <b class="money">
                                            <?php echo ($_SESSION['cart'][$row['id']]['quantity'] + $totalprice + $shipingcharge) + $tax; ?>
                                            <input type="hidden" name="grandtotal" value="<?php echo ($_SESSION['cart'][$row['id']]['quantity'] + $totalprice + $shipingcharge) + $tax; ?>">
                                            </b>
                                        </span>
                                    </div>

                                    <button name="ordersubmit" id="cartCheckout" class="btn btn-lg my-4 checkout w-100">Proceed To Checkout</button>
                                    <div class="paymnet-img text-center"><img src="assets/images/icons/safepayment.png" alt="Payment" width="299" height="28" /></div>
                                </div>                               
                            </div>
                        </div>

                      
                        </div>
                        </form> 
                        <?php } ?>
                        
                        <!--End Cart Sidebar-->
                    </div>
                </div>
                <!--End Main Content-->

                
            </div>
            <!-- End Body Container -->

           <?php include 'footer.php'?>