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
class Admin_Presentaciones_Ajax_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }

    public function get_index() {
        return "No tienes los premisos suficientes para visualizar esta pagina";
    }

    public function post_cambiar_nombre() {
        $oldName = trim(Input::get('name'));
        $newName = trim(Input::get('content'));

        $presentacion = Presentacion::find($oldName);
        if (is_null($presentacion)) {
            echo "No se pudo cambiar el nombre de la presentación.";
            exit;
        }
        
        $presentacion->nombre = $newName;
        $presentacion->save();
        echo "Se cambio correctamente";
    }

    public function post_cambiar_descripcion() {
        $nombre = trim(Input::get('name'));
        $descripcion = trim(Input::get('content'));

        try {
            
        } catch (NotifierValidatorException $ex) {
            
        }
    }

}

?>
