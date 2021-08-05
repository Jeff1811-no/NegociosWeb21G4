<?php

namespace Controllers\Mnt;

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
        $time = time();
        $token = md5(bitacoras. $time);
        $_SESSION["bitacoras_xss_token"] = $token;
        $_SESSION["bitacoras_xss_token_tts"] = $time;
        \Views\Renderer::render("mnt/bitacoras", $viewData);
    }
}

?>