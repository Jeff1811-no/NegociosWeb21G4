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

        $viewData["CanInsert"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\New");
        $viewData["CanUpdate"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Upd");
        $viewData["CanDelete"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Del");
        $viewData["CanView"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Dsp");
        $viewData["Admin"] = self::isFeatureAutorized("Controllers\Mnt\Usuario\Adm");

        foreach($usuarios as $usuario){
            $roles= \Dao\Security\Security::getRolesByUsuario($usuario["usercod"]);
            $usuario["roles"] = "";
            foreach($roles as $rol){
                $usuario["roles"] .= $rol["rolescod"]." " ;
            }
            $usuario["CanView"] = false;
            if($viewData["Admin"] && true){
                $usuario["CanView"] = true; 
            }
            if($usuario["usercod"] == \Utilities\Security::getUserId()){
                $usuario["CanView"] = true;
            }
            $viewData["Usuarios"][] = $usuario;
        }
        
        
        // href="index.php?page=mnt_usuario&mode=DSO&id={{usercod}}" agregar esto en private layout

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
