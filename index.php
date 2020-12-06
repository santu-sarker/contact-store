<?php
session_start();
if (!isset($_SESSION['login_session_id'])) {
    header("location: ./login.php");

}
//define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
//printf(ROOT_PATH);
include_once "./includes/contact_operation.inc.php";
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="./images/icon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <link rel="stylesheet" type='text/css' href="./css/index.css">
  <script defer src="./javascripts/contact.js"></script>
  <title>Contact Store</title>
</head>
  <body>

<div class="container-fluid p-0 main_div">

      <div class="">
        <?php include './Side_views/index_navbar.php'?>
      </div>
      <?php include './Side_views/add_contact.php'?>
      <?php include './Side_views/delete_contact.php'?>

  <div class="row justify-content-center">
  <div class=" card col-lg-10 col-md-10 col-sm-10 col-12 p-5 m-5">
  <?php
if (isset($_SESSION['contact_type'])) {?>
        <div class="alert alert-<?php printf($_SESSION['contact_type']);?> alert-dismissible fade show text-center" role="alert">
          <strong><?php echo $_SESSION['contact_msg'] ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
         </div>

      <?php unset($_SESSION['contact_type']);}?>

  <?php if (!empty($contact_details)) {?>
    <div class="table-responsive">
      <table class="table table-bordered ">
        <thead class="thead-light text-center">
          <tr>
            <th scope="col">Rows</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>

        <?php $id = 1;
    foreach ($contact_details as $contact) {
        ?>
          <tbody class="text-center">

            <tr>
              <th scope="row"><?php echo $id ?></th>
              <td style="display:none;"><?php echo $contact['contact_id'] ?></td>
              <td><?php echo $contact['contact_name'] ?></td>
              <td><?php echo $contact['contact_number'] ?></td>
              <td><?php echo $contact['contact_email'] ?></td>
              <td><button class="btn btn-warning edit_modal" >Edit</button></td>
              <td><button class="btn btn-danger delete_modal" >Delete</button></td>
            </tr>
          </tbody>
        <?php $id++;}?>

      </table>
      </div>

    <?php } else {?>
        <h5 class="text-center">No Contacts Available<h5>
   <?php }?>
    </div>
  </div>


</div>



      <!-- Bootstrap Js -->
      <script src="./javascripts/jquery-3.5.1.min.js"></script>
      <script src="./javascripts/bootstrap.min.js"></script>
      <script src="./javascripts/popper.min.js"></script>
      <script src="./javascripts/all.min.js"></script>
      <!-- <script src="./javascript/header.js"> </script> -->
  </body>
</html>

