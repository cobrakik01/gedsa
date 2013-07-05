<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Album extends Eloquent {

    public static $table = "albums";

    public function get_dir() {
        $dir = str_replace(' ', '_', $this->nombre);
        return empty($dir) ? '?dir=' . $this->url : $dir;
    }

    public static function find_by_name_to_dir($dir) {
        return Album::find_by_name(str_replace('_', ' ', $dir));
    }

    public function administrador() {
        return Administrador::where('id', '=', $this->administradores_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function fotos($fotos_por_pagina = 10) {
        return Foto::where('albums_id', '=', $this->id)->paginate($fotos_por_pagina);
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }
    
    public function num_fotos(){
        return Foto::where('albums_id', '=', $this->id)->count();
    }

    public static function find_by_name($nombre) {
        return Album::where('nombre', '=', $nombre)->first();
    }

    public static function find_by_url($url) {
        return Album::where('url', '=', $url)->first();
    }

    /**
     * Elimina todas las fotos relacionadas con el album
     * @return int Retorna el numero de fotos eliminadas
     */
    public function delete_all_photos() {
        return Foto::where('albums_id', '=', $this->id)->delete();
    }

    public function num_photos() {
        return Foto::where('albums_id', '=', $this->id)->count();
    }

}

?>
