<?php 
namespace Dao;

class RolesUsuariosPanel extends Table{

    public static function getActiveRolesUsuarios()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from roles_usuarios where roleuserest='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllRolesUsuarios()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from roles_usuarios;",
            array()
        );
        return $registros;
    }
    
    public static function getRolUsuarioByRol($id)
    {
        $sqlstr = "SELECT * from roles_usuarios where rolescod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function getRolByUsuario($id)
    {
        $sqlstr = "SELECT * from roles_usuarios where usercod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addRolUsuario($usercod, $rolescod, $roleuserest)
    {
        $roleuserexp = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
        $insSQL = "INSERT INTO `roles_usuarios` (`usercod`, `rolescod`, `roleuserest`, `roleuserfch`, `roleuserexp`) VALUES (:usercod, :rolescod, :roleuserest, NOW(), :roleuserexp);";
        $parameters = array(
            'usercod' => $usercod,
            'rolescod' => $rolescod,
            'roleuserest' => $roleuserest,
            'roleuserexp' =>  $roleuserexp
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateRolUsuario($rolescod, $roleuserest, $usercod)
    {
        $updSQL = "UPDATE `roles_usuarios` set `rolescod`=:rolescod, `roleuserest`=:roleuserest where `usercod`=:usercod;";
        $parameters = array(
            'rolescod' => $rolescod,
            'roleuserest' => $roleuserest,
            'usercod' => $usercod
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

}



?>