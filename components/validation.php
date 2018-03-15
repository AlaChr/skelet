<?php

class Validation {
    //если ошибка возвращает строку
    static function validation_inputdata($str, $min = 1, $max = 50){
        if ($check = preg_match('/[\<\>\"\!\^\*\'\$\#\&]+/', $str)) {
            return $err = 'Введены недопустимые символы'; 
        }
            elseif (strlen($str) < $min or strlen($str) > $max) {
                return $err = "Введите количество символов в диапазоне от '$min' до '$max'"; 
            }
    } 
    
    //если ошибка возвращает строку
    static function validation_text($text){
        if ($check = preg_match('/[\<\>\"\!\^\*\'\$\#\&]+/', $text)) {
            return $err = 'Введены недопустимые символы'; 
        }
    } 
    
    //если ошибка возвращает строку
    static function validation_email($str){
        if ($check = preg_match('[@]', $str)) {
            
        }
        else {return $err = 'Введите верный адрес электронной почты';}
    }
}

