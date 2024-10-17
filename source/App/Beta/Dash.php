<?php

namespace Source\App\Beta;

use Source\Models\Auth;
use Source\Models\Company\User;
use Source\Models\Contact;
use Source\Models\Patrimony\Brand;
use Source\Models\Patrimony\Model;
use Source\Models\Patrimony\Patrimony;
use Source\Models\Patrimony\Product;

/**
 * Class Dash
 * @package Source\App\Beta
 */
class Dash extends Admin
{
    /**
     * Dash constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function dash(): void
    {
        redirect("/beta/home");
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function home(?array $data): void
    {

        //CHART PRINTERS

        $printers = (new Patrimony())
        ->find("movement_id = :movement AND status = :status AND product_id = :product", "movement=2&status=actived&product=4")
        ->count();

        $printerstotais = (new Patrimony())
        ->find("status = :status AND product_id = :product", "status=actived&product=4")
        ->count();

        $chartprinters = $printers / $printerstotais * 100;
        $chartprinterstotais = 100 - $chartprinters;
        $estoqueprinters = $printerstotais - $printers;

        //END CHART PRINTERS

        //CHART TABLETS

        $tablets = (new Patrimony())
        ->find("movement_id = :movement AND status = :status AND product_id = :product", "movement=2&status=actived&product=5")
        ->count();

        $tabletstotais = (new Patrimony())
        ->find("status = :status AND product_id = :product", "status=actived&product=5")
        ->count();

        $charttablets = $tablets / $tabletstotais * 100;
        $charttabletstotais = 100 - $charttablets;
        $estoquetablets = $tabletstotais - $tablets;

        //END CHART TABLETS

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Aplicativo",
            CONF_SITE_DESC,
            url("/beta"),
            theme("/assets/images/image.jpg", CONF_VIEW_APP),
            false
        );
        

        echo $this->view->render("widgets/dash/home", [
            "app" => "dash",
            "head" => $head,
            "chartprinters" => $chartprinters,
            "chartprinterstotais" => $chartprinterstotais,
            "estoqueprinters" => $estoqueprinters,
            "printers" => $printers,
            "charttablets" => $charttablets,
            "charttabletstotais" => $charttabletstotais,
            "estoquetablets" => $estoquetablets,
            "tablets" => $tablets,
            "contacts" => (object)[
                "contacts" => (new Contact())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new Contact())->find("status = :s", "s=disabled")->count(),
                "totals" => (new Contact())->find()->count()
            ],
            "patrimonys" => (object)[
                "patrimonys" => (new Patrimony())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new Patrimony())->find("status = :s", "s=disabled")->count(),
                "totals" => (new Patrimony())->find()->count()
            ],
            "brands" => (object)[
                "brands" => (new Brand())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new Brand())->find("status = :s", "s=disabled")->count(),
                "totals" => (new Brand())->find()->count()
            ],
            "products" => (object)[
                "products" => (new Product())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new Product())->find("status = :s", "s=disabled")->count(),
                "totals" => (new Product())->find()->count()
            ]
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        $this->message->success("Você saiu com sucesso {$this->user->user_name}.")->icon()->flash();

        Auth::logout();
        redirect("/entrar");
    }
}