<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\FileInclusion;
use SafePHP\Verify;

if(isset($_POST["validate_file_inclusion"])) {
    if($_FILES["a_file_inclusion"] != null) {
        $VerifyExtension = Verify::verifyExtension($_FILES["a_file_inclusion"]["name"]);
        if ($VerifyExtension === 1) {
            echo "<p>Format valide !</p>";
        } else {
            echo "<p>Format non valide !</p>";
        }
    }
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="extension_valides">Format attendu(s) : png, jpg, jpeg</label>
    <br>
    <input type="file" name="a_file_inclusion">
    <button type="submit" name="validate_file_inclusion">
        Inclure le fichier
    </button>
</form>