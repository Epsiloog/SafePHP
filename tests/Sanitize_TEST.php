<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Sanitize;

if (!session_start()) {
    session_start();
}

if (isset($_POST["testSanitize"])) {
    $Filtre = Sanitize::sanitize($_POST["testSanitize"], "text");
    $raw = $_POST["testSanitize"];

    echo "<h3>Comparaison</h3>";

    echo "<strong>Entrée brute :</strong><br>";
    echo "<pre>" . htmlspecialchars($raw, ENT_QUOTES, 'UTF-8') . "</pre>";

    echo "<strong>Après sanitize :</strong><br>";
    echo "<pre>" . htmlspecialchars($Filtre, ENT_QUOTES, 'UTF-8') . "</pre>";

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
    <h2>Utiliser les filtres sanitizes</h2>
    <form action="" method="POST">

        <label for="testXSSInput">Entrée : </label>
        <input type="text" name="testSanitize" placeholder="Texte...">

        <button type="submit">
            Envoyer
        </button>
    </form>
</body>

</html>