<?php 

namespace Controllers\Retails;

class Carrito extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $usuario = \Utilities\Security::getUserId();
        $tmpCarrito = \Dao\CarritoPanel::getCarritoById($usuario);
        if (isset($_POST["cantidad"]) && isset($_POST["producto"])){
            \Dao\CarritoPanel::updateCarritoProducto($usuario, $_POST["producto"], $_POST["cantidad"] );
        }
        $viewData["carrito"] = array();
        foreach ($tmpCarrito as $carrito) {

            $carrito["img"]="";   
            $file = file_exists("uploads/productos/".$carrito['producto'].".jpeg") ? $carrito['producto'].".jpeg" :
            (file_exists("uploads/productos/".$carrito['producto'].".jpg") ? $carrito['producto'].".jpg" : 
            (file_exists("uploads/productos/".$carrito['producto'].".png") ? $carrito['producto'].".png" : 
            (file_exists("uploads/productos/".$carrito['producto'].".gif") ? $carrito['producto'].".gif" : "default.jpg")));
            $carrito["img"]="NegociosWeb21G4/uploads/productos/$file";

            $tmpProducto = \Dao\ProductosPanel::getProductoById($carrito['producto']);
            $carrito['dsc'] = $tmpProducto['ProdDescripcion'];

            $viewData["carrito"][] = $carrito;
            
        }

        if(isset($_POST["btnEliminar"])){
            $producto = $_POST["producto"];
            \Dao\CarritoPanel::deleteCarritoProducto($usuario, $producto);
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=retails_carrito",
                "Se elimino del carrito");
        }
        
    
        \Views\Renderer::render("retails/carrito", $viewData);
    }
}

?>