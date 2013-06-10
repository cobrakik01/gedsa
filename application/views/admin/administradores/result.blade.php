@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>{{$accion}}</h3>
    @if($users->results)
    <table class="tresult" align="center">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Activo</th>
            <th>Accion</th>
        </tr>
        @foreach($users->results as $us)
        <tr>
            <td>
            {{$us->id}}
            </td>
            <td>
            {{$us->nombre}}
            </td>
            <td>
            @if($us->activo)
                Si
            @else
                No
            @endif
            </td>
            <td>
                {{HTML::link('administradores_admin/ver/' . base64_encode($us->descripcion_usuarios_id),'Ver')}}
                @if($us->activo)
                {{HTML::link('administradores_admin/desactivar/' . base64_encode($us->id),'Desactivar')}}
                @else
                {{HTML::link('administradores_admin/activar/' . base64_encode($us->id),'Activar')}}
                @endif
                
                {{HTML::link('#','Editar')}}
                {{HTML::link('#','Eliminar')}}
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <table align="center">
        <tr>
            <td>
                <h3>No se encontraron registros</h3>
            </td>
        </tr>
    </table>
    @endif
    {{$users->links()}}
@endsection