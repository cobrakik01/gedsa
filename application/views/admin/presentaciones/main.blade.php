@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administración de Albums</h2>
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('presentaciones_admin/nuevo','Nueva Presentacion')}}
            </li>
            <li>
                {{HTML::link('presentaciones_admin/mis_albums','Mis Presentaciones')}}
            </li>
            <li>
                {{HTML::link('presentaciones_admin/buscar_album','Buscar Presentaciones')}}
            </li>
            @yield_section
        </ul>
    </div>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection