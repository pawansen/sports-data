<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    .information_heading {
    padding: 1.5em 0;
}
.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {

    text-align: center;
}
p, td { font-family: freeserif; }

p{
    font-weight: 900;
}
  </style>

</head>
<body>

<div class="container">

  <div class="row information_heading">
    <div class="col-md-12">
      <div class="">
        <h2 class="title-heading">Billing Statement </h2>
        <p><b>Retailer Name: </b> <span> <?php if(!empty($user)) {echo $user->first_name.' '.$user->last_name;}?> </span></p>
        <p><b>Phone no: </b> <span>+91 <?php if(!empty($user)) {echo $user->phone;}?> </span></p>
        <p><b>Email ID: </b> <span><?php if(!empty($user)) {echo $user->email;}?> </span></p>
        <p><b>PAN: </b> <span> <?php if(!empty($user)) {echo $user->pan_number;}?></span></p>
        <p><b>Aadhar: </b> <span><?php if(!empty($user)) {echo $user->aadhar_number;}?></span></p>
        <p><b>Bank account: </b> <span><?php if(!empty($user)) {echo $user->account_number;}?></span></p>
        <p><b>IFSC Code: </b> <span><?php if(!empty($user)) {echo $user->ifsc_code;}?> </span></p>
         </div>
    </div>
  </div>

  <?php if(!empty($orders)){
      foreach($orders as $order){
          $address = $order->address;
          $products = $order->items;
          ?>

   <div class="row">
   <hr>
   <div class="table-responsive">
   <div class="col-md-12"><b>Order ID: </b> <span> <?php echo $order->order_code;?> </span></div>
   <div class="col-md-12"><b>Order Date: </b> <span> <?php echo date('d-m-Y',strtotime($order->order_date));?> </span></div>
   <div class="col-md-12"><p><b>Address: </b> <span>
       <?php if(!empty($address)) {echo $address->address1.' '.$address->address2.' '.$address->city.' '.$address->state_name.' '.$address->pin_code.' India';}?> </span></p>
   </div>
   <table class="table table-hover table-bordered text-center">
    <thead>
      <tr>
        <th>Date</th>
        <th>Product / Discription</th>
        <th>Regular Price</th>
        <th>Purchased Price</th>
        <th>Quantity</th>
        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody>
        <?php if(!empty($products)){
            if(!empty($products)){
                foreach($products as $item){ ?>
                    <tr>
                        <td><?php echo date('d-m-Y',strtotime($order->order_date)) ?></td>
                        <td><?php echo $item->item_name;?></td>
                        <td><?php echo $item->price;?></td>
                        <td><?php echo $item->product_price;?></td>
                        <td><?php echo $item->product_qty;?></td>
                        <td><?php echo $item->total_product_price;?></td>
                    </tr>
               <?php }
            }
        }?>

    </tbody>
  </table>
    <table class="table table-hover table-bordered text-center">
    <thead>
      <tr>
        <th>Date</th>
        <th>Order ID</th>
        <th>Purchased Price</th>
        <th>Delivery Fee</th>
        <th>Discounted Price</th>
        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody>
                    <tr>
                        <td><?php echo date('d-m-Y',strtotime($order->order_date)) ?></td>
                        <td><?php if(!empty($order->order_code)) {echo $order->order_code;}?></td>
                        <td><?php echo $order->total_product_price;?></td>
                        <td><?php echo $order->delivery_fee;?></td>
                        <td><?php echo $order->discounted_price;?></td>
                        <td><?php echo $order->final_price;?></td>
                    </tr>
    </tbody>
  </table>
  </div>
  </div>

     <?php }
  } ?>


</div>

</body>
</html>

