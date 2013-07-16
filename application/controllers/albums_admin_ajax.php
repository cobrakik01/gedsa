<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Albums_Admin_Ajax
 *
 * @author cobrakik
 */
class Albums_Admin_Ajax_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }

    public function get_results($action = "mis_albums") {
        $cont = new AlbumController();
        $titulo = "";
        $albums = null;
        switch ($action) {
            case "mis_albums":
                $titulo = "Mis Álbumes";
                $albums = $cont->buscarAlbumsPorIdDeAdministrador(Auth::user()->id);
                break;
            case "todos":
                $titulo = "Todos los Álbumes";
                $albums = $cont->todosLosAlbums();
                break;
        }
        return \Laravel\View::make('admin.presentaciones.ajax.results')->with(array('albums' => $albums, 'titulo' => $titulo));
    }

}

?>
