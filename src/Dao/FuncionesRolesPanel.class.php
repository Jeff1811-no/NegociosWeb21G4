<?php 
namespace Dao;

class FuncionesRolesPanel extends Table{

    public static function getActiveFuncionesRoles()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from funciones_roles where fnrolest='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllFuncionesRoles()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from funciones_roles;",
            array()
        );
        return $registros;
    }

    public static function getFuncionRolById($id)
    {
        $sqlstr = "SELECT * from funciones_roles where rolescod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addFuncionRol($fncod, $fnrolest)
    {
        $insSQL = "INSERT INTO `funciones_roles` (`fncod`, `fnrolest`, `fnexp`) VALUES (:fncod, :fnrolest, '2030-01-01');";
        $parameters = array(
            'fncod' => $fncod,
            'fnrolest' => $fnrolest
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateFuncionRol($fncod, $fnrolest, $rolescod)
    {
        $updSQL = "UPDATE `funciones_roles` set `fncod`=:fncod, `fnrolest`=:fnrolest where `rolescod`=:rolescod;";
        $parameters = array(
            'fncod' => $fncod,
            'fnrolest' => $fnrolest,
            'rolescod' => $rolescod
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteFuncionRol($rolescod)
    {
        $delSQL = "DELETE FROM `funciones_roles`  where `rolescod`=:rolescod;";
        $parameters = array(
            'rolescod' => $rolescod
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>