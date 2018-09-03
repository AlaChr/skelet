<?php

class Validation {
    
// очистка входных данных
    static function clear ($value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        
        return $value;
    }

    //проверка длины вводимого значения
    static function check_length($str, $min = 1, $max = 50){
        $result = (mb_strlen($str) < $min or mb_strlen($str) > $max); 
        
        return !$result;       
    }
    
    //проверка формата email
    static function check_img($str){
        $result = (is_uploaded_file($_FILES['uploadfile']['tmp_name']) && ($_FILES['uploadfile'])&&(exif_imagetype($_FILES['uploadfile']['tmp_name']))); 
        
        return $result;    
        }
    
    //проверка формата email
    static function validation_email($str){
        $result = preg_match('[@]', $str);
        
        return $result;    
        } 
}

