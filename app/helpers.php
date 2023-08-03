<?php 
//Functii helper definite global pentru aplicatie. Sunt incarcate in composer.json. (CTRL + F -> app/helpers.php)
//Helper functions defined globally for the aplication. They are loaded in composer.json. (CTRL + F -> app/helpers.php)
if(!function_exists('clamp')){
    function clamp($min, $max, $value) {
        return $value < $max ? ($value > $min ? $value : $min) : $max; 
    }
}