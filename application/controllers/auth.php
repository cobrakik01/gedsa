<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author cobrakik
 */
class Auth_Controller extends Base_Controller {

    public function get_login() {
        return View::make('auth.login');
    }

    public function post_login() {
        $us = Administrador::where('nombre', '=', trim(Input::get('txtNombreUsuario')))->first();
        if ($us && $us->password == Input::get('txtPassword') && $us->activo) {
            Auth::login($us);
            return Redirect::to('admin');
        } else {
            return Laravel\View::make('auth.login')->with(array('error' => 'El usuario es incorrecto', 'txtNombreUsuario' => Input::get('txtNombreUsuario')));
        }
    }

}

?>
