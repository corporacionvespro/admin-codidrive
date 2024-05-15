
<!-- Modal -->
<div class="modal fade" id="legales" tabindex="-1" role="dialog" aria-labelledby="legalesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; display: block;">
        <h5 id="legalesLabel" style="text-align: center;">CREDENCIALES</h5>

      </div>
      <div class="modal-body" style="height: auto !important;">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <h2 style="text-align: center;">CREDENCIALES</h2>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="example2cols1Input">USUARIO</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="example2cols2Input">CONTRASE&Ntilde;A</label>
                    <div class="input-group">
                      <input id="txtPassword" type="Password" name="Password" class="form-control">
                      <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()" style="height: 46px;padding-top: 12px;font-size: 19px;background: #5F00BE;border-color: #5F00BE;"> <span class="fa fa-eye-slash icon"></span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
    <div class="scroll-wrapper scrollbar-inner scroll-content scroll-scrollx_visible" style="position: relative;">
      <div class="scrollbar-inner scroll-content" style="height: 822.469px; margin-bottom: 0px; margin-right: 0px; max-height: none;">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
          <!---->
          <a class="navbar-brand" href="./admin" id="img_base_menu" style="width: 100%;">
            <img src="./assets/img/brand/logo.png" class="navbar-brand-img" alt="..." style="width: 100%;height: 100%;">
          </a>
          <div class="ml-auto">
            <!-- Sidenav toggler -->
            <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar-inner">
          <!-- Collapse -->

          <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
              <!--  -->

              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'panel') {
                                        echo  "active";
                                      }
                                    } ?>" href="./admin">
                  <i class="fas fa-chart-bar" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Inicio</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'solicitudes') {
                                        echo  "active";
                                      }
                                    } ?>" href="./solicitudes">
                  <i class="fas fa-route" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Solicitudes</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'mapa') {
                                        echo  "active";
                                      }
                                    } ?>" href="./mapa">
                  <i class="fas fa-map" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Mapa</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'pasajeros') {
                                        echo  "active";
                                      }
                                    } ?>" href="./pasajeros">
                  <i class="fas fa-users" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Pasajeros</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'conductores') {
                                        echo  "active";
                                      }
                                    } ?>" href="./conductores">
                  <i class="fas fa-car" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Conductores</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'tempconductor') {
                                        echo  "active";
                                      }
                                    } ?>" href="./tempconductor">
                  <i class="fas fa-user-shield" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Solicitud conductor</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {
                                      if ($var == 'estconductores') {
                                        echo  "active";
                                      }
                                    } ?>" href="./estadisticac">
                  <i class="fas fa-money-bill" style="color: #5F00BE;"></i>
                  <span class="nav-link-text">Saldo conductor</span>
                </a>
              </li>
              <!-- /////////////////////////////////////////////////////////////////////// -->
              <!-- / -->
            </ul>
          </div>
        </div>
      </div>
      <div class="scroll-element scroll-x">
        <div class="scroll-element_outer">
          <div class="scroll-element_size"></div>
          <div class="scroll-element_track"></div>
          <div class="scroll-bar" style="width: 0px; left: 0px;"></div>
        </div>
      </div>
      <div class="scroll-element scroll-y">
        <div class="scroll-element_outer">
          <div class="scroll-element_size"></div>
          <div class="scroll-element_track"></div>
          <div class="scroll-bar" style="height: 0px;"></div>
        </div>
      </div>
    </div>
    <div class="scroll-element scroll-x scroll-scrollx_visible">
      <div class="scroll-element_outer">
        <div class="scroll-element_size"></div>
        <div class="scroll-element_track"></div>
        <div class="scroll-bar" style="width: 24px; left: 0px;"></div>
      </div>
    </div>
    <div class="scroll-element scroll-y scroll-scrollx_visible">
      <div class="scroll-element_outer">
        <div class="scroll-element_size"></div>
        <div class="scroll-element_track"></div>
        <div class="scroll-bar" style="height: 0px; top: 0px;"></div>
      </div>
    </div>
  </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class=" navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" style="background: #132e62 !important;border-bottom: none !important;">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->

        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center ml-md-auto">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main" style="margin-left: 12px;">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
          <li class="nav-item d-sm-none">
          </li>
          <style>
            .navbar .collapse .navbar-nav .nav-item .nav-link:not(.btn) .material-icons {
              margin-top: -3px;
              top: 0;
              position: relative;
              margin-right: 3px;
            }

            .navbar .notification {
              position: absolute;
              top: 5px;
              border: 1px solid #fff;
              right: 10px;
              font-size: 9px;
              background: #5F00BE;
              color: #fff;
              min-width: 20px;
              padding: 0 5px;
              height: 20px;
              border-radius: 10px;
              text-align: center;
              line-height: 19px;
              vertical-align: middle;
              display: block;
            }

            .navbar .openpay {
              position: absolute;
              top: 5px;
              border: 1px solid #fff;
              right: 10px;
              font-size: 9px;
              background: #5F00BE;
              color: #fff;
              min-width: 20px;
              padding: 0 5px;
              height: 20px;
              border-radius: 10px;
              text-align: center;
              line-height: 19px;
              vertical-align: middle;
              display: block;
            }

            #iconcampana {
              color: #7e7f81 !important;
            }

            #iconopenpay {
              color: #7e7f81 !important;
            }
          </style>
          <li class="nav-item dropdown" id="campana">

          </li>
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0">

          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?php echo './assets/img/brand/logo.png'; ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block" style="display: block !important;">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION["nombre_usuario"]; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Bienvenido <?php echo $_SESSION["nombre_usuario"]; ?></h6>
              </div>
              <div class="dropdown-divider"></div>
              <!--<button class="dropdown-item" onclick="modalmostrar()">
                <i class="ni ni-paper-diploma"></i>
                <span>Terminos y condiciones Vespro</span>
              </button>-->
              <a href="./logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Salir</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->