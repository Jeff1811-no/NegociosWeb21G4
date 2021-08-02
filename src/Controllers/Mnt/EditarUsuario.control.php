<?php

namespace Controllers\Mnt;

use Controllers\Sec\Login;
use Dao\Dao;
use Utilities\ArrUtils;

class EditarUsuario extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo EditarUsuarioPanel',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["usercod"] = 0;
        $viewData["useremail"] = "";
        $viewData["username"] = "";
        $viewData["userpswd"] = "";
        $viewData['showCommitBtn'] = true;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['usercod'] = $_POST['usercod'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['editarusuarios_xss_token']) {
                $time = time();
                $token = md5("editarusuarios" . $time);
                $_SESSION['editarusuarios_xss_token'] = $token;
                $_SESSION['editarusuarios_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_editarusuarios',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
                $viewData["useremail"] = $_POST["useremail"];
                $viewData["username"] = $_POST["username"];
                $viewData["userpswd"] = $_POST["userpswd"];

            }

            

            switch($viewData['mode']) {
            case 'UPD':
                if($viewData['userpswd']){
                    $ok = \Dao\Security\Security::updateUserClient(
                        $viewData["useremail"],
                        $viewData["username"],
                        $viewData["userpswd"],
                        $viewData["usercod"]
                    );
                }else{
                    $ok = \Dao\Security\Security::updateNoPass(
                        $viewData["useremail"],
                        $viewData["username"],
                        $viewData["usercod"]
                    );
                }
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=index',
                        'Usuario actualizado Exitosamente'
                    );
                }
                break;
            }

        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['usercod'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
            $usercod = \Dao\Security\Security::getUserById($viewData['usercod']);
            $usercod['userpswd'] = '';
            error_log(json_encode($usercod));
            if (!$usercod) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_editarusuarios',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($usercod, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['usercod'],
                $viewData['useremail']
            );
        \Views\Renderer::render('mnt/editarusuario', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['editarusuarios_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt_editarusuarios',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['editarusuarios_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_editarusuarios',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
