<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\Patrimony\Brand;
use Source\Models\Patrimony\Patrimony;
use Source\Models\Patrimony\Product;
use Source\Models\Report\Online;
use Source\Models\Company\User;

/**
 * Class Dash
 * @package Source\App\Admin
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
        redirect("/painel/controle/inicial");
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function home(?array $data): void
    {
        //real time access
        if (!empty($data["refresh"])) {
            $list = null;
            $items = (new Online())->findByActive();
            if ($items) {
                foreach ($items as $item) {
                    $list[] = [
                        "dates" => date_fmt($item->created_at, "H\hi") . " - " . date_fmt($item->updated_at, "H\hi"),
                        "user" => ($item->user ? $item->user()->user_name : "Guest User"),
                        "pages" => $item->pages,
                        "url" => $item->url
                    ];
                }
            }

            echo json_encode([
                "count" => (new Online())->findByActive(true),
                "list" => $list
            ]);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Dashboard",
            CONF_SITE_DESC,
            url("/painel"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/dash/home", [
            "app" => "dash",
            "head" => $head,
            "users" => (object)[
                "users" => (new User())->find("level_id < 4")->count(),
                "admins" => (new User())->find("level_id >= 4")->count(),
                "totals" => (new User())->find()->count()
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
            ],
            "online" => (new Online())->findByActive(),
            "onlineCount" => (new Online())->findByActive(true)
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        $this->message->success("Você saiu com sucesso {$this->user->user_name}.")->flash();

        Auth::logout();
        redirect("/painel/login");
    }
}