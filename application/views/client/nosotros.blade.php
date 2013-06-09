@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
<div style="font-stretch: extra-condensed; font-size: 25px; margin-top: 20px;">
    Nosotros
</div>
@endsection

@section('contenido')
<div class="article">
    Estos son algunos de nuestro trabajos
</div>
@endsection