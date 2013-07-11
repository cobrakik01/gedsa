<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Albums_Admin_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }

    public function get_index() {
        return Laravel\Redirect::to('albums_admin/mis_albums');
    }

    public function get_nuevo() {
        return Laravel\View::make('admin.albums.nuevo');
    }

    public function post_nuevo() {
        $controlador = new AlbumController();
        $album = new Album();
        $album->nombre = Input::get('nombre');
        $album->descripcion = Input::get('descripcion');
        $errors = $controlador->nuevoAlbum($album);
        if ($errors->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($errors);
        }
        return Laravel\Redirect::to('albums_admin/ver_fotos/' . AlbumController::toDir($album));
    }

    public function get_mis_albums() {
        $controlador = new AlbumController();
        $albums = $controlador->buscarAlbumsPorIdDeAdministrador(Auth::user()->id);
        return Laravel\View::make('admin.albums.mis_albums', array('albums' => $albums));
    }

    public function get_todos() {
        $controlador = new AlbumController();
        $albums = $controlador->todosLosAlbums();
        return Laravel\View::make('admin.albums.todos', array('albums' => $albums));
    }

    public function get_cambiar_nombre_descripcion($dir_album = "") {
        $controlador = new AlbumController();
        $album = $controlador->buscarPorNombreDeAlbum($dir_album);
        if (is_null($album)) {
            Message::showMessage('El album: ' . Format::dirToTextFormat($dir_album) . ', no existe');
        }
        return Laravel\View::make('admin.albums.cambiar_nombre_descripcion')->with(array('album' => $album));
    }

    public function post_cambiar_nombre_descripcion() {
        $cont = new AlbumController();
        $album = new Album();
        $album->nombre = Input::get('nombre');
        $album->descripcion = Input::get('descripcion');

        $errors = $cont->actualizarPorId(Input::get('id'), $album);
        if ($errors->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($errors);
        }
        $url = "albums_admin/ver_fotos/" . $cont->getDirName($album);
        return \Laravel\Redirect::to($url);
    }

    public function get_buscar_album() {
        $controlador = new AlbumController();
        $orden = Input::get('orden');
        $buscar = Input::get('buscar');
        $resultados = Input::get('resultados');
        $op = Input::get('filtro');
        $albums = null;

        try {
            switch ($op) {
                case 0;
                    $albums = $controlador->buscarAlbumPorId($buscar, true, $resultados, $orden);
                    break;
                case 1:
                    $albums = $controlador->buscarPorNombreDeAlbum($buscar, true, $resultados, $orden);
                    break;
                case 2:
                    $albums = $controlador->buscarPorFecha($buscar, true, $resultados, $orden);
                    break;
                case 3:
                    $albums = $controlador->buscarAlbumsPorNombreDeAdministrador($buscar, true, $resultados, $orden);
                    break;
            }
            return \Laravel\View::make('admin.albums.buscar_album')->with(array('albums' => $albums));
        } catch (NotifierValidatorException $ex) {
            $not = $ex->getNotification();
            if ($not->fails()) {
                return \Laravel\Redirect::back()->with_errors($not);
            }
        }
    }

    public function get_ver_fotos($nombre_album = "") {
        $controlador = new AlbumController();
        $album = $controlador->buscarPorNombreDeAlbum($nombre_album);
        if (is_null($album)) {
            return Message::showMessage('Esta pagina no esta disponible');
        }
        $fotos = $album->fotos();
        return Laravel\View::make('admin.albums.ver')->with(array('album' => $album, 'fotos' => $fotos));
    }

    public function post_subir_foto() {
        $usar_nombre_archivo = Input::get('nombre_archivo');
        $cont_album = new AlbumController();

        $rules = array();
        if (!$usar_nombre_archivo)
            $rules['nombre'] = 'required';

        $errors = $cont_album->subirFoto(Input::get('nombre_album'), Input::get('descripcion'), 'foto', Input::get('nombre'), $rules);
        return \Laravel\Redirect::back()->with_errors($errors);
    }

    public function get_eliminar($nombre_album = "") {
        $controlador = new AlbumController();
        try {
            $controlador->eliminarAlbumPorNombre($nombre_album);
        } catch (Exception $ex) {
            return Message::showMessage($ex->getMessage());
        }
        return \Laravel\Redirect::back();
    }

}

?>
