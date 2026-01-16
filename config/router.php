<?php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "accueil":
            $content = "./Components/accueill.php";
            $title = "SafePHP | Accueil";
            $ressourceCSS = "./Styles/accueil.css";
            break;

        case "test_csrf":
            $content = "./tests/CSRF_TEST.php";
            $title = "SafePHP | Test CSRF";
            $ressourceCSS = "";
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

        default:
            $content = "./Components/404.php";
            $title = "SafePHP | Page non trouvée !";
            $ressourceCSS = "./Styles/404.css";
            break;
    }
} else {
    $content = "./Components/accueill.php";
    $title = "SafePHP | Accueil";
    $ressourceCSS = "./Styles/accueil.css";
}