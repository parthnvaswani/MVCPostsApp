<?php 
    require './common/header.php';
    require './common/navbar.php';
?>
  <style>.error-message {
  padding: 7px 10px;
  background: #fff1f2;
  border: #ffd5da 1px solid;
  color: #d6001c;
  border-radius: 4px;
  margin: 30px 10px 10px 10px;
}</style>
  <div class="register">
    <div class="container">
      <div class="row">
        <div class="col-md-8 m-auto">
          <h1 class="display-4 text-center">Sign Up</h1>
          <p class="lead text-center">Create your DevConnector account</p>
          <form action="../index.php?act=register" method="post">
            <div class="form-group">
              <input type="username" class="form-control form-control-lg" placeholder="username" name="username" minlength="5" required/>
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" minlength="8" required/>
            </div>
            <?php 
                if(isset($_SESSION["errorMessage"])) {
                ?>
                <div class="error-message"><?php  echo $_SESSION["errorMessage"]; ?></div>
                <?php 
                unset($_SESSION["errorMessage"]);
                } 
            ?>
            <input type="submit" class="btn btn-info btn-block mt-4" name="register" />
          </form>
        </div>
      </div>
    </div>
  </div>
<?php 
    require './common/footer.php';
?>