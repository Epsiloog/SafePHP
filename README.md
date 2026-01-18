# SafePHP (Version Alpha)

## Sommaire

- [Sommaire](#sommaire)
- [Introduction](#introduction)
  - [Contenu de la librarie](#contenu-de-la-librairie)
  - [Outils requis](#outils-requis)
  - [Installation](#installation)
  - [Utilisation générale](#utilisation-générale)
  - [Foncitonalités à disposition](#fonctionalités-à-disposition)
  - [Contribution](#contribution)
- [Avant toute chose](#avant-toute-chose)
- [Les différentes classes](#les-différentes-classes)
  - [Auth](#la-classe-auth)
  - [CSRF](#la-classe-csrf)
  - [Sanitize](#la-classe-sanitize)
  - [Verify](#la-classe-verify)

## Introduction

Librairie PHP pour implémenter des moyens de cybersécurité facilment !

### Contenu de la librairie

Cette librairie contient des classes utilisables sans instancier d'objet (Donc en faisant NomDeLaclasse::NomDeLaFonction). <br>
De plus, plusieurs fichiers de configuration sont à disposition dans le dossier **config** comme :

- Un fichier de configuration Apache **.htaccess**
- Un fichier **safephp.env** où mettre vos variables d'environnement
- un fichier **php.ini** avec des modules activés/désactivés par défault

### Outils requis

PHP : Version 8.3.0 minimum \
Serveur LAMP ou XAMP (Pas pour la librairie mais votre projet PHP en général)

### Installation

**En cours de développement**

### Utilisation générale

Toutes les fonctions peuvent être utilisées sans instacier la classe SafePHP.

Vous pouvez les tester depuis la page index.php (Qui récupère les tests du dossier test).

### Fonctionalités à disposition

Pour moment, la librairie est en alpha, **Rien n'est grantie d'avoir une sécurité optimale et un fonctionnement dans 100% des cas.**

Voici les fonctionnement disponibles :

    1. Verification des types des inputs HTML dans un formulaire.
    2. Verification CSRF
    3. Nettoyage des inputs HTML
    4. Génération de formulaires avec des outils sécurisés
    5. Vérification des extensions ajoutées
    6. Vérification de la signature des fichiers (image uniquement, les autres sont en cours de développement)
    7. Fichiers de configuration dans le dossier config

### Contribution

Le projet SafePHP est en open source et libre de toute utilisation, que ce soit personnelle comme pédagogique. **Vous pouvez bien évidement contribuer activement au projet en faisant des fixs ou en apportant des features par exemple**.
Vous pouvez me conctacter à l'adresse mail thomas.thony.69@gmail.com .

## Avant toute chose

Ce projet a été fait par un étudiant en informatique, avec le moins d'utilisation d'IA possible (Pas même pour la documentation), et vérification auprès de communautées certifiées quand c'est le cas.
Je vous remercie d'être indulgent sur la qualité de code, ce projet a pour but de faciliter des développeurs pour la cyber-sécurite.

## Les différentes classes

### La classe Auth

La classe Auth contient une fonction par défaut de connexion et d'inscription, le hash utilisé est celui par défaut de PHP (d'après la documentation PHP, c'est l'algorithme [BCRYPT](https://www.php.net/manual/fr/string.constants.php#constant.crypt-blowfish)).

Il y'a également une gestion des sessions utilisateur, il y'a :

- Les fonctions **login** et **register** qui créent les sessions utilisateur.
- La fonction **logout** qui détruit toutes les sessions créées.

### La classe CSRF

La classe CSRF contient une fonction **createCSRF** qui crée un jeton CSRF, à ajouter impérativeur dans chacun de vos formulaires.
Lorsque vos formulaires sont soumis, utilisez la fonction **verifyCSRF** pour confirmer la présence de votre jeton CSRF.

```php
<?php 
use SafePHP\CSRF;

if (isset($_POST["text_test"])) {
    CSRF::verifyCSRF(); //Vérification du jeton CSRF quand le formulaire est envoyé
}
?>

<div class="test-csrf">
    <form action="" method="POST">
        <?php 
            CSRF::createCSRF(); //Création du jeton CSRF 
        ?> 

        <input type="text" name="text_test" id="text_test" placeholder="Votre texte...">

        <button type="submit" onclick="<?php ?>">
            Envoyer
        </button>
    </form>
</div>
?>
```

### La classe Sanitize

Une seule fonction **sanitize** est disponible pour le moment dans cette classe qui permet de simplifier l'utilisation des filtres **Sanitize** présents par défault dans le langage PHP.

Elle s'utilise de cette manière :

```php
<?php 
Sanitize::sanitize($Input, $TypeFiltre); //Les filtres disponibles sont : email, int, float, string, text et bool
?>
```

```php 
<?php
use SafePHP\Sanitize;

if (!session_start()) {
    session_start();
}

if (isset($_POST["testSanitize"])) {
    $FiltreText = Sanitize::sanitize($_POST["testSanitize"], "text");

    $FiltreMail = Sanitize::sanitize($_POST["testSanitizeMail"], "email");

    echo "<h3>Comparaison</h3>";

    foreach($_POST as $APost) {
        echo "<strong>Entrée brute :</strong><br>";
        echo "<pre>" . htmlspecialchars($APost, ENT_QUOTES, 'UTF-8') . "</pre>";
        echo "<strong>Après sanitize :</strong><br>";
        echo "<pre>" . htmlspecialchars($APost, ENT_QUOTES, 'UTF-8') . "</pre>";
    }
}

?>
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
```

### La classe Verify

La classe Verify possède trois listes d'extensions de fichiers disponibles, pour les documents, les images et les vidéos.
Vous pouvez voir la liste pour chaque type de fichiers en faisant :

```php
<?php
Verify::getTypeFileAviable($AType); //$AType: "Documents", "Images" ou "Videos"
?>
```

La classe Verify va regarder plusieurs choses :

- Vérifier le typage des entrées HMTL. 
- Vérifier le type d'image et des fichiers (Leurs signatures).
