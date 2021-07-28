<?php

namespace Controllers\Mnt;

use Utilities\ArrUtils;

class Producto extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo ProductosPanel',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["ProdId"] = 0;
        $viewData["ProdNombre"] = "";
        $viewData["ProdDescripcion"] = "";
        $viewData["ProdPrecioVenta"] = "";
        $viewData["ProdPrecioCompra"] = "";
        $viewData["ProdStock"] = "";
        $viewData["ProdEst"] = 'ACT';

        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['ProdEst_act'] = true;
        $viewData['ProdEst_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['ProdId'] = $_POST['ProdId'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['productos_xss_token']) {
                $time = time();
              $token = md5(productos . $time);
                $_SESSION['productos_xss_token'] = $token;
                $_SESSION['productos_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_productos',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
               $viewData["ProdNombre"] = $_POST["ProdNombre"];
                $viewData["ProdDescripcion"] = $_POST["ProdDescripcion"];
                $viewData["ProdPrecioVenta"] = $_POST["ProdPrecioVenta"];
                $viewData["ProdPrecioCompra"] = $_POST["ProdPrecioCompra"];
                $viewData["ProdStock"] = $_POST["ProdStock"];
                $viewData["ProdEst"] = $_POST["ProdEst"];

            }
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao\ProductosPanel::addProducto(
                    $viewData["ProdNombre"],
                    $viewData["ProdDescripcion"],
                    $viewData["ProdPrecioVenta"],
                    $viewData["ProdPrecioCompra"],
                    $viewData["ProdStock"],
                    $viewData["ProdEst"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_productos',
                        'ProductosPanel agregado Exitosamente'
                    );
                }
                break;
            case 'UPD':
                $ok = \Dao\ProductosPanel::updateProducto(
                    $viewData["ProdNombre"],
                    $viewData["ProdDescripcion"],
                    $viewData["ProdPrecioVenta"],
                    $viewData["ProdPrecioCompra"],
                    $viewData["ProdStock"],
                    $viewData["ProdEst"],
                    $viewData["ProdId"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_productos',
                        'ProductosPanel actualizado Exitosamente'
                    );
                }
                break;
            case 'DEL':
                $ok = \Dao\ProductosPanel::deleteProducto(
                    $viewData['ProdId']
                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_productos',
                        'ProductosPanel eliminado Exitosamente'
                    );
                }
                break;
            }


        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['ProdId'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
        if ($viewData['mode'] == 'INS') {
            $viewData['ModalTitle'] = 'Agregando nuevo ProductosPanel';
        } else {

            $ProdId = \Dao\ProductosPanel::getProductoById($viewData['ProdId']);

            error_log(json_encode($ProdId));
            if (!$ProdId) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_productos',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($ProdId, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['ProdId'],
                $viewData['ProdNombre']
            );
            $viewData['ProdEst_act'] = $viewData['ProdEst'] == 'ACT';
            $viewData['ProdEst_ina'] = $viewData['ProdEst'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
            }

        }

        \Views\Renderer::render('mnt/producto', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['productos_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt_productos',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['productos_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_productos',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
