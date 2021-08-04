<?php

namespace Controllers\Retails;

class Catalogo extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmpProductos = \Dao\ProductosPanel::getAllProductos();
        $viewData["Productos"] = array();
        
        foreach ($tmpProductos as $productos) {
    
            $productos["ProdIMG"]="";   
           
                
                $file = file_exists("uploads/productos/".$productos['ProdId'].".jpeg") ? $productos['ProdId'].".jpeg" :
                (file_exists("uploads/productos/".$productos['ProdId'].".jpg") ? $productos['ProdId'].".jpg" : 
                (file_exists("uploads/productos/".$productos['ProdId'].".png") ? $productos['ProdId'].".png" : 
                (file_exists("uploads/productos/".$productos['ProdId'].".gif") ? $productos['ProdId'].".gif" : "default.jpg")));
                $productos["ProdIMG"]="NegociosWeb21G4/uploads/productos/$file";

                
            
            $viewData["productos"][] = $productos;
          
        }
        \Views\Renderer::render("retails/catalogo", $viewData);
    }
}

?>