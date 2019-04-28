<link href="includes/css/style.css" rel="stylesheet" media="all" type="text/css"> 

<?php
require('includes/header.php');
require('includes/informations.php');
?>
<?php

if(isset($_POST['forminscription'])) {
        $secretKey = "6LfnKZ0UAAAAAAstNqZqtdK9m-XBQJFS2mABe9IP";
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $response = json_decode($response);
        if ($response->success){

   $pseudo = htmlspecialchars($_POST['pseudo']);
      $nom = htmlspecialchars($_POST['nom']);
         $prenom = htmlspecialchars($_POST['prenom']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse, nom, prenom, permissions) VALUES(?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp, $nom, $prenom, 0));
                     $erreur = "Votre compte a bien été créé ! <a href=\"Connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}else {
      $erreur = "Captcha Incorrect !";
}}
?>


<html>
   <head>
      <title>Inscription | Héberg-FR</title>
      <meta charset="utf-8">
   </head>
   <body>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <div align="center">
      		<fieldset><legend>Inscription : </legend>
         <br /><br />
         <form  id="contact" method="POST" action="">
            <table>

                     <p><label for="pseudo">Pseudo :</label>

                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" /></p>

                    <p> <label for="prenom">Prénom :</label>
                     <input type="text" placeholder="Votre Prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" /></p>

                    <p> <label for="nom">Nom :</label>

                     <input type="text" placeholder="Votre Nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" /></p>

                     <p><label for="mail">Mail :</label>

                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" /></p>

                     <p><label for="mail2">Confirmation du mail :</label>

                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" /></p>
               <div class="clear spacer"></div>
                     <p><label for="mdp">Mot de passe :</label>

                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" /></p>

                     <p><label for="mdp2">Confirmation du mot de passe :</label>

                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" /></p>
                                    <div class="clear spacer"></div>
                                    
               <div class="g-recaptcha" data-sitekey="6LfnKZ0UAAAAAFIkIv7mZaEkd-g7KEE9JP6dKqVQ"></div>
                     <br />
                     <input type="submit" name="forminscription" value="S'inscrire" />
                  </td>
               </tr>
            </table>
         </form>	</fieldset>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>

   <style>
   .form-error {
      float:right;
   }
</style>

                     
                                       </div>

                                              </div>
<?php
require('includes/footer.php');?>