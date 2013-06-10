<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author cobrakik
 */
class Admin_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->filter('before','auth');
    }
    
    public function get_index() {  
        return Laravel\Redirect::to('perfil_admin');
    }
    
    public function get_logout(){
        Auth::logout();
        return Laravel\Redirect::to('login');
    }

}

?>
