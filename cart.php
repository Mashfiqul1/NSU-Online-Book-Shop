<?php include "header.php"; ?>
<?php include "db_connect.php"; ?>
<?php 
if (!$_SESSION['login']) {
  header("Location: login.php");
}
?>
<?php
$id = $_SESSION['user_id'];
if(!isset($_GET['add']) && !isset($_GET['remove']) && isset($_GET['product'])){
    $sql= "SELECT * from cart where product_id='{$_GET['product']}'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 0) {
      $sql ="INSERT INTO cart(user_id, product_id,quantity) VALUES ('{$id}','{$_GET['product']}','1')";
      //echo $sql;
      $result = mysqli_query($connect, $sql);
      if ($result ) {
        header('Location:cart.php');
      }
    }
      
  }
elseif (isset($_GET['add']) && isset($_GET['product'])) {
  $product =$_GET['product'];
  $sql= "SELECT * from cart where cart_id='{$_GET['add']}'";
  $result = mysqli_query($connect, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row =mysqli_fetch_array($result);
    $quantity = $row['quantity']+1;
    $sql= "UPDATE `cart` SET `quantity` = '{$quantity}' WHERE cart_id='{$_GET['add']}'";
    $result = mysqli_query($connect, $sql);
    if ($result ) {
      header('Location:cart.php');
    }
  }
}else if(isset($_GET['remove']) && isset($_GET['product'])) {
  $product =$_GET['product'];
  $sql= "SELECT * from cart where cart_id='{$_GET['remove']}'";
  $result = mysqli_query($connect, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row =mysqli_fetch_array($result);
    $quantity = $row['quantity']-1;
    $sql= "UPDATE `cart` SET `quantity` = '{$quantity}' WHERE cart_id='{$_GET['remove']}'";
    $result = mysqli_query($connect, $sql);
    if ($result ) {
      header('Location:cart.php');
    }
  }else{
    $sql ="INSERT INTO cart(user_id, product_id,quantity) VALUES ('{$id}','{$product}',1)";
    $result = mysqli_query($connect, $sql);
    if ($result ) {
      header('Location:cart.php');
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>
<body>
    
  <h2 class="text-center p-3 text-light bg-success mt-5">Adding to Cart</h2>


    <section class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div style="background-image: url(images/bro.jpg);background-size: cover;">
                <h3 class="p-5 text-center"></h3>
              </div>
              
            </div>
        </div>
      </section>
      <section class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="row">
                <table class="table">
                    <thead class="bg-warning text-light">
                        <th>Item</th>
                        <th>Title</th>
                        <th>Price($)</th>
                        <th>Quantity</th>
                        <th>Total($)</th>
                    </thead>
                    <tbody>

<?php 

$user_id = $_SESSION['user_id'];

$sql ="SELECT * FROM product JOIN cart ON product.product_id=cart.product_id WHERE user_id='{$user_id}'";
  
  $result = mysqli_query($connect, $sql);
  if (mysqli_num_rows($result) > 0) {
    $subtotal = 0;
    $dis = '';
      while ($row = mysqli_fetch_array($result)) {
        $total = $row['product_price']*$row['quantity'];
        if ($row['quantity'] == 0) {
          $dis = 'disabled';
        };
  ?>


<tr id="">
    <td><img width="80" src="img/<?php echo $row['product_image']; ?>"></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['product_price']; ?></td>
    <td>
      <div class="input-group main" id="">
        <span class="input-group-btn">
            <a type="submit" href="?remove=<?php echo $row['cart_id']; ?>&product=<?php echo $row['product_id']; ?>" id="" class="btn btn-danger <?php echo $dis; ?>"  data-type="minus">
              <span class="fa fa-minus"></span>
            </a>
        </span>
        <input type="text" name="quant" class="qnty" value="<?php echo $row['quantity'] ?>" min="1" max="100" size="3">
        <span class="input-group-btn">
            <a type="submit" href="?add=<?php echo $row['cart_id']; ?>&product=<?php echo $row['product_id']; ?>" id="" class="btn btn-success bplus" data-type="plus" data-field="quant[2]" value="">
            <span class="fa fa-plus"></span>
            </a>
        </span>
</div>
</td>
<td class="subtotal"><?php 
                        echo $total;
                        $subtotal += $total;
                      ?></td>
</tr>


        <?php
      };

  }

 ?>


          	</tbody>
          </table>
        </div>
      </div>
      <div class="col-md-5">
        <form method="post">
          <div class="pl-3">
            <ul class="list-group">
              <li class="list-group-item list-group-item-secondary">Cart Sub total <span class="float-right" id="totalAmount">$ <?php echo $subtotal; ?></span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Tax <span class="float-right">10%</span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Shipping cost <span class="float-right">Free</span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Total <span class="float-right" id="finalAmount">$ <?php echo $final_total =($subtotal*0.1)+$subtotal; ?></span></li>
            </ul>
          </div>
          <br>
          <br>
          <a href="checkout.php?price=<?php echo $final_total; ?>" class="btn btn-primary float-right" name="save">checkout</a>
          <br>
          <br>
        </form>
        
      </div>
  </div>
</section>
<footer class="footer text-center text-light container-fluid bg-dark">
	<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="info">
						<ul class="nav nav-pills">
							<li><a href="" class="text-white"><i class="fa fa-phone"></i> +8801712345678   </a></li>
							<li><a href="" class="text-white"><i class="fa fa-envelope"></i> bookhouse@gmail.com</a></li>
						</ul>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<button class="btn top_btn"><i class="fa fa-facebook"></i></button>
						<button class="btn top_btn"><i class="fa fa-twitter"></i></button>
						<button class="btn top_btn"><i class="fa fa-trash"></i></button>
						<button class="btn top_btn"><i class="fa fa-close"></i></button>
						<button class="btn top_btn"><i class="fa fa-folder"></i></button>
					</div>
				</div>
			</div>
		</div>
</footer>

</body>
</html>