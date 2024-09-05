<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\Patrimonio\BemMarca;
use Source\Models\Patrimonio\BemModelo;
use Source\Models\Report\Online;
use Source\Models\User;

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
                        "user" => ($item->user ? $item->user()->fullName() : "Guest User"),
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
                "totais" => (new User())->find()->count()
            ],
            "marcas" => (object)[
                "marcas" => (new BemMarca())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new BemMarca())->find("status = :s", "s=disabled")->count(),
                "totais" => (new BemMarca())->find()->count()
            ],
            "modelos" => (object)[
                "modelos" => (new BemModelo())->find("status != :s", "s=disabled")->count(),
                "disableds" => (new BemModelo())->find("status = :s", "s=disabled")->count(),
                "totais" => (new BemModelo())->find()->count()
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
        $this->message->success("Você saiu com sucesso {$this->user->first_name}.")->flash();

        Auth::logout();
        redirect("/painel/login");
    }
}