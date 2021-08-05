<?php

namespace Controllers\Retails;

class ProductoDetalle extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $usuario = \Utilities\Security::getUserId();
        $viewData["Productos"] = array();
        $viewData['ProdId'] = isset($_GET['id'])? $_GET['id'] : $_POST['ProdId'];
        $tmpProducto = \Dao\ProductosPanel::getProductoById($viewData['ProdId']);
        $tmpProducto["img"]="";   
        $file = file_exists("uploads/productos/".$tmpProducto['ProdId'].".jpeg") ? $tmpProducto['ProdId'].".jpeg" :
        (file_exists("uploads/productos/".$tmpProducto['ProdId'].".jpg") ? $tmpProducto['ProdId'].".jpg" : 
        (file_exists("uploads/productos/".$tmpProducto['ProdId'].".png") ? $tmpProducto['ProdId'].".png" : 
        (file_exists("uploads/productos/".$tmpProducto['ProdId'].".gif") ? $tmpProducto['ProdId'].".gif" : "default.jpg")));
        $tmpProducto["img"]="NegociosWeb21G4/uploads/productos/$file";
        if(!$tmpProducto){
            \Utilities\Site::redirectToWithMsg(
                'index.php',
                'No existe el registro'
            );
        }
        if(isset($_POST["btnAgregarCarrito"])){
            $tmp = \Dao\CarritoPanel::getCarrito($usuario,$_POST["ProdId"]);
            if($tmp){
                $unidades = $tmp[0]["cantidad"] + $_POST["ProdStock"];
                if(\Dao\CarritoPanel::updateCarritoProducto($usuario,$_POST["ProdId"],$unidades)){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=Retails_productodetalle&id='.$_POST["ProdId"],
                        'Se actualizo el carrito'
                    );
                }
            }else{
                if(\Dao\CarritoPanel::addCarrito($usuario, $_POST["ProdId"] ,$_POST["ProdStock"], $_POST["ProdPrecioVenta"]))
                {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=Retails_productodetalle&id='.$_POST["ProdId"],
                        'Agregado al carrito'
                    );
                }
            }
        }
        
        \Views\Renderer::render("retails/productodetalle", $tmpProducto);
    }
}

?>