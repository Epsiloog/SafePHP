<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\FileInclusion;
use SafePHP\Verify;

if (isset($_POST["validate_file_inclusion"])) {
    if ($_FILES["a_file_inclusion"] != null) {
        $VerifyExtension = Verify::verifyExtensionImage($_FILES["a_file_inclusion"]["name"]);
        $Signature = FileInclusion::verifySignatureImage($_FILES["a_file_inclusion"]["tmp_name"]);
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

<div class="result-container">
    <?php
    if (isset($_POST["validate_file_inclusion"]) && ($_FILES["a_file_inclusion"] != null)) {
        $result = FileInclusion::renameFile($_FILES['a_file_inclusion']['tmp_name'],$_FILES['a_file_inclusion']['name']);
        $Test = Verify::verifySignatureFile($result, "null");
        echo $Test;
    }
    ?>
    <p>
        <?php
        if (isset($rename)) {
            echo $rename;
        } else
            return;
        ?>
    </p>
</div>