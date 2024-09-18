<?php

namespace Source\App\Beta;

use Source\Models\Auth;
use Source\Models\User;
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