<?php

namespace Controllers\Admin;

class Roles extends \Controllers\PrivateController {

    public function run():void
    {
        $viewData = array();
        $tmpRoles = \Dao\RolesPanel::getAllRoles();
        $viewData["roles"] = array();
        $counter = 0;
        foreach ($tmpRoles as $roles) {
            $counter ++;
            $roles["rownum"] = $counter;
            $viewData["roles"][] = $roles;
        }
        $time = time();
        $token = md5("roles". $time);
        $_SESSION["roles_xss_token"] = $token;
        $_SESSION["roles_xss_token_tts"] = $time;
        \Views\Renderer::render("admin/roles", $viewData);
    }
}

?>