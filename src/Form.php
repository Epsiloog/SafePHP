<?php
namespace SafePHP;
use Exception;
use SafePHP\CSRF;

class Form {
    public static function getForm(){
        if(!CSRF::verifyCSRF())
            return;


    }

    public static function createForm($NbCheckbox = null, $NbColor = null, $NbDate = null, $NbDateTimeLocal = null, $NbEmail = null, $NbFile = null, $NbImage = null, $NbMonth = null, $NbNumber = null, $NbPassword = null, $NbRadio = null, $NbRange = null, $NbSearch = null, $NbTel = null, $NbText = null, $NbTime = null, $NbUrl = null, $NbWeek = null){
        CSRF::createCSRF();
        if (isset($_POST["number_checkbox"])) {
            try {
            
                for($i = 0; $i < $NbCheckbox; $i++){
                    echo(sprintf("<input type='checkbox' name='chechbox_template %i'>", htmlspecialchars(+$i, ENT_QUOTES, 'UTF-8')));
                }
                
                return;
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }
}