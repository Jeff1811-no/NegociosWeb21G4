<?php

namespace Controllers\Mnt;

use Utilities\ArrUtils;



class Usuario extends \Controllers\PrivateController
{
    private $notDisplayIns = false;
    private $allInfoDisplayed = true;
    private $mode = '';

    public function run():void
    {
        $viewData = array();
        $tmpRoles = \Dao\RolesPanel::getActiveRoles();
        $ModalTitles = array(
            'INS' => 'Nuevo Usuario',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        $viewData["usercod"] = 0;
        $viewData["useremail"] = "";
        $viewData["username"] = "";
        $viewData["userpswd"] = "";
        $viewData["userest"] = 'ACT';
        $viewData["userinsert"] = true;
        $viewData["userupdate"] = true;
        $viewData["userdsp"] = true;
        $viewData["rolescod"] = "";

        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['userest_act'] = true;
        $viewData['userest_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['rolescod'] = $_POST['rolesCombo'];
            $viewData['usercod'] = $_POST['usercod'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['users_xss_token']) {
                $time = time();
                $token = md5("users" . $time);
                $_SESSION['users_xss_token'] = $token;
                $_SESSION['users_xss_token_tts'] = $time;
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_usuarios',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
                $viewData["useremail"] = $_POST["useremail"];
                $viewData["username"] = $_POST["username"];
                $viewData["userpswd"] = $_POST["userpswd"];
                $viewData["userest"] = $_POST["userest"];
            }            
            
         
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao\Security\Security::newUsuario(
                    $viewData["useremail"],
                    $viewData["username"],
                    $viewData["userpswd"],

                );
                if ($ok) {
                    $u = \Dao\Security\Security::getUsuarioByEmail($viewData["useremail"]);
                    if(\Dao\RolesUsuariosPanel::addRolUsuario($u["usercod"],"PUBLIC","ACT")){
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt_usuarios',
                            'UsersPanel agregado Exitosamente'
                        );
                    }
                }
                break;
            case 'UPD':
                $p = \Dao\Security\Security::getUserById($viewData['usercod']);
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
                    if(\Dao\RolesUsuariosPanel::updateRolUsuario($viewData["rolescod"],"ACT",$viewData["usercod"])){
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt_usuarios',
                            'UsersPanel actualizado Exitosamente'
                        );
                    }
                }
                break;
            case 'DEL':
                $ok = \Dao\Security\Security::deleteUser(
                    $viewData['usercod']
                );
                if ($ok) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_usuarios',
                        'UsersPanel eliminado Exitosamente'
                    );
                }
                break;
            }


        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['usercod'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
        if ($viewData['mode'] == 'INS') {
            $viewData['ModalTitle'] = 'Agregando nuevo UsersPanel';
            $viewData['userinsert'] = false;
            $vieData['hidden'] = 'type="hidden"';
            $viewData["userupdate"] = false;
            
          
        } else {
           
            $usercod = \Dao\Security\Security::getUserById($viewData['usercod']);
            $usercod['userpswd'] = '';
            $r = \Dao\RolesUsuariosPanel::getRolByUsuario($viewData["usercod"]);
            $viewData['rolesCombo'] = $this->arrayToCombo($tmpRoles, 'rolescod','rolesdsc', $r['rolescod']);
            $viewData["userupdate"] = true;

            error_log(json_encode($usercod));
            if (!$usercod) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_usuarios',
                    'No existe el registro'
                );
            }
            \Utilities\ArrUtils::mergeFullArrayTo($usercod, $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['usercod'],
                $viewData['useremail']
            );
            $viewData['userest_act'] = $viewData['userest'] == 'ACT';
            $viewData['userest_ina'] = $viewData['userest'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
                $viewData["userupdate"] = false;
                
            }
            

        }
       
        
       
        \Views\Renderer::render('mnt/usuario', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['users_xss_token'])) {
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt_usuarios',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['users_xss_token_tts'] > 86400) {
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_usuarios',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

    private function arrayToCombo($arreglo, $valueField, $textField, $selectedValue){
        $htmlBuffer = "";
        foreach ($arreglo as $item) {
            $htmlBuffer .= '<option value="'.$item[$valueField].'" '.(($selectedValue == $item[$valueField])? "selected" : "" ).'>'.$item[$textField].'</option>';
        }
        return $htmlBuffer;
    }

}
?>