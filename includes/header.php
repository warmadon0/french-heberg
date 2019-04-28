
<?php $bdd = new PDO('mysql:host=localhost;dbname=french_u5xk', 'french_u5xk', 'Paul44570'); ?>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="UTF-8">
  <link href='http://fonts.googleapis.com/css?family=Ubuntu|Lato' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="includes/css/main.css">
  <link rel="stylesheet" href="includes/css/flexslider.css">
  <script src='../www.google.com/recaptcha/api.js'></script>
  <script src="../ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="theme/site/ckeditor/ckeditor.js"></script>
  <script src="../ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="manifest" href="manifest.json" />
  <script src="../cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "d1e27d7e-3e87-4e02-ad26-2a1d7cedb8c5",
      });
    });
  </script>
      <link rel="stylesheet" href="theme/site/css/mobile.css">
  <meta name="google-site-verification" content="XuNQDACWseyqVy9N65JG9-R2Hbzva_bujz-r8ZqI3dg" />
  <link rel="stylesheet" type="text/css" href="../cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <meta name="apple-itunes-app" content="app-id=1438881623, affiliate-data=myAffiliateData, app-argument=https://itunes.apple.com/fr/app/NationsGlory/id1438881623">
  <script src="../cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
  <script>
    window.addEventListener("load", function(){
      window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#eaf7f7",
            "text": "#5c7291"
          },
          "button": {
            "background": "#56cbdb",
            "text": "#ffffff"
          }
        },
        "theme": "edgeless",
        "position": "bottom-left",
        "content": {
          "message": "NationsGlory utilise des cookies propres et tiers afin d'offrir le meilleur service. Si tu utilises notre service, nous considérons que tu acceptes son utilisation.",
          "dismiss": "C'est compris !",
          "deny": "Refuser",
          "link": "En savoir plus",
          "href": "https://www.nationsglory.fr/pages/politique-de-confidentialite"
        }
      })});
    </script>
  </head>
  <body>
              <div id="topbar" class="force-small">
                    <div class="wrap">
            <a class="ham mobile">
              <div class="fa fa-bars"></div>
              </a>              <div id="logo"></div>
         
              <div class="clear"></div>
                         <ul class="navbar-nav navbar-dark ml-auto">
 <li class="nav-item">
          <a href="redirection.php?nom=index" class="nav-link">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown">Communauté</a>
          <div class="dropdown-menu">
            <a href="redirection.php?nom=faq" class="dropdown-item">
              <i class="icon material-icons">question_answer</i>
              <span>F.A.Q.</span>
            </a>
            <span class="dropdown-separator"></span>
            <a href="redirection.php?nom=staff" class="dropdown-item">L'équipe</a>
            <a href="redirection.php?nom=partners" class="dropdown-item">Partenaires</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="redirection.php?nom=mail" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
                  <a href="redirection.php?nom=shop" class="btn">
            <i class="nav-item-icon material-icons">shopping_cart</i>
            <span>Boutique</span>
          </a>
        </li>
                <li class="nav-item">
<?php  if($_COOKIE['id'] >= 1){
         echo "<a class='nav-link dropdown'>Espace Membres</a>";
         echo "<div class='dropdown-menu'>"; 

           echo "<a href='profil.php?id=";
           echo $_COOKIE['id'];  
           echo "' class='dropdown-item'>";
                     echo "<span>Mon Profil</span>";
                     echo "</a>";
 echo "<a href='editionprofil.php' class='dropdown-item'>";
                     echo "<span>Profil Edit</span>";
                     echo "</a>";
                                                       echo '<span class="dropdown-separator"></span>';
             echo '<a href="deconnexion.php" class="dropdown-item">Deconnexion</a>';
}else {
           echo "<a class='nav-link dropdown'>Connexion / Inscription</a>";
         echo "<div class='dropdown-menu'>"; 
 echo "<a href='Inscriptions.php' class='dropdown-item'>";
                     echo "<span>Inscription</span>";
                     echo "</a>";
                                  echo '<span class="dropdown-separator"></span>';
             echo '<a href="Connexion.php" class="dropdown-item">Connexion</a>';
} ?>
                  

          </div>
        </li>
 </ul>          </div>
        </div>
                      <div id="hero" style="height:150px;">
                <div class="wrap centered">
                  <a href="index.html"><div id="logotext" style="margin-bottom: 0px;max-width:330px;height:55px;margin-left:0;bottom:20%;margin-left:15px;"></div></a>
                </div>
              </div>
                        <div class="container content">
              <div class="wrap">
                                                    <script src="../apis.google.com/js/platform.js"></script>
<style>
.tile{padding:25px;height:60px;width:41%;margin:5px;float:left;}
.tileavatar{float:left;width:50px;font-size: 20px;text-align: right;}
.tiledesc{float:right;width:200px;text-align:right;font-size:14px;margin-top:-5px;}
.tiledesc a{color:white;text-decoration:none;}
.partnerbox{margin-bottom:30px;background:#f5f5f5;float:left;margin-left:10px;height:190px;width:150px;border: 1px solid #D4D4D4;padding:10px;text-align:center;box-shadow: 0 1px 3px rgba(0,0,0,0.12);}
</style>
<div class="block">
  <div class="padded">



  


    <div class="clear"></div>
