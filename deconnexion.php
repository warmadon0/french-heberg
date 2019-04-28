<?php
session_start();
$_SESSION = array();
setCookie('id','0',time()+24*3600);
setCookie('pseudo','',time()+24*3600);
setCookie('prenom','',time()+24*3600);
setCookie('nom','',time()+24*3600);
setCookie('mail','',time()+24*3600);

setCookie('deco','10',time()+24*3600);

session_destroy();
header("Location: index.php");
?>