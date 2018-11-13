<?php
$mail = "devunity62400@gmail.com"; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_html = "<html><head></head><body><center>Bonjour, <br/> ".htmlentities($_POST['user'])."  vous contact pour ".htmlentities($_POST['raison'])." voici sont message <br/><br/> ".htmlentities($_POST['contenue'])."</center></body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Prise de contact de ".$_POST['user'].", pour ".$_POST['raison']." ";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"".addslashes($_POST['user'])."\"<".addslashes($_POST['email']).">".$passage_ligne;
$header.= "Reply-to: \"".addslashes($_POST['user'])."\" <".addslashes($_POST['email']).">".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
header('location: contact_true.php?valide=true');
//==========

