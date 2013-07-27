<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminPerfil
 *
 * @author cobrakik
 */
class Admin_Perfil_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }
    
    public function get_index() {
        $user = Auth::user();
        $us_desc = $user->descripcion();
        // $us_desc = DescripcionUsuario::find($user->descripcion_usuarios_id);
        return View::make('admin.perfil')->with(array('user' => $user, 'us_desc' => $us_desc));
    }

}

?>
