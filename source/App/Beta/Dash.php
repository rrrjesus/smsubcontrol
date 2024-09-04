<?php

namespace Source\App\Beta;

use Source\Models\Auth;
use Source\Models\CafeApp\AppPlan;
use Source\Models\CafeApp\AppSubscription;
use Source\Models\Category;
use Source\Models\Post;
use Source\Models\Report\Online;
use Source\Models\User;

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
        redirect("/beta/dash/home");
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
            "users" => (object)[
                "users" => (new User())->find("level_id < 5")->count(),
                "admins" => (new User())->find("level_id >= 5")->count()
            ],
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        $this->message->success("Você saiu com sucesso {$this->user->first_name}.")->icon()->flash();

        Auth::logout();
        redirect("/beta/login");
    }
}