<?php
require_once __DIR__ . '/../vendor/autoload.php';
use SafePHP\FileInclusion;
use SafePHP\Verify;
use SafePHP\Exceptions;

$Succes = "Fichier inclus avec succès !";

//Section Image
if (isset($_POST["validate_image_inclusion"])) {
    if ($_FILES["an_image_inclusion"] != null && $_FILES["an_image_inclusion"]["error"] === UPLOAD_ERR_OK) {
        $VerifyExtension = Verify::verifyExtensionImage($_FILES["an_image_inclusion"]["name"]);
        if ($VerifyExtension === 1) {
            $Signature = FileInclusion::verifySignatureImage($_FILES["an_image_inclusion"]["tmp_name"]);
            if ($Signature === false) {
                echo Exceptions::getErreurSignature() . " une image !</p>";
            } else {
                echo $Succes;
            }
        } else {
            echo Exceptions::getErreurExtension();
        }
    } else {
        echo Exceptions::getErreurFichierVide();
    }
}

//Section Video
if (isset($_POST["validate_video_inclusion"])) {
    if ($_FILES["a_video_inclusion"] != null && $_FILES["a_video_inclusion"]["error"] === UPLOAD_ERR_OK) {
        $Signature = Verify::verifySignatureFile(
            $_FILES["a_video_inclusion"]["tmp_name"],
            $_FILES["a_video_inclusion"]["name"],
            "Videos"
        );
        if ($Signature === false) {
            echo Exceptions::getErreurSignature() . " une vidéo !</p>";
        } else {
            echo $Succes;
        }
    } else {
        echo Exceptions::getErreurFichierVide();
    }
}

//Section Fichier
if (isset($_POST["validate_document_inclusion"])) {
    if ($_FILES["a_document_inclusion"] != null && $_FILES["a_document_inclusion"]["error"] === UPLOAD_ERR_OK) {
        $Signature = Verify::verifySignatureFile(
            $_FILES["a_document_inclusion"]["tmp_name"],
            $_FILES["a_document_inclusion"]["name"],
            "Documents"
        );
        if ($Signature === false) {
            echo Exceptions::getErreurSignature() . " un document !</p>";
        } else {
            echo $Succes;
        }
    } else {
        echo Exceptions::getErreurFichierVide();
    }
}
?>
<div class="inclusion-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="extension_valides">Format attendu(s) : png, jpeg, jpg, gif</label>
        <br>
        <input type="file" name="an_image_inclusion">
        <button type="submit" name="validate_image_inclusion">
            Inclure l'image
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
        <label for="extension_valides">Format attendu(s) : pdf, doc, docx, txt, odt, ppt, pptx</label>
        <br>
        <input type="file" name="a_document_inclusion">
        <button type="submit" name="validate_document_inclusion">
            Inclure le fichier
        </button>
    </form>
</div>