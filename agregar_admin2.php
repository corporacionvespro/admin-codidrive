<?php
session_start();
require_once 'conectar.php'; ?>
<?php
/*--------------------------------------------------------------*/
/* redireccionar
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
function TildesHtml($cadena)
{
    return str_replace(array("'", "á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ"), array("&rsquo;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;"), $cadena);
}

date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;

if (isset($_POST['guardar'])) { //    
    if (empty($errors)) {
        $dni = $_POST['dni'];
        $nombre_usuario  = $_POST['nombre_usuario'];
        $nombre_usuario2  = md5($nombre_usuario);
        $password  = $_POST['Password'];
        $password2  = md5($password);
        $correo  = $_POST['correo'];
        $detalle2  = $_POST['detalle'];
        $detalle  = TildesHtml($detalle2);
        $celular  = $_POST['celular'];
        $nombre2 = $_POST['nombre'];
        $nombre = TildesHtml($nombre2);


        $query2 = "INSERT INTO `usuarios` (`nombre`, `usuario`, `contra`, `usercrypto`, `passcrypto`, `estado`, `nivel`, `creado`, `detalle`, `id_empresa`) VALUES ('{$nombre}','{$nombre_usuario}','{$password}','{$nombre_usuario2}','{$password2}','1','2','{$fechahora}','{$detalle}','{$_SESSION["empresa"]}')";

        if ($db->query($query2)) {
            $query_usuarios = $db->query("SELECT id FROM `usuarios` ORDER BY `usuarios`.`id` DESC");
            $id_usuarios = $query_usuarios->fetch_assoc();
            $id_usuarioss = $id_usuarios['id'];
            //bien 
            $query3 = "INSERT INTO `admin` 
            (`nombre`, `dni`, `correo`, `celular`, `fecha`, `hora`, `estado`, `id_usuario`, `id_empresa`, `detalle`) 
            VALUES 
            ('{$nombre}','{$dni}','{$correo}','{$celular}','{$fecha}','{$hora24}','1','{$id_usuarioss}','{$_SESSION["empresa"]}','{$detalle}')";

            if ($db->query($query3)) {

                redirect('administradores.php', false); // ruta a redirecionarsi falla  

            } else {
                //falló
                redirect('administradores.php', false); // ruta a redirecionarsi falla
            }
        } else {
            //falló
            redirect('administradores.php', false); // ruta a redirecionarsi falla
        }
    } else {
        //falló
        redirect('administradores.php', false); // ruta a redirecionarsi falla
    }
}
?>