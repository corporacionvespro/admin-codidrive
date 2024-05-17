<!-- Footer -->
<footer class="footer pt-0 " style="position: fixed;left:0px;bottom: -7px;height: 0px !important;width:100%;background: #ffffff;padding-top: 2px !important;text-align: right;box-shadow: -1px 3px 1rem 0 rgb(228 233 247)">
  <div class="row align-items-center justify-content-lg-between ">
    <div class="col-lg-12 ">
      <div class="copyright text-center text-lg-center text-muted " style="color: #01296e !important;">
        ©  <a href="https://vespro.io" target="_blank" class="font-weight-bold ml-1" target="_blank" style="color: #5F00BE;">Tecnolog&iacute;a Vespro</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<!---->
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/js-cookie/js.cookie.js"></script>
<script src="./assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="./assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
<script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>



<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="./assets/js/demo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.1/howler.min.js"></script>
<script>
  function redireccion() {
    $("#iconcampana").click(function() {
      window.location = "#";
    });
  }

  function modalmostrar() {
    $('#legales').modal('show');
  }

  function modalocultar() {
    $('#legales').modal('hide')
  }

  function modalmostrar2() {
    $('#cookies').modal('show');
  }

  function modalocultar2() {
    $('#cookies').modal('hide')
  }


  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

  // Windows Phone must come first because its UA also contains "Android"
  if (/windows phone/i.test(userAgent)) {
    //return "Windows Phone";
  }

  if (/android/i.test(userAgent)) {
    // return "Android";
  }

  // iOS detection from: http://stackoverflow.com/a/9039885/177710
  if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
    // return "iOS";
    $("#img_base_menu").css("display", "none");
  }

  function fetchCounter() {
    $.ajax({
      url: "doc_vencidos.php",
      type: "GET",
      success: function(data) {
        if (data.count == 0) {
          $("#campanaaleta").hide();
        } else {
          $("#campanaaleta").show();
          $("#counter").text(data.count);
        }
      },
      error: function(error) {
        console.error("Error al obtener el contador:", error);
      }
    });
  }
  function cumpleCounter() {
    $.ajax({
      url: "doc_cumple.php",
      type: "GET",
      success: function(data) {
        if (data.count == 0) {
          $("#campanaaleta2").hide();
        } else {
          $("#campanaaleta2").show();
          $("#counter2").text(data.count);
        }
      },
      error: function(error) {
        console.error("Error al obtener el contador:", error);
      }
    });
  }
  $("#campanaaleta").click(function() {
        window.location.href = "./documentos";
    });
  $("#campanaaleta2").click(function() {
        window.location.href = "./cumple";
    });
  fetchCounter();
  cumpleCounter();
</script>

</body>

</html>