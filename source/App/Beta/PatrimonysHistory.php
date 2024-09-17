<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimony\Bem;
use Source\Models\Patrimony\PatrimonyHistory;

/**
 * Class PatrimonyHistory
 * @package Source\App\Beta
 */
class PatrimonysHistory extends Admin
{
    
/**
 * PatrimonyHistory constructor.
 */
public function __construct()
{
    parent::__construct();
}

/**
 * @param array|null $data
 * @throws \Exception
 */
public function term(?array $data): void
{
    //update term
    $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
    $termPrint = (new PatrimonyHistory())->findById($data["patrimonys_id"]);

    $head = $this->seo->render(
        CONF_SITE_NAME . " - Termo de - ".(!empty($termPrint->userPatrimony()->rf) ? $termPrint->userPatrimony()->rf : "Responsabilidade")." - "
        .(!empty($termPrint->userPatrimony()->user_name) ? $termPrint->userPatrimony()->user_name : "")." - ".$termPrint->type_part_number.":".$termPrint->part_number ,
        CONF_SITE_DESC,
        url(),
        theme("/assets/images/favicon.ico"),
        false
    );

    echo $this->view->render("widgets/patrimonys/term", [
        "head" => $head,
        "term" => $termPrint,
        "urls" => "patrimonios/historico/termo/{$termPrint->id}",
        "namepage" => "Termo",
        "name" => "Imprimir"
    ]);
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