<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin {

    public static function controllers() {
        Router::controller('admin');
        Router::controller('Administradores_Admin');
        Router::controller('Perfil_Admin');
    }

}

?>
