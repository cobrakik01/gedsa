@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administración de Presentaciones</h2>
@section('menu_albums')
<div class="menu">
    <ul>
        @section('menu_items_albums')
        <li>
            <!-- <a href="#" id="btnNuevaPresentacion">Nueva Presentación</a> -->
            {{HTML::link('admin/presentaciones/nueva_presentacion','Nueva Presentación')}}
        </li>
        <li>
            {{HTML::link('admin/presentaciones/mis_presentaciones','Mis Presentaciones')}}
        </li>
        <li>
            {{HTML::link('admin/presentaciones/buscar_presentaciones','Buscar Presentaciones')}}
        </li>
        @yield_section
    </ul>
</div>
<script>
    $(document).ready(function() {
        cbk("#btnNuevaPresentacion").presentacion.nuevo();
    });
</script>
@yield_section

@section('contenido_albums')    
@yield_section
@endsection