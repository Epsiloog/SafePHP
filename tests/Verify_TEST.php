<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Verify;

if(isset($_POST["test_verify"]) && !empty($_POST["test_verify"])) {
    $Input = $_POST["test_verify"];
    $Verify = Verify::verify($Input, "integer");
    
    if($Verify === 0) {
        echo "Pas le bon TYPE : " . gettype($Input);
    } else {
        echo "Bon type !";
    }
} else {
    echo "Valeur non saisie ou vide !";
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
    <h2>Test de typage</h2>
    <form action="" method="POST">
        <label for="input">Input</label>
        <input type="number" name="test_verify">

        <button type="submit">
            Créer le formulaire
        </button>
    </form>
</body>
</html>