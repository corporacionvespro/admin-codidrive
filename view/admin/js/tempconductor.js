var tipo_opreacion = '';
var metodo_pago = '';
var tipo_pago = '';
var idpersonas = '';
var idcuentas = '';
var idvehiculos = '';
var idconductore = '';
var valores = '';
var glob_fecha_notf = '';
var glob_xdias2 = '';
var glob_monto2 = '';
var glob_f_final = '';
var glob_f_inicio = '';
var glob_dias = '';
var glob_detalleact = '';
var glob_idconductor = '';
$(document).ready(function () {
    $(function () {
        $("#example").DataTable({

            "responsive": true,
            "autoWidth": false,
            "order": [0, 'DESC'],
            "pageLength": 25,
            "columnDefs": [{
                "className": "dt-center",
                "targets": [4, 5, 6, 7, 8]
            }],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                /*"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", */
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
                    /*Siguiente*/
                    "sPrevious": "<" /*Anterior*/
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
            "sAjaxSource": "server_process_tempconductores.php",
        });

    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#foto").change(function () {
    readURL(this);
});
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

function datos() {
    $('#exampleModal3').modal('show');
}

function revisar() {
    $('#txterror').text('');
    $("#error").css("display", "none");
    $("#regformulario").css("display", "block");

}
$("#formuploadajax").on("submit", function (e) {
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("formuploadajax"));
    formData.append("dato", "valor");
    $.ajax({
            url: "https://chapatutaxi.com/admin/newreg",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function (res) {
            if (JSON.parse(res).estado === 'ok') {
                window.location.href = './tempconductor';
            } else {
                $("#regformulario").css("display", "none");
                $("#error").css("display", "block");
                $('#txterror').text(JSON.parse(res).mensaje);
            }
        });
});

function editardatos2() {
    nombres = $("#nombres2").val();
    correo = $("#correo2").val();
    clave = $("#clave2").val();
    telefono = $("#telefono2").val();
    foto2 = $("#foto2").val();
    var file_data = $('#foto2').prop('files')[0];
    var form = new FormData();
    form.append("clave", clave);
    form.append("correo", correo);
    form.append("id_cuenta", idcuentas);
    form.append("id_persona", idpersonas);
    form.append("nombres", nombres);
    form.append("telefono", telefono);
    form.append("foto", foto2);

    var settings = {
        "url": "https://codidrive.com/codi/api//driver/updatedriver",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        if (file_data === undefined) {
            table2.fnReloadAjax('server_process_tempconductores.php');
            table2.fnReloadAjax();
            $('#exampledatos').modal('hide');
        } else {
            var form_data = new FormData();
            form_data.append("foto", file_data);
            form_data.append("id_persona", idpersonas);
            var settings = {
                "url": "https://codidrive.com/codi/api/driver/updatephoto",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form_data
            };
            $.ajax(settings).done(function (response2) {
                table2.fnReloadAjax('server_process_tempconductores.php');
                table2.fnReloadAjax();
                $('#exampledatos').modal('hide');
            });
        }
    });
}

function vehiculodatos(id) {
    idvehiculos = id;
    $("#placa3").val('');
    $("#marca3").val('');
    $("#color3").val('');
    $("#anio3").val('');
    $("#unidad3").val('');
    var form = new FormData();
    form.append("id_vehiculo", id);
    var settings = {
        "url": "https://codidrive.com/codi/api//driver/infovehiculo",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        $('#examplevehiculo').modal('show');
        var json2 = JSON.parse(response);
        $("#placa3").val(json2.conductor.placa);
        $("#marca3").val(json2.conductor.marca);
        $("#color3").val(json2.conductor.color);
        $("#anio3").val(json2.conductor.anio);
        $("#unidad3").val(json2.conductor.unidad);
    });
}

function passw() {
    var x = document.getElementById("clave");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
var myInput = document.getElementById("clave");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
myInput.onfocus = function () {
    document.getElementById("message").style.display = "block";
}
myInput.onblur = function () {
    document.getElementById("message").style.display = "none";
}
myInput.onkeyup = function () {
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}

function personalesdatos(idpersona, idcuenta) {
    idpersonas = idpersona;
    idcuentas = idcuenta;
    $("#nombres2").val('');
    $("#telefono2").val('');
    /**/
    $('#imagePreview2').css('background-image', 'url(https://codidrive.com/admin/assets/img/brand/logo.png)');
    $('#imagePreview2').hide();
    $('#imagePreview2').fadeIn(650);
    /**/
    $("#correo2").val('');
    $("#clave2").val('');
    var form = new FormData();
    form.append("id_persona", idpersona);
    var settings = {
        "url": "https://codidrive.com/codi/api//driver/infodriver",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        var json2 = JSON.parse(response);
        $("#nombres2").val(json2.conductor.nombres);
        $("#telefono2").val(json2.conductor.telefono);
        /**/
        if (json2.conductor.foto == 'https://chapatutaxi.com/codiapi/images/logo.png') {
            var url = 'https://codidrive.com/admin/assets/img/brand/logo.png';
        } else {
            var url = 'https://chapatutaxi.com/codiapi/images/' + json2.conductor.foto;
        }
        $('#imagePreview2').css('background-image', 'url(' + url + ')');
        $('#imagePreview2').hide();
        $('#imagePreview2').fadeIn(650);
        /**/
        $("#correo2").val(json2.conductor.correo);
        $("#clave2").val(json2.conductor.clave);
        $('#exampledatos').modal('show');
    });
}

function editarvehiculo2() {
    marca = $("#marca3").val();
    placa = $("#placa3").val();
    unidad = $("#unidad3").val();
    color = $("#color3").val();
    anio = $("#anio3").val();
    var form = new FormData();
    form.append("anio", anio);
    form.append("color", color);
    form.append("id_vehiculo", idvehiculos);
    form.append("marca", marca);
    form.append("placa", placa);
    form.append("unidad", unidad);

    var settings = {
        "url": "https://codidrive.com/codi/api//driver/updatevehicle",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        table2.fnReloadAjax('server_process_tempconductores.php');
        table2.fnReloadAjax();
        $('#examplevehiculo').modal('hide');
    });
}

function cambiarestado3(id, estado) {
    var form = new FormData();
    form.append("estado", estado);
    form.append("id_conductor", id);

    var settings = {
        "url": "https://codidrive.com/codi/api//driver/state",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        table2.fnReloadAjax('server_process_tempconductores.php');
        table2.fnReloadAjax();
    });
}

function cambiarestado2(id, estado) {
    $("#monto").val(0);
    $("#f_inicio").val('');
    $("#f_final").val('');
    $("#dias").val('');
    $("#detalleact").val('');
    $("#Deposito").val('');
    $("#states").val('');
    $("#s_bille").val('');
    $("#resuemn_general").css("display", "none");
    idconductore = id;
    valores = estado;
    $("#guardarmonto").css("display", "none");
    $('#exampledesbloquear').modal('show');
}

function guardarmontos() {

    var form = new FormData();
    form.append("estado", valores);
    form.append("id_conductor", idconductore);

    var settings = {
        "url": "https://codidrive.com/codi/api//driver/state",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {
        var table2 = $('#example').dataTable();
        table2.fnReloadAjax('server_process_tempconductores.php');
        table2.fnReloadAjax();
    });
    $('#exampledesbloquear').modal('hide');
}

function c_fechas() {
    var monto = parseFloat($("#monto").val());
    var fecha1 = $("#f_inicio").val();
    var dias_f = parseInt($("#dias").val());
    $("#f_final").val(moment(fecha1).add(dias_f, 'days').format('YYYY-MM-DD'));
    var fecha_f = $("#f_final").val();
    var not = moment(fecha_f).subtract(1, 'days').format('YYYY-MM-DD');
    var xdias = (monto / dias_f);
    resumen(not, xdias);
}

function c_dias() {
    var monto = parseFloat($("#monto").val());
    var fecha1 = $("#f_inicio").val();
    var fecha2 = $("#f_final").val();
    $("#dias").val(moment(fecha2).diff(moment(fecha1), 'days'));
    var dias_f = parseInt($("#dias").val());
    var not = moment(fecha2).subtract(1, 'days').format('YYYY-MM-DD')
    var xdias = (monto / dias_f);
    resumen(not, xdias);
}

function resumen(not, xdias) {
    var xdias2 = xdias.toLocaleString("es-PE", {
        style: "currency",
        currency: "PEN"
    });
    var monto = parseFloat($("#monto").val());
    var monto2 = monto.toLocaleString("es-PE", {
        style: "currency",
        currency: "PEN"
    });
    document.getElementById("cos").innerHTML = xdias2;
    document.getElementById("cost").innerHTML = monto2;
    document.getElementById("f_bloq").innerHTML = $("#f_final").val();
    document.getElementById("f_not").innerHTML = not;
    document.getElementById("f_activa").innerHTML = $("#f_inicio").val();
    document.getElementById("periodo").innerHTML = $("#dias").val();
    document.getElementById("detallecos").innerHTML = $("#detalleact").val();
    $("#resuemn_general").css("display", "block");
    $("#guardarmonto").css("display", "block");
    glob_fecha_notf = not;
    var newxdias = xdias2.slice(3)
    var newmonto = monto2.slice(3)
    glob_xdias2 = newxdias.replace(',', '');
    glob_monto2 = newmonto.replace(',', '');
    glob_f_final = $("#f_final").val();
    glob_f_inicio = $("#f_inicio").val();
    glob_dias = $("#dias").val();
    glob_detalleact = $("#detalleact").val();
}

function bloqcon() {
    $("#resuemn_general").css("display", "none");
    $("#guardarmonto").css("display", "none");
}

function actcon() {
    $("#resuemn_general").css("display", "block");
    $("#guardarmonto").css("display", "block");
}

function regsaldo() {
    if ($('#banc_efec').is(':checked')) {
        tipo_pago = 'efectivo';
        tipo_opreacion = 'efectivo';
        metodo_pago = 'efectivo';
    } else {
        tipo_pago = 'banco';
        tipo_opreacion = $("#Deposito").val();
        if (tipo_opreacion == 'Banca') {
            metodo_pago = $("#states").val();
        } else if (tipo_opreacion == '0') {
            metodo_pago = 'indefinido';
        } else {
            metodo_pago = $("#s_bille").val();
        }
    }
    $.ajax({
        type: "POST",
        url: "https://chapatutaxi.com/admin/agregar_saldo.php",
        data: {
            id_conductores: idconductore,
            monto: glob_monto2,
            cantidad_dias: glob_dias,
            monto_dia: glob_xdias2,
            fecha_inicio: glob_f_inicio,
            fecha_final: glob_f_final,
            fecha_notificar: glob_fecha_notf,
            detalleact: glob_detalleact,
            metodo_pago: metodo_pago,
            tipo_pago: tipo_pago,
            tipo_opreacion: tipo_opreacion,

        },
        beforeSend: function () {
            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
        },
        success: function (result2) {
            var div = document.getElementById('load');
            div.style.display = 'none';
            var table2 = $('#example').dataTable();
            table2.fnReloadAjax('server_process_tempconductores.php');
            table2.fnReloadAjax();
            $('#exampledesbloquear').modal('hide');
        }
    });
}
$('#states').select2();

function cambiar_valor() {
    if ($('#banc_efec').is(':checked')) {
        $("#bille_div").css("display", "none");
        $("#banca_div").css("display", "none");
        $("#tipo_tranf").css("display", "none");
        document.getElementById("s_bille").value = "0";
        document.getElementById("Deposito").value = "0";
        document.getElementById("states").value = "0";
    } else {
        $("#tipo_tranf").css("display", "block");
        document.getElementById("s_bille").value = "0";
        document.getElementById("Deposito").value = "0";
        document.getElementById("states").value = "0";
    }
}

function mostrarselect(valor) {
    if (valor == 'Banca') {
        $("#bille_div").css("display", "none");
        $("#banca_div").css("display", "block");
        document.getElementById("s_bille").value = "0";
    } else if (valor == '0') {
        document.getElementById("states").value = "0";
        document.getElementById("s_bille").value = "0";
        $("#bille_div").css("display", "none");
        $("#banca_div").css("display", "none");
    } else {
        document.getElementById("states").value = "0";
        $("#bille_div").css("display", "block");
        $("#banca_div").css("display", "none");
    }
}

function tabladatos() {
    let interval = setInterval(function () {
        var table3 = $('#example').dataTable();
        table3.fnReloadAjax('server_process_tempconductores.php');
        table3.fnReloadAjax();
    }, 120000);
    setTimeout(function () {
        clearInterval(interval);
    }, 43200000);
}

function documentos(id) {
    glob_idconductor = id;
    
    $("#fecha_nac").val('');
    $("#doc_personal").val('');
    $("#imagen1").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image1").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces1").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingUno").addClass("collapsed");
    $("#collapseUno").removeClass("show");
    $("#headingUno").attr("aria-expanded", "false");
    $("#ndni").val('');
    $("#imagen2").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image2").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces2").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingDos").addClass("collapsed");
    $("#collapseDos").removeClass("show");
    $("#headingDos").attr("aria-expanded", "false");
    $("#fvdni").val('');
    $("#imagen3").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image3").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces3").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingTres").addClass("collapsed");
    $("#collapseTres").removeClass("show");
    $("#headingTres").attr("aria-expanded", "false");
    $("#nlicencia").val('');
    $("#imagen4").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image4").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces4").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingCuatro").addClass("collapsed");
    $("#collapseCuatro").removeClass("show");
    $("#headingCuatro").attr("aria-expanded", "false");
    $("#fvlicencia").val('');
    $("#imagen5").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image5").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces5").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingCinco").addClass("collapsed");
    $("#collapseCinco").removeClass("show");
    $("#headingCinco").attr("aria-expanded", "false");
    $("#fvsoat").val('');
    $("#imagen6").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image6").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces6").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingSeis").addClass("collapsed");
    $("#collapseSeis").removeClass("show");
    $("#headingSeis").attr("aria-expanded", "false");
    $("#imagen7").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image7").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces7").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingSiete").addClass("collapsed");
    $("#collapseSiete").removeClass("show");
    $("#headingSiete").attr("aria-expanded", "false");
    $("#imagen8").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image8").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces8").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#headingOcho").addClass("collapsed");
    $("#collapseOcho").removeClass("show");
    $("#headingOcho").attr("aria-expanded", "false");
    $("#frev_t").val('');
    $("#glpgnv").val('');
    $("#frev_c").val('');

    $.ajax({
        url: 'agregar_documento_conductor.php',
        type: "post",
        data: {
            id: id
        },
        beforeSend: function () {
            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
        },
        success: function (data) {
            var div = document.getElementById('load');
            div.style.display = 'none';
            $('#exampledocumentos').modal('show');
            $("#doc_personal").val(data.dni_tipo);
            $("#imagen1").val(data.dni_foto_frontal);
            $("#uploaded_image1").attr("src", data.dni_foto_frontal);
            $("#enlaces1").attr("href", data.dni_foto_frontal);
            $("#fecha_nac").val(data.fecha_nacimiento);
            $("#ndni").val(data.dni_numero);
            $("#imagen2").val(data.dni_foto_posterior);
            $("#uploaded_image2").attr("src", data.dni_foto_posterior);
            $("#enlaces2").attr("href", data.dni_foto_posterior);
            $("#fvdni").val(data.dni_fv);
            $("#imagen3").val(data.licencia_foto_frontal);
            $("#uploaded_image3").attr("src", data.licencia_foto_frontal);
            $("#enlaces3").attr("href", data.licencia_foto_frontal);
            $("#nlicencia").val(data.licencia_numero);
            $("#imagen4").val(data.licencia_foto_posterior);
            $("#uploaded_image4").attr("src", data.licencia_foto_posterior);
            $("#enlaces4").attr("href", data.licencia_foto_posterior);
            $("#fvlicencia").val(data.licencia_fv);
            $("#imagen5").val(data.soat_foto);
            $("#uploaded_image5").attr("src", data.soat_foto);
            $("#enlaces5").attr("href", data.soat_foto);
            $("#fvsoat").val(data.soat_fv);
            $("#imagen6").val(data.tp_foto_frontal);
            $("#uploaded_image6").attr("src", data.tp_foto_frontal);
            $("#enlaces6").attr("href", data.tp_foto_frontal);
            $("#imagen7").val(data.tp_foto_posterior);
            $("#uploaded_image7").attr("src", data.tp_foto_posterior);
            $("#enlaces7").attr("href", data.tp_foto_posterior);
            $("#imagen8").val(data.antecedentes_foto);
            $("#uploaded_image8").attr("src", data.antecedentes_foto);
            $("#enlaces8").attr("href", data.antecedentes_foto);
            $("#frev_t").val(data.revision_tecnica_fv);
            $("#glpgnv").val(data.certificado_gnv_glp_tipo);
            $("#frev_c").val(data.certificado_gnv_glp_fv);
        }
    });
}
tabladatos();
$(document).ready(function () {
    var $modal1 = $('#modal1');
    var $modal2 = $('#modal2');
    var $modal3 = $('#modal3');
    var $modal4 = $('#modal4');
    var $modal5 = $('#modal5');
    var $modal6 = $('#modal6');
    var $modal7 = $('#modal7');
    var $modal8 = $('#modal8');
    var image1 = document.getElementById('sample_image1');
    var image2 = document.getElementById('sample_image2');
    var image3 = document.getElementById('sample_image3');
    var image4 = document.getElementById('sample_image4');
    var image5 = document.getElementById('sample_image5');
    var image6 = document.getElementById('sample_image6');
    var image7 = document.getElementById('sample_image7');
    var image8 = document.getElementById('sample_image8');
    var cropper1;
    var cropper2;
    var cropper3;
    var cropper4;
    var cropper5;
    var cropper6;
    var cropper7;
    var cropper8;
    $('#upload_image1').change(function (event) {
        var files1 = event.target.files;

        var done = function (url1) {
            image1.src = url1;
            $modal1.modal('show');
        };

        if (files1 && files1.length > 0) {
            reader1 = new FileReader();
            reader1.onload = function (event) {
                done(reader1.result);
            };
            reader1.readAsDataURL(files1[0]);
        }
    });
    $('#upload_image2').change(function (event) {
        var files2 = event.target.files;

        var done = function (url2) {
            image2.src = url2;
            $modal2.modal('show');
        };

        if (files2 && files2.length > 0) {
            reader2 = new FileReader();
            reader2.onload = function (event) {
                done(reader2.result);
            };
            reader2.readAsDataURL(files2[0]);
        }
    });
    $('#upload_image3').change(function (event) {
        var files3 = event.target.files;

        var done = function (url3) {
            image3.src = url3;
            $modal3.modal('show');
        };

        if (files3 && files3.length > 0) {
            reader3 = new FileReader();
            reader3.onload = function (event) {
                done(reader3.result);
            };
            reader3.readAsDataURL(files3[0]);
        }
    });
    $('#upload_image4').change(function (event) {
        var files4 = event.target.files;

        var done = function (url4) {
            image4.src = url4;
            $modal4.modal('show');
        };

        if (files4 && files4.length > 0) {
            reader4 = new FileReader();
            reader4.onload = function (event) {
                done(reader4.result);
            };
            reader4.readAsDataURL(files4[0]);
        }
    });
    $('#upload_image5').change(function (event) {
        var files5 = event.target.files;

        var done = function (url5) {
            image5.src = url5;
            $modal5.modal('show');
        };

        if (files5 && files5.length > 0) {
            reader5 = new FileReader();
            reader5.onload = function (event) {
                done(reader5.result);
            };
            reader5.readAsDataURL(files5[0]);
        }
    });
    $('#upload_image6').change(function (event) {
        var files6 = event.target.files;

        var done = function (url6) {
            image6.src = url6;
            $modal6.modal('show');
        };

        if (files6 && files6.length > 0) {
            reader6 = new FileReader();
            reader6.onload = function (event) {
                done(reader6.result);
            };
            reader6.readAsDataURL(files6[0]);
        }
    });
    $('#upload_image7').change(function (event) {
        var files7 = event.target.files;

        var done = function (url7) {
            image7.src = url7;
            $modal7.modal('show');
        };

        if (files7 && files7.length > 0) {
            reader7 = new FileReader();
            reader7.onload = function (event) {
                done(reader7.result);
            };
            reader7.readAsDataURL(files7[0]);
        }
    });
    $('#upload_image8').change(function (event) {
        var files8 = event.target.files;

        var done = function (url8) {
            image8.src = url8;
            $modal8.modal('show');
        };

        if (files8 && files8.length > 0) {
            reader8 = new FileReader();
            reader8.onload = function (event) {
                done(reader8.result);
            };
            reader8.readAsDataURL(files8[0]);
        }
    });
    $modal1.on('shown.bs.modal', function () {
        cropper1 = new Cropper(image1, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview1'
        });
    }).on('hidden.bs.modal', function () {
        cropper1.destroy();
        cropper1 = null;
    });
    $modal2.on('shown.bs.modal', function () {
        cropper2 = new Cropper(image2, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview2'
        });
    }).on('hidden.bs.modal', function () {
        cropper2.destroy();
        cropper2 = null;
    });
    $modal3.on('shown.bs.modal', function () {
        cropper3 = new Cropper(image3, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview3'
        });
    }).on('hidden.bs.modal', function () {
        cropper3.destroy();
        cropper3 = null;
    });
    $modal4.on('shown.bs.modal', function () {
        cropper4 = new Cropper(image4, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview4'
        });
    }).on('hidden.bs.modal', function () {
        cropper4.destroy();
        cropper4 = null;
    });
    $modal5.on('shown.bs.modal', function () {
        cropper5 = new Cropper(image5, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview5'
        });
    }).on('hidden.bs.modal', function () {
        cropper5.destroy();
        cropper5 = null;
    });
    $modal6.on('shown.bs.modal', function () {
        cropper6 = new Cropper(image6, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview6'
        });
    }).on('hidden.bs.modal', function () {
        cropper6.destroy();
        cropper6 = null;
    });
    $modal7.on('shown.bs.modal', function () {
        cropper7 = new Cropper(image7, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview7'
        });
    }).on('hidden.bs.modal', function () {
        cropper7.destroy();
        cropper7 = null;
    });
    $modal8.on('shown.bs.modal', function () {
        cropper8 = new Cropper(image8, {
            aspectRatio: NaN,
            viewMode: 1,
            preview: '#preview8'
        });
    }).on('hidden.bs.modal', function () {
        cropper8.destroy();
        cropper8 = null;
    });

    $('#crop1').click(function () {
        canvas1 = cropper1.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas1.toBlob(function (blob1) {
            url1 = URL.createObjectURL(blob1);
            var reader1 = new FileReader();
            reader1.readAsDataURL(blob1);
            reader1.onloadend = function () {
                var base64data1 = reader1.result;
                var tipo1 = 'dni_frontal';
                var id1 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data1,
                        tipo: tipo1,
                        id: id1,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data1) {
                        var div1 = document.getElementById('load');
                        div1.style.display = 'none';
                        $modal1.modal('hide');
                        $('#uploaded_image1').attr('src', data1);
                        $('#imagen1').val(data1);
                    }
                });
            };
        });
    });
    $('#crop2').click(function () {
        canvas2 = cropper2.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas2.toBlob(function (blob2) {
            url2 = URL.createObjectURL(blob2);
            var reader2 = new FileReader();
            reader2.readAsDataURL(blob2);
            reader2.onloadend = function () {
                var base64data2 = reader2.result;
                var tipo2 = 'dni_posterior';
                var id2 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data2,
                        tipo: tipo2,
                        id: id2,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data2) {
                        var div2 = document.getElementById('load');
                        div2.style.display = 'none';
                        $modal2.modal('hide');
                        $('#uploaded_image2').attr('src', data2);
                        $('#imagen2').val(data2);
                    }
                });
            };
        });
    });
    $('#crop3').click(function () {
        canvas3 = cropper3.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas3.toBlob(function (blob3) {
            url3 = URL.createObjectURL(blob3);
            var reader3 = new FileReader();
            reader3.readAsDataURL(blob3);
            reader3.onloadend = function () {
                var base64data3 = reader3.result;
                var tipo3 = 'licencia_delantera';
                var id3 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data3,
                        tipo: tipo3,
                        id: id3,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data3) {
                        var div3 = document.getElementById('load');
                        div3.style.display = 'none';
                        $modal3.modal('hide');
                        $('#uploaded_image3').attr('src', data3);
                        $('#imagen3').val(data3);
                    }
                });
            };
        });
    });
    $('#crop4').click(function () {
        canvas4 = cropper4.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas4.toBlob(function (blob4) {
            url4 = URL.createObjectURL(blob4);
            var reader4 = new FileReader();
            reader4.readAsDataURL(blob4);
            reader4.onloadend = function () {
                var base64data4 = reader4.result;
                var tipo4 = 'licencia_posterior';
                var id4 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data4,
                        tipo: tipo4,
                        id: id4,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data4) {
                        var div4 = document.getElementById('load');
                        div4.style.display = 'none';
                        $modal4.modal('hide');
                        $('#uploaded_image4').attr('src', data4);
                        $('#imagen4').val(data4);
                    }
                });
            };
        });
    });
    $('#crop5').click(function () {
        canvas5 = cropper5.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas5.toBlob(function (blob5) {
            url5 = URL.createObjectURL(blob5);
            var reader5 = new FileReader();
            reader5.readAsDataURL(blob5);
            reader5.onloadend = function () {
                var base64data5 = reader5.result;
                var tipo5 = 'soat';
                var id5 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data5,
                        tipo: tipo5,
                        id: id5,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data5) {
                        var div5 = document.getElementById('load');
                        div5.style.display = 'none';
                        $modal5.modal('hide');
                        $('#uploaded_image5').attr('src', data5);
                        $('#imagen5').val(data5);
                    }
                });
            };
        });
    });
    $('#crop6').click(function () {
        canvas6 = cropper6.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas6.toBlob(function (blob6) {
            url6 = URL.createObjectURL(blob6);
            var reader6 = new FileReader();
            reader6.readAsDataURL(blob6);
            reader6.onloadend = function () {
                var base64data6 = reader6.result;
                var tipo6 = 't_v_propiedad_delantero';
                var id6 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data6,
                        tipo: tipo6,
                        id: id6,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data6) {
                        var div6 = document.getElementById('load');
                        div6.style.display = 'none';
                        $modal6.modal('hide');
                        $('#uploaded_image6').attr('src', data6);
                        $('#imagen6').val(data6);
                    }
                });
            };
        });
    });
    $('#crop7').click(function () {
        canvas7 = cropper7.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas7.toBlob(function (blob7) {
            url7 = URL.createObjectURL(blob7);
            var reader7 = new FileReader();
            reader7.readAsDataURL(blob7);
            reader7.onloadend = function () {
                var base64data7 = reader7.result;
                var tipo7 = 't_v_propiedad_posterior';
                var id7 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data7,
                        tipo: tipo7,
                        id: id7,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data7) {
                        var div7 = document.getElementById('load');
                        div7.style.display = 'none';
                        $modal7.modal('hide');
                        $('#uploaded_image7').attr('src', data7);
                        $('#imagen7').val(data7);
                    }
                });
            };
        });
    });
    $('#crop8').click(function () {
        canvas8 = cropper8.getCroppedCanvas({
            width: 1920,
            height: 1920
        });

        canvas8.toBlob(function (blob8) {
            url8 = URL.createObjectURL(blob8);
            var reader8 = new FileReader();
            reader8.readAsDataURL(blob8);
            reader8.onloadend = function () {
                var base64data8 = reader8.result;
                var tipo8 = 'antecedentes_penales';
                var id8 = glob_idconductor;
                $.ajax({
                    url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                    type: "post",
                    data: {
                        image: base64data8,
                        tipo: tipo8,
                        id: id8,
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (data8) {
                        var div8 = document.getElementById('load');
                        div8.style.display = 'none';
                        $modal8.modal('hide');
                        $('#uploaded_image8').attr('src', data8);
                        $('#imagen8').val(data8);
                    }
                });
            };
        });
    });
});

function eliminarimagen(id_hidden, id_upload) {
    if (confirm("¿Desea eliminar esta imagen?") == true) {
        var hidden = '#' + id_hidden;
        var upload = '#' + id_upload;
        $(hidden).val(0);
        $(upload).attr("src", "https://iwork.pe/imagenes/imgqr/images.png");
    }
}

function documentosfn() {
    var id = glob_idconductor;
    var fecha_nac = $("#fecha_nac").val();
    var doc_identidad = $("#doc_personal").val();
    var doc_img_front = $("#imagen1").val();
    var doc_n = $("#ndni").val();
    var doc_img_back = $("#imagen2").val();
    var doc_fv = $("#fvdni").val();
    var licencia_img_front = $("#imagen3").val();
    var licencia_n = $("#nlicencia").val();
    var licencia_img_back = $("#imagen4").val();
    var licencia_fv = $("#fvlicencia").val();
    var soat_img = $("#imagen5").val();
    var soat_fv = $("#fvsoat").val();
    var tp_img_front = $("#imagen6").val();
    var tp_img_back = $("#imagen7").val();
    var antp_img = $("#imagen8").val();
    var rt_fv = $("#frev_t").val();
    var cert_tipo = $("#glpgnv").val();
    var cert_fv = $("#frev_c").val();
    $.ajax({
        url: 'agregar_documentos.php',
        type: "post",
        data: {
            id: id,
            fecha_nac:fecha_nac,
            doc_identidad: doc_identidad,
            doc_img_front: doc_img_front,
            doc_n: doc_n,
            doc_img_back: doc_img_back,
            doc_fv: doc_fv,
            licencia_img_front: licencia_img_front,
            licencia_n: licencia_n,
            licencia_img_back: licencia_img_back,
            licencia_fv: licencia_fv,
            soat_img: soat_img,
            soat_fv: soat_fv,
            tp_img_front: tp_img_front,
            tp_img_back: tp_img_back,
            antp_img: antp_img,
            rt_fv: rt_fv,
            cert_tipo: cert_tipo,
            cert_fv: cert_fv,
        },
        beforeSend: function () {
            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
        },
        /* */
        success: function (data) {
            var div = document.getElementById('load');
            div.style.display = 'none';
            $('#exampledocumentos').modal('hide');
            /* */
        }
    });
}

function eliminar_conductor(id_p, id_pa) {
    let text = "¡Advertencia!\n" +
        "Eliminar este conductor:\n" +
        "1. Sin historial de solicitudes: Se borrarán todos sus datos.\n" +
        "2. Con historial de solicitudes: Los datos se asignarán a 'Vespro Tech' antes de borrarlos.\n" +
        "Nunca modificar o eliminar 'Vespro Tech.'\n" +
        "Si aceptas eliminar al conductor, esta acción será irreversible.'\n" +
        "¿Deseas continuar con la eliminación?";
    if (confirm(text) == true) {
        $.ajax({
            type: 'POST',
            url: './eliminar_conductor.php',
            data: {
                id_pe: id_p,
                id_pa: id_pa,
            },
            success: function (response2) {

                var table3 = $('#example').dataTable();
                table3.fnReloadAjax('server_process_tempconductores.php');
                table3.fnReloadAjax();
            }
        });
    } else {
        //
    }
}