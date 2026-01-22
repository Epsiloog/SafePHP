# [SafePHP](#safephp)  (Version Alpha) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
## (An english version is in work) 
<a href="#sommaire"><img src="./Components/Img/fra.svg" style="width:40px; height:auto;"></a> <a href="#summary"><img src="./Components/Img/eng.svg" style="width:40px; height:auto;"></a>
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

## Introduction

Librairie PHP pour implémenter des moyens de cybersécurité facilment !

### Contenu de la librairie

Cette librairie contient des classes utilisables sans instancier d'objet, donc en faisant

```php
NomDeLaclasse::NomDeLaFonction
```

De plus, plusieurs fichiers de configuration sont à disposition dans le dossier **config** comme :

- Un fichier de configuration Apache **.htaccess**
- Un fichier **safephp.env** où mettre vos variables d'environnement
- un fichier **php.ini** avec des modules activés/désactivés par défault

### Outils requis

PHP : Version 8.0.0 minimum \
Serveur LAMP ou XAMP

### Installation

Vous pouvez l'installer avec composer :

```php
composer require thomas-thony/safephp
```

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
    6. Vérification de la signature des fichiers
    7. Fichiers de configuration dans le dossier config

### Contribution

Le projet SafePHP est en open source et libre de toute utilisation, que ce soit personnelle comme pédagogique. **Vous pouvez bien évidement contribuer activement au projet en faisant des fixs, des tests ou en apportant des features par exemple**.
Vous pouvez me conctacter à l'adresse mail thomas.thony.69@gmail.com .

## Avant toute chose

Ce projet a été fait par un étudiant en informatique, avec le moins d'utilisation d'IA possible (Pas même pour la documentation), et vérification auprès de communautées certifiées quand c'est le cas.
Je vous remercie d'être indulgent sur la qualité de code mais en étant pédagogique sur l'apport d'améliorations (dans le code ou simplement la manière de faire, tous les avis sont bon à prendre), ce projet a pour but de faciliter des développeurs pour la cyber-sécurité.

## Les différentes classes

- [AntiCommands](#la-classe-anticommands)
- [Auth](#la-classe-auth)
- [CSRF](#la-classe-csrf)
- [Database](#la-classe-database)
- [FileInclusion](#la-classe-fileinclusion)
- [Network](#la-classe-network)
- [Sanitize](#la-classe-sanitize)
- [SRI](#la-classe-sri)
- [Verify](#la-classe-verify)

### La classe AntiCommands

La classe AntiCommands a pour but d'éviter l'injection de commandes Shell ou Cmd.

### La classe Auth

La classe Auth contient une fonction par défaut de connexion et d'inscription, le hash utilisé est celui par défaut de PHP (d'après la documentation PHP, c'est l'algorithme [BCRYPT](https://www.php.net/manual/fr/string.constants.php#constant.crypt-blowfish)).

Pour la gestion des sessions utilisateur, il y'a :

- Les fonctions **login** et **register** qui créent les sessions utilisateur.
- La fonction **logout** qui détruit toutes les sessions créées.

### La classe CSRF

La classe CSRF contient une fonction **createCSRF** qui crée un jeton CSRF, à ajouter impérativement dans chacun de vos formulaires.
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

### La classe Database

Cette classe permet l'authentification, l'insertion de données en requêtes SQL en toutes sécurité par des requêtes préparées, un accès par le principe du moindre privilège et le filtrage permanent de ce qui entre et sort de la base de données.

### La classe FileInclusion

Cette classe gère l'ensemble des fonctions associées à la gestion des fichiers.
Une première fonction permet de renommer les fichiers inclus de manière aléatoire sur 24 bits, puis sont déplacés dans un dossier "caché" (débutant par un ' **.** ').

### La classe Network

Cette sert à Ajouter, lire et / ou supprimer des adresses IP de listes différentes :

```php
<?php
namespace SafePHP;
class Network {
    private static array $WhiteList; //Adresses autorisées
    private static array $GreyList; //Adresses autorisées sous controle
    private static array $BlackList; //Adresses bannies/refusées
}
/*
Getters et setters pour chaque liste définis dans la classe
*/
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

Un exemple concret :

```php
<?php
use SafePHP\Sanitize;

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

### La classe SRI

Cette classe est l'une des plus simples à utiliser car il suffit d'une seule fonction à mettre pour chaque appel par ressources Javascript ou CSS.

Pour ce faire, faites simplement :

```php
<?php
use SafePHP\SRI;

$CSSFile = "./styles/main.css";
$JSFile = "./scripts/main.js";

SRI::createSRI("css", $CSSFile); //css ou js, sinon erreur
SRI::createSRI("js", $JSFile);
?>
```

Vous pourrez vérifier le résultat depuis l'inspecteur d'élement.

### La classe Verify

La classe Verify possède trois listes d'extensions de fichiers disponibles, pour les documents, les images et les vidéos.
Vous pouvez voir la liste pour chaque type de fichiers en faisant :

```php
<?php
Verify::getTypeFileAviable($AType); //"Documents", "Images" ou "Videos"
?>
```

La classe Verify va regarder plusieurs choses :

- Vérifier le typage des entrées HMTL :

  ```php
  <?php
      use SafePHP\Verify;

      if(isset($_POST["test_verify"]) && !empty($_POST["test_verify"])) {
      $InputInt = $_POST["test_verify"];
      $Verify = Verify::verify($Input, "integer");

      $InputString = $_POST["test_verify_string"];
      $VerifyBis = Verify::verify($InputString, "string");

          if($Verify === 0) {
              echo "Pas le bon TYPE : " . gettype($InputInt);
          } else {
              echo "Bon type !";
          }

          if ($VerifyBis === 0) {
              echo "Pas le bon TYPE : " . gettype($InputString);
          } else {
              echo "Bon type !";
          }

      } else {
          echo "Valeur non saisie ou vide !";
      }
  ?>
  ```

- Vérifier le type d'image et des fichiers (Leurs signatures) :
  ```php
    //Section Fichier
    if (isset($_POST["validate_document_inclusion"])) {
        if ($\_FILES["a_document_inclusion"] != null && $_FILES["a_document_inclusion"] ["error"] === UPLOAD_ERR_OK) {
            $Signature = Verify::verifySignatureFile($_FILES["a_document_inclusion"]["tmp_name"], $_FILES["a_document_inclusion"]["name"],"Documents");
            if ($Signature === false) {
                echo Exceptions::getErreurSignature() . " un document !</p>";
            } else {
                echo $Succes;
            }
        } else {
            echo Exceptions::getErreurFichierVide();
        }
    }
    ```

# [SafePHP](#safephp) (Alpha Version) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) 
<a href="#sommaire"><img src="./Components/Img/fra.svg" style="width:40px; height:auto;"></a> <a href="#summary"><img src="./Components/Img/eng.svg" style="width:40px; height:auto;"></a>
## Summary

- [Summary](#summary)
- [Introduction](#introduction)
  - [Library's content](#librarys-content)
  - [Requirements](#requirements)
  - [Installation](#installation)
  - [General usage](#general-usage)
  - [Features aviables](#features-aviables)
  - [Contribution](#contribution)
- [Before anything](#before-anything)
- [All differents classes](#all-differents-classes)

## Introduction

Library written in PHP to use cyber-security tools easly !

### Library's content

This library has classes that didn't need without instantiating an object, so, by doing :

```php
Class::function
```

Even more, a couple of configuration's files are aviables in the folder **config** like :

- A file for Apache configuration nammed **.htaccess**
- A **safephp.env** file where use your's environnement variables 
- A **php.ini** file with modules enables & disabled by default 

### Requirements

PHP : At least version 8.0.0\
LAMP or XAMP server

### Installation

You can install the library with composer :

```php
composer require thomas-thony/safephp
```

### General usage

Every functions are  meaned to be used without instantiating an object of SafePHP's class.

You can test them from index.php (That got tests from the **test** folder).

### Features aviables

For the moment, the library is an alpha, **anything is sure of having the best security and an 100% working efficency**.

Here's aviables features :

    1. Verification of HTML's inputs type in a form.
    2. CSRF verification 
    3. Sanitize of HTML's inputs
    4. Creation of forms with secure tools
    5. Extension's verification
    6. Checksum of files
    7. Configuration's files in the **config** folder

### Contribution
The SafePHP project is in open-source and free of usage, for personal or educative purpose.  **You can of course contribute by doing fixes, tests or creating new features**. \
To join me, you can e-mail me at thomas.thony.69@gmail.com.

## Before anything
This project was made by a student in computer science, with the least AI as possible (not even for documentation), and verification with certified communities when it was used.
Thank you for being lenient on the quality of the code but by being educational about making improvements (in the code or simply the way to do it, all opinions are good), this project aims to facilitate developers for cyber-security.

## All differents classes

- [AntiCommands](#anticommands-class)
- [Auth](#auth-class)
- [CSRF](#csrf-class)
- [Database](#database-class)
- [FileInclusion](#fileinclusion-class)
- [Network](#network-class)
- [Sanitize](#sanitize-class)
- [SRI](#sri-class)
- [Verify](#verify-class)

### AntiCommands Class
The Anticommands class was made to avoid commands injection like Shell or Cmd.

### Auth Class
The Auth class has a default function for login and register, the hash used is the default one made in PHP (which is, according to PHP documentation is [BCRYPT](https://www.php.net/manual/fr/string.constants.php#constant.crypt-blowfish)) 

For users's session management, there are : 

- **login** and **register** functions that create sessions.
- **logout** function that destroy every sessions mades.

### CSRF Class

The CSRF class has a function **createCSRF** that create a CSRF token, to implement in every form you create.
Once your forms submited, call the function **verifyCSRF** to confirm your CSRF token's presence.

```php
<?php
use SafePHP\CSRF;

if (isset($_POST["text_test"])) {
    CSRF::verifyCSRF(); //Verifying CSRF toekn
}
?>

<div class="test-csrf">
    <form action="" method="POST">
        <?php
            CSRF::createCSRF(); //Insert CSRF token
        ?>

        <input type="text" name="text_test" id="text_test" placeholder="Votre texte...">

        <button type="submit" onclick="<?php ?>">
            Envoyer
        </button>
    </form>
</div>
?>
```

### Database Class

This class can manage authentification, datas insertion in SQL requests, prepared for a better security, an access by the principle of least privilege and a permanent filter for everything to goes to and come from the database.

### FileInclusion Class

This class manage all functions linked to files management.
A primary function can rename diles includes with randoms characters on 24 bits, then moved on a hidden folder(starting with a '**.**'). 


### Network Class

This class sert can add, read and/or delete IP adresses of differents lists :

```php
<?php
namespace SafePHP;
class Network {
    private static array $WhiteList; //Autorised adresses 
    private static array $GreyList; //Autorised adresses under control 
    private static array $BlackList; //Refused/banned adresses
}
/*
Getters and setters for each lists
*/
?>
```

### Sanitize Class
Only one function **sanitize** is aviable for the moment in this class that simplify the usage of filters **Sanitize** by default in PHP. 

Here's how it's used :

```php
<?php
Sanitize::sanitize($Input, $TypeFiltre); //Filters aviables are : email, int, float, string, text and bool
?>
```

Example :

```php
<?php
use SafePHP\Sanitize;

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

### SRI Class
This class is one of the most easiest to use because it only need one function to call for every ressources in CSS or JS.

Just do :

```php
<?php
use SafePHP\SRI;

$CSSFile = "./styles/main.css";
$JSFile = "./scripts/main.js";

SRI::createSRI("css", $CSSFile); //css ou js, otherwise error
SRI::createSRI("js", $JSFile);
?>
```

You can see the results on web tools developpement in our browser.

### Verify Class

The Verify class contains 3 extension's files lists, for documents, pictures and videos. 
You can see the list for each type of files by doing :

```php
<?php
Verify::getTypeFileAviable($AType); //"Documents", "Images" ou "Videos"
?>
```

The Verfiy class will verify a couple of things :

- HTML's Inputs types :

  ```php
  <?php
      use SafePHP\Verify;

      if(isset($_POST["test_verify"]) && !empty($_POST["test_verify"])) {
      $InputInt = $_POST["test_verify"];
      $Verify = Verify::verify($Input, "integer");

      $InputString = $_POST["test_verify_string"];
      $VerifyBis = Verify::verify($InputString, "string");

          if($Verify === 0) {
              echo "Pas le bon TYPE : " . gettype($InputInt);
          } else {
              echo "Bon type !";
          }

          if ($VerifyBis === 0) {
              echo "Pas le bon TYPE : " . gettype($InputString);
          } else {
              echo "Bon type !";
          }

      } else {
          echo "Valeur non saisie ou vide !";
      }
  ?>
  ```

- Verify image type and of others files (Their checksum) :
  ```php
    //Section Fichier
    if (isset($_POST["validate_document_inclusion"])) {
        if ($\_FILES["a_document_inclusion"] != null && $_FILES["a_document_inclusion"] ["error"] === UPLOAD_ERR_OK) {
            $Signature = Verify::verifySignatureFile($_FILES["a_document_inclusion"]["tmp_name"], $_FILES["a_document_inclusion"]["name"],"Documents");
            if ($Signature === false) {
                echo Exceptions::getErreurSignature() . " un document !</p>";
            } else {
                echo $Succes;
            }
        } else {
            echo Exceptions::getErreurFichierVide();
        }
    }
    ```