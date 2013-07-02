<!DOCTYPE html><!-- HEADER -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Taller de Arquitectura Gedsa</title>
        {{HTML::style('pages/css/client-style.css')}}
    </head>

    <body>
        <div class="header">
            <div class="wrapper-s">
                <div id="container-logo">
                    {{ HTML::image('pages/img/logo.png', 'Logo GEDSA') }}
                    <div id="font-header" style="margin-top: 50px;">
                        <div style="font-size: 36px; color: #2D2D2D; font-weight: bold;">
                            GEDSA
                        </div>
                        <div style="font-size: 15px; font-weight: lighter; color: #818181; clear: both;">
                            <em>Taller de Arquitectura</em>
                        </div>
                    </div>
                </div>
                <div id="container-slogan">
                    <span style="font-size: 50px; color: #262626">P</span>lasmamos tus sueños
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="wrapper-s">
                <ul>
                    @section('menu')
                    <li>{{HTML::link('/','Inicio')}}</li>
                    <li>{{HTML::link('/servicios','Servicios')}}</li>
                    <li>{{HTML::link('/trabajos','Nuestros Trabajos')}}</li>
                    <li>{{HTML::link('/nosotros','Nosotros')}}</li>
                    <li>{{HTML::link('/contactanos','Contactenos')}}</li>
                    @yield_section
                </ul>
            </div>
        </div>
        <!-- END HEADER -->

        <!-- BODY -->
        <div id="container-body">
            <div class="wrapper-s">  <!-- MAIN WRAPPER -->
                @section('slider')
                <div id="container-slider">
                    <div class="content-slider">
                        <div class="slider">
                            {{ HTML::image('pages/img/Albums/Album 2/fachada interior 2.jpg', 'Logo GEDSA') }}
                            <div class="bg-description-slider">
                                <h3>Titulo Foto</h3>
                                <div>
                                    Descripcion de la foto
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield_section
                @yield('titulo_seccion')
                <div id="content"> <!-- ARTICLES -->
                    @yield('contenido')
                </div> <!-- END ARTICLES -->
                <div class="aside"> <!-- BANNER´S -->
                    <div class="banner">
                        <ul class="vmenu">
                            <h3>Tambien visitenos en...</h3>
                            <li>
                                <a href="http://www.facebook.com/tallerdearq.geedsa?fref=ts" target="blanck"> {{ HTML::image('pages/img/contactanos/search2.png', 'Faceboock', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Faceboock</a>
                                <a href="">{{ HTML::image('pages/img/contactanos/twitter_borde.png', 'Twitter', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Twitter</a>
                                <a href="">{{ HTML::image('pages/img/contactanos/youtube.png', 'Youtube', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Youtube</a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- END BANNER´S -->

            </div><!-- END MAIN WRAPPER -->
        </div>
        <!-- END BODY -->
        <!-- FOOTER -->
        <div id="footer">
            <div class="wrapper-s" id="footer-content">
                Taller de Arquitectura <div style="font-weight: bold;">GEDSA</div>
                <p>
                    &copy<?php echo date('Y');?>
                </p>
            </div>
        </div>
    </body>
</html>
<!-- END FOOTER -->