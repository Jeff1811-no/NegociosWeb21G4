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
            if(\Utilities\Security::isLogged()){
                if($_POST['ProdStock'] != 0){
                    $tmp = \Dao\CarritoPanel::getCarrito($usuario,$_POST["ProdId"]);
                    if($tmp){
                        $unidades = $tmp[0]["cantidad"] + $_POST["ProdStock"];
                        if(\Dao\CarritoPanel::updateCarritoProducto($usuario,$_POST["ProdId"],$unidades)){
                            $p = \Dao\ProductosPanel::getProductoById($_POST["ProdId"]);
                            $s = $p["ProdStock"] - $_POST["ProdStock"];
                           if( \Dao\ProductosPanel::updateProductoStock($s, $_POST["ProdId"])){
                                \Utilities\Site::redirectToWithMsg(
                                    'index.php?page=Retails_productodetalle&id='.$_POST["ProdId"],
                                    'Se actualizo el carrito'
                                );
                            }
                        }
                    }else{
                        if(\Dao\CarritoPanel::addCarrito($usuario, $_POST["ProdId"] ,$_POST["ProdStock"], $_POST["ProdPrecioVenta"]))
                        {
                            $p = \Dao\ProductosPanel::getProductoById($_POST["ProdId"]);
                            $s = $p["ProdStock"] - $_POST["ProdStock"];
                            \Dao\ProductosPanel::updateProductoStock($s, $_POST["ProdId"]);
                            \Utilities\Site::redirectToWithMsg(
                                'index.php?page=Retails_productodetalle&id='.$_POST["ProdId"],
                                'Agregado al carrito'
                            );
                        }
                    }

                }else{
                    \Utilities\Site::redirectToWithMsg(
                        'index.php',
                        'Ya no hay existencia de este producto'
                    );
                }
            }else{
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=sec_login',
                    'Inicia Sesion para poder agregar datos al carrito'
                );
            }
        }
        
        
        
        \Views\Renderer::render("retails/productodetalle", $tmpProducto);
    }
}

?>