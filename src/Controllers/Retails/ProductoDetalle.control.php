<?php

namespace Controllers\Retails;

class Productos extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmpProductos = \Dao\ProductosPanel::getProductoById();
        $viewData["Producto"] = array();
        \Views\Renderer::render("retails/productosdetalle", $viewData);
    }
}

?>