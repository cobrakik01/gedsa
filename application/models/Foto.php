<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author cobrakik
 */
class Foto extends Eloquent {

    public static $table = "fotos";

    public function administrador() {
        return Administrador::where('id', '=', $this->administradores_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }
    
    public function album() {
        return Album::where('id', '=', $this->albums_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

}

?>
