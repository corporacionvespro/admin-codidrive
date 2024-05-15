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
            "sAjaxSource": "server_process_solicitudes.php",
        });

    });
});
var autolat;
var autolon;
var manuallat;
var manuallon;
var inputmapa = 0;

function recarga() {
    var table2 = $('#example').dataTable();
    table2.fnReloadAjax('server_process_solicitudes.php');
    table2.fnReloadAjax();
    var div = document.getElementById('load');
    $('#exampleModal3').modal('hide');
    div.style.display = 'none';
    tabladatos();
}

function datos() {
    $('#exampleModal3').modal('show');
}

function tabladatos() {
    let interval = setInterval(function () {
        var table3 = $('#example').dataTable();
        table3.fnReloadAjax('server_process_solicitudes.php');
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

function solicitartaxi() {
    var direccion_actual = '';
    var latitud_origen = '';
    var longitud_origen = '';
    if (inputmapa == 0) {
        direccion_actual = $("#pac-input").val();
        latitud_origen = autolat;
        longitud_origen = autolon;
    } else {
        direccion_actual = $("#input-address-formated").val();
        latitud_origen = manuallat;
        longitud_origen = manuallon;
    }
    var nombres = $("#nombres").val();
    var precio = $("#precio").val();
    var referencia = $("#referencia").val();
    var telefono = $("#telefono").val();
    var form = new FormData();
    form.append("direccion_actual", direccion_actual);
    form.append("latitud_origen", latitud_origen);
    form.append("longitud_origen", longitud_origen);
    form.append("nombres", nombres);
    form.append("precio", precio);
    form.append("referencia", referencia);
    form.append("telefono", telefono);
    var settings = {
        "url": "https://chapatutaxi.com/chapaapi/api/request/web",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        var json2 = JSON.parse(response);
        if (json2.message == 'Solicitud enviada correctamente') {
            $.ajax({
                type: 'GET',
                url: 'https://chapatutaxi.com/chapaapi/api/token',
                beforeSend: function () {
                    $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                },
                success: function (response2) {
                    response2.tokens.forEach(function (item) {
                        $("#input-address-formated").val('');
                        $("#pac-input").val('');
                        $("#nombres").val('');
                        $("#precio").val('');
                        $("#referencia").val('');
                        $("#telefono").val('');
                        tokens(nombres, item.token)
                    });
                }
            });
        } else {}
    });
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
function finalizarsol(id) {
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
        table2.fnReloadAjax('server_process_solicitudes.php');
        table2.fnReloadAjax();
        $('#modal-notification').modal('hide');
    });
}

function finalizarsol2() {
    var form = new FormData();
    form.append("id_solicitud", id_solicitud);

    var settings = {
        "url": "./finalizar_solicitud.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        table2.fnReloadAjax('server_process_solicitudes.php');
        table2.fnReloadAjax();
        $('#modal-notificationes').modal('hide');
    });
}

function tabladatos2() {
    let interval2 = setInterval(function () {
        var table4 = $('#example').dataTable();
        table4.fnReloadAjax('server_process_solicitudes.php');
        table4.fnReloadAjax();
    }, 30000);
    setTimeout(function () {
        clearInterval(interval2);
    }, 43200000);
}
tabladatos2();