<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Envoi d'un email par formulaire</title>
</head>

<body>
<?php
$retour = mail('valentin.antoin@gmail.com', $_POST['name'], $_POST['message'], $_POST['mail']);
if ($retour) {
    echo '<p>Votre message a bien été envoyé !</p>';
}
?>
</body>

</html>










