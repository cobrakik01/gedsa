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
        $album = new Album();
        $album->nombre = Input::get('nombre');
        $album->descripcion = Laravel\Input::get('descripcion');
        /*
        $rules = array('nombre' => 'required|unique:' . Album::$table);
        $validation = \Laravel\Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $carpeta_album = Format::skipTilde(Laravel\Input::get('nombre')); //str_replace(array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'), array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'), Laravel\Input::get('nombre'));
        $path = "pages/uploads/albums/" . $carpeta_album;
        $f = new \Laravel\File();
        $f->mkdir($path);

        if (!$f->exists($path)) {
            return Laravel\View::make('admin.message')->with('msg', 'Ocurrio un error al crear el album ' . Laravel\Input::get('nombre'));
        }
        $album = new Album();
        $album->administradores_id = Auth::user()->id;
        $album->nombre = $carpeta_album;
        $album->descripcion = Laravel\Input::get('descripcion');
        $album->url = $path;
        $album->save();
         
        return Laravel\Redirect::to('albums_admin/ver_fotos/' . $album->get_dir());
         * 
         */
    }

    public function get_mis_albums() {
        $albums = Album::where('administradores_id', '=', Auth::user()->id)->paginate(10);
        return Laravel\View::make('admin.albums.mis_albums', array('albums' => $albums));
    }

    public function get_todos() {
        $albums = Album::select()->paginate(10);
        return Laravel\View::make('admin.albums.todos', array('albums' => $albums));
    }
    
    public function get_cambiar_nombre_descripcion($dir_album = ""){
        $album = Album::find_by_name_to_dir($dir_album);
        if($dir_album == "" || is_null($album)){
            return Laravel\View::make('admin.message')->with('msg', 'El album: ' . str_replace('_', ' ', $dir_album) . ', no existe');
        }
        return Laravel\View::make('admin.albums.cambiar_nombre_descripcion')->with(array('album'=>$album));
    }
    
    public function post_cambiar_nombre_descripcion(){
        //$f = new Laravel\File(); Renombrar Carpeta del album
        
        return "Se cambiara";
    }

    /*
      public function get_buscar() {
      return Laravel\View::make('admin.albums.buscar');
      }
     */

    public function get_ver_fotos($nombre_album = "") {
        if ($nombre_album == "" || is_null($nombre_album) || $nombre_album == null) {
            return Laravel\View::make('admin.message')->with('msg', 'Esta pagina no esta disponible');
        }
        $album = Album::find_by_name_to_dir($nombre_album);
        if (is_null($album)) {
            return Laravel\View::make('admin.message')->with('msg', 'Esta pagina no esta disponible');
        }
        $fotos = $album->fotos();
        return Laravel\View::make('admin.albums.ver')->with(array('album' => $album, 'fotos' => $fotos));
    }

    public function post_subir_foto() {
        $usar_nombre_archivo = Input::get('nombre_archivo');
        $file = \Laravel\Input::file('foto');
        $rules = array('foto' => 'required|min:5|max:2048|mimes:jpeg,bmp,png');
        if (!$usar_nombre_archivo)
            $rules['nombre'] = 'required';
        $validation = \Laravel\Validator::make(\Laravel\Input::all(), $rules);

        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $nombre_album = Input::get('nombre_album');
        $url_album = "pages/uploads/albums/" . $nombre_album;
        $nombre_foto = str_replace(array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'), array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'), ($usar_nombre_archivo) ? $file['name'] : (Input::get('nombre') . '.' . File::extension($file['name'])));
        $url_foto = $url_album . "/" . str_replace(' ', '_', $nombre_foto);

        if (Laravel\File::exists($url_foto)) {
            return Laravel\View::make('admin.message')->with('msg', '<h3>La foto ya existe</h3><div class="subtitle-message">La foto no puede ser cargada al album: ' . $nombre_album . '</div>');
        }
        \Laravel\Input::upload('foto', $url_album, str_replace(' ', '_', $nombre_foto));
        if (!Laravel\File::exists($url_foto)) {
            return Laravel\View::make('admin.message')->with('msg', 'Ocurrio un error al subir la foto: "' . $nombre_foto . '"');
        }

        $album = Album::find_by_name($nombre_album);
        $foto = new Foto();

        if (is_null($album)) {
            return Laravel\View::make('admin.message')->with('msg', 'El album: "' . $nombre_album . '" no existe, por tanto no se subira la foto.');
        }

        $foto->administradores_id = Auth::user()->id;
        $foto->albums_id = $album->id;
        $foto->nombre = $nombre_foto;
        $foto->descripcion = Input::get('descripcion');
        $foto->url = $url_foto;
        $foto->save();
        return \Laravel\Redirect::back();
    }

    public function get_eliminar($nombre_album = "") {
        $dir = Input::get('dir');
        if (Laravel\Input::has('dir')) {
            $album = Album::find_by_url($dir);
            if (!$this->eliminarAlbum($album)) {
                return Laravel\View::make('admin.message')->with('msg', 'El album con url: /' . $album->url . ', no se pudo eliminar');
            }
        } else if ($nombre_album == "") {
            return Laravel\View::make('admin.message')->with('msg', 'Esta pagina no esta disponible');
        }

        $album = Album::find_by_name_to_dir($nombre_album);
        if (!$this->eliminarAlbum($album)) {
            return Laravel\View::make('admin.message')->with('msg', 'El album con url: /' . $album->url . ', no se pudo eliminar');
        }
        return \Laravel\Redirect::back();
    }

    private function eliminarAlbum($album) {
        $success = false;
        $file = new \Laravel\File();

        if (is_null($album)) {
            return Laravel\View::make('admin.message')->with('msg', 'El album que se quiere eliminar no existe');
        }

        if ($file->exists($album->url)) {
            $file->rmdir($album->url);
        }
        if (!$file->exists($album->url)) {
            $success = true;
        }
        if ($album->num_photos() > 0) {
            $nRowsOld = $album->num_photos();
            $nRows = $album->delete_all_photos();
            if ($nRowsOld != $nRows) {
                return Laravel\View::make('admin.message')->with('msg', 'Ocurrio un error al eliminar las fotos del album: ' . $album->nombre);
            }
        }
        $album->delete();
        return $success;
    }

}

?>
