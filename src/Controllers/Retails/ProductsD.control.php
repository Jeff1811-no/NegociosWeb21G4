<?php

namespace Controllers\Retails;

class ProductsD extends \Controllers\PublicController{

        
  /*  public function run() :void
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
        \Views\Renderer::render("productsDetails", $dataview,$layout);
       
    }*/

    private function run(): void
    {
        $_data = \Dao\CarritoDetailsPanel::getProductsDetails($this->ProdId);
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

 //   public function run():void
   // {
     //   $viewData = array();
      //  $tmpProductsD = \Dao\ProductsDPanel::getProductDetail(1);
      //  $viewData["productDetails"] = array();
      //  $counter = 0;
       // foreach ($tmpProductsD as $Pdetails) {
        //    $counter ++;
       //     $Pdetails["rownum"] = $counter;
       //     $viewData["productDetails"][] = $Pdetails;
      //  }
       // $time = time();
       // $token = md5("productDetails". $time);
      //  $_SESSION["productDetails_xss_token"] = $token;
      //  $_SESSION["productDetails_xss_token_tts"] = $time;
       // \Views\Renderer::render("rts/ProductDetails", $viewData);
    //}

}

?>