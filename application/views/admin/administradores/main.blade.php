@layout('admin.main')

@section('menu')
    @parent
@endsection

@section('contenido')
    <h2>Administradores</h2>
    <hr />
    @section('menu_admin')
    <div class="menu">
        <ul>
            <li>
                {{HTML::link('administradores_admin/nuevo','Nuevo')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/todos','Todos')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/activos','Activos')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/result/inactivos','Inactivos')}}
            </li>
            <li>
                {{HTML::link('administradores_admin/buscar','Buscar')}}
            </li>
        </ul>
    </div>
    @yield_section

    @section('contenido_admin')    
    @yield_section
@endsection