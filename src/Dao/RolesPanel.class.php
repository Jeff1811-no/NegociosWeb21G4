<?php 
namespace Dao;

class RolesPanel extends Table{

    public static function getActiveRoles()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from roles where rolesest='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllRoles()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from roles;",
            array()
        );
        return $registros;
    }

    public static function getRolById($id)
    {
        $sqlstr = "SELECT * from roles where rolescod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addRol($rolesdsc, $rolesest)
    {
        $insSQL = "INSERT INTO `roles` (`rolesdsc`, `rolesest`) VALUES (:rolesdsc, :rolesest);";
        $parameters = array(
            'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateRol($rolesdsc, $rolesest, $rolescod)
    {
        $updSQL = "UPDATE `roles` set `rolesdsc`=:rolesdsc, `rolesest`=:rolesest where `rolescod`=:rolescod;";
        $parameters = array(
           'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest,
           'rolescod' => $rolescod
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteRol($rolescod)
    {
        $delSQL = "DELETE FROM `roles`  where `rolescod`=:rolescod;";
        $parameters = array(
            'rolescod' => $rolescod
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>