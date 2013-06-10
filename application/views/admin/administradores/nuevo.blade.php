@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>Nuevo Administrador</h3>
    {{Form::open()}}
    <table style="width: 300px; margin: 0 auto;">
        <tr>
            <td>
                {{Form::label('txtNombre','Nombre')}}
            </td>
            <td>
                {{Form::text('txtNombre')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtApp','Apellido Paterno')}}
            </td>
            <td>
                {{Form::text('txtApp')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtApm','Apellido Materno')}}
            </td>
            <td>
                {{Form::text('txtApm')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtDireccion','Direccion')}}
            </td>
            <td>
                {{Form::text('txtDireccion')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtTelefono','Telefono')}}
            </td>
            <td>
                {{Form::telephone('txtTelefono')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtEmail','E-Mail')}}
            </td>
            <td>
                {{Form::email('txtEmail')}}
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                {{Form::submit('Crear')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
@endsection