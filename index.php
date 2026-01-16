<?php
require_once "./config/router.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="<?php include_once $ressourceCSS; ?>">
    <title>SafePHP | Accueil</title>
</head>
<header>
    <?php
    include_once "./Components/navbar.php";
    ?>
</header>

<body>
    <section>
        <?php
        include_once $content;
        ?>
    </section>
</body>


<footer>
    <?php
    include_once "./Components/footer.php";
    ?>
</footer>
</html>