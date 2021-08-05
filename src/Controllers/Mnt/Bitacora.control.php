<?php

namespace Controllers\Mnt;

use Utilities\ArrUtils;

class Bitacora extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo BitacorasPanel',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["idbitacora"] = 0;
$viewData["accion"] = "";
$viewData["fecha_accion"] = "";
$viewData["descripcion"] = 'ACT';

        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['descripcion_act'] = true;
        $viewData['descripcion_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['idbitacora'] = $_POST['idbitacora'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['bitacoras_xss_token']) {
                $time = time();
              $token = md5(bitacoras . $time);
                $_SESSION['bitacoras_xss_token'] = $token;
                $_SESSION['bitacoras_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_bitacoras',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
               $viewData["accion"] = $_POST["accion"];
$viewData["fecha_accion"] = $_POST["fecha_accion"];
$viewData["descripcion"] = $_POST["descripcion"];

            }
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao\BitacorasPanel::addBitacora(
                    $viewData["accion"],
$viewData["fecha_accion"],
$viewData["descripcion"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_bitacoras',
                        'BitacorasPanel agregado Exitosamente'
                    );
                }
                break;
            case 'UPD':
                $ok = \Dao\BitacorasPanel::updateBitacora(
                    $viewData["accion"],
$viewData["fecha_accion"],
$viewData["descripcion"]
,
                    $viewData["idbitacora"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_bitacoras',
                        'BitacorasPanel actualizado Exitosamente'
                    );
                }
                break;
            case 'DEL':
                $ok = \Dao\BitacorasPanel::deleteBitacora(
                    $viewData['idbitacora']
                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_bitacoras',
                        'BitacorasPanel eliminado Exitosamente'
                    );
                }
                break;
            }


        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['idbitacora'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
        if ($viewData['mode'] == 'INS') {
            $viewData['ModalTitle'] = 'Agregando nuevo BitacorasPanel';
        } else {

            $idbitacora = \Dao\BitacorasPanel::getBitacoraById($viewData['idbitacora']);

            error_log(json_encode($idbitacora));
            if (!$idbitacora) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_bitacoras',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($idbitacora, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['idbitacora'],
                $viewData['accion']
            );
            $viewData['descripcion_act'] = $viewData['descripcion'] == 'ACT';
            $viewData['descripcion_ina'] = $viewData['descripcion'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
            }

        }

        \Views\Renderer::render('mnt/bitacora', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['bitacoras_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt_bitacoras',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['bitacoras_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_bitacoras',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
