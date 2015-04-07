<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);


	session_start();


	require("facebook-php-sdk-v4-4.0-dev/autoload.php");

	use Facebook\FacebookSession; /*on charge tout mais on les initialise pas. Ta inclu la page et maintenetant on l'initialise.*/
	use Facebook\FacebookRedirectLoginHelper;

	//variable défini une seule fois et que l'on peu plus modifier
	const APP_ID = "1556890417914830";
	const APP_SECRET = "e58912ad3ae1f534444a84525b8ce791";

	FacebookSession::setDefaultApplication(APP_ID, APP_SECRET);

	$helper = new FacebookRedirectLoginHelper('https://esginbaspurs.herokuapp.com/');
	$loginUrl = $helper->getLoginUrl();
	// Use the login url on a link or button to redirect to Facebook for authentication


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ESGI NBA SPURS</title>
		<meta name="description" content="description de ma page"> 

		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '<?php APP_ID; ?>',
		      xfbml      : true,
		      version    : 'v2.3'
		    });
		  };

		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/fr_FR/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		</script>

	</head>

	<body>
		<a href="<?php echo $loginUrl; ?>">Se connecter</a>
		<br><br><br>
		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>

	</body>



</html>