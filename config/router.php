<?php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "accueil":
            $content = "./Components/accueill.php";
            $title = "SafePHP | Accueil";
            $ressourceCSS = "./styles/accueil.css";
            break;

        case "test_csrf":
            $content = "./tests/CSRF_TEST.php";
            $title = "SafePHP | Test CSRF";
            $ressourceCSS = "./styles/CSRF_TEST.css";
            break;

        case "test_verify":
            $content = "./tests/Verify_TEST.php";
            $title = "SafePHP | Test Verify";
            $ressourceCSS = "";
            break;

        case "test_sanitize":
            $content = "./tests/Sanitize_TEST.php";
            $title = "SafePHP | Test Sanitize";
            $ressourceCSS = "";
            break;

        case "test_auth":
            $content = "./tests/Auth_TEST.php";
            $title = "SafePHP | Test Sanitize";
            $ressourceCSS = "";
            break;

        case "test_form":
            $content = "./tests/Form_TEST.php";
            $title = "SafePHP | Test Form";
            $ressourceCSS = "./styles/Form_TEST.css";
            break;

        case "test_file_inclusion":
            $content = "./tests/FileInclusion_TEST.php";
            $title = "SafePHP | Test Form";
            $ressourceCSS = "./styles/Form_TEST.css";
            break;

        case "test_sri":
            $content = "./tests/Test_SRI.php";
            $title = "SafePHP | Test SRI";
            $ressourceCSS = "./styles/Form_TEST.css";
            break;

        case "test_network":
            $content = "./tests/Network_TEST.php";
            $title = "SafePHP | Test Réseau";
            $ressourceCSS = "./styles/Form_TEST.css";
            break;

        default:
            $content = "./Components/404.php";
            $title = "SafePHP | Page non trouvée !";
            $ressourceCSS = "./styles/404.css";
            break;
    }
} else {
    $content = "./Components/accueill.php";
    $title = "SafePHP | Accueil";
    $ressourceCSS = "./styles/accueil.css";
}

/* ===============LISTE BLANCHE POUR LE ROUTEUR PHP======================
$pages_whitelist = array(
    '1' => 'home.php',
    '2' => 'account.php',
    '3' => 'commands.php'
);

$page = $_GET['page'];
if (array_key_exists($page, $pages_whitelist)) {
    include $pages_whitelist[$page];
}
else {
    erreur
}
*/