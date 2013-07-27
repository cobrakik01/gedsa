@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>
        Presentacion <span style="font-weight: bold;">{{$presentacion->nombre}}</span>
        <!-- <a href='/' id='presentacion-editar-nombre'>editar</a> -->
        {{HTML::link('admin/presentaciones/editar_nombre/' . base64_encode($presentacion->nombre) . '/' . base64_encode($presentacion->administradores_id), 'editar')}}
    </h3>
    <div style="margin-bottom: 30px;">
        <div id="descripcion-presentacion">
            @if(strlen($presentacion->descripcion) > 0)
                {{$presentacion->descripcion}}
            @else
                Este álbum aún no tiene descripcion.
            @endif
            {{HTML::link('admin/presentaciones/editar_descripcion/' . base64_encode($presentacion->nombre) . '/' . base64_encode($presentacion->administradores_id), 'editar')}}
            <!-- <a href='#' id='presentacion-editar-descripcion'>editar</a> -->
        </div>
        <div id="dlg-presentacion" style="display: none;">
            <div id="dlg-presentacion-content">
            </div>
        </div>
    </div>
    <div class="wraper-photo">
            <ul>
                @foreach($fotos->results as $foto)
                    <li title="{{(strlen($foto->descripcion) > 0) ? 'Descripción: ' . $foto->descripcion : ''}}">
                        <div class="container-photo">
                            {{ HTML::image($foto->url, $foto->nombre, array('border'=>'0')) }}
                            <ul class="controls-photo">
                            <li>
                                {{HTML::link('admin/albumes/editar_foto/' . $foto->id,'', array('class'=>'btnEditControl', 'title'=>'Editar Foto'))}}
                            </li>
                            <li>
                                {{HTML::link('admin/presentaciones/eliminar_foto/?pnom=' . base64_encode($presentacion->nombre) . '&fid=' . base64_encode($foto->id) , '', array('class'=>'btnDeleteControl', 'title'=>'Eliminar Foto'))}}
                            </li>
                            </ul>
                            <div class="description-photo-bg"></div>
                            <div class="description-photo">
                                {{$foto->shortDescription()}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <table align='center'>
            <tr>
                <td>
                    {{$fotos->links()}}
                </td>
            </tr>
        </table>
    <script>
        (function(){
            $(".wraper-photo ul li").tooltip();
        })();
    </script>
@endsection