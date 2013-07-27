@layout('admin.main')

@section('menu')
    @parent
@endsection

@section('contenido')
    <h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administradores</h2>
    @section('menu_admin')
    <div class="menu">
        <ul>
            <li>
                {{HTML::link('admin/administradores/nuevo','Nuevo administrador')}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/todos','Todos los administradores')}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/activos','Administradores activos')}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/inactivos','Administradores inactivos')}}
            </li>
            <li>
                {{HTML::link('admin/administradores/buscar','Buscar administradores')}}
            </li>
        </ul>
    </div>
    @yield_section

    @section('contenido_admin')    
    @yield_section
@endsection