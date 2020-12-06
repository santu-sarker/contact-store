<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="./images/icon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/registration.css">

  <title>Registration Page</title>
</head>
  <body>
  <div class="container-fluid p-0 main_div">

<div class="">
  <?php include './Side_views/login_navbar.php'?>
</div>
<div class="row justify-content-center my-3">
  <div class="card col-lg-6 col-md-8 col-sm-10 col-12 justify-content-center p-5 m-5 user_card">
    <?php
if (isset($_SESSION['error_type'])) {?>
        <div class="alert alert-<?php printf($_SESSION['error_type']);?> alert-dismissible fade show text-center" role="alert">
          <strong><?php echo $_SESSION['error'] ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
         </div>

      <?php
unset($_SESSION['error_type']);}?>
    <form class="form-signin" action="./includes/registration.inc.php" method="POST" autocomplete="on">
      <h1 class="h3 mb-3 text-center register_head p-2">Page Registration Form</h1>
      <div class="card-body justify-content-center">
        <div class="row my-3">

          <input type="name" name="user_name" id="user_name" class="form-control col-lg-12 col-md-12 col-sm-12 col-12  " placeholder="Enter User Name" required autofocus>


        </div>
        <div class="row my-3">

          <input type="number" name="user_number" id="user_number" class="form-control col-12 "  placeholder="Enter Your Contact Number" required autofocus>

        </div>
        <div class="row my-3">

          <input type="email" name="user_email" id="user_email" class="form-control col-12 "  placeholder="Enter a Valid Email Adress" required autofocus>

        </div>
        <div class="row my-3">

          <input type="password" name="user_pass" id="page_Password" class="form-control col-12" placeholder="Enter a Password" required>

        </div>
        <div class="row my-3">

          <input type="password" name="user_confirm_password" id="confirm_password" class="form-control col-12" placeholder="Confirm Entered Password" required>

        </div>
        <div class="row">
          <div class="text col-3 ">Gender</div>
          <div class=" form-check col-3 ">
          <label class="gender-check-label" for="male">
          <input  type="radio" class="form-check-input" id="male" name="gender" value="male" >Male
          </label>
          </div>
          <div class="form-check col-3">
          <label class="gender-check-label" for="female">
          <input type="radio" class="form-check-input" id="female" name="gender" value="female">Female
          </label>
          </div>
        </div>
        <div class="row checkbox ">

          <label class="form-check-label col-lg-12 col-md-12 col-sm-12 col-12">
            <input type="checkbox" name="check_box" id="page_checkbox" class="form-check-input" required>
            I Read and Accept <a href="#">Terms and Conditions</a>
          </label>

        </div>

      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit" name="submit" >Sign in</button>
    </form>


  </div>

</div>


</div>

      <!-- Bootstrap Js -->
      <script src="./javascripts/jquery-3.5.1.min.js"></script>
      <script src="./javascripts/bootstrap.min.js"></script>
      <script src="./javascripts/popper.min.js"></script>
      <script src="./javascripts/all.min.js"></script>

  </body>
</html>
