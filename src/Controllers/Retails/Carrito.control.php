<?php 

namespace Controllers\Retails;

class Carrito extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $usuario = \Utilities\Security::getUserId();
        $tmpCarrito = \Dao\CarritoPanel::getCarritoById($usuario);
        $viewData["carrito"] = array();
        $counter = 0;

        foreach ($tmpCarrito as $carrito) {
            $counter ++;
            $carrito["rownum"] = $counter;
            $viewData["carrito"][] = $carrito;
        }
        $time = time();
        $token = md5("carrito". $time);
        $_SESSION["carrito_xss_token"] = $token;
        $_SESSION["carrito_xss_token_tts"] = $time;
        \Views\Renderer::render("retails/carrito", $viewData);
    }
}

?>
