<?php 

namespace Controllers\Retails;

class Carrito extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $viewData["updown"]=0;
        $usuario = \Utilities\Security::getUserId();
        $s=0;
        $tmpCarrito = \Dao\CarritoPanel::getCarritoById($usuario);
        
        $viewData["carrito"] = array();
        foreach ($tmpCarrito as $carrito) {

            $carrito["img"]="";   
            $file = file_exists("uploads/productos/".$carrito['producto'].".jpeg") ? $carrito['producto'].".jpeg" :
            (file_exists("uploads/productos/".$carrito['producto'].".jpg") ? $carrito['producto'].".jpg" : 
            (file_exists("uploads/productos/".$carrito['producto'].".png") ? $carrito['producto'].".png" : 
            (file_exists("uploads/productos/".$carrito['producto'].".gif") ? $carrito['producto'].".gif" : "default.jpg")));
            $carrito["img"]="NegociosWeb21G4/uploads/productos/$file";

            $tmpProducto = \Dao\ProductosPanel::getProductoById($carrito['producto']);
            $carrito['dsc'] = $tmpProducto['ProdNombre'];
            $carrito['existencia'] = $tmpProducto['ProdStock'];

            $viewData["carrito"][] = $carrito;
            
        }

        if(isset($_POST["btnEliminar"])){
            $producto = $_POST["producto"];
            if(\Dao\CarritoPanel::deleteCarritoProducto($usuario, $producto)){
                $p = \Dao\ProductosPanel::getProductoById($_POST["producto"]);
                $s = $p["ProdStock"] + $_POST["can"];
                \Dao\ProductosPanel::updateProductoStock($s, $producto);
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=retails_carrito",
                    "Se elimino del carrito");
            }
            
        }

        if (isset($_POST["cantidad"]) && isset($_POST["producto"])){
            if($_POST["updown"] == 0){
                if(\Dao\CarritoPanel::updateCarritoProducto($usuario,$_POST["producto"],$_POST["cantidad"])){
                    $p = \Dao\ProductosPanel::getProductoById($_POST["producto"]);
                    $s = $p["ProdStock"] - 1;
                    \Dao\ProductosPanel::updateProductoStock($s, $_POST["producto"]);
                }
            }else{
                if(\Dao\CarritoPanel::updateCarritoProducto($usuario,$_POST["producto"],$_POST["cantidad"])){
                    $p = \Dao\ProductosPanel::getProductoById($_POST["producto"]);
                    $s = $p["ProdStock"] + 1;
                    \Dao\ProductosPanel::updateProductoStock($s, $_POST["producto"]);
                }
            }
        }
        
    
        \Views\Renderer::render("retails/carrito", $viewData);
    }
}

?>