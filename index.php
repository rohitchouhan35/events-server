<?php 
require_once './vendor/autoload.php';

$clientID = '224762843069-.apps.googleusercontent.com';
$clientSecret = 'GOCSPX-';
$redirectUrl = 'http://localhost:3000/';

// creating client request to google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email');

// redirect after login
if(isset($_GET['code'])) {
    
}
else {
    echo "<a href='".$client->createAuthUrl()."'>Login with Goggle</a>";
}
?>
<body>
    <h1>hii</h1>
</body>