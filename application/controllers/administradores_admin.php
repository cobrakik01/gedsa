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

    private function verificarDatos() {
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

    public function get_editar($id) {
        $id = base64_decode($id);
        $us = Administrador::find($id);
        $us_desc = $us->descripcion();
        return View::make('admin.administradores.editar')->with(array('us' => $us, 'us_desc' => $us_desc));
    }

    public function post_editar() {
        if ($this->verificarDatos()) {
            $id = base64_decode(Input::get('txtId'));

            $us = Administrador::find($id);

            if ($us->password != Input::get('txtPasswordA')) {
                return \Laravel\Redirect::back()->with_input();
            }

            $us_desc = $us->descripcion();
            //$us_desc = DescripcionUsuario::find($us->descripcion_usuarios_id);

            $us_desc->nombre = Input::get('txtNombre');
            $us_desc->apellido_paterno = Input::get('txtApp');
            $us_desc->apellido_materno = Input::get('txtApm');
            $us_desc->direccion = Input::get('txtDireccion');
            $us_desc->telefono = Input::get('txtTelefono');
            $us_desc->email = Input::get('txtEmail');

            $us_desc->save();

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
        $us_dec = $us->descripcion();
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
                $users = Administrador::select()->order_by('nombre','desc')->paginate($registros_por_pagina);
                break;
            case 'activos':
                $accion = "Administradores Activos";
                $users = Administrador::where('activo', '=', true)->order_by('nombre','desc')->paginate($registros_por_pagina);
                break;
            case 'inactivos':
                $accion = 'Administradores Inactivos';
                $users = Administrador::where('activo', '=', false)->order_by('nombre','desc')->paginate($registros_por_pagina);
                break;
        }
        return View::make('admin.administradores.result')->with(array('users' => $users, 'accion' => $accion));
    }

    public function get_buscar() {
        return View::make('admin.administradores.buscar')->with(array('users' => null, 'us_desc' => null));
    }

    public function post_buscar() {
        $txtBuscar = Input::get('txtBuscar');
        $listFiltro = Input::get('listFiltro');
        $listOrden = Input::get('listOrden');
        $listResultadosPorPagina = Input::get('listResultadosPorPagina');

        $users = null;
        $us_desc = null;
        
        switch ($listFiltro) {
            case 'id_admin':
                $users = Administrador::where('id','=',$txtBuscar)->order_by('id', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'nom_administrador':
                $users = Administrador::where('nombre', 'like', '%' . $txtBuscar . '%')->order_by('nombre', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_nom':
                $us_desc = DescripcionUsuario::where('nombre','like','%' . $txtBuscar . '%')->order_by('nombre', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_app':
                $us_desc = DescripcionUsuario::where('apellido_paterno','like','%' . $txtBuscar . '%')->order_by('apellido_paterno', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_apm':
                $us_desc = DescripcionUsuario::where('apellido_materno','like','%' . $txtBuscar . '%')->order_by('apellido_materno', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'email':
                $us_desc = DescripcionUsuario::where('email','like','%' . $txtBuscar . '%')->order_by('email', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'fecha_reg':
                $us_desc = DescripcionUsuario::where('created_at','like','%' . $txtBuscar . '%')->order_by('created_at', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'telefono':
                $us_desc = DescripcionUsuario::where('telefono','like','%' . $txtBuscar . '%')->order_by('telefono', $listOrden)->paginate($listResultadosPorPagina);
                break;
        }
        return View::make('admin.administradores.buscar')->with(array('users' => $users, 'us_desc' => $us_desc, 'txtBuscar' => $txtBuscar, 'listFiltro' => $listFiltro, 'listOrden' => $listOrden, 'listResultadosPorPagina' => $listResultadosPorPagina));
    }

}

?>
