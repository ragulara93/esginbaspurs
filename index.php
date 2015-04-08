<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    session_start();
	require("facebook-php-sdk-v4-4.0-dev/autoload.php");
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    
    const APPID = "1556890417914830";
    const APPSECRET = "e58912ad3ae1f534444a84525b8ce791";
    FacebookSession::setDefaultApplication(APPID, APPSECRET);
    $helper = new FacebookRedirectLoginHelper('https://esginbaspurs.herokuapp.com/');
    if( isset($_SESSION) &&  isset($_SESSION['fb_token']))
    {
      $session  = new FacebookSession($_SESSION['fb_token']);
    }else
    {
      $session = $helper->getSessionFromRedirect();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Titre de ma page</title>   
        <meta name="description" content="description de ma page">
       
    </head>
    <body>
         <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '<?php echo APPID;?>',
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


        <h1>Mon application facebook</h1>

        <div
          class="fb-like"
          data-share="true"
          data-width="450"
          data-show-faces="true">
        </div>
        <br>
        <!-- <div class="fb-comments" data-href="http://skrzypczyk.fr" data-numposts="5" data-colorscheme="light"></div> -->
        <br>

        <?php
          if($session)
          {
            
            $token = (string) $session->getAccessToken();
            $_SESSION['fb_token'] = $token;
            //Prepare
            $request = new FacebookRequest($session, 'GET', '/me');
            //execute
            $response = $request->execute();
            //transform la data graphObject
            $user = $response->getGraphObject("Facebook\GraphUser");
           /* echo "<pre>";
            print_r($user);
            echo "</pre>";*/
        
          }else{
            $loginUrl = $helper->getLoginUrl();
            echo "<a href='".$loginUrl."'>Se connecter</a>";
          }
            
        ?>
    </body>
</html>

