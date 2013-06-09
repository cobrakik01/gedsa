@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
<div style="font-stretch: extra-condensed; font-size: 25px; margin-top: 20px;">
    Servicios
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
    <img src="/img/Albums/Album 15-03-2013/IMG_20120710_123149.jpg" width="180" height="150" />
</div>

<div class="article">
    <img src="/img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg" width="180" height="150" />
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