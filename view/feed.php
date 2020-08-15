<?php 
    require './common/header.php';
    require './common/navbar.php';
?>
<script>let user='<?php echo $_SESSION['userDetails']; ?>';
</script>
  <div class="feed">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="post-form mb-3">
            <div class="card card-info">
              <div class="card-header bg-info text-white">
                Say Somthing...
              </div>
              <div class="card-body">
                <form onsubmit="addPost(event)">
                  <div class="form-group">
                    <textarea class="form-control form-control-lg" placeholder="Create a post" id="content" minlength="5" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-dark">Submit</button>
                </form>
              </div>
            </div>
          </div>

          <!-- Post Feed -->
          <div class="posts">
            
            

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<script src="../Public/scripts/feed.js"></script>
<?php 
    require './common/footer.php';
?>