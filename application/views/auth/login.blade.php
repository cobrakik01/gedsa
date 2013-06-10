@layout('admin.main')

@section('menu')
@endsection

@section('contenido')
{{ HTML::span('Inicio de Sesion', array('style' => 'font-size: 20px;')) }}
{{ Form::open('login', 'POST') }}
<table align="center" style="width: 320px;">
    <tr>
        <td align="right">
            {{ Form::label('txtNombreUsuario', 'Nombre de Usuario') }}
        </td>
        <td>
            {{ Form::text('txtNombreUsuario', Input::old('txtNombreUsuario')) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            {{ Form::label('txtPassword', 'Contraseña') }}
        </td>
        <td>
            {{ Form::password('txtPassword') }}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            {{ Form::submit('Iniciar') }}
        </td>
    </tr>
</table>
{{ Form::close() }}
@endsection
