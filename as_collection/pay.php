<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0)
        {   
    header('location:login.php');
    }
    else{
      echo'
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
    </head>';
    include 'header.php'
?>
<div class="page-header text-center">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                <div class="page-title"><h1>Proceed for Payment</h1></div>
                <!--Breadcrumbs-->
                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a><span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Proceed for Payment</span></div>
                <!--End Breadcrumbs-->
            </div>
        </div>
    </div>
</div>
  <center><h1 class="mt-5">Pay For AS Collection!!</h1></center>

    <?php

// Replace these with your actual PhonePe API credentials

$merchantId = '#'; // sandbox or test merchantId
$apiKey='#'; // sandbox or test APIKEY
$redirectUrl = 'http://localhost/pankaj/adjoint%20eccomerce/Online%20Shopping%20Portal%20project/ui/success_payment.php';


// $merchantId = ''; // sandbox or test merchantId
// $apiKey=''; // sandbox or test APIKEY
// $redirectUrl = 'http://localhost/pankaj/adjoint%20eccomerce/Online%20Shopping%20Portal%20project/ui/success_payment.php';


// Set transaction details
$order_id = uniqid(); 
 if(isset($_SESSION['order_data']) && isset($_SESSION['grandtotal_data'])) {
    $order_data = $_SESSION['order_data'];
    $amount = $_SESSION['grandtotal_data'];
    $userID = $_SESSION['id'];
    // echo $userID;
    $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
    $row=mysqli_fetch_array($query);
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['contactno'];   
}

$description = 'Payment for Product/Service';
$merchantTransactionId = 'MT' . uniqid();
$merchantUserId = 'MUID' . uniqid();

$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => $merchantTransactionId, // test transactionID
    "merchantUserId"=> $merchantUserId,
    'amount' => $amount*100,
    'redirectUrl'=>$redirectUrl,
    'redirectMode'=>"POST",
    'callbackUrl'=>$redirectUrl,
    "merchantOrderId"=>$order_id,
   "mobileNumber"=>$mobile,
   "message"=>$description,
   "email"=>$email,
   "shortName"=>$name,
   "paymentInstrument"=> array(    
    "type"=> "PAY_PAGE",
  )
);


 $jsonencode = json_encode($paymentData);
 $payloadMain = base64_encode($jsonencode);
 $salt_index = 1; //key index 1
 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
 $sha256 = hash("sha256", $payload);
 $final_x_header = $sha256 . '###' . $salt_index;
 $request = json_encode(array('request'=>$payloadMain));
                
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => $request,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
     "X-VERIFY: " . $final_x_header,
     "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $res = json_decode($response);
 
if(isset($res->success) && $res->success=='1'){
$paymentCode=$res->code;
$paymentMsg=$res->message;
$payUrl=$res->data->instrumentResponse->redirectInfo->url;
// echo $payUrl;exit;
// header('Location:'.$payUrl); exit;
// echo '<a href="'.$payUrl.'">click here</a>';
echo '<p class="m-auto mb-5" style="width:300px"><a href="'.$payUrl.'" class="btn btn-lg my-4 checkout w-100">Proceed To Payment</a></p>';

}
}
}        
include 'footer.php';      
?>