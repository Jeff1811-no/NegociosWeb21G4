<?php

namespace Controllers\Retails;

class ProductoDetalle extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $viewData["Productos"] = array();
        $viewData['ProdId'] = isset($_GET['id'])? $_GET['id'] : 0;
        if($viewData['ProdId']){
            $tmpProducto = \Dao\ProductosPanel::getProductoById($viewData['ProdId']);
            if(!$tmpProducto){
                \Utilities\Site::redirectToWithMsg(
                    'index.php',
                    'No existe el registro'
                );
            }
        }else{
            \Utilities\Site::redirectToWithMsg(
                'index.php',
                'Ingrese el registro'
            );
        }
        
        \Views\Renderer::render("retails/productodetalle", $tmpProducto);
    }
}

?>