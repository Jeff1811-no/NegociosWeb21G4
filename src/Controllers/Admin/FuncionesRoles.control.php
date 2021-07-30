<?php

namespace Controllers\Admin;

class FuncionesRoles extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $tmpFuncionesRoles = \Dao\FuncionesRolesPanel::getAllFuncionesRoles();
        $viewData["funcionesroles"] = array();
        $counter = 0;
        foreach ($tmpFuncionesRoles as $funcionesroles) {
            $counter ++;
            $funcionesroles["rownum"] = $counter;
            $viewData["funcionesroles"][] = $funcionesroles;
        }
        $time = time();
        $token = md5("funcionesroles". $time);
        $_SESSION["funcionesroles_xss_token"] = $token;
        $_SESSION["funcionesroles_xss_token_tts"] = $time;
        \Views\Renderer::render("admin/funcionesroles", $viewData);
    }
}

?>