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

    public function get_nuevo() {
        return View::make('admin.administradores.nuevo');
    }

    public function verificarDatos() {
        $nombre = Input::get('txtNombre');
        $app = Input::get('txtApp');
        $apm = Input::get('txtApm');
        $direccion = Input::get('txtDireccion');
        $telefono = Input::get('txtTelefono');
        $email = Input::get('txtEmail');
        $nikname = Input::get('txtNombreAdmin');
        $password = Input::get('txtPassword');
        $cpassword = Input::get('txtCPassword');

        if (strlen(trim($nombre)) <= 0 || strlen(trim($app)) <= 0 || strlen(trim($direccion)) <= 0 || strlen(trim($telefono)) <= 0 || strlen(trim($nikname)) <= 0 || strlen(trim($password)) <= 0 || strlen(trim($cpassword)) <= 0 || $password != $cpassword) {
            /*
              return View::make('admin.administradores.nuevo')->with(array(
              'txtNombre' => $nombre,
              'txtApp' => $app,
              'txtApm' => $apm,
              'txtDireccion' => $direccion,
              'txtTelefono' => $telefono,
              'txtEmail' => $email,
              'txtNombreAdmin' => $nikname));
             */

            return false;
        }
        return true;
    }

    public function post_nuevo() {
        if ($this->verificarDatos()) {
            $us_desc = new DescripcionUsuario();
            $us_desc->nombre = Input::get('txtNombre');
            $us_desc->apellido_paterno = Input::get('txtApp');
            $us_desc->apellido_materno = Input::get('txtApm');
            $us_desc->direccion = Input::get('txtDireccion');
            $us_desc->telefono = Input::get('txtTelefono');
            $us_desc->email = Input::get('txtEmail');
            $us_desc->save();


            $us_desc = DescripcionUsuario::where('updated_at', '=', date('Y-m-d') . ' ' . date('H:i:s'))->first();
            $us = new Administrador();
            $us->descripcion_usuarios_id = $us_desc->id;
            $us->nombre = Input::get('txtNombreAdmin');
            $us->password = Input::get('txtPassword');
            $us->activo = true;

            $us->save();
            return \Laravel\Redirect::to('administradores_admin/result/todos');
        } else {
            return \Laravel\Redirect::back()->with_input();
        }
    }

    public function get_editar($id) {
        $id = base64_decode($id);
        $us = Administrador::find($id);
        $us_desc = DescripcionUsuario::find($us->descripcion_usuarios_id);
        return View::make('admin.administradores.editar')->with(array('us' => $us, 'us_desc' => $us_desc));
    }
    
    public function post_editar(){
        if ($this->verificarDatos()) {
            $id = base64_decode(Input::get('txtId'));
            
            $us = Administrador::find($id);
            
            if($us->password != Input::get('txtPasswordA')){
                return \Laravel\Redirect::back()->with_input();
            }
            
            $us_desc = DescripcionUsuario::find($us->descripcion_usuarios_id);
            
            $us_desc->nombre = Input::get('txtNombre');
            $us_desc->apellido_paterno = Input::get('txtApp');
            $us_desc->apellido_materno = Input::get('txtApm');
            $us_desc->direccion = Input::get('txtDireccion');
            $us_desc->telefono = Input::get('txtTelefono');
            $us_desc->email = Input::get('txtEmail');;
            $us_desc->save();
            
            $us->descripcion_usuarios_id = $us_desc->id;
            $us->nombre = Input::get('txtNombreAdmin');
            $us->password = Input::get('txtPassword');
            $us->activo = true;

            $us->save();
            return \Laravel\Redirect::to('administradores_admin/result/todos');
        }
        return \Laravel\Redirect::back()->with_input();
    }

    public function get_eliminar($id) {
        $id = base64_decode($id);
        $us = Administrador::find($id);
        $us_desc = DescripcionUsuario::find($us->descripcion_usuarios_id);
        $us->delete();
        $us_desc->delete();
        return \Laravel\Redirect::back();
    }

    public function get_ver($id) {
        $us = Administrador::find(base64_decode($id));
        $us_dec = DescripcionUsuario::where('id','=',$us->descripcion_usuarios_id)->first();
        return View::make('admin.administradores.ver')->with(array('us_desc' => $us_dec));
    }

    public function get_activar($id) {
        $user = Administrador::find(base64_decode($id));
        $user->activo = true;
        $user->save();
        return Laravel\Redirect::back();
    }

    public function get_desactivar($id) {
        $user = Administrador::find(base64_decode($id));
        $user->activo = false;
        $user->save();
        return Laravel\Redirect::back();
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

    public function get_buscar(){
        return View::make('admin.administradores.buscar');
    }
    
}

?>
