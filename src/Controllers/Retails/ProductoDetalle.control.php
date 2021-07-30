<?php

namespace Controllers\Retails;

class ProductoDetalle extends \Controllers\PublicController {

    public function run():void
    {
        
        $tmpProducto = \Dao\ProductosPanel::getProductoById(1);
        
        \Views\Renderer::render("retails/productodetalle", $tmpProducto);
    }
}

?>