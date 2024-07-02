<?php include 'header.php'; ?>
    <section class="container m-5">
<?php include "db_connect.php"; ?>
<?php
  $search =$_GET['searching'];
  $sql = "SELECT * FROM product WHERE product_name LIKE '%{$search}%'";
  $result = mysqli_query($connect, $sql);
  //$data = mysqli_fetch_array($result);
  //print_r($data);
?>
      <h2 class="text-center p-3 text-light bg-success">All Booklist</h2>
        <div class="row">
          <?php 
            if (mysqli_num_rows($result) > 0) {
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
        <?php }}else{echo '<h2>No books found</h2>'; } ?>
          
        </div>
      </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>