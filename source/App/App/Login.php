<?php

namespace Source\App\App;

use Source\Core\Controller;
use Source\Models\Auth;

/**
 * Class Login
 * @package Source\App\App
 */
class Login extends Controller
{
    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/");
    }

    /**
     * App access redirect
     */
    public function root(): void
    {
        $user = Auth::user();

        if ($user && $user->level >= 3) {
            redirect("/app/dash");
        } else {
            redirect("/app/login");
        }
    }

    /**
     * @param array|null $data
     */
    public function login(?array $data): void
    {
        $user = Auth::user();

        if ($user && $user->level >= 3) {
            redirect("/app/dash");
        }

        if (!empty($data["email"]) && !empty($data["password"])) {
            if (request_limit("loginLogin", 3, 5 * 60)) {
                $json["message"] = $this->message->error("ACESSO NEGADO: Aguarde por 5 minutos para tentar novamente.")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            $login = $auth->login($data["email"], $data["password"], true, 5);

            if ($login) {
                $json["redirect"] = url("/app/dash");
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | App",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_APP),
            false
        );

        echo $this->view->render("widgets/login/login", [
            "head" => $head
        ]);
    }
}