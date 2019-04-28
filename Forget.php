<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=french_u5xk', 'french_u5xk', 'Paul44570');

if(isset($_GET['section'])) {

$section = htmlspecialchars($_GET['section']);

}
if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $bdd->prepare('SELECT id,pseudo FROM membres WHERE mail = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $pseudo = $mailexist->fetch();
            $pseudo = $pseudo['pseudo'];
            
            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            for($i=0; $i < 8; $i++) { 
               $recup_code .= mt_rand(0,9);
            }
            $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if($mail_recup_exist == 1) {
               $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
               $recup_insert->execute(array($recup_code,$recup_mail));
            } else {
               $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
               $recup_insert->execute(array($recup_mail,$recup_code));
            }
            $header="MIME-Version: 1.0\r\n";
         $header.='From:"Héberg-FR.fr"<support@Héberg-FR.fr>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <html>
         <head>
           <title>Récupération de mot de passe - Héberg-FR.fr</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>
                     
                     <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                     Voici votre code de récupération: <b>'.$recup_code.'</b>
                     A bientôt sur <a href="http://Héberg-FR.fr/">Héberg-FR.fr</a> !
                     
                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         mail($recup_mail, "Récupération de mot de passe - Héberg-FR.fr", $message, $header);
            header("Location:Forget.php?section=code");
         } else {
            $error = "Cette adresse mail n'est pas enregistrée";
         }
      } else {
         $error = "Adresse mail invalide";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail";
   }
}
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
      $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      if($verif_req == 1) {
         $up_req = $bdd->prepare('UPDATE recuperation SET confirme = 1 WHERE mail = ?');
         $up_req->execute(array($_SESSION['recup_mail']));
         header('Location:Forget.php?section=changemdp');
      } else {
         $error = "Code invalide";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme = $bdd->prepare('SELECT confirme FROM recuperation WHERE mail = ?');
      $verif_confirme->execute(array($_SESSION['recup_mail']));
      $verif_confirme = $verif_confirme->fetch();
      $verif_confirme = $verif_confirme['confirme'];
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
               $mdp = sha1($mdp);
               $ins_mdp = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE mail = ?');
               $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
              $del_req = $bdd->prepare('DELETE FROM recuperation WHERE mail = ?');
              $del_req->execute(array($_SESSION['recup_mail']));
               header('Location: Connexion.php');
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}
?>

<link href="includes/css/style.css" rel="stylesheet" media="all" type="text/css"> 

<?php
require('includes/header.php');
require('includes/informations.php');
?>
<fieldset>
<h4 class="title-element">Récupération de mot de passe</h4>
<?php if($section == 'code') { ?>
Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
<br/>
<form method="post">
   <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
   <input type="submit" value="Valider" name="verif_submit"/>
</form>
<?php } elseif($section == "changemdp") { ?>
Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
<form method="post">
   <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
   <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
   <input type="submit" value="Valider" name="change_submit"/>
</form>
<?php } else { ?>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
   <input type="submit" value="Valider" name="recup_submit"/></fieldset>
</form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; } ?>




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
                                              </div>
<?php
require('includes/footer.php');?>