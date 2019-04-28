<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=french_u5xk', 'french_u5xk', 'Paul44570');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
