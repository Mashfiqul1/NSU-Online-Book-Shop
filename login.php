<?php include 'db_connect.php'; ?>
<?php
session_start();
if (isset($_SESSION['login'])) {
  header('Location: index.php');
}

$connect = mysqli_connect("localhost", "root" );

mysqli_select_db($connect, 'group3');

if(isset($_POST['submit'])){
 
  $sql = "SELECT * FROM user WHERE username='{$_POST['username']}' AND password='{$_POST['password']}'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
  if ($row > 0) {
    $_SESSION['login'] = 'true';
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];;
    header('location:index.php');
  }else{
    echo '<h4 class="text-center p-3 text-danger">username and password is incorrect</h4>';
  }
  
} 

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>

<body>

  <section class="container-fluid mt-5 mb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 bg-secondary">
          <form class=" p-3" method="post">

            <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username</label >
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" placeholder="Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10 mb-2 ">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12 ml-2 " align="center">
                <input class="btn btn-primary" align="float-right" type="submit" name="submit" value="login">
              </div>
            </div>
            
          </form>
          <div class="form-group row">
              <div class="col-sm-6 ml-2 ">
                <p class="text-light">Create Your Account</p>
                <a href="register.php" class="btn btn-success" align="float-right">SignUp</a>
              </div>
            </div>
        </div>
        <div class="col-md-6"></div>
      </div>
    </div>
    </div>
  </section>



</body>

</html>