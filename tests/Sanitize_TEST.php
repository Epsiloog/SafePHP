<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Sanitize;

if (!session_start()) {
    session_start();
}

if (isset($_POST["testSanitize"])) {
    $FiltreText = Sanitize::sanitize($_POST["testSanitize"], "text");

    $FiltreMail = Sanitize::sanitize($_POST["testSanitizeMail"], "email");

    echo "<h3>Comparaison</h3>";
    echo "<strong>Entrée brute :</strong><br>";
    echo "<pre>" . $FiltreText . "</pre>";
    echo "<strong>Après sanitize :</strong><br>";
    echo "<pre>" . htmlspecialchars($FiltreText, ENT_QUOTES, 'UTF-8') . "</pre>";

    echo "<strong>Entrée brute :</strong><br>";
    echo "<pre>" . $FiltreMail . "</pre>";
    echo "<strong>Après sanitize :</strong><br>";
    echo "<pre>" . htmlspecialchars($FiltreMail, ENT_QUOTES, 'UTF-8') . "</pre>";
}

?>
<head>
    <title>Test Form</title>
</head>

<body>
    <h2>Utiliser les filtres sanitizes</h2>
    <form action="" method="POST">

        <label for="testXSSInput">Entrée : </label>
        <input type="text" name="testSanitize" placeholder="Texte...">
        <br>
        <input type="email" name="testSanitizeMail" placeholder="adresse@mail.com">
        <br>
        <button type="submit">
            Envoyer
        </button>
    </form>
</body>

</html>