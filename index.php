<?php

require_once "app/init.php";

$googleClient = new Google_Client;

$auth = new GoogleAuth($googleClient);

if ($auth->checkRedirectCode()) {
	header('Location: '. $_SERVER["PHP_SELF"]);
}

if(!$auth->isLoggedIn()){
	$cardTitle = "You are not a member.";
	$cardLink = $auth->getAuthUrl();
	$cardLinkText = 'Sign in <span class="oi oi-account-login"></span>';
}else{
	$auth->setToken($_SESSION['access_token']);
	$oauth2 = new Google_Service_Oauth2($googleClient);
	$userInfo = $oauth2->userinfo->get();
	$name = $userInfo["name"];
	$cardTitle = "Welcome ".$name;
	$cardLink = "logout.php";
	$cardLinkText = 'Log out <span class="oi oi-account-logout"></span>';
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Google PHP API Client</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />
</head>
<body>
	<nav class="navbar bg-secondary text-white">
		<h1>Google PHP API Client</h1>
	</nav>
	<div class="d-md-flex flex-row justify-content-around align-items-stretch align-content-stretch">
		<div class="card mt-5">
			<div class="card-header">
			<h2>Google PHP API Client</h2>
			</div>
			<img class="card-img-top" src="http://placehold.it/500x250" alt="Card image cap">
			<div class="card-body">
				<p class="card-title"><?php echo $cardTitle; ?></p>
				<a href="<?php echo $cardLink; ?>" class="card-link btn btn-primary"><?php echo $cardLinkText; ?></a>
			</div>
		</div>
	</div>
</body>
</html>