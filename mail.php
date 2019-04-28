<link href="includes/css/style.css" rel="stylesheet" media="all" type="text/css"> 
<?php
require('includes/header.php');
require('includes/informations.php');
require('includes/contact.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Contact | Héberg-FR</title>

</head>
<body>


<center>
<form id="contact" method="post" action="mail.php">
	<fieldset><legend>Contact Support : </legend>
		<p><label for="nom">Pseudonyme : </label><?php echo "<input type='text' id='nom' name='nom' value='" . $_COOKIE['pseudo'] . "' />"; ?></p>
		<p><label for="email">Email : </label><input type="text" id="email" name="email" /></p>
		<p><label for="objet">Objet De l'e-mail : </label><input type="text" id="objet" name="objet" /></p>
		<p><label for="message">Message : </label><textarea id="message" name="message" cols="30" rows="10"></textarea></p>
<div class="g-recaptcha" data-sitekey="6LfnKZ0UAAAAAFIkIv7mZaEkd-g7KEE9JP6dKqVQ"></div>
	</fieldset>

	<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer" /></div>


</form>

</center>
<script src="https://www.google.com/recaptcha/api.js"></script>
                                              </div>
<?php
require('includes/footer.php');?>