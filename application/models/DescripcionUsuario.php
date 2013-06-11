<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescripcionUsuario
 *
 * @author cobrakik
 */
class DescripcionUsuario extends Eloquent {
    public static $table = "descripcion_usuarios";
    
    public function administrador(){
        return $this->has_one('Administrador'); // indica que la clave foranea de esta tabla se encuentra dentro de Administrador
    }
}

?>
