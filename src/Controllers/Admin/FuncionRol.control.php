<?php

namespace Controllers\Admin;

use Utilities\ArrUtils;

class FuncionRol extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo FuncionesRolesPanel',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["rolescod"] = 0;
        $viewData["fncod"] = "";
        $viewData["fnrolest"] = 'ACT';

        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['fnrolest_act'] = true;
        $viewData['fnrolest_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['rolescod'] = $_POST['rolescod'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['funcionesroles_xss_token']) {
                $time = time();
                $token = md5("funcionesroles" . $time);
                $_SESSION['funcionesroles_xss_token'] = $token;
                $_SESSION['funcionesroles_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_funcionesroles',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
               $viewData["fncod"] = $_POST["fncod"];
                $viewData["fnrolest"] = $_POST["fnrolest"];

            }
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao\FuncionesRolesPanel::addFuncionRol(
                    $viewData["fncod"],
                    $viewData["fnrolest"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_funcionesroles',
                        'FuncionesRolesPanel agregado Exitosamente'
                    );
                }
                break;
            case 'UPD':
                $ok = \Dao\FuncionesRolesPanel::updateFuncionRol(
                    $viewData["fncod"],
                    $viewData["fnrolest"],
                    $viewData["rolescod"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_funcionesroles',
                        'FuncionesRolesPanel actualizado Exitosamente'
                    );
                }
                break;
            case 'DEL':
                $ok = \Dao\FuncionesRolesPanel::deleteFuncionRol(
                    $viewData['rolescod']
                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_funcionesroles',
                        'FuncionesRolesPanel eliminado Exitosamente'
                    );
                }
                break;
            }


        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['rolescod'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
        if ($viewData['mode'] == 'INS') {
            $viewData['ModalTitle'] = 'Agregando nuevo FuncionesRolesPanel';
        } else {

            $rolescod = \Dao\FuncionesRolesPanel::getFuncionRolById($viewData['rolescod']);

            error_log(json_encode($rolescod));
            if (!$rolescod) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_funcionesroles',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($rolescod, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['rolescod'],
                $viewData['fncod']
            );
            $viewData['fnrolest_act'] = $viewData['fnrolest'] == 'ACT';
            $viewData['fnrolest_ina'] = $viewData['fnrolest'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
            }

        }

        \Views\Renderer::render('admin/funcionrol', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['funcionesroles_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=admin_funcionesroles',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['funcionesroles_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_funcionesroles',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
