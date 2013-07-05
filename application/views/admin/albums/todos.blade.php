@layout('admin.albums.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Todos los Albums</h3>
    @if($albums->results)
    <table class="tresult" align="center">
        <tr>
            <th>
                ID
            </th>
            <th>
                Nombre del album
            </th>
            <th>
                Autor
            </th>
            <th>
                Fecha de creacion
            </th>
            <th>
                Ultima edición
            </th>
            <th>
                Direccion
            </th>
            <th>
                Accion
            </th>
        </tr>
        @foreach($albums->results as $album)
        @if($album->num_fotos() > 0)
        <tr>
            <td>
                {{$album->id}}
            </td>
            <td>
                {{HTML::link('albums_admin/ver_fotos/' . $album->get_dir() ,$album->nombre, array('title'=>'Click para ver las fotos del Album'))}}
            </td>
            <td>
                {{HTML::link('administradores_admin/ver/' . base64_encode($album->administrador()->id) ,$album->administrador()->nombre, array('title'=>'Click para ver la informacion del Administador'))}}
            </td>
            <td>
                {{$album->created_at}}
            </td>
            <td>
                {{$album->updated_at}}
            </td>
            <td>
                {{$album->url}}
            </td>
            <td align="center">
                {{HTML::link('albums_admin/eliminar/' . $album->get_dir(),'Eliminar')}}
            </td>
        </tr>
        @else
        <tr class="warning" title="Álbum vacío">
            <td>
                {{$album->id}}
            </td>
            <td>
                {{HTML::link('albums_admin/ver_fotos/' . $album->get_dir() ,$album->nombre, array('title'=>'Click para ver las fotos del Album'))}}
            </td>
            <td>
                {{HTML::link('administradores_admin/ver/' . base64_encode($album->administrador()->id) ,$album->administrador()->nombre, array('title'=>'Click para ver la informacion del Administador'))}}
            </td>
            <td>
                {{$album->created_at}}
            </td>
            <td>
                {{$album->updated_at}}
            </td>
            <td>
                {{$album->url}}
            </td>
            <td align="center">
                {{HTML::link('albums_admin/eliminar/' . $album->get_dir(),'Eliminar')}}
            </td>
        </tr>
        @endif
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$albums->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        <div class="title-message">No se encontraron álbumes.</div>
        <div>Al parecer nadie ha creado ni un álbum, se tú el primero dando clic {{HTML::link('albums_admin/nuevo', 'aquí')}} o dando clic en la opción "nuevo" del menú de arriba</div>
    </div>
    @endif
@endsection