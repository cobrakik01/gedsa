<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mis_presentaciones
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Mis_Presentaciones_Controller extends Admin_Base_Controller {

    public function get_index() {
        $control = new PresentacionController();
        try {
            $presentaciones = $control->getListPresentaciones();
        } catch (NotifierValidatorException $ex) {
            return $ex->getMessage();
        }
        return \Laravel\View::make('admin.presentaciones.mis_presentaciones')->with(array('presentaciones' => $presentaciones, 'activePresentaciones' => true, 'activeMisPresentaciones' => true));
    }

}

?>
