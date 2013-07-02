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
                {{Form::label('nombre','Nombre *')}}
            </td>
            <td>
                {{Form::text('nombre', ($us_desc)?$us_desc->nombre:Input::old('nombre'))}}
            </td>
            <td>
                {{$errors->first('nombre')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('app','Apellido Paterno *')}}
            </td>
            <td>
                {{Form::text('app', ($us_desc)?$us_desc->apellido_paterno:Input::old('app'))}}
            </td>
            <td>
                {{$errors->first('app')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('apm','Apellido Materno')}}
            </td>
            <td>
                {{Form::text('apm', ($us_desc)?$us_desc->apellido_materno:Input::old('apm'))}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('direccion','Direccion *')}}
            </td>
            <td>
                {{Form::text('direccion', ($us_desc)?$us_desc->direccion:Input::old('direccion'))}}
            </td>
            <td>
                {{$errors->first('direccion')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('telefono','Telefono * ')}}
            </td>
            <td>
                {{Form::telephone('telefono', ($us_desc)?$us_desc->telefono:Input::old('telefono'))}}
            </td>
            <td>
                {{$errors->first('telefono')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('email','E-Mail')}}
            </td>
            <td>
                {{Form::email('email', ($us_desc)?$us_desc->email:Input::old('email'))}}
            </td>
            <td>
                {{$errors->first('email')}}
            </td>
        </tr>
        <tr>
            <td>
                Nik Name
            </td>
            <td>
                {{($us)?$us->nombre:Input::old('nikname')}}
                {{Form::hidden('nikname', ($us)?$us->nombre:Input::old('nikname'))}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('password_old', 'Password Actual *')}}
            </td>
            <td>
                {{Form::password('password_old')}}
            </td>
            <td>
                {{$errors->first('password_old')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('password', 'Nuevo Password *')}}
            </td>
            <td>
                {{Form::password('password')}}
            </td>
            <td>
                {{$errors->first('password')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('password_confirmation', 'Confirmar Password *')}}
            </td>
            <td>
                {{Form::password('password_confirmation')}}
            </td>
            <td>
                {{$errors->first('password_confirmation')}}
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                {{Form::submit('Guardar Cambios')}}
            </td>
        </tr>
    </table>
    {{Form::hidden('id', base64_encode(($us)?$us->id:Input::old('id')))}}
    {{Form::close()}}
@endsection