<div id="content-ajax" style="font-size: 14px;">
@section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('','Mis Álbumes', array('id'=>'mis_albumes_ajax'))}}
            </li>
            <li>
                {{HTML::link('','Todos los Álbumes', array('id'=>'todas_las_presentaciones'))}}
            </li>
            @yield_section
        </ul>
    </div>
    <script>
        $(document).ready(function(){
            var imgLoading = "<div style=\"text-align: center;\" id=\"loading\"><img src=\"/pages/img/sys_admin/load.gif\" /></div>";
            var base_url = "/index.php/albums_admin_ajax/results/";
            
            $(".tresult tr").tooltip();
            
            $("#mis_albumes_ajax").click(function(e){
                e.preventDefault();
                $( "#content-ajax" ).html(imgLoading);
                $.ajax({
                    url: base_url + "mis_albums",
                    // data: {zipcode: 97201},
                    success: function(data) {
                        $( "#content-ajax" ).html(data);
                    }
                });
            });
            
            $("#todas_las_presentaciones").click(function(e){
                e.preventDefault();
                $("#content-ajax" ).html(imgLoading);
                $.ajax({
                    url: base_url + "todos",
                    // data: {zipcode: 97201},
                    success: function(data) {
                        $( "#content-ajax" ).html(data);
                    }
                });
            });
        });
    </script>
@yield_section

@section('contenido_albums')    
@yield_section
</div>