<nav class="navbar bg-dark navbar-dark navbar-expand-sm">
  <div class="container-fluid px-5">
    <a href="#" class="navbar-brand ">Contact Store</a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#index_navbar" aria-controls="login_navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end " id="index_navbar">
        <ul class="navbar-nav text-center">
          <li class="nav-item index_username"><a href="" class="nav-link "><?php echo $_SESSION['login_session_name'] ?></a></li>
          <li class="nav-item "><a href="" id="add_contact" data-toggle="modal" data-target="#contact_modal" class="nav-link">Add Contact</a></li>
          <li class="nav-item "><a href="./logout.php" class="nav-link">Logout</a></li>
        </ul>
    </div>
  </div>

</nav>
