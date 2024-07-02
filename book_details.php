<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <title>Document</title>

</head>
<body>
  <?php  include('db_connect.php'); ?>
  <section class="nav justify-content-center m-3 text-warning">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Book House</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Catagories
              </button>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
  <?php

                $sql = "SELECT * FROM category";
                $result = mysqli_query($connect, $sql);
                $output = '';
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_array($result)) {
                    echo '<li><a class="dropdown-item" href="catagory.php?id=' . $row['cat_id'] . '">' . $row['cat_title'] . '</a></li>';
                  }
                }

                ?>
              </ul>
            </div>
          </ul>

          <form action="search.php" class="d-flex justify-content-end">
            <input name="searching" class="form-control me-2" type="search" placeholder="Search Books Here" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>

    </nav>
</section>

<?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM `product` WHERE product_id='{$id}'";
  $result = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($result);
  //print_r($data);
 ?>


    <section class="container m-5">
        <div class="row">
          <div class="col-md-6 ">
           
            <img class="img-fluid" src="img/<?php echo $data['product_image'] ?>" alt="Card image cap">
    
          </div>
          <div class="col-md-6 mt-5">
                <h6>Name : <span class="text-secondary"><?php echo $data['product_name'] ?></span></h6>
                <h6>Writer : <?php echo $data['writer'] ?></h6>
                <h6>Price : <span class="text-secondary">$<?php echo $data['product_price'] ?></span> </h6>
                <h6>Edition : <?php echo $data['edition']; ?></h6>
  
      <a class="btn btn-primary btn-success" href="cart.php?product=<?php echo $data['product_id']; ?>" role="button">Add to cart</a>
            </div>
        </div>
    </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>