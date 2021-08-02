<?php

namespace Controllers\Mnt;

use Utilities\ArrUtils;

class EditarUsuario extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'UPD' => 'Actualizando %s - %s',
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
        }
            $usercod = \Dao\Security\Security::getUserById($viewData['usercod']);
            $usercod['userpswd'] = '';
            error_log(json_encode($usercod));
            if (!$usercod) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=index',
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

}
?>
