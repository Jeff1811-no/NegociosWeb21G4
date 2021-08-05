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
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from carritousuario WHERE usuario=:id;",
            array("id" => $id)
        );
        return $registros;

    }

    public static function getCarrito($id, $pro)
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from carritousuario WHERE usuario=:id AND producto=:pro",
            array("id" => $id, "pro" => $pro)
        );
        return $registros;

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

    public static function updateCarritoProducto($usuario, $producto, $cantidad,)
    {
        $updSQL = "UPDATE `carritousuario` set `cantidad`=:cantidad where `usuario`=:usuario and `producto`=:producto;";
        $parameters = array(
            'cantidad' => $cantidad,
            'usuario' => $usuario,
            'producto' => $producto
        );

        return self::executeNonQuery($updSQL, $parameters);
    }


    public static function deleteCarritoProducto($usuario, $producto)
    {
        $delSQL = "DELETE FROM `carritousuario` WHERE usuario=:usuario AND producto=:producto;";
        $parameters = array(
            "usuario" => $usuario,
            "producto" => $producto

        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>