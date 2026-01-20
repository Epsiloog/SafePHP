# Contribution

## What to do to contribute

Like said on the **README**, you can contribute to this project by doing fixes on classes, tests, create features or complete documentation. 

## How to contribute 

### For everyone

You can create a fork of the main branch of this project.
To submit your changes to the main branch, you can ask for a pull requests.

### For thoses who code
For a better understanding by everyone, thanks to follow the write convention that is already in use.
Also, for a better developpement efficiency and debbuging, some comments in your changes are appreciated.

Exemples : 
```php
<?php
    //############BAD COMMENT EXEMPLE######################## 

    //Function that rename a file 
    public static function renameFile($tmpFilePath, $originalFileName){
        $TempDir = "./.tmp";
        $ExtensionFile = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $RandomName = bin2hex(random_bytes(24));
        $NewFilePath = "$TempDir/$RandomName.$ExtensionFile";

        $Movefile = move_uploaded_file($tmpFilePath, $NewFilePath);

        if ($Movefile) {
            echo "Déplacement du fichier réussi !";
            return $NewFilePath;
        } else {
            echo "Erreur lors du déplacement de fichier";
            return false;
        }
    }

//############GOOD COMMENT EXEMPLE######################## 
    //Function that rename a file
    public static function renameFile($tmpFilePath, $originalFileName){
        $TempDir = "./.tmp"; //Declare a path
        $ExtensionFile = pathinfo($originalFileName, PATHINFO_EXTENSION); //Get the file extension

        $RandomName = bin2hex(random_bytes(24)); //Create a random name
        $NewFilePath = "$TempDir/$RandomName.$ExtensionFile"; //New path of the file added in param

        $Movefile = move_uploaded_file($tmpFilePath, $NewFilePath); //Move the file to the temp folder 

        if ($Movefile) { //If it's a succes 
            echo "Déplacement du fichier réussi !";
            return $NewFilePath;
        } else { //If it failed
            echo "Erreur lors du déplacement de fichier";
            return false;
        }
    }
?>
```

### For thoses who write 
No need to be Balzac or Shakespeare to write documentation, as long as it's readable. 