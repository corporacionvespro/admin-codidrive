var glob_idconductor = '';

function procesarCadena(cadena) {
    cadena = cadena.replace(/[^a-zA-Z0-9]/g, '');
    cadena = cadena.toUpperCase();
    cadena = cadena.slice(0, 3) + '-' + cadena.slice(3);
    return cadena;
}

function cargids() {
    glob_idconductor = $("#ndni").val();
    $("#imagen1").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image1").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces1").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen2").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image2").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces2").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen3").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image3").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces3").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen4").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image4").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces4").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen5").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image5").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces5").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen6").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image6").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces6").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen7").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image7").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces7").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
    $("#imagen8").val('https://iwork.pe/imagenes/imgqr/images.png');
    $("#uploaded_image8").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
    $("#enlaces8").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
}

function revisar() {
    $('#txterror').text('');
    $("#error").css("display", "none");
    $("#stepsform").css("display", "block");
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
$(document).ready(function () {
    $('[data-dismiss]').on('click', function () {
        var targetId = $(this).data('dismiss');
        $('#' + targetId).modal('hide');
    });
    var current_fs, next_fs, previous_fs;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    setProgressBar(current);
    $(".next").click(function () {
        var elementId = $(this).attr("id");
        if (elementId == 'primer') {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            next_fs.show();
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        } else if (elementId == 'segundo') {
            var srcValueval = $("#selfieImg").attr("src");
            if (srcValueval === "https://iwork.pe/chapatutaxi/53/dni_frontal/53-06102023153803.webp") {
                alert("Por favor, ten en cuenta que es obligatorio tomar la foto para poder continuar. Asegúrate de seguir las instrucciones y hacer clic en 'Abrir cámara' en la parte superior para completar este paso. ¡Gracias por tu cooperación!");
            } else {
                var nombres = $("#nombres").val();
                var telefono = $("#telefono").val();
                var correo = $("#correo").val();
                var fecha_nac = $("#fecha_nac").val();
                var clave = $("#clave").val();
                if (nombres === "" || telefono === "" || correo === "" || clave === "") {
                    alert("¡Casi has terminado! Para procesar tu solicitud, por favor asegúrate de completar todos los campos.");
                } else {
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    next_fs.show();
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function (now) {
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({
                                'opacity': opacity
                            });
                        },
                        duration: 500
                    });
                    setProgressBar(++current);
                }
            }
        } else if (elementId == 'tercero') {
            var placa = $("#placa").val();
            var marca = $("#marca").val();
            var color = $("#color").val();
            var anio = $("#anio").val();
            if (placa === "" || marca === "" || color === "" || anio === "") {
                alert("¡Casi has terminado! Para procesar tu solicitud, por favor asegúrate de completar todos los campos.");
            } else {
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function (now) {
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(++current);
            }
        } else if (elementId == 'cuarto') {
            var doc_personal = $("#doc_personal").val();
            var ndni = $("#ndni").val();
            var imagen1 = $("#imagen1").val();
            var imagen2 = $("#imagen2").val();
            var imagen3 = $("#imagen3").val();
            var imagen4 = $("#imagen4").val();
            var imagen8 = $("#imagen8").val();
            if (doc_personal === "0" || ndni === "" || imagen1 === "0" || imagen2 === "0" || imagen3 === "0" || imagen4 === "0" || imagen8 === "0" || imagen1 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen2 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen3 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen4 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen8 === "https://iwork.pe/imagenes/imgqr/images.png") {
                alert("¡Casi has terminado! Para procesar tu solicitud, por favor asegúrate de completar todos los campos y subir todas las imágenes requeridas.");
            } else {
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function (now) {
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(++current);
            }
        } else if (elementId == 'quinto') {
            var imagen5 = $("#imagen5").val();
            var imagen6 = $("#imagen6").val();
            var imagen7 = $("#imagen7").val();
            var glpgnv = $("#glpgnv").val();
            var frev_c = $("#frev_c").val();
            if (imagen5 === "" || imagen6 === "" || imagen7 === "" || imagen5 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen6 === "https://iwork.pe/imagenes/imgqr/images.png" || imagen7 === "https://iwork.pe/imagenes/imgqr/images.png") {
                alert("¡Casi has terminado! Para procesar tu solicitud, por favor asegúrate de completar todos los campos y subir todas las imágenes requeridas.");
            } else {
                var nombres = $("#nombres").val();
                var telefono = $("#telefono").val();
                var correo = $("#correo").val();
                var fecha_nac = $("#fecha_nac").val();
                var clave = $("#clave").val();
                var placa = $("#placa").val();
                var marca = $("#marca").val();
                var color = $("#color").val();
                var anio = $("#anio").val();
                var id = glob_idconductor;
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
                var srcValue = $("#selfieImg").attr("src");
                $.ajax({
                    url: 'https://codidrive.com/admin/newregistro',
                    type: "post",
                    data: {
                        nombres: nombres,
                        telefono: telefono,
                        correo: correo,
                        fecha_nac: fecha_nac,
                        clave: clave,
                        placa: placa,
                        marca: marca,
                        color: color,
                        anio: anio,
                        id: id,
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
                        srcValue: srcValue
                    },
                    beforeSend: function () {
                        $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                    },
                    success: function (res) {
                        
                        var nombreurl = encodeURIComponent($('#nombres').val());
                        var resultado = $('#placa').val();
                        var placaurl = encodeURIComponent(procesarCadena(resultado));
                        $("#mensaje").css("display", "none");
                        if (JSON.parse(res).estado === 'ok') {
                            $("#valido").css("display", "block");
                            $("#stepsform").css("display", "none");
                            $('#txtvali').text('¡Estamos procesando tu solicitud! El equipo de Operaciones de Chapa tu Taxi se pondrá en contacto contigo en un plazo máximo de 3 días hábiles. ¡Gracias por tu comprensión y paciencia!');
                            inicio = '..🔔🔔%20%2ANUEVO%20REGISTRO%2A%20🔔🔔..%0A😁%20%2ANombre%2A%3A%20' + nombreurl + '.%0A🔸%20%2APlaca%2A%3A%20' + placaurl + '.%0A🔕🔕🔕🔕🔕🔕🔕🔕🔕🔕🔕%0A';
                            window.open('https://api.whatsapp.com/send?phone=51992195100&text=' + inicio, '_blank');
                        } else {
                            $("#stepsform").css("display", "none");
                            $("#error").css("display", "block");
                            $('#txterror').text(JSON.parse(res).mensaje);
                        }
                    }
                });
            }
        } else {

        }
    });
    $(".previous").click(function () {
        var elementId = $(this).attr("id");
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        previous_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now) {
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }
    $(".submit").click(function () {
        return false;
    })
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