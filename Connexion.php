<link href="includes/css/style.css" rel="stylesheet" media="all" type="text/css"> 
<?php
session_start(); 
$bdd = new PDO('mysql:host=localhost;dbname=french_u5xk', 'french_u5xk', 'Paul44570');
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
                  $_SESSION['nom'] = $userinfo['nom'];
                           $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
setCookie('pseudo',$userinfo['pseudo'],time()+24*3600);
setCookie('nom',$userinfo['nom'],time()+24*3600);
setCookie('prenom',$userinfo['prenom'],time()+24*3600);
setCookie('mail',$userinfo['mail'],time()+24*3600);
setCookie('id',$userinfo['id'],time()+24*3600);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<?php
require('includes/header.php');
require('includes/informations.php');
?>
<html>
   <head>
      <title>Connexion | Héberg-FR</title>
      <meta charset="utf-8">
   </head>
   <body>
    <section class="section section-hero section-scrim-25 section-100vh" style="background: url(../www.nationsglory.fr/theme/site/img/header_hd_sombre.png) rgb(0, 0, 0);background-size: cover;background-position-x: -500px;">
      <div class="hero-top"></div>
      <div class="hero-container container">
        <div class="row align-items-center">
          <div class="col-8 hero-content">
            <h1 class="hero-heading">Hosting Proposer par <b>Héberg-FR</b>, de grand projets vous attendent !</h1>
            <p class="hero-muted">
             Rejoins-nous sur Discord : <a href="https://discord.gg/YVBPJrY">ICI</a>
            </p>
          </div>
          <div class="col-4">
            <div class="card signin-container">
                            <div class="card-heading">
                <h2>Connexion</h2>
              </div>
              <div class="card-body">
                <form action="Connexion.php" method="POST">
                  <input placeholder="Email" name="mailconnect" type="text" class="form-control">
                  <input placeholder="Mot de passe" name="mdpconnect" type="password" class="form-control">
                  <div class="clear"></div>
                  <div class="spacer"></div>
                  <div class="flex-row align-items-center space-between">
                     <a href="Forget.php" class="black-50">Mot de passe oublié ?</a>
                    <button type="submit" name="formconnexion" class="btn btn-grey">CONNEXION</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
              <div class="card-footer">
                <a href="Inscriptions.php" class="btn btn-block btn-whitesmoke">Inscrivez vous ici !</a>
              </div>
      <div class="hero-bottom">
        <div class="container space-between">
          <p>
            <strong>Nouveau dans le coin ?</strong> Découvre nos offres dès aujourd’hui !          </p>
          <a href="faq.php" class="btn btn-icon">
            <i class="icon material-icons">play_circle_filled</i>
            <span>Découvrer Héberg-FR</span>
          </a>
        </div>
      </div>
    </section>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
                                              </div>
<?php
require('includes/footer.php');?>