@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('perfil_admin',Auth::user()->nombre)}} - Administración de Presentaciones</h2>
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                <a href="#" id="dialogo">Nueva Presentación</a>
                <!-- {{HTML::link('presentaciones_admin/nueva_presentacion','Nueva Presentación')}} -->
            </li>
            <li>
                {{HTML::link('presentaciones_admin/mis_presentaciones','Mis Presentaciones')}}
            </li>
            <li>
                {{HTML::link('presentaciones_admin/buscar_presentaciones','Buscar Presentaciones')}}
            </li>
            @yield_section
        </ul>
    </div>
    <div id="dialog" title="Selecciona las fotos" style="display: none;">
        <div id="content-ajax">
        </div>
    </div>
    <script>
        $(function() {
            $("#dialogo").click(function(e){
                e.preventDefault();
                $( "#dialog" ).dialog({
                    modal:true,
                    width: 700,
                    position: "top",
                    buttons: [{
                            text: "Seleccionar fotos",
                            click: function() {
                                $( this ).dialog( "close" );
                                    alert("ok");
                                }
                            }],
                    create: function( event, ui ) {
                        $( "#content-ajax" ).html("<div style=\"text-align: center;\" id=\"loading\"><img src=\"/pages/img/sys_admin/load.gif\" /></div>");
                        $.ajax({
                            url: "/index.php/albums_admin_ajax/results/",
                            success: function(data) {
                                $( "#content-ajax" ).html(data);
                            }
                        });
                }});
            });
        });
    </script>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection