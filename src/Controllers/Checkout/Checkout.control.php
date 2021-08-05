<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $viewData = array();
        $usuario = \Utilities\Security::getUserId();
        $tmpCarrito = \Dao\CarritoPanel::getCarritoById($usuario);
        if ($this->isPostBack()) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/NegociosWeb21G4/index.php?page=checkout_error",
                "http://localhost/NegociosWeb21G4/index.php?page=checkout_accept"
            );

            foreach ($tmpCarrito as $carrito) {
                
                $tmpProducto = \Dao\ProductosPanel::getProductoById($carrito['producto']);
                $carrito['Nombre'] = $tmpProducto['ProdNombre'];
                $carrito['Dsc'] = $tmpProducto['ProdDescripcion'];


                $PayPalOrder->addItem($carrito['Nombre'], $carrito['Dsc'], "PRD1", $carrito['precio'], 15, $carrito['cantidad'], "DIGITAL_GOODS");
            }
            
            // $PayPalOrder->addItem("Test 2", "TestItem2", "PRD2", 50, 7.5, 2, "DIGITAL_GOODS");


            $response = $PayPalOrder->createOrder();


            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
