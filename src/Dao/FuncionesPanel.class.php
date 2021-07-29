<?php 
namespace Dao;

class FuncionesPanel extends Table{

    public static function getActiveFunciones()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from funciones where fnest='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllFunciones()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from funciones;",
            array()
        );
        return $registros;
    }

    public static function getFuncionById($id)
    {
        $sqlstr = "SELECT * from funciones where fncod=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addFuncion($fndsc, $fnest, $fntyp)
    {
        $insSQL = "INSERT INTO `funciones` (`fndsc`, `fnest`, `fntyp`) VALUES (:fndsc, :fnest, :fntyp);";
        $parameters = array(
            'fndsc' => $fndsc,
            'fnest' => $fnest,
            'fntyp' => $fntyp
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateFuncion($fndsc, $fnest, $fntyp, $fncod)
    {
        $updSQL = "UPDATE `funciones` set `fndsc`=:fndsc, `fnest`=:fnest, `fntyp`=:fntyp where `fncod`=:fncod;";
        $parameters = array(
            'fndsc' => $fndsc,
            'fnest' => $fnest,
            'fntyp' => $fntyp,
            'fncod' => $fncod
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteFuncion($fncod)
    {
        $delSQL = "DELETE FROM `funciones`  where `fncod`=:fncod;";
        $parameters = array(
            'fncod' => $fncod
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>