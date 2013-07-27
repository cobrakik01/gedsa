<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin {

    public static function controllers() {
        /**
         * Normal
         */
        Router::controller('admin.home');
        Router::controller('admin.perfil');
        Router::controller('admin.albumes');
        Router::controller('admin.presentaciones');
        Router::controller('admin.login');
        Router::controller('admin.logout');
        Router::controller('admin.administradores');
        
        /*
         * Ajax
         */
        Router::controller('admin.albumes_ajax');
        Router::controller('admin.presentaciones_ajax');
    }

}

?>
