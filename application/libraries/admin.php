<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin {

    public static function controllers() {
        Router::controller('admin');
        Router::controller('perfil_admin');
        Router::controller('albums_admin');
        Router::controller('presentaciones_admin');
        Router::controller('administradores_admin');
        
        Router::controller('albums_admin_ajax');
    }

}

?>
