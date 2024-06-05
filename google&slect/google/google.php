
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" href="css/SOSIAL.LOGIN.css">
</head>
<body>
 

<?php
require_once 'vendor/autoload.php';

 
$clientID = '27634668984-5ooshfi469quhah2nmbaj6jpcdot12hd.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/SAMIR/BOKINGG9/singGoogle/google.php';

 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

 
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

 
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  
?>

<div class="container" >
  <form action="" method="POST">
    <div class="row">
      <label for="email">Email: <?php echo $email ; ?></label>
      <label for="name">name: <?php echo $name ; ?></label>
    
    </div>
    </form>
    </div>

<?php } else { ?>

<div class="to">
  <h2>Login</h2>
  <form action="" method="POST">
    <div class="row">
      <label>Email</label>
      <input type="email" id="email" name="email" placeholder=" email" >
    </div>
    <div class="row">
      <label>Password</label>
      <input type="password" id="password" name="password" placeholder="password" >
    </div>
    <div class="row">
      <a href="" class="forgot-password"> Password?</a>
      <input type="submit" id="submit" value="Submit">
    </div>
  </form>
  <div class="or">OR</div>
  <div class="socialLogin">
    <a href="" class="socialBtn facebook">
      <img src="img/facebook.png" alt="Facebook Icon">
      Login Facebook
    </a>
    <a href=" <?php echo $client->createAuthUrl() ?> " class="socialBtn twitter">
      <img src="img/google.png" alt="Google Icon">
      Login   Twitter
    </a>
    <a href="#" class="socialBtn google">
      <img src="img/twiter.jpg" alt="Twitter Icon">
      Login   Google
    </a>
  </div>
</div>
<?php } ?>
</body>
</html>
