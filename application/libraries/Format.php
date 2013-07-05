<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Format
 *
 * @author cobrakik
 */
class Format {

    public static function skipTilde($text) {
        return str_replace(array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'), array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'), $text);
    }

}

?>
