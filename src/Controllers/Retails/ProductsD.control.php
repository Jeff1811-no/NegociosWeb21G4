<?php

namespace Controllers\Retails;

class ProductsD extends \Controllers\PublicController{

    public function run():void
    {
        $viewData = array();
        $tmpProductsD = \Dao\ProductsDPanel::getProductDetail(1);
        $viewData["productDetails"] = array();
        $counter = 0;
        foreach ($tmpProductsD as $Pdetails) {
            $counter ++;
            $Pdetails["rownum"] = $counter;
            $viewData["productDetails"][] = $Pdetails;
        }
        $time = time();
        $token = md5("productDetails". $time);
        $_SESSION["productDetails_xss_token"] = $token;
        $_SESSION["productDetails_xss_token_tts"] = $time;
        \Views\Renderer::render("rts/ProductDetails", $viewData);
    }

}

?>