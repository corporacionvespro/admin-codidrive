<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#01286b" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Codi</title>

    <!--Import Google Icon Font-->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />

    <!-- Compiled and minified CSS -->
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css"
    />
  </head>

  <body>
    <style>
      html,
      body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        margin: 0;
      }
      #div1 {
        height: 80px;
        width: 100%;
        background-color: red;

        display: flex;
        justify-content: center;
        align-items: center;
      }

      #div2 {
        flex: 1;
        /*background-color: green;*/
        position: initial;
      }
      *:focus {
        outline: none;
      }
      nav {
        color: #fff0;
        background-color: #ee6e7300;
        width: 100%;
        height: 0px;
        line-height: 56px;
      }
      .z-depth-1,
      nav,
      .card-panel,
      .card,
      .toast,
      .btn,
      .btn-large,
      .btn-small,
      .btn-floating,
      .dropdown-content,
      .collapsible,
      .sidenav {
        -webkit-box-shadow: none;
        box-shadow: none;
      }
      .fixed-action-btn.active ul {
        visibility: visible;
      }
      .btn-floating i {
        width: inherit;
        display: inline-block;
        text-align: center;
        color: #fff;
        font-size: 1.8rem;
        line-height: 35px;
        left: -8px;
        /* right: -4px; */
        position: relative;
      }
      .btn-floating {
        border-style: double;
        border-width: 8px;
        display: inline-block;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
        width: 50px;
        height: 50px;
        line-height: 33px;
        padding: 0;
        background-color: #01286b;
        border-radius: 50%;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
        cursor: pointer;
        vertical-align: middle;
        margin-top: -13px;
      }
      .sidenav-overlay {
        background-color: rgb(0 0 0 / 60%);
      }
      .rounded-circle,
      .avatar.rounded-circle img {
        border-radius: 50% !important;
      }
      .avatar img {
        width: 100%;
        border-radius: 0.375rem;
      }
      img {
        vertical-align: middle;
        border-style: none;
      }
      .media {
        display: flex;
        align-items: flex-start;
      }
      li {
        color: #01286b;

        font-size: 15px;
      }
      li span {
        color: #01286b;
      }
      .sidenav li > a > i,
      .sidenav li > a > [class^="mdi-"],
      .sidenav li > a li > a > [class*="mdi-"],
      .sidenav li > a > i.material-icons {
        float: left;
        height: 48px;

        line-height: 48px;

        margin: 0 32px 0 0;
        width: 24px;
        color: #01286b;
      }
      .gmnoprint {
        display: none;
      }
      .gm-control-active,
      .gm-fullscreen-control {
        display: none;
      }
      :target a {
        display: none;
      }
    </style>

    <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>-->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Buscar Dirección</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <nav style="z-index: 2" class="nav-wrapper">
      <div class="container">
        <!----><input type="hidden" id="loc_lat" />
        <input type="hidden" id="loc_long" />
        <input
          type="text"
          class="form-control"
          id="search_input"
          placeholder="Buscar"
          style="
            width: 276px;
            margin-top: 52px;
            border-radius: 25px;
            background: #ffffff;
            color: #01286b;
            padding-left: 8px;
            border: none;
            font-size: 1.3rem;
            height: 36px;
            padding-bottom: 0px;
            position: relative;
            margin-left: 17px;
            margin-bottom: 10px;
          "
        />

        <button
          id="buscar1"
          type="button"
          class="brand-logo"
          style="
            width: 284px;
            margin-top: -47px;
            border-radius: 25px;
            background: #01286b;
            padding-left: 22px;
            border: none;
            font-size: 1.3rem;
            height: 36px;
            padding-bottom: 2px;
          "
        >
          ¿A dónde quieres ir?
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-search"
            viewBox="0 0 16 16"
            style="left: 19px; position: relative"
          >
            <path
              d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
            ></path>
          </svg>
        </button>
      </div>
    </nav>
    <div id="div2" style="position: initial; overflow: hidden"></div>
    <style>
      #div2 {
        flex: 1;
        /*background-color: green;*/
        position: initial;
      }
      :target a {
        display: none;
      }
    </style>

    <ul class="sidenav" id="menu-responsive" style="background: #e2f1fa">
      <li>
        <div
          class="media align-items-center"
          style="
            margin-top: 52px;
            margin-right: 18px;
            border-bottom: solid;
            margin-left: 18px;
            padding-bottom: 25px;
            border-bottom-color: #929292b8;
            border-width: 2.6px;
          "
        >
          <div
            class="media-body ml-2"
            style="width: 289px; margin-left: 0px; margin-top: 12px"
          >
            <span class="mb-0 text-sm font-weight-bold" style="width: 148px"
              >HENRY DELGADO</span
            >
          </div>
          <span
            class="avatar avatar-sm rounded-circle"
            style="
              /* border: 15px; */
              /* border-color: #6cd2d294; */
              border: solid;
              border-top-color: #57bfba;
              border-right-color: #57bfba;
              border-bottom-color: #57bfba;
              border-left-color: #57bfba;
              border-width: 2px;
            "
          >
            <img
              alt="Image placeholder"
              src="http://codidrive.com/vespro/files/imagenes/user_icon.png"
              style="height: 66px; width: 66px; /* margin-right: 0px; */"
            />
          </span>
          <!--<div class="media-body ml-2 d-none d-lg-block">-->
        </div>
      </li>
      <li>
        <a href="ios.html">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >map</i
          >
          <span class="nav-link-text">Mapa</span>
        </a>
      </li>
      <li>
        <a href="ios_perfil.html">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >person</i
          >
          <span class="nav-link-text">Mi perfil</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >person_pin_circle</i
          >
          <span class="nav-link-text">Lugares recomendados</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >star</i
          >
          <span class="nav-link-text">Lugares Favoritos</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >description</i
          >
          <span class="nav-link-text">Historial de servicios</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >local_offer</i
          >
          <span class="nav-link-text">Promociones</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >announcement</i
          >
          <span class="nav-link-text">Acerca de codi App</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >share</i
          >
          <span class="nav-link-text">Compartir aplicaci&oacute;n</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i
            class="material-icons"
            style="margin-right: 13px; margin-left: -13px"
            >power_settings_new</i
          >
          <span class="nav-link-text">Cerrar sesi&oacute;n</span>
        </a>
      </li>
    </ul>
    <main style="height: 0px">
      <div class="container bsa">
        <div class="row">
          <div class="col s12 m8 offset-m1 xl7 offset-xl1">
            <div id="" class="">
              <div
                class="fixed-action-btn direction-top active"
                style="bottom: 0px; right: 24px"
              >
                <a
                  class="btn-floating btn-large red"
                  style="visibility: hidden"
                >
                  <i class="material-icons">mode_edit</i>
                </a>
                <ul>
                  <li>
                    <a
                      data-target="menu-responsive"
                      class="btn-floating sidenav-trigger"
                      style="
                        opacity: 1; /*transform: scale(0.4) translateY(40px) translateX(0px);*/
                      "
                    >
                      <i class="material-icons">format_list_bulleted</i>
                    </a>
                  </li>
                  <li>
                    <a
                      id="full"
                      class="btn-floating darken-1"
                      style="
                        opacity: 1; /*transform: scale(0.4) translateY(40px) translateX(0px);*/
                      "
                    >
                      <i class="material-icons">gps_fixed</i>
                    </a>
                  </li>
                  <li>
                    <a
                      id="updateMap"
                      class="btn-floating"
                      style="
                        opacity: 1; /*transform: scale(0.4) translateY(40px) translateX(0px);*/
                      "
                    >
                      <i class="material-icons">flag</i>
                    </a>
                  </li>
                  <li>
                    <a
                      class="btn-floating"
                      style="
                        opacity: 1; /*transform: scale(0.4) translateY(40px) translateX(0px);*/
                      "
                    >
                      <i class="material-icons">star</i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Table of Contents -->
        </div>
      </div>
    </main>

    <!-- Compiled and minified JavaScript 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>-->

    <script src="materialize.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB7FIwlIrSNJA9dz77tHakwVLhOhzsXkTI"></script>
    <script>
      /**/ $("#buscar1").click(function () {
        $("#buscar1").css("display", "none");
        $("#search_input").css("display", "block");
       
      });
      ////////////////pantalla completa /////////////////////
      document.addEventListener("DOMContentLoaded", function () {
        // var elems = document.querySelectorAll('.sidenav');
        // var instances = M.Sidenav.init(elems);
        M.AutoInit();
      });
    </script>
    <script type="text/javascript">
      function alterna_modo_de_pantalla() {
        if (
          (document.fullScreenElement && document.fullScreenElement !== null) || // metodo alternativo
          (!document.mozFullScreen && !document.webkitIsFullScreen)
        ) {
          // metodos actuales
          if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
          } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
          } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(
              Element.ALLOW_KEYBOARD_INPUT
            );
          }
        } else {
          if (document.cancelFullScreen) {
            document.cancelFullScreen();
          } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
          } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
          }
        }
      }
    </script>
    <script type="text/javascript">
      $("#full").click(function (event) {
        alterna_modo_de_pantalla();
      });

      document.addEventListener(
        "keydown",
        function (e) {
          if (e.keyCode == 49) {
            alterna_modo_de_pantalla();
          }
        },
        false
      );
    </script>
    <script type="text/javascript">
      document.addEventListener(
        "keydown",
        function (e) {
          if (e.keyCode == 57) {
            alterna_modo_de_pantalla();
          }
        },
        false
      );
    </script>

    <script type="text/javascript">
      var searchInput = "search_input";

      $(document).ready(function () {
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById(searchInput),
          {
            types: ["geocode"],
          }
        );

        google.maps.event.addListener(
          autocomplete,
          "place_changed",
          function () {
            var near_place = autocomplete.getPlace();
            document.getElementById(
              "loc_lat"
            ).value = near_place.geometry.location.lat();
            document.getElementById(
              "loc_long"
            ).value = near_place.geometry.location.lng();

            document.getElementById(
              "latitude_view"
            ).innerHTML = near_place.geometry.location.lat();
            document.getElementById(
              "longitude_view"
            ).innerHTML = near_place.geometry.location.lng();
          }
        );
      });
      /*$(document).on("change", "#" + searchInput, function () {
  document.getElementById("latitude_input").value = "";
  document.getElementById("longitude_input").value = "";

  document.getElementById("latitude_view").innerHTML = "";
  document.getElementById("longitude_view").innerHTML = "";
});*/
      var autocomplete;
      autocomplete = new google.maps.places.Autocomplete(
        document.getElementById(searchInput),
        {
          types: ["geocode"],
          componentRestrictions: {
            country: "PERU",
          },
        }
      );
      ///////////////////////////actualizar marcvadores ya creados ////////////
      $("#updateMap").click(function () {
        /* var lat = parseFloat(document.getElementById("markerLat").value);
        var lng = parseFloat(document.getElementById("markerLng").value);
        var newLatLng = new google.maps.LatLng(lat, lng);*/
        var newLatLng = new google.maps.LatLng(
          -6.79487150027018,
          -79.84341760311517
        );
        marker.setPosition(newLatLng);
      });
      ////////////////////carga de mapa comun//////
      /* var myCenter = new google.maps.LatLng(
        -6.761634055390451,
        -79.83944636137045
      );

      var marker = new google.maps.Marker({
        position: myCenter,
      });

      window.onload = function () {
        var mapOptions = {
          center: myCenter,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          panControl: false,
          zoomControl: false,
          scaleControl: false,
          styles: [],
        };
        var map = new google.maps.Map(
          document.getElementById("div2"),
          mapOptions
        );
        marker.setMap(map);
      };*/
    </script>

    <script type="text/javascript">
      ///////////////////////////////////encontrar tu localizacion//////////////
      /* var map;
      function initMap() {
        map = new google.maps.Map($("#div2")[0], {
          center: { lat: -6.761634055390451, lng: -79.83944636137045 },
          zoom: 16,
        });
      }

      $("#my_location").click(function () {
        //user click on button
        if ("geolocation" in navigator) {
          navigator.geolocation.getCurrentPosition(show_location, show_error, {
            timeout: 1000,
            enableHighAccuracy: true,
          }); //position request
        } else {
          console.log("Browser doesn't support geolocation!");
        }
      });

      //Success Callback
      function show_location(position) {
        infoWindow = new google.maps.InfoWindow({ map: map });
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
        infoWindow.setPosition(pos);
        infoWindow.setContent("User Location found.");
        map.setCenter(pos);
      }

      //Error Callback
      function show_error(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            alert("Permission denied by user.");
            break;
          case error.POSITION_UNAVAILABLE:
            alert("Location position unavailable.");
            break;
          case error.TIMEOUT:
            alert("Request timeout.");
            break;
          case error.UNKNOWN_ERROR:
            alert("Unknown error.");
            break;
        }
      }*/
    </script>
    <script>
      ////////////////////movimineto del marcador////////////////////
      var position = [-6.761634055390451, -79.83944636137045];

      function initialize() {
        var latlng = new google.maps.LatLng(position[0], position[1]);
        var myOptions = {
          zoom: 16,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        };
        map = new google.maps.Map(document.getElementById("div2"), myOptions);

        marker = new google.maps.Marker({
          position: latlng,
          map: map,
          title: "Latitude:" + position[0] + " | Longitude:" + position[1],
        });

        google.maps.event.addListener(map, "click", function (event) {
          var result = [event.latLng.lat(), event.latLng.lng()];
          transition(result);
        });
      }

      //Load google map
      google.maps.event.addDomListener(window, "load", initialize);

      var numDeltas = 100;
      var delay = 10; //milliseconds
      var i = 0;
      var deltaLat;
      var deltaLng;
      ////////////actualizar marcadores/////////////
      $("#updateMap").click(function () {
        var result = [-6.762558576758108, -79.83909905702524];
        transition(result);
      });
      function transition(result) {
        i = 0;
        deltaLat = (result[0] - position[0]) / numDeltas;
        deltaLng = (result[1] - position[1]) / numDeltas;
        moveMarker();
      }

      function moveMarker() {
        position[0] += deltaLat;
        position[1] += deltaLng;
        var latlng = new google.maps.LatLng(position[0], position[1]);
        marker.setTitle(
          "Latitude:" + position[0] + " | Longitude:" + position[1]
        );
        marker.setPosition(latlng);
        if (i != numDeltas) {
          i++;
          setTimeout(moveMarker, delay);
        }
      }

      ////////////busca direcciones ///////////////////
    </script>
  </body>
</html>