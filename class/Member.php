<?php
namespace Phppot;
use \Phppot\DataSource;
class Member
{
    private $ds;
    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }
    public function processLogin($username, $password)
    {
        $query = "SELECT `id`, `nombre`, `usercrypto`, `passcrypto`, `nivel`, `ultimo_ingreso`, `id_empresa`, `cliente` FROM `usuarios` WHERE `usuario`= ? AND `contra`= ? AND `estado`= '1' ";
        $paramType = "ss";
        $paramArray = array($username, $password);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if (!empty($memberResult)) {
            $query = "SELECT `id`, `nombre`, `usercrypto`, `passcrypto`, `nivel`, `ultimo_ingreso`, `id_empresa`, `cliente` FROM `usuarios` WHERE `usuario`= ? AND `contra`= ? AND `estado`= '1' ";
            $paramType = "ss";
            $paramArray = array($username, $password);
            $memberResult = $this->ds->select($query, $paramType, $paramArray);
            if (!empty($memberResult)) {
                $_SESSION["userId"] = $memberResult[0]["id"];
                $_SESSION["level"] = $memberResult[0]["nivel"];
                $_SESSION["empresa"] = $memberResult[0]["id_empresa"];
                $_SESSION["nombre_usuario"] = $memberResult[0]["nombre"];
                $_SESSION["ultimo_ingreso"] = $memberResult[0]["ultimo_ingreso"];
                $_SESSION["cliente"] = $memberResult[0]["cliente"];
                return true;
            }
        }
    }
}
