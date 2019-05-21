
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Envoi d'un email par formulaire</title>
</head>

<body>
<?php
$retour = mail('valentin.antoin@gmail.com', $_POST['title'] ,$_POST['name'], $_POST['message'], $_POST['mail']);
if ($retour) {
    echo "<script>alert(\"Votre message est bien envoyé \")</script>";

    echo $twig->render('contact.twig');
}
?>
</body>

</html>
