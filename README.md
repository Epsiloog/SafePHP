# [SafePHP](#safephp)  (Version Alpha) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
## (An english version is in work) 
<a href="#sommaire"><img src="./Components/Img/fra.svg" style="width:40px; height:auto;"></a> <a href="#summary"><img src="./Components/Img/eng.svg" style="width:40px; height:auto;"></a>
## Sommaire

- [Sommaire](#sommaire)
- [Contribution au projet](#contribution-au-projet)
- [Introduction](#introduction)
  - [Pourquoi faire SafePHP](#pourquoi-faire-safephp)
  - [Avant toute chose](#avant-toute-chose)
  - [Contenu de la librarie](#contenu-de-la-librairie)
  - [Outils requis](#outils-requis)
  - [Installation](#installation)
  - [Configuration générale](#configuration-générale)
  - [Utilisation générale](#utilisation-générale)

## Contribution au projet

Le projet SafePHP est en open source et libre de toute utilisation, que ce soit personnelle comme pédagogique. **Vous pouvez bien évidement contribuer activement au projet en faisant des fixs, des tests, des features ou en complétant les différentes documentations par exemple**.
Vous pouvez me conctacter à l'adresse mail thomas.thony.69@gmail.com .

## Introduction
### Pourquoi faire SafePHP
SafePHP est une librairie PHP qui permet d'implémenter des moyens de cybersécurité facilment !<br>
Cela rends le développement de moyens de cybersécurité rapide efficace et facile à maintenir.

### Avant toute chose

Ce projet a été fait par un étudiant en informatique, avec le moins d'utilisation d'IA possible (Pas même pour la documentation), et vérification auprès de communautées certifiées quand c'est le cas.
Je vous remercie d'être indulgent sur la qualité de code mais en étant pédagogique sur l'apport d'améliorations (dans le code ou simplement la manière de faire, tous les avis sont bon à prendre), ce projet a pour but de faciliter la vie des développeurs pour la cyber-sécurité. J'espère évidement que SafePHP sera utilisé par le plus grand nombre de développeurs et/ou qu'il sera maintenu par les plus enthousiastes de la libraire.

### Contenu de la librairie

Cette librairie contient plusieurs fichiers de configuration sont à disposition dans le dossier **config** comme :

- Un fichier de configuration Apache **.htaccess**
- Un fichier **.env.example** où mettre vos variables d'environnement
- un fichier **php.ini** avec des modules activés/désactivés par défault

### Outils requis

Composer : Version 2.9.3 \
PHP : Version 8.0.0 minimum \
Serveur LAMP ou XAMP

### Installation

Vous pouvez l'installer avec composer :

```php
composer require thomas-thony/safephp
```
N'oubliez pas d'installer les dépendences associées pour assurer le bon fonctionnement du la librairie: 

```php
composer update || composer install
```

### Configuration générale

Avant de pouvoir utiliser pleinement SafePHP, pensez à importer les fichiers de configuration présents dans **./config** à la racine de votre projet et de mettre vos varibales d'environnement à jour dans le fichier .env .

#### Utiliser les variables d'environnement
La classe [Secret](https://safephp.alwaysdata.net/docs/classes/SafePHP-Secret.html) permet de gérer l'importation de votre fichier .env .


### Utilisation générale
La documentation détaillée des classes est disponible à cette adresse : https://safephp.alwaysdata.net/docs/


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
- A **.env.example** file where use your's environnement variables 
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