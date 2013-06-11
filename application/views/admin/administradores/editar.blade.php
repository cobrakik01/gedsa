@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>Editar Administrador</h3>
    <div style="padding: 10px; text-align: center; background-color: #f7f7f7; border: solid 1px #efefef; width: 300px; margin: 0 auto; margin-bottom: 20px;">Todos los campos con asterisco son requeridos</div>
    {{Form::open()}}
    <table align="center">
        <tr>
            <td>
                {{Form::label('txtNombre','Nombre *')}}
            </td>
            <td>
                {{Form::text('txtNombre', $us_desc->nombre)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtApp','Apellido Paterno *')}}
            </td>
            <td>
                {{Form::text('txtApp', $us_desc->apellido_paterno)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtApm','Apellido Materno')}}
            </td>
            <td>
                {{Form::text('txtApm', $us_desc->apellido_materno)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtDireccion','Direccion *')}}
            </td>
            <td>
                {{Form::text('txtDireccion', $us_desc->direccion)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtTelefono','Telefono * ')}}
            </td>
            <td>
                {{Form::telephone('txtTelefono', $us_desc->telefono)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtEmail','E-Mail')}}
            </td>
            <td>
                {{Form::email('txtEmail', $us_desc->email)}}
            </td>
        </tr>
        <tr>
            <td>
                Nik Name
            </td>
            <td>
                {{$us->nombre}}
                {{Form::hidden('txtNombreAdmin', $us->nombre)}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtPasswordA', 'Password Actual *')}}
            </td>
            <td>
                {{Form::password('txtPasswordA')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtPassword', 'Nuevo Password *')}}
            </td>
            <td>
                {{Form::password('txtPassword')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('txtCPassword', 'Confirmar Password *')}}
            </td>
            <td>
                {{Form::password('txtCPassword')}}
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                {{Form::submit('Guardar Cambios')}}
            </td>
        </tr>
    </table>
    {{Form::hidden('txtId', base64_encode($us->id))}}
    {{Form::close()}}
@endsection