@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administración de Albums</h2>
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
                {{HTML::link('albums_admin/buscar_album','Buscar Álbum')}}
            </li>
            @yield_section
        </ul>
    </div>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection