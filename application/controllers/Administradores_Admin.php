<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administradores
 *
 * @author cobrakik
 */
class Administradores_Admin_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }

    public function get_index() {
        return Redirect::to('administradores_admin/result/todos');
    }
    
    public function get_nuevo(){
        return View::make('admin.administradores.nuevo');
    }

    public function get_result($arg) {
        $users = null;
        $registros_por_pagina = 15;
        $accion = "sin accion";
        switch ($arg) {
            case 'todos':
                $accion = "Todos Los Registros";
                $users = Administrador::select()->paginate($registros_por_pagina);
                break;
            case 'activos':
                $accion = "Administradores Activos";
                $users = Administrador::where('activo', '=', true)->paginate($registros_por_pagina);
                break;
            case 'inactivos':
                $accion = 'Administradores Inactivos';
                $users = Administrador::where('activo', '=', false)->paginate($registros_por_pagina);
                break;
        }
        return View::make('admin.administradores.result')->with(array('users' => $users, 'accion' => $accion));
    }

}

?>
