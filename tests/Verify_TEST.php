<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Verify;

if(isset($_POST["test_verify"])) {
    $Input = $_POST["test_verify"];
    $TypeToHave = "integer";
    var_dump(gettype($Input), $Input);
    $Verify = Verify::verify($Input, $TypeToHave);
    if($Verify === 0) {
        echo "Pas le bon TYPE !!";
    } else {
        echo "Bon type !";
    }

    if (is_numeric($Input) && (int) $Input == $Input) {
        echo "C'est un nombre entier !";
    }
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
        <label for="checkboxInput">Input</label>
        <input type="number" name="test_verify">

        <button type="submit">
            Créer le formulaire
        </button>
    </form>
</body>
</html>