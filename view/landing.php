<?php 
    require './common/header.php';
    require './common/navbar.php';
?>

<link rel="stylesheet" href="../Public/styles/style.css">
<div class="landing">
  <div class="dark-overlay landing-inner text-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="display-3 mb-4">Developer Hub</h1>
          <p class="lead">Share posts and get help from other developers</p>
          <hr />
          <a href="../index.php?act=register" class="btn btn-lg btn-info mr-2"
            >Sign Up</a
          >
          <a href="../index.php?act=login" class="btn btn-lg btn-light"
            >Login</a
          >
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
    require './common/footer.php';
?>