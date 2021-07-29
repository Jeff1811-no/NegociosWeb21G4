<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Usuarios extends PrivateController{
    public function run():void
    {
        $usuarios = array();
        $viewData = array();
        $usuarios = \Dao\Security\Security::getUsuarios();
        $viewData["Usuarios"] = array();
        foreach($usuarios as $usuario){
            $roles= \Dao\Security\Security::getRolesByUsuario($usuario["usercod"]);
            $usuario["roles"] = "";
            foreach($roles as $rol){
                $usuario["roles"] .= $rol["rolescod"]." " ;
            }
            
            $viewData["Usuarios"][] = $usuario;
        }
        
        $viewData["CanInsert"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\New");
        $viewData["CanUpdate"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Upd");
        $viewData["CanDelete"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Del");
        $viewData["CanView"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Dsp");
        $viewData["Admin"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Adm");

        \Views\Renderer::render("mnt/usuarios", $viewData);
    }


}

/*
{
    Usuarios: [],
    CanInsert: true,
    CanUpdate: true,
    CanDelete: true,
    CanView: true
}

withContext =
root =
{
    Usuarios: [],
    CanInsert: true,
    CanUpdate: true,
    CanDelete: true,
    CanView: true
}

foreach Usuarios
    withContext = Usuarios
    
    root =
        {
            Usuarios: [],
            CanInsert: true,
            CanUpdate: true,
            CanDelete: true,
            CanView: true
        }
endfor Usuarios
*/

?>
