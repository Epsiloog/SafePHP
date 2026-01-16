<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Verify;

if(isset($_POST["test_verify"]) && !empty($_POST["test_verify"])) {
    $InputInt = $_POST["test_verify"];
    $Verify = Verify::verify($Input, "integer");

    $InputString = $_POST["test_verify_string"];
    $VerifyBis = Verify::verify($InputString, "string");
    
    if($Verify === 0) {
        echo "Pas le bon TYPE : " . gettype($InputInt);
    } else {
        echo "Bon type !";
    }
    
    if ($VerifyBis === 0) {
        echo "Pas le bon TYPE : " . gettype($InputString);
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
        <label for="input_int">Int Input</label>
        <input type="number" name="test_verify_int">
        
        <label for="input_string">String Input</label>
        <input type="text" name="test_verify_string">

        <button type="submit" name="test_verify">
            Créer le formulaire
        </button>
    </form>
</body>
</html>