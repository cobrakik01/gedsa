@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2> Nuestros Trabajos </h2>
@endsection

@section('contenido')
<?php for($a = 0; $a < 2; $a++): ?>
<div class="limites-album">
    <h3 style="padding-top: 10px; padding-left: 10px;">Titulo Album </h3>
    <div style="font-size: 13px; margin-bottom: 20px; margin-left: 50px; font-weight: lighter;">
        Descripcion detallada del album
    </div>
    <div class="marco-album">
        <?php for($i = 0; $i < 9; $i++): ?>
        <div class="cont-foto">
            {{ HTML::image('pages/img/Albums/Album 15-03-2013/IMG_20120710_124026.jpg', 'Fachada', array('width'=>'100%', 'height'=>'100%', 'border'=>'0')) }}
            <div class="desc-foto">
                Descripcion de la foto
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>
<?php endfor; ?>
@endsection