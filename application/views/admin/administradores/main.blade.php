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
                {{HTML::link('administradores_admin/nuevo','Nuevo administrador')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/todos','Todos los administradores')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/activos','Administradores activos')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/inactivos','Administradores inactivos')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/buscar','Buscar administradores')}}
            </li>
        </ul>
    </div>
    @yield_section

    @section('contenido_admin')    
    @yield_section
@endsection