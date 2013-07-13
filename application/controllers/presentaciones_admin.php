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
class Presentaciones_Admin_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before', 'auth');
    }
    
    public function get_index(){
        return \Laravel\View::make('admin.presentaciones.mis_presentaciones');
    }
    
}

?>
