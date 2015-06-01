<?php
include("inc/header.php");

require_once('api/TwitterAPIExchange.php');

// Access tokens from Twitter - - see: https://dev.twitter.com/apps/
$settings = array(
    'oauth_access_token'        => "",
    'oauth_access_token_secret' => "",
    'consumer_key'              => "",
    'consumer_secret'           => ""
);
// Request details
$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

// Assume post is incorrect
$post = false;

// Check for post var
if (!empty($_POST)) {
  $msg = trim($_POST['msg']);

  // Check for empty message
  if(!empty($msg)) {
    $post = true;
  }
}

// Check for post
if($post) :

  $postfields = array(
    'status' => $msg
  );

  $twitter = new TwitterAPIExchange($settings);
  $output  = $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

  $outputArray = json_decode($output);
  if(sizeof($outputArray->errors)) : ?>

    <h2>Oops: Twitter returned this message...</h2>
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <?php echo $outputArray->errors[0]->message; ?>
    </div>
    <a href="index.php" class="btn btn-lg btn-primary">
      Try again
      <span class="glyphicon glyphicon-chevron-repeat"></span>
    </a>

  <?php else : ?>

    <h2>Your message is posted</h2>
    <blockquote>
      <p>
        <?php echo $msg; ?>
      </p>
    </blockquote>
    <div class="alert alert-success" role="alert">
      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
      This is some personal message which you could add.
    </div>
    <a href="index.php" class="btn btn-lg btn-primary">
      Continue
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  <?php endif; ?>

<?php else : ?>
  <h2>Oops: Your message was not posted</h2>
  <div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    Please check if your message is not empty.
  </div>
  <a href="index.php" class="btn btn-lg btn-primary">
    <span class="glyphicon glyphicon-chevron-left"></span>
    Try again
  </a>
<?php endif; ?>

<?php include('inc/footer.php');
