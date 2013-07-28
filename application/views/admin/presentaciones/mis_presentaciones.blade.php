@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Mis Presentaciones</h3>
    @if($presentaciones->total > 0)
    <table class="tresult" align="center">
        <tr>
            <th>
                Nombre
            </th>
            <th>
                Creado
            </th>
            <th>
                Modificado
            </th>
            <th>
                Acción
            </th>
        </tr>
        @foreach($presentaciones->results as $presentacion)
        <tr>
            <td>
                {{HTML::link('admin/presentaciones/ver_presentacion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), $presentacion->nombre)}}
            </td>
            <td>
                {{$presentacion->created_at}}
            </td>
            <td>
                {{$presentacion->updated_at}}
            </td>
            <td align="center">
                {{HTML::link('admin/presentaciones/eliminar_presentacion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), 'Eliminar')}}
            </td>
        </tr>
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$presentaciones->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        <h2>Sin presentaciones</h2>
        <p>
            Aun no tienes ninguna presentación, puedes crear una nueva presentacion dando clic {{HTML::link('admin/presentaciones/nueva_presentacion/','aquí')}}
            o dando clic en la opción <strong>"Nueva Presentación"</strong> en el menu de arriba.
        </p>
    </div>
    @endif
@endsection