@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administración de Albums</h2>
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('admin/albumes/nuevo','Nuevo álbum')}}
            </li>
            <li>
                {{HTML::link('admin/albumes/mis_albums','Mis álbumes')}}
            </li>
            <li>
                {{HTML::link('admin/albumes/todos','Mostrar todos los álbumes')}}
            </li>
            <li>
                {{HTML::link('admin/albumes/buscar_album','Buscar álbum')}}
            </li>
            @yield_section
        </ul>
    </div>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection