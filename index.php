<?php 
require_once './vendor/autoload.php';

$clientID = '224762843069-o6jpcp7unjcf4h519fjr8v6qk6b2jo1h.apps.googleusercontent.com';
$clientSecret = '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';
// $redirectUrl = 'http://localhost:3000/';
$redirectUrl = 'https://eventsaroundyou.netlify.app/';

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