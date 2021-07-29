<?php

namespace Controllers\Admin;

use Utilities\ArrUtils;

class Rol extends \Controllers\PrivateController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo RolesPanel',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["rolescod"] = "";
        $viewData["rolesdsc"] = "";
        $viewData["rolesest"] = 'ACT';

        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['rolesest_act'] = true;
        $viewData['rolesest_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['rolescod'] = $_POST['rolescod'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['roles_xss_token']) {
                $time = time();
                $token = md5("roles" . $time);
                $_SESSION['roles_xss_token'] = $token;
                $_SESSION['roles_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_roles',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
               $viewData["rolesdsc"] = $_POST["rolesdsc"];
                $viewData["rolesest"] = $_POST["rolesest"];

            }
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao\RolesPanel::addRol(
                    $viewData["rolescod"],
                    $viewData["rolesdsc"],
                    $viewData["rolesest"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_roles',
                        'RolesPanel agregado Exitosamente'
                    );
                }
                break;
            case 'UPD':
                $ok = \Dao\RolesPanel::updateRol(
                    $viewData["rolesdsc"],
                    $viewData["rolesest"],
                    $viewData["rolescod"]

                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_roles',
                        'RolesPanel actualizado Exitosamente'
                    );
                }
                break;
            case 'DEL':
                $ok = \Dao\RolesPanel::deleteRol(
                    $viewData['rolescod']
                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=admin_roles',
                        'RolesPanel eliminado Exitosamente'
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
            $viewData['ModalTitle'] = 'Agregando nuevo RolesPanel';
        } else {

            $rolescod = \Dao\RolesPanel::getRolById($viewData['rolescod']);

            error_log(json_encode($rolescod));
            if (!$rolescod) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_roles',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($rolescod, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['rolescod'],
                $viewData['rolesdsc']
            );
            $viewData['rolesest_act'] = $viewData['rolesest'] == 'ACT';
            $viewData['rolesest_ina'] = $viewData['rolesest'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
            }

        }

        \Views\Renderer::render('admin/rol', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['roles_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=admin_roles',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['roles_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=admin_roles',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
