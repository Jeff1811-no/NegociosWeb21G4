<?php 

namespace Controllers\Retails;

class Carrito extends \Controllers\PrivateController {

    private $ProdId = 0;
    private $ProdNombre = "";
    private $ProdDescripcion = "";
    private $ProdPrecioVenta = "";
    private $ProdCantidad = 1;
    private $ProdStock = "";
    private $PrimaryMediaDoc = "";
    private $PrimaryMediaPath = "";
    private $AllProductMedia = array(); 
    private $Error = "";

    private $mode_dsc = "";

    
    public function run() :void
    {
        $this->ProdId = isset($_GET["ProdId"])?$_GET["ProdId"]:0;
       
        if($this->isPostBack()) 
        {
           $this->_loadPostData();
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        $this->_load();
        $dataview = get_object_vars($this);

       
    }

    private function _load()
    {
        $_data = \Dao\Retails\CarritoDetailsPanel::getProductsDetails($this->ProdId);
       // $_productMedia = \Dao\Client\Productos::getAllProductMedia($this->ProdId);

        if ($_data) 
        {
            $this->ProdId = $_data["ProdId"];
            $this->ProdNombre = $_data["ProdNombre"];
            $this->ProdDescripcion = $_data["ProdDescripcion"];
            $precioFinal = ($_data["ProdPrecioVenta"]) + ($_data["ProdPrecioVenta"] * 0.15); 
            $this->ProdPrecioVenta = number_format($precioFinal, 2);
            $this->ProdStock = $_data["ProdStock"];
           
        }
        $dataView= $_data;
        \Views\Renderer::render("productsDetails", $dataview);
     //  if($_productMedia)
     //   {
    //        $this->AllProductMedia = $_productMedia;
    //    }
    }
 
}

?>
