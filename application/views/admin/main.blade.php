<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Panel de Administración GEDSA</title>
        {{HTML::style('css/admin-style.css')}}
    </head>
    <body>
        <div id="logo">
            <div style="font-size: 20px; padding-left: 50px; padding-top: 20px;">GEDSA</div>
            <div style="padding-bottom: 20px; padding-left: 20px;">Panel de Administración</div>
        </div>
        <div class="menu">
            <ul>
                @section('menu')
                <li>{{HTML::link('perfil_admin', 'Perfil')}}</li>
                <li>{{HTML::link('albums_admin', 'Albums')}}</li>
                <li>{{HTML::link('servicios_admin', 'Servicios')}}</li>
                <li>{{HTML::link('administradores_admin', 'Administradores')}}</li>
                <li>{{HTML::link('admin/logout', 'Cerrar Sesion')}}</li>
                @yield_section
            </ul>
        </div>
        <div class="wraper">
            <div id="container">
                @yield('contenido')
            </div>
        </div>
        <div id="footer">
            Taller de Arquitectura <div style="font-weight: bold;">GEDSA</div>&copy<?php echo date('Y'); ?>
        </div>
    </body>
</html>