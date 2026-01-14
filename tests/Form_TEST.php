<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\CSRF;
use SafePHP\Form;

if (!session_start()) {
    session_start();
}

if(isset($_POST["createForm"])) {
    Form::createForm($_POST["number_checkbox"]);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form</title>
</head>

<body>
    <h2>Créer un formulaire</h2>
    <form action="" method="POST">

        <label for="checkboxInput">Nombre de checkbox</label>
        <input type="number" name="number_checkbox">

        <button type="submit">
            Créer le formulaire
        </button>
    </form>
</body>
</html>