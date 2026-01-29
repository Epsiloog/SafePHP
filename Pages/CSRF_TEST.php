<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\CSRF;

if (isset($_POST["text_test"])) {
    CSRF::verifyCSRF();
}

?>

<div class="test-csrf">
    <form action="" method="POST">
        <?php CSRF::createCSRF(); ?>

        <input type="text" name="text_test" id="text_test" placeholder="Votre texte...">

        <button type="submit" onclick="<?php ?>">
            Envoyer
        </button>
    </form>
</div>