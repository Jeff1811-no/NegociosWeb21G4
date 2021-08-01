<?php 

namespace Controllers\Retails;

class Carrito extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $usuario = \Utilities\Security::getUserId();
        $tmpCarrito = \Dao\CarritoPanel::getCarritoById($usuario);
        
        $viewData["carrito"] = array();
        foreach ($tmpCarrito as $carrito) {
            $viewData["carrito"][] = $carrito;
            
        }
        // var_dump($viewData);
        //     die();
        $time = time();
        $token = md5("carrito". $time);
        $_SESSION["carrito_xss_token"] = $token;
        $_SESSION["carrito_xss_token_tts"] = $time;
        \Views\Renderer::render("retails/carrito", $tmpCarrito);
    }
}

?>