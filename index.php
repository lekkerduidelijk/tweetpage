<?php include('inc/header.php'); ?>

      <h2>Post a tweet</h2>
      <form method="post" action="tweet.php">
        <div class="form-group">
          <textarea class="form-control" id="msg" name="msg" rows="3" required maxlength="140"></textarea>
          <p class="help-block">Maximum of 140 characters</p>
        </div>

        <button type="submit" class="btn btn-lg btn-primary">
          Send
          <span class="glyphicon glyphicon-chevron-right"></span>
        </button>
      </form>

<?php include('inc/footer.php');
