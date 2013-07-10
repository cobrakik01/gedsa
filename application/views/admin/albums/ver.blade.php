@layout('admin.albums.main')

@section('menu_albums')
@parent
@endsection

@section('menu_items_albums')
@parent
@endsection

@section('contenido_albums')
<div style="text-align: right;">
    {{ HTML::link('albums_admin/cambiar_nombre_descripcion/' . AlbumController::toDir($album),'Cambiar nombre y/o descripción.') }}
</div>
<h3>
    Fotos del Album <em>"{{$album->nombre}}"</em>
</h3>
<div style="padding: 10px; margin-bottom: 20px;">
    {{$album->descripcion}}
</div>
<div class="message">
    @if(!$fotos->results)
    <div class="title-message">
        <h4>Este álbum aún no tiene fotos, empieza subiendo la primera foto de este álbum.</h4>
    </div>
    @endif
    <div>
        {{Form::open_for_files('albums_admin/subir_foto/')}}
        <table align="center" border="0">
            <tr>
                <td align="right">{{ Form::label('nombre','Nombre') }}</td>
                <td align="left">{{ Form::text('nombre', Input::old('nombre')) }}</td>
                <td>{{ Form::label('nombre_archivo','Usar nombre de archivo', array('title'=>'Si la casilla esta seleccionada se usara el nombre original del archivo como nombre de la foto.', 'style'=>'margin-left: 10px;')) }} {{ Form::checkbox('nombre_archivo', 1, true) }}</td>
                <td>
                    @if($errors->first('nombre'))
                    <div class="warning"> 
                        {{$errors->first('nombre')}}
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td align="right">{{ Form::label('descripcion','Descripción') }}</td>
                <td colspan="3" align="left">{{ Form::text('descripcion', Input::old('descripcion')) }}</td>
            </tr>
            <tr>
                <td>{{Form::label('foto','Selecciona una foto')}}</td>
                <td>{{ Form::file('foto') }}</td>
                <td colspan="2">
                    @if($errors->first('foto'))
                    <div class="warning"> 
                        {{$errors->first('foto')}}
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">{{Form::submit('Subir Foto')}}</td>
            </tr>
        </table>
        {{ Form::hidden('nombre_album', $album->nombre) }}
        {{Form::close()}}
    </div>
    <div>
        Solo se pueden subir fotos menores o iguales a 2 megabytes
    </div>
    @if($errors->first('errores'))
    <div class="warning">
        {{$errors->first('errores')}}
    </div>
    @endif
</div>
@if($fotos->results)
@foreach($fotos->results as $foto)
    {{ HTML::image($foto->url, $foto->nombre, array('width'=>'200px')) }}
@endforeach
@endif
@endsection