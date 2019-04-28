<link href="includes/css/style.css" rel="stylesheet" media="all" type="text/css"> 
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=french_u5xk', 'french_u5xk', 'Paul44570');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<?php
require('includes/header.php');
require('includes/informations.php');
?>
<html>
   <head>
      <title>Profil | Héberg-FR</title>
      <meta charset="utf-8">
   </head>
   <body>
      <style>
      u2 {
 color:#FF0000;
 font-weight:bold
 }
u1 {
 color:#0026FF;
 font-weight:bold
 }
u {
 color:#4800FF;
 font-weight:bold
 }
</style>
      <div align="center">
         <h2>Profil de <?php if($userinfo['permissions'] == 4){
echo '<u2>Admin</u2> ';
         }elseif ($userinfo['permissions'] == 3) {
echo '<u1>Modérateur</u1> ';
         }elseif ($userinfo['permissions'] == 2) {
echo '<u> Partenaire</u> ';
         } echo $userinfo['pseudo']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['pseudo']; ?>
         <br />
                  Nom = <?php echo $userinfo['nom']; ?>
         <br />
                  Prénom = <?php echo $userinfo['prenom']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>
   </body>
</html>
<?php   
}
?>

                                              </div>
<?php
require('includes/footer.php');?>