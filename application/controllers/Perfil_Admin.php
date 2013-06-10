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
class Perfil_Admin_Controller extends Base_Controller {

    public function get_index() {
        $user = Auth::user();
        $us_desc = DescripcionUsuario::find($user->descripcion_usuarios_id);
        return View::make('admin.perfil')->with(array('user' => $user, 'us_desc' => $us_desc));
    }

}

?>
