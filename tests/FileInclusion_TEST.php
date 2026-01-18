<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\FileInclusion;
use SafePHP\Verify;

//Section Image
if (isset($_POST["validate_image_inclusion"])) {
    if ($_FILES["an_image_inclusion"] != null) {
        $VerifyExtension = Verify::verifyExtensionImage($_FILES["an_image_inclusion"]["name"]);
        $Signature = FileInclusion::verifySignatureImage($_FILES["an_image_inclusion"]["tmp_name"]);
    }
}


//Section Video
if (isset($_POST["validate_video_inclusion"])) {
    if($_FILES["a_video_inclusion"]) {
        $Test = Verify::verifySignatureFile($_FILES["a_video_inclusion"]["name"], "Videos");
        if ($Test === false) {
            echo "Erreur : La signature de ce fichier ne correspond pas à celle attendue pour une vidéo!";
        } else {
            echo $Test;
        }
    }
}

//Section Fichier
if (isset($_POST["validate_document_inclusion"])) {
    if ($_FILES["a_document_inclusion"]) {
        $Test = Verify::verifySignatureFile($_FILES["a_document_inclusion"]["name"], "Documents");
        if ($Test === false) {
            echo "Erreur : La signature de ce fichier ne correspond pas à celle attendue pour un document!";
        } else {
            echo $Test;
        }
    }
}
?>

<div class="inclusion-container">
    <form action="" method="POST" enctype="multipart/form-data"></form>
    <label for="extension_valides">Format attendu(s) : png, jpeg, jpg, gif</label>
    <br>
    <input type="file" name="an_image_inclusion">
    <button type="submit" name="validate_image_inclusion">
        Inclure le fichier
    </button>
    </form>
</div>

<br>
<div class="inclusion-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="extension_valides">Format attendu(s) : mov, mp4, m4a</label>
        <br>
        <input type="file" name="a_video_inclusion">
        <button type="submit" name="validate_video_inclusion">
            Inclure la vidéo
        </button>
    </form>
</div>

<br>
<div class="inclusion-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="extension_valides">Format attendu(s) : png, jpg, jpeg</label>
        <br>
        <input type="file" name="a_document_inclusion">
        <button type="submit" name="validate_document_inclusion">
            Inclure le fichier
        </button>
    </form>
</div>