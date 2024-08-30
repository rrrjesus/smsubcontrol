<?php

namespace Source\App\App;

use Source\Core\Controller;
use Source\Models\Auth;

/**
 * Class Admin
 * @package Source\App\App
 */
class Admin extends Controller
{
    /**
     * @var \Source\Models\User|null
     */
    protected $user;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/");

        $this->user = Auth::user();

        if (!$this->user || $this->user->level < 3) {
            $this->message->error("Para acessar é preciso logar-se")->flash();
            redirect("/app/login");
        }
    }
}