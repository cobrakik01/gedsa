@layout('admin.presentaciones.ajax.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Nueva Presentación</h3>
    {{Form::open()}}
    <table align="center" border="0">
        <tr>
            <td>
                {{Form::label('nombre', 'Nombre')}}
            </td>
            <td>
                {{Form::text('nombre')}}
            </td>
        </tr>
        <tr>
            <td colspan="2" align='center'>
                {{Form::label('descripcion','Descripcón')}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{Form::textarea('descripcion', '', array('rows'=>'5'))}}
            </td>
        </tr>
        <tr>
            <td colspan="2" align='center'>
                {{Form::submit('Crear Presentación')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
    
    <h4>{{$titulo}}</h4>
    <div style="font-size: 12px; color: #66cc00; position: relative; top: -20px;">No se muestran los álbumes vacíos</div>
    
    <?php if($albums->total > 0): ?>
        <table class="tresult" align="center" width="100%">
            <?php foreach ($albums->results as $album): ?>
                <?php if(!$album->vacio()): ?>
                    <tr style="cursor: pointer;" title="Da clic para visualizar las fotos del álbum">
                        <td>
                            {{$album->nombre}}
                        </td>
                        <td>
                            {{$album->descripcion}}
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="message">No se encontro ningun álbum</div>
    <?php endif; ?>
@endsection