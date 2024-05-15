$(document).ready(function () {
    $(function () {
        $("#example").DataTable({

            "responsive": true,
            "autoWidth": false,
            "order": [0, 'DESC'],
            "pageLength": 25,

            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "No se encontraron registros.",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },

                "dom": 'lBfrtip',
                "buttons": [{
                    "extend": 'excelHtml5',
                    "text": '<i class="fas fa-file-excel"></i> ',
                    "titleAttr": 'Exportar a Excel',
                    "className": 'btn btn-success'
                },
                {
                    "extend": 'pdfHtml5',
                    "text": '<i class="fas fa-file-pdf"></i> ',
                    "titleAttr": 'Exportar a PDF',
                    "className": 'btn btn-danger'
                },
                {
                    "extend": 'print',
                    "text": '<i class="fa fa-print"></i> ',
                    "titleAttr": 'Imprimir',
                    "className": 'btn btn-info'
                },
                ]
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "server_process_asociados.php",
        });

    });
});
var autolat;
var autolon;
var manuallat;
var manuallon;
var valores_modal;
var asociado;
var inputmapa = 0;
var val_modales = 0;

function recarga() {
    var table2 = $('#example').dataTable();
    table2.fnReloadAjax('server_process_asociados.php');
    table2.fnReloadAjax();
    var div = document.getElementById('load');
    $('#exampleModal3').modal('hide');
    div.style.display = 'none';
    tabladatos();
}

function datos(valores, id_asociados, nombre_asociado, telefono_asociado, direccion, latitud, longitud, nombre_admin, telefono_admin, id_categoria_asociados, detalle, logo) {

    asociado = '';
    val_modales = valores;
    if (valores == 'registrar') {
        $("#pac-input").val('')
        $("#input-address-formated").val('')
        $("#detalle").val('');
        $("#telefono_admin").val('');
        $("#nombres_admin").val('');
        $("#nombres_asociado").val('');
        $("#telefono_asociado").val('');
        $("#categorias option[value='0']").attr("selected", true);
        $('#imagePreview2').css('background-image', 'url(https://chapatutaxi.com/admin/assets/img/brand/logo.png)');
        $('#imagePreview2').hide();
        $('#imagePreview2').fadeIn(650);
        $('#exampleModal3').modal('show');
    } else {
        autolat = latitud;
        autolon = longitud;
        manuallat = latitud;
        manuallon = longitud;
        asociado = id_asociados;
        $("#pac-input").val(direccion);
        $("#input-address-formated").val(direccion);
        $("#detalle").val(detalle);
        $("#telefono_admin").val(telefono_admin);
        $("#nombres_admin").val(nombre_admin);
        $("#nombres_asociado").val(nombre_asociado);
        $("#telefono_asociado").val(telefono_asociado);
        $("#categorias option[value='" + id_categoria_asociados + "']").attr("selected", true);

        $('#imagePreview2').css('background-image', 'url(' + logo + ')');
        $('#imagePreview2').hide();
        $('#imagePreview2').fadeIn(650);
        $('#exampleModal3').modal('show');
    }

}

function tabladatos() {
    let interval = setInterval(function () {
        var table3 = $('#example').dataTable();
        table3.fnReloadAjax('server_process_asociados.php');
        table3.fnReloadAjax();
    }, 60000);
    setTimeout(function () {
        clearInterval(interval);
    }, 900000);
}

function initialize() {
    var map;
    var marker;
    var myLatlng = new google.maps.LatLng(-6.780333, -79.840486);
    var geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 13,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("Mapa"), mapOptions);
    var marker;
    google.maps.event.addListener(map, 'click', function (event) {
        placeMarker(event.latLng);
    });


    function placeMarker(location) {
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.DROP,
                zoom: 13
            });
        } else {
            marker.setPosition(location);
        }
        geocoder.geocode({
            location: location
        },
            (
                results = google.maps.GeocoderResult,
                status = google.maps.GeocoderStatus
            ) => {
                if (status === "OK") {
                    if (results[0]) {
                        var address_components = results[0].address_components;
                        var components = {};
                        jQuery.each(address_components, function (k, v1) {
                            jQuery.each(v1.types, function (k2, v2) {
                                components[v2] = v1.long_name
                            });
                        });
                        var city, postal_code, state, country, sublocality, street_number, route;
                        if (components.locality) {
                            city = components.locality;
                        }
                        if (!city) {
                            city = components.administrative_area_level_1;
                        }
                        if (components.postal_code) {
                            postal_code = components.postal_code;
                        }
                        if (components.postal_code) {
                            postal_code = components.postal_code;
                        }
                        if (components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }
                        if (components.route) {
                            route = components.route;
                        }
                        if (components.sublocality_level_1) {
                            sublocality = components.sublocality_level_1;
                        }
                        if (components.country) {
                            country = components.country;
                        }
                        if (components.street_number) {
                            street_number = components.street_number;
                        }
                        $('#input-address-formated').val(results[0].formatted_address);
                        manuallat = marker.getPosition().lat();
                        manuallon = marker.getPosition().lng();
                    } else {
                        window.alert("No results found");
                    }
                } else {
                    window.alert("Geocoder failed due to: " + status);
                }
            }
        );
    }
}

function initAutocomplete() {
    var direc = '';
    var coord = '';
    const map = new google.maps.Map(document.getElementById("map"), {
        center: {
            lat: -6.780333,
            lng: -79.840486
        },
        zoom: 13,
        mapTypeId: "roadmap",
    });
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });
    let markers = [];
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];
        const bounds = new google.maps.LatLngBounds();
        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                return;
            }
            markers.push(
                new google.maps.Marker({
                    map,
                    title: place.name,
                    position: place.geometry.location,
                })
            );
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
                autolat = place.geometry.location.lat();
                autolon = place.geometry.location.lng();
                coord = place.geometry.location.lat() + ',' + place.geometry.location.lng();
                direc = place.formatted_address;
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

function iniciar() {
    initialize();
    initAutocomplete();
}
window.iniciar = iniciar;

function cambiar_valor() {
    if (inputmapa == 0) {
        $("#mapa2").css("display", "none");
        $("#mapa1").css("display", "block");
        inputmapa = 1;
    } else {
        $("#mapa1").css("display", "none");
        $("#mapa2").css("display", "block");
        inputmapa = 0;
    }
}

function buscarpasjero() {
    var telefono = $("#telefono").val();
    $("#nombres").val("");
    var form = new FormData();
    form.append("telefono", telefono);
    var settings = {
        "url": "https://chapatutaxi.com/chapaapi/api/passenger/search",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        var json2 = JSON.parse(response);
        $("#nombres").val(json2.info.nombres);
    });
}

function reg_asociados() {

    var direccion_actual = '';
    var latitud_origen = '';
    var longitud_origen = '';
    var url = '';

    var detalle = $("#detalle").val();
    var categorias = $("#categorias").val();
    var telefono_admin = $("#telefono_admin").val();
    var nombres_admin = $("#nombres_admin").val();
    var nombres_asociado = $("#nombres_asociado").val();
    var telefono_asociado = $("#telefono_asociado").val();

    var imagenInput = document.getElementById('foto2');
    var imagen = imagenInput.files[0];

    var logo = 'https://chapatutaxi.com/admin/assets/img/brand/logo.png';

    if (inputmapa == 0) {
        direccion_actual = $("#pac-input").val();
        latitud_origen = autolat;
        longitud_origen = autolon;
    } else {
        direccion_actual = $("#input-address-formated").val();
        latitud_origen = manuallat;
        longitud_origen = manuallon;
    }
    if (val_modales == 'registrar') {

        url = "agregar_asociado.php";
    } else {
        url = "editar_asociado.php";
    }

    if (imagen) {
        var lector = new FileReader();
        lector.onload = function (evento) {
            var contenido = evento.target.result;
            var base64 = contenido.split(',')[1]; // Remover "data:image/jpeg;base64,"

            $.ajax({
                type: "POST",
                url: "https://iwork.pe/chapatutaxi/categorias_asociados/upbase64.php",
                data: {
                    imagen_base64: base64
                },
                success: function (response) {
                    console.log("Imagen subida correctamente.<br>URL de la imagen: " + response);
                    logo = response;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            logo:logo,
                            asociado: asociado,
                            direccion_actual: direccion_actual,
                            latitud_origen: latitud_origen,
                            longitud_origen: longitud_origen,
                            detalle: detalle,
                            categorias: categorias,
                            telefono_admin: telefono_admin,
                            nombres_admin: nombres_admin,
                            nombres_asociado: nombres_asociado,
                            telefono_asociado: telefono_asociado
                        },
                        beforeSend: function () {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function (result2) {
                            var div = document.getElementById('load');
                            div.style.display = 'none';
                            var table2 = $('#example').dataTable();
                            table2.fnReloadAjax('server_process_asociados.php');
                            table2.fnReloadAjax(); /**/
                            $('#exampleModal3').modal('hide');
                        }
                    });
                }
            });
        };
        lector.readAsDataURL(imagen);
    } else {
        console.error('Por favor selecciona una imagen.'); $.ajax({
            type: "POST",
            url: url,
            data: {
                logo:logo,
                asociado: asociado,
                direccion_actual: direccion_actual,
                latitud_origen: latitud_origen,
                longitud_origen: longitud_origen,
                detalle: detalle,
                categorias: categorias,
                telefono_admin: telefono_admin,
                nombres_admin: nombres_admin,
                nombres_asociado: nombres_asociado,
                telefono_asociado: telefono_asociado
            },
            beforeSend: function () {
                $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
            },
            success: function (result2) {
                var div = document.getElementById('load');
                div.style.display = 'none';
                var table2 = $('#example').dataTable();
                table2.fnReloadAjax('server_process_asociados.php');
                table2.fnReloadAjax(); /**/
                $('#exampleModal3').modal('hide');
            }
        });
    }
}

function eliminar_asociado(id) {
    let text = "¿Desea eliminar el negocio asociado?";

    if (confirm(text) == true) {
        $.ajax({
            type: 'POST',
            url: 'eliminar_asociado.php',
            data: {
                id: id
            },
            success: function (response2) {

                var table3 = $('#example').dataTable();
                table3.fnReloadAjax('server_process_asociados.php');
                table3.fnReloadAjax();
            }
        });
    }
}

function tokens(name, tk) {
    var form = new FormData();
    form.append("titulo", "SOLICITUD WEB 🔔");
    form.append("descripcion", "Central: " + name);
    form.append("token", tk);
    var settings = {
        "url": "https://chapatutaxi.com/chapaapi/api/token/pushdriver",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        recarga();
    });
}
var id_solicitud = '';

function cancelar(id) {
    id_solicitud = id;
}

function cancelar2() {
    var form = new FormData();
    form.append("id_solicitud", id_solicitud);

    var settings = {
        "url": "https://chapatutaxi.com/chapaapi/api//request/delete",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        table2.fnReloadAjax('server_process_asociados.php');
        table2.fnReloadAjax();
        $('#modal-notification').modal('hide');
    });
}

$("#foto2").change(function () {
    readURL2(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader2 = new FileReader();
        reader2.onload = function (e) {
            $('#imagePreview2').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
        }
        reader2.readAsDataURL(input.files[0]);
    }
}

function tabladatos2() {
    let interval2 = setInterval(function () {
        var table4 = $('#example').dataTable();
        table4.fnReloadAjax('server_process_asociados.php');
        table4.fnReloadAjax();
    }, 30000);
    setTimeout(function () {
        clearInterval(interval2);
    }, 43200000);
}
tabladatos2();