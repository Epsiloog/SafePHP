<?php
namespace SafePHP;
use SafePHP\CSRF;
use Exception;

class Form {
    public static function getForm(){
        if (!CSRF::verifyCSRF()) {
            die("Jeton CSRF invalide !");
        }
    }
    
    public static function createForm($NbCheckbox = null, $NbColor = null, $NbDate = null, $NbDateTimeLocal = null, $NbEmail = null, $NbFile = null, $NbImage = null, $NbMonth = null, $NbNumber = null, $NbPassword = null, $NbRadio = null, $NbRange = null, $NbSearch = null, $NbTel = null, $NbText = null, $NbTime = null, $NbUrl = null, $NbWeek = null){
        
        CSRF::createCSRF();

        //Liste de tous les inputs possibles avec leur quantité envoyée en paramètres
        $InputConfig = [
            'number_checkbox' => [
                'type' => 'checkbox',
                'count' => $NbCheckbox
            ],
            'number_colorpicker' => [
                'type' => 'color',
                'count' => $NbColor
            ],
            'number_date' => [
                'type' => 'date',
                'count' => $NbDate
            ],
            'number_datetimelocal' => [
                'type' => 'datetime-local',
                'count' => $NbDateTimeLocal
            ],
            'number_email' => [
                'type' => 'email',
                'count' => $NbEmail
            ],
            'number_file' => [
                'type' => 'file',
                'count' => $NbFile
            ],
            'number_image' => [
                'type' => 'image',
                'count' => $NbImage
            ],
            'number_month' => [
                'type' => 'month',
                'count' => $NbMonth
            ],
            'number_number' => [
                'type' => 'number',
                'count' => $NbNumber
            ],
            'number_password' => [
                'type' => 'password',
                'count' => $NbPassword
            ],
            'number_radio' => [
                'type' => 'radio',
                'count' => $NbRadio
            ],
            'number_range' => [
                'type' => 'range',
                'count' => $NbRange
            ],
            'number_search' => [
                'type' => 'search',
                'count' => $NbSearch
            ],
            'number_tel' => [
                'type' => 'tel',
                'count' => $NbTel
            ],
            'number_text' => [
                'type' => 'text',
                'count' => $NbText
            ],
            'number_time' => [
                'type' => 'time',
                'count' => $NbTime
            ],
            'number_url' => [
                'type' => 'url',
                'count' => $NbUrl
            ],
            'number_week' => [
                'type' => 'week',
                'count' => $NbWeek
            ],
        ];

        foreach ($_POST as $key => $value) {
            if (empty($value) || !isset($InputConfig[$key]))
                continue;
            try {
                $config = $InputConfig[$key];
                $baseName = str_replace('number_', '', $key) . '_template';
                for ($i = 0; $i < $config['count']; $i++) {
                    echo sprintf(
                        "<label for='%s_%d'> %s_%d </label>",
                        htmlspecialchars($config['type'], ENT_QUOTES, 'UTF-8'),
                        $i,
                        htmlspecialchars($baseName, ENT_QUOTES, 'UTF-8'),
                        $i
                    );
                    echo sprintf(
                        "<input type='%s' name='%s_%d'>",
                        htmlspecialchars($config['type'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($baseName, ENT_QUOTES, 'UTF-8'),
                        $i
                    );
                    echo "<br>";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public static function createLoginForm(){
        echo "<form method='POST' action=''>
                ". CSRF::createCSRF() . "
                
             </form>";
    }

    public static function createRegisterForm(){

    }
}