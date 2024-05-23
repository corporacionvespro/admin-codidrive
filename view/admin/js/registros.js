function procesarCadena(cadena) {
    cadena = cadena.replace(/[^a-zA-Z0-9]/g, '');
    cadena = cadena.toUpperCase();
    cadena = cadena.slice(0, 3) + '-' + cadena.slice(3);
    return cadena;
}

$("#formuploadajax").on("submit", function (e) {
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("formuploadajax"));
    formData.append("dato", "valor");
    $.ajax({
            url: "https://codidrive.com/admin/newreg",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function (res) {
            var nombreurl = encodeURIComponent($('#nombres').val());
            var resultado = $('#placa').val();
            var placaurl = encodeURIComponent(procesarCadena(resultado));
            $("#formulario").css("display", "none");
            if (JSON.parse(res).estado === 'ok') {
                $("#valido").css("display", "block");
                $('#txtvali').text(JSON.parse(res).mensaje);
                inicio = '..🔔🔔%20%2ANUEVO%20REGISTRO%2A%20🔔🔔..%0A😁%20%2ANombre%2A%3A%20' + nombreurl + '.%0A🔸%20%2APlaca%2A%3A%20' + placaurl + '.%0A🔕🔕🔕🔕🔕🔕🔕🔕🔕🔕🔕%0A';
                window.open('https://api.whatsapp.com/send?phone=51967075303&text=' + inicio, '_blank');
            } else {
                $("#error").css("display", "block");
                $('#txterror').text(JSON.parse(res).mensaje);
            }
        });
});
function revisar() {
    $('#txterror').text('');
    $("#error").css("display", "none");
    $("#formulario").css("display", "block");
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

    var current_fs, next_fs, previous_fs;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

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
    });

    $(".previous").click(function () {

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

});