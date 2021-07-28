<?php
namespace Dao;

class ProductsDPanel extends Table{

    public static function getProductDetail($id)
    {
        $sqlstr = "SELECT * from productos where ProdId=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }



}


?>