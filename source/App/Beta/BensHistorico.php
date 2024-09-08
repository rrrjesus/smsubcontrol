<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimony\Bem;
use Source\Models\Patrimony\BemHistorico;

/**
 * Class BensHistorico
 * @package Source\App\Beta
 */
class BensHistorico extends Admin
{
    
    /**
     * BensHistorico constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

/**
     * APP HOME
     */
    public function bensLista(): void
    {
        $head = $this->seo->render(
            "Bens Historico - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonio = (new Bem())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/benshistorico/lista", [
            "head" => $head,
            "patrimonio" => $patrimonio,
            "urls" => "",
            "icon" => "" 
        ]);
    }

}