<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotoController
 *
 * @author cobrakik
 */
class FotoController {

    /**
     * Cambia la url de todas las fotos del album segun su id
     * @param int $idAlbum
     * @param string $url
     */
    public function cambiarUrl($idAlbum, $url) {
        $album = Album::find($idAlbum);
        $fotos = $album->fotos();
        if (!ends_with($url, '/')) {
            $url .= '/';
        }
        foreach ($fotos->results as $foto) {
            $new_url = $url . $this->getFileName($foto);
            $foto->url = $new_url;
            $foto->save();
        }
    }

    /**
     * Obtiene el nombre real de la foto almacenada en el disco
     * @param Foto $foto
     * @return string
     */
    public function getFileName(Foto $foto) {
        return Format::textToDirFormat($foto->nombre);
    }

}

?>
