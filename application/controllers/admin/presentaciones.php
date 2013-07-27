<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of presentaciones_admin
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }

    public function get_index() {
        return $this->get_mis_presentaciones();
    }

    public function get_mis_presentaciones() {
        $control = new PresentacionController();
        try {
            $presentaciones = $control->getListPresentaciones();
        } catch (NotifierValidatorException $ex) {
            return $ex->getMessage();
        }
        return \Laravel\View::make('admin.presentaciones.mis_presentaciones')->with(array('presentaciones' => $presentaciones));
    }

    public function get_eliminar_presentacion($nombre_encode = "", $id_admin_encode = -1) {
        $nombre = base64_decode($nombre_encode);
        $id_admin = base64_decode($id_admin_encode);
        try {
            $control = new PresentacionController();
            $control->eliminarPresentacion($id_admin, $nombre);
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
        return \Laravel\Redirect::back();
    }

    public function get_ver_presentacion($nombre_encode = "", $id_admin_encode = -1) {
        $nombre = base64_decode($nombre_encode);
        $id_admin = base64_decode($id_admin_encode);
        try {
            $control = new PresentacionController();
            $presentacion = $control->getPresentacion($id_admin, $nombre);
            $fotos = $presentacion->fotos();
            return Laravel\View::make('admin.presentaciones.ver_presentacion')->with(array('presentacion' => $presentacion, 'fotos' => $fotos));
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
    }

    public function get_eliminar_foto() {
        $presentacion_nombre = base64_decode(Input::get('pnom'));
        $foto_id = base64_decode(Input::get('fid'));

        try {
            $control = new PresentacionController();
            $control->eliminarFotoDePresentacionPorId($presentacion_nombre, $foto_id);
            return Laravel\Redirect::back();
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
    }

    public function get_editar_nombre($nombre = "", $admin_id = -1) {
        try {
            if ($nombre == "" || $admin_id == -1) {
                return Message::showMessage('Esta pagina no esta disponible', 'Advertencia');
            }
            $control = new PresentacionController();
            $nombre = base64_decode($nombre);
            $admin_id = base64_decode($admin_id);

            $presentacion = $control->buscar($nombre, $admin_id);
            return Laravel\View::make('admin.presentaciones.editar_nombre')->with(array('presentacion' => $presentacion));
        } catch (NotifierValidatorException $ex) {
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function post_editar_nombre() {
        $new_name = trim(Input::get('new_name'));
        $old_name = Input::get('old_name');
        $admin_id = Input::get('admin_id');
        try {
            $control = new PresentacionController();
            $control->cambiarNombrePresentacion($admin_id, $old_name, $new_name);
            return \Laravel\Redirect::to('admin/presentaciones/ver_presentacion/' . base64_encode($new_name) . '/' . base64_encode($admin_id));
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return \Laravel\Redirect::back()->with_errors($error);
            }
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function get_editar_descripcion($nombre = "", $admin_id = -1) {
        try {
            if ($nombre == "" || $admin_id == -1) {
                return Message::showMessage('Esta pagina no esta disponible', 'Advertencia');
            }
            $control = new PresentacionController();
            $nombre = base64_decode($nombre);
            $admin_id = base64_decode($admin_id);

            $presentacion = $control->buscar($nombre, $admin_id);
            return Laravel\View::make('admin.presentaciones.editar_descripcion')->with(array('presentacion' => $presentacion));
        } catch (NotifierValidatorException $ex) {
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function post_editar_descripcion() {
        $descripcion = trim(Input::get('descripcion'));
        $name = Input::get('name');
        $admin_id = Input::get('admin_id');
        try {
            $control = new PresentacionController();
            $control->cambiarDescripcionDePresentacion($admin_id, $name, $descripcion);
            return \Laravel\Redirect::back();
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return \Laravel\Redirect::back()->with_errors($error);
            }
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function get_nueva_presentacion() {
        Laravel\Session::instance()->put('idFoto', 'Federico');
        Planear modo de seleccion de fotos para la creacion de una nueva presentacion
    }

}

?>
