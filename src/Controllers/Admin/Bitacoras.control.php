<?php

namespace Controllers\Admin;

class Bitacoras extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmpBitacoras = \Dao\BitacorasPanel::getAllBitacoras();
        $viewData["Bitacoras"] = array();
        $counter = 0;
        foreach ($tmpBitacoras as $bitacoras) {
            $counter ++;
            $bitacoras["rownum"] = $counter;
            $viewData["bitacoras"][] = $bitacoras;
        }
        \Views\Renderer::render("admin/bitacoras", $viewData);
    }
}

?>