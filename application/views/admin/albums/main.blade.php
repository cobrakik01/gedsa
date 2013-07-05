@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;">Administración de Albums</h2>
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('albums_admin/nuevo','Nuevo')}}
            </li>
            <li>
                {{HTML::link('albums_admin/mis_albums','Mis Albums')}}
            </li>
            <li>
                {{HTML::link('albums_admin/todos','Todos')}}
            </li>
            <li>
                {{HTML::link('albums_admin/buscar','Buscar')}}
            </li>
            @yield_section
        </ul>
    </div>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection