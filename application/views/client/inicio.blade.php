@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@parent
@endsection

@section('titulo_seccion')
<div style="font-stretch: extra-condensed; font-size: 25px; margin-top: 20px;">
    Algunos Servicios
</div>
@endsection

@section('contenido')
<div class="article">
    <div>
        <h3>
            Articulo Izquierdo
        </h3>
        <div>
            Resumen
        </div>
    </div>
    {{ HTML::image('img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg', 'Fachada', array('width'=>'180', 'height'=>'150', 'border'=>'0')) }}
</div>

<div class="article">
    {{ HTML::image('img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg', 'Fachada', array('width'=>'180', 'height'=>'150', 'border'=>'0')) }}
    <div>
        <h3>
            Articulo Derecho
        </h3>
        <div>
            Resumen
        </div>
    </div>
</div>
<div style="background-color: #f4f4f4; border: solid 1px #e5e5e5; text-align: center; padding: 10px; font-size: 12px;">
    {{HTML::link('/servicios','...Mas Servicios...')}}
</div>
@endsection