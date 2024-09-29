 <!--Footer-->
 <div class="footer">
                
                <div class="footer-top clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Informations</h4>
                                <ul>
                                    <li><a href="my-account.php">My Account</a></li>
                                    <li><a href="login.php">Login</a></li>
                                    <li><a href="my-wishlist.php">Wishlist</a></li>
                                    <li><a href="my-cart.php">My Cart</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Quick Shop</h4>
                                <ul>
                                <?php $sql=mysqli_query($con,"select id,categoryName  from category limit 5");
                                    while($row=mysqli_fetch_array($sql))
                                    {
                                ?>
                                    <li><a href="category.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Customer Services</h4>
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Return Policy</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-contact">
                                <h4 class="h4">Contact Us</h4>
                                <p class="address d-flex"><i class="icon anm anm-map-marker-al pt-1"></i>Chouhan Banger, Seelampur, Delhi, India </p>
                                <p class="phone d-flex align-items-center"><i class="icon anm anm-phone-l"></i>  <b class="me-1 d-none">Phone:</b> <a href="tel:7599612695">+91-7599612695</a></p>
                                <p class="email d-flex align-items-center"><i class="icon anm anm-envelope-l"></i> <b class="me-1 d-none">Email:</b> <a href="mailto:aleem2023web@gmail.com">aleem2023web@gmail.com</a></p>
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
                            <div class="copytext">Copyright &copy; 2024 AS Collection All Rights Reserved.</div>
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
                                
                                <div id="cart-drawer" class="block block-cart">
                                <?php
                                    if(!empty($_SESSION['cart'])){
                                ?>
                                    <div class="minicart-header">
                                        <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                                        <h4 class="fs-6">Your cart (<?php echo $_SESSION['qnty'];?> Items)</h4>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="minicart-header">
                                        <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                                        <h4 class="fs-6">Your cart (0 Items)</h4>
                                     </div>
                                     <?php }?>
                                    <div class="minicart-content">
                                        <ul class="m-0 clearfix">
                
                                        <?php
                                            if(!empty($_SESSION['cart'])){
                                        ?>
                
                                        <?php
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
                                                $totalprice += $subtotal;
                                                $_SESSION['qnty']=$totalqunty+=$quantity;
                
                                            ?>
                
                
                                            <li class="item d-flex justify-content-center align-items-center">
                                                <a class="product-image rounded-3" href="product-details.php?pid=<?php echo $row['id'];?>">
                                                    <img class="blur-up lazyload" data-src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="product" title="Product" width="120" height="170" />
                                                </a>
                                                <div class="product-details">
                                                    <a class="product-title" href="product-details.php?pid=<?php echo $row['id'];?>"><?php echo $row['productName']; ?></a>
                                                    <div class="priceRow">
                                                        <div class="product-price">
                                                            <strong> RS - <span class="price"><?php echo ($row['productPrice']+$row['shippingCharge']); ?>*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></span></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="qtyDetail text-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                                        <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="qty">
                                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                                    </div>
                                                    <a href="#" class="remove" ><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                                </div>
                                            </li>
                                            
                
                                            <?php } } ?>
                
                                            
                                        </ul>
                                    </div>
                                    <div class="minicart-bottom">
                                        
                                        <div class="subtotal clearfix my-3">
                                            <div class="totalInfo clearfix"><span>Total:</span><span class="item product-price"><?php echo $_SESSION['tp']="$totalprice". ".00"; ?> </span></div>
                                        
                
                                        </div>
                                        <div class="minicart-action d-flex mt-3">
                                            <a href="index.php" class="proceed-to-checkout btn btn-primary w-50 me-1">Continue Shopping</a>
                                            <a href="my-cart.php" class="cart-btn btn btn-secondary w-50 ms-1">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                                <!--MiniCart Content-->
                            </div>
                
                            <?php } else{?>
                
                                <div id="cartEmpty" class="cartEmpty d-flex-justify-center flex-column text-center p-3 text-muted ">
                                    <div class="cartEmpty-content mt-4">
                                        <i class="icon anm anm-cart-l fs-1 text-muted"></i> 
                                        <p class="my-3">No Products in the Cart</p>
                                        <a href="index.php" class="btn btn-primary cart-btn">Continue shopping</a>
                                    </div>
                                </div>
                
                            <?php } ?>
                 <!--End MiniCart Drawer-->


            <!-- Including Jquery/Javascript -->
            <!-- Plugins JS -->
            <script src="assets/js/plugins.js"></script>
            <!-- Main JS -->
            <script src="assets/js/main.js"></script>

        </div>

        
        <!--End Page Wrapper-->
    </body>
</html>