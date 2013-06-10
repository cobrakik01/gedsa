@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>Administrador Seleccionado</h3>
    @if($us_desc)
    <p>
    Nombre: {{$us_desc->nombre . ' ' . $us_desc->apellido_paterno . ' ' . $us_desc->apellido_materno}} <br />
    Direccion: {{$us_desc->direccion}} <br />
    Telefono: {{$us_desc->telefono}} <br />
    E-Mail: {{$us_desc->email}}
    </p>
    @else
    No existe el usuario solicitado
    @endif
@endsection