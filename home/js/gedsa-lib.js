function AlbumController(_element) {
    var htmlLoading = "<div style=\"text-align: center;\" id=\"loading\"><img src=\"/pages/img/sys_admin/load.gif\" /><br />Cargando...</div>";

    this.cargarMisAlbumes = function() {
        cargar("/index.php/admin/albumes_ajax/results/mis_albums");
    };

    this.cargarTodos = function() {
        cargar("/index.php/admin/albumes_ajax/results/todos");
    };

    function cargar(url) {
        $.ajax({
            url: url,
            error: function(response, textStatus) {
                $(_element).html(textStatus);
            },
            beforeSend: function(jqXHR, settings) {
                $(_element).html(htmlLoading);
            },
            success: function(data) {
                $(_element).html(data);
            }
        });
    }

    this.verFotosDeAlbum = function(idAlbum) {
        cargar("/index.php/admin/albumes_ajax/ver_album/" + idAlbum);
    };
}
///////////////////// END CLASS AlbumController ////////////////////////


/**
 * 
 * @param {string} _element selector
 * @returns {PresentacionController}
 */
function PresentacionController(_element) {

    var contentName = "#content-ajax";
    var dlgName = "#dialogoNuevaPresentacion";
    var htmlDialog = "<div id=\"dialogoNuevaPresentacion\" title=\"Selecciona las fotos para la presentación\" style=\"display: none;\"><div id=\"content-ajax\"></div></div>";

    function abrirMensage(container, text) {
        $(container).append("<div id='dlg-msg' style=\"text-align: center;\" id=\"loading\">" + text + "</div>");
        $("#dlg-msg").dialog({
            modal: true,
            buttons: [{
                    text: "cerrar",
                    click: function() {
                        $(this).dialog("close");
                    }
                }],
            close: function() {
                $(this).remove();
            }
        });
    }

    function abrirDialogo() {
        $(dlgName).dialog({
            modal: true,
            width: 700,
            position: "top",
            buttons: [{
                    text: "Seleccionar Fotos",
                    click: function() {
                        if (typeof(presentacion) != "undefined") {
                            if (presentacion.fotos.length > 0) {
                                presentacion.nombre = $("input[name='nombre']").val();
                                if (presentacion.nombre == "") {
                                    abrirMensage(contentName, "Aun no a colocado ningun nombre a la presentación.");
                                } else {
                                    $.ajax({
                                        url: "/index.php/admin/albumes_ajax/nueva_presentacion/",
                                        type: "POST",
                                        data: {"data": presentacion},
                                        error: function(jqXHR, textStatus, errorThrow) {
                                            abrirMensage(contentName, "Notificar del error al administrador del sistema, error:" + jqXHR.responseText);
                                            $("#dlg-msg").dialog("close");
                                            $(dlgName).dialog("close");
                                            // paginar resultados de los albumes al momento de seleccionar las fotos de la presentacion
                                        },
                                        beforeSend: function(jqXHR, settings) {
                                            $(contentName).append("<div id='dlg-msg' style=\"text-align: center;\" id=\"loading\"><img src=\"/pages/img/sys_admin/load.gif\" /><br />Creando presentación...</div>");
                                            $("#dlg-msg").dialog({
                                                modal: true,
                                                close: function() {
                                                    $(this).remove();
                                                }
                                            });
                                        },
                                        success: function(data) {
                                            $("#dlg-msg").text(data);
                                            $("#dlg-msg").dialog("close");
                                            location.reload();
                                        }
                                    });
                                }
                            }
                        }
                    }
                }, {
                    text: "Cancelar",
                    click: function() {
                        $(this).dialog("close");
                    }
                }],
            close: function() {
                $(this).dialog("destroy");
                PresentacionController.dialogoCreado = false;
                presentacion.fotos = null;
                delete presentacion.fotos;
                
                presentacion = null;
                delete presentacion;
            },
            create: function(event, ui) {
                cbk(contentName).album.cargarMisAlbumes();
                PresentacionController.dialogoCreado = true;
            }
        });
    }

    this.nuevo = function() {
        $(_element).click(function(e) {
            e.preventDefault();
            if (!util.existe(dlgName)) {
                $("body").append(htmlDialog);
            }
            if (util.existe(dlgName)) {
                if (util.inVisible(dlgName)) {
                    abrirDialogo();
                }
            }
        });
    };

    this.misAlbumes = function() {
        $(_element).click(function(e) {
            e.preventDefault();
            if (PresentacionController.dialogoCreado) {
                cbk(contentName).album.cargarMisAlbumes();
            }
        });
    };

    this.todosLosAlbumes = function() {
        $(_element).click(function(e) {
            e.preventDefault();
            if (PresentacionController.dialogoCreado) {
                cbk(contentName).album.cargarTodos();
            }
        });
    };

}
/**
 * **************************************************************
 *       Variables estaticas de la clase PresentacionController
 * **************************************************************
 */
PresentacionController.dialogoCreado = false;
///////////////////// END CLASS PresentacionController ////////////////////////

/**
 * 
 * @type Util contiene metodos genericos
 */
var util = {
    existe: function(_element) {
        return $(_element).length > 0;
    },
    visible: function(_element) {
        return $(_element).is(":visible");
    },
    inVisible: function(_element) {
        return $(_element).is(":hidden");
    }
};

/**
 * 
 * @param {string} _element selector
 * @returns {CbkFramework} Inicia una nueva instancia de la clase CbkFramework
 */
cbk = function(_element) {
    return new CbkFramework(_element);
};

/**
 * 
 * @param {string} _element selector
 * @returns {CbkFramework} Clase CbkFramework que contiene los objetos de los controladores del sistema
 */
function CbkFramework(_element) {
    this.presentacion = new PresentacionController(_element);
    this.album = new AlbumController(_element);
}