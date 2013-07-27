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
                {{HTML::link('admin/presentaciones/ver_presentacion/' . base64_encode($presentacion->nombre) . '/' . base64_encode($presentacion->administradores_id), $presentacion->nombre)}}
            </td>
            <td>
                {{$presentacion->created_at}}
            </td>
            <td>
                {{$presentacion->updated_at}}
            </td>
            <td align="center">
                {{HTML::link('admin/presentaciones/eliminar_presentacion/' . base64_encode($presentacion->nombre) . '/' . base64_encode($presentacion->administradores_id), 'Eliminar')}}
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
        Aun no tienes ninguna presentación
    </div>
    @endif
@endsection