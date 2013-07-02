@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2> Servicios </h2>
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
    {{ HTML::image('pages/img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg', 'Fachada', array('width'=>'180', 'height'=>'150', 'border'=>'0')) }}
</div>

<div class="article">
    {{ HTML::image('pages/--img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg', 'Fachada', array('width'=>'180', 'height'=>'150', 'border'=>'0')) }}
    <div>
        <h3>
            Articulo Derecho
        </h3>
        <div>
            Resumen
        </div>
    </div>
</div>
@endsection