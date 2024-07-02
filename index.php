<?php include "db_connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['username'])) {
  $name = $_SESSION['username'];
}else{
  $name = '';
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: index.php");
}
 ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <title>Book</title>
</head>

<body>
  <h2 class="p-3 text-light bg-success"><span>Welcome  <?php echo $name; ?></span><span class="float-right"></span>
    <?php if(isset($_SESSION['login'])){ echo '<a href="?logout" class="btn btn-small btn-primary float-right">logout</a>'; 
      } else{
        echo '<a href="login" class="btn btn-small btn-primary float-right">logIn</a>';
      }

    ?>
  </h2>

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
  $sql = "SELECT * FROM `product`";
  $result = mysqli_query($connect, $sql);
 ?>
<section class="container m-5">
  <h2 class="text-center p-3 text-light bg-success">All Booklist</h2>
  <div class="row">
    <?php 

    if ($result) {
      while ($data = mysqli_fetch_array($result)) {
    ?>
    <div class="col-md-4 mt-1">
      <img class="img-fluid" src="img/<?php echo $data['product_image'] ?>" alt="Card image cap" style="width: 300px;height: 300px;">
      <br>
        <div class=" d-inline p-1 float-left"><?php echo $data['product_name']; ?></div>
        <div class=" d-inline p-1 float-right " style="margin-right: 70px;">$<?php echo $data['product_price']; ?></div>
      <br>
      <a class="btn btn-primary btn-success float-right" href="book_details.php?id=<?php echo $data['product_id']; ?>" role="button" style="margin-right: 70px;">Book Details</a>
    </div>
    <?php } }?>
  </div>
</section>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>