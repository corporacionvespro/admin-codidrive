<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
    <div class="scroll-wrapper scrollbar-inner scroll-content scroll-scrollx_visible" style="position: relative;">
      <div class="scrollbar-inner scroll-content" style="height: 822.469px; margin-bottom: 0px; margin-right: 0px; max-height: none;">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
          <a class="navbar-brand" href="#" >
            <img src="" class="navbar-brand-img" alt="...">
            <!---->
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
              <li class="nav-item">
                <a class="nav-link <?php if (isset($var)) {if ($var == 'negocio') {echo  "active";}} ?>" href="negocio.php">
                  <i class="fas fa-boxes" style="color: #ffffff;"></i>
                  <span class="nav-link-text">Negocios</span>
                </a>
              </li>
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
  <nav class=" navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" style="background: linear-gradient(87deg, #5F00BE 0, #5F00BE 100%) !important;border-bottom: none !important;">
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
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="https://iwork.pe/imagenes/imgtiendas/2/categorias/2-21092022155819.webp">
                </span>
                <div class="media-body ml-2 d-none d-lg-block" style="display: block !important;">
                  <span class="mb-0 text-sm  font-weight-bold" style="color: #7e7f81;"><?php echo $_SESSION["nombre_usuario"]; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Bienvenido <?php echo $_SESSION["nombre_usuario"]; ?></h6>
              </div>
              <div class="dropdown-divider"></div>
              <a href="./logout.php" class="dropdown-item">
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