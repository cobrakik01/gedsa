<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author cobrakik
 */
class Administrador extends Eloquent {
    public static $table = "administradores";
    public static $timestamps = false;
    
    public function descripcion(){
        return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }
}

?>
