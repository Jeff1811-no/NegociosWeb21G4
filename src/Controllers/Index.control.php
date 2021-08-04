<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class Index extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {
        \Utilities\Site::addLink("public/css/heropanel.css");
        /*
        1 Conseguir de la DB los registro de Heroes activos
        2 Injectarlo en un arreglo de vista
        3 Mostrar los heros panels en la vista
        */
        $viewData = array();
        $viewData["page"] = $this->toString();
    
     
        $tmpProductos = \Dao\ProductosPanel::getLastProductos();
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


        \Views\Renderer::render("index", $viewData);
    }
}
?>
