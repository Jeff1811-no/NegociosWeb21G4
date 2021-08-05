<?php 
namespace Dao;

class BitacorasPanel extends Table{

    public static function getActiveBitacoras()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from bitacora where descripcion='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllBitacoras()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from bitacora;",
            array()
        );
        return $registros;
    }

    public static function getBitacoraById($id)
    {
        $sqlstr = "SELECT * from bitacora where idbitacora=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addBitacora($accion, $fecha_accion, $descripcion)
    {
        $insSQL = "INSERT INTO `bitacora` (`accion`, `fecha_accion`, `descripcion`) VALUES (:accion, :fecha_accion, :descripcion);";
        $parameters = array(
            'accion' => $accion,
'fecha_accion' => $fecha_accion,
'descripcion' => $descripcion
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateBitacora($accion, $fecha_accion, $descripcion, $idbitacora)
    {
        $updSQL = "UPDATE `bitacora` set `accion`=:accion, `fecha_accion`=:fecha_accion, `descripcion`=:descripcion where `idbitacora`=:idbitacora;";
        $parameters = array(
           'accion' => $accion,
'fecha_accion' => $fecha_accion,
'descripcion' => $descripcion,
           'idbitacora' => $idbitacora
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteBitacora($idbitacora)
    {
        $delSQL = "DELETE FROM `bitacora`  where `idbitacora`=:idbitacora;";
        $parameters = array(
            'idbitacora' => $idbitacora
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>