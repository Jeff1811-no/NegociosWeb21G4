<?php 
namespace Dao;

class ProductosPanel extends Table{

    public static function getActiveProductos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from productos where ProdEst='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAllProductos()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from productos;",
            array()
        );
        return $registros;
    }

    public static function getProductoById($id)
    {
        $sqlstr = "SELECT * from productos where ProdId=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function addProducto($ProdNombre, $ProdDescripcion, $ProdPrecioVenta, $ProdPrecioCompra, $ProdStock, $ProdEst)
    {
        $insSQL = "INSERT INTO `productos` (`ProdNombre`, `ProdDescripcion`, `ProdPrecioVenta`, `ProdPrecioCompra`, `ProdStock`, `ProdEst`) VALUES (:ProdNombre, :ProdDescripcion, :ProdPrecioVenta, :ProdPrecioCompra, :ProdStock, :ProdEst);";
        $parameters = array(
            'ProdNombre' => $ProdNombre,
            'ProdDescripcion' => $ProdDescripcion,
            'ProdPrecioVenta' => $ProdPrecioVenta,
            'ProdPrecioCompra' => $ProdPrecioCompra,
            'ProdStock' => $ProdStock,
            'ProdEst' => $ProdEst
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function updateProducto($ProdNombre, $ProdDescripcion, $ProdPrecioVenta, $ProdPrecioCompra, $ProdStock, $ProdEst, $ProdId)
    {
        $updSQL = "UPDATE `productos` set `ProdNombre`=:ProdNombre, `ProdDescripcion`=:ProdDescripcion, `ProdPrecioVenta`=:ProdPrecioVenta, `ProdPrecioCompra`=:ProdPrecioCompra, `ProdStock`=:ProdStock, `ProdEst`=:ProdEst where `ProdId`=:ProdId;";
        $parameters = array(
            'ProdNombre' => $ProdNombre,
            'ProdDescripcion' => $ProdDescripcion,
            'ProdPrecioVenta' => $ProdPrecioVenta,
            'ProdPrecioCompra' => $ProdPrecioCompra,
            'ProdStock' => $ProdStock,
            'ProdEst' => $ProdEst,
            'ProdId' => $ProdId
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function deleteProducto($ProdId)
    {
        $delSQL = "DELETE FROM `productos`  where `ProdId`=:ProdId;";
        $parameters = array(
            'ProdId' => $ProdId
        );

        self::executeNonQuery($delSQL, $parameters);
        $lastId = self::getLastId();
        $actSQL = "ALTER TABLE `productos` AUTO_INCREMENT = $lastId";
        return self::executeNonQuery($actSQL,array());
    }

}



?>