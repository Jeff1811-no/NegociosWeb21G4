<?php 
namespace Dao;

class CarritoPanel extends Table{
    /*
    `usuario` bigint(10) NOT NULL,
    `producto` bigint(18) NOT NULL,
    `cantidad` bigint(10) NOT NULL,
    `precio` decimal(18,4) NOT NULL,
    `fechacompra` datetime NOT NULL,
    
    */


    public static function getCarritoById($id)
    {
        $sqlstr = "SELECT * from carritousuario where usuario=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addCarrito($usuario, $producto, $cantidad, $precio)
    {
        $insSQL = "INSERT INTO `carritousuario` (`usuario`, `producto`, `cantidad`, `precio`, `fechacompra`) VALUES ( :usuario, :producto, :cantidad, :precio, NOW());";
        $parameters = array(
            "usuario" => $usuario,
            "producto" => $producto,
            "cantidad" => $cantidad,
            "precio" => $precio,
        );

        return self::executeNonQuery($insSQL, $parameters);
    }


    public static function deleteCarritoProducto($usuario, $producto)
    {
        $delSQL = "DELETE FROM `carritousuario` WHERE usuario=:usuario AND $producto;";
        $parameters = array(
            "usuario" => $usuario,
            "producto" => $producto

        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>