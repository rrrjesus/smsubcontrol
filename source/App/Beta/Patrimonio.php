<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Models\Bem;

/**
 * Class Bens
 * @package Source\App\Beta
 */
class Patrimonio extends Admin
{
    /**
     * Patrimonio constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

/**
     * APP HOME
     */
    public function patrimonioLista(): void
    {
        $head = $this->seo->render(
            "Olá {$this->user->bens_nome}. - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonio = (new Bem())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/patrimonio/lista", [
            "head" => $head,
            "patrimonio" => $patrimonio,
            "urls" => "",
            "icon" => "" 
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function patrimonio(?array $data): void
    {
        if (!empty($data["update"])) {
            $patrimonio = (new Bem())->findById($this->patrimonio->id);
            $patrimonio->bens_nome = $data["bens_nome"];
            $patrimonio->last_name = $data["last_name"];
            $patrimonio->email = $data["email"];
            $patrimonio->phone = preg_replace("/[^0-9]/", "", $data["phone"]);

            if (!empty($_FILES["photo"])) {
                $file = $_FILES["photo"];
                $upload = new Upload();

                if ($this->patrimonio->photo()) {
                    (new Thumb())->flush("storage/{$this->patrimonio->photo}");
                    $upload->remove("storage/{$this->patrimonio->photo}");
                }

                if (!$patrimonio->photo = $upload->image($file, "{$patrimonio->bens_nome} {$patrimonio->id} " . time(), 360)) {
                    $json["message"] = $upload->message()->before("Ooops {$this->patrimonio->bens_nome}! ")->after(".")->render();
                    echo json_encode($json);
                    return;
                }
            }

            if (!$patrimonio->save()) {
                $json["message"] = $patrimonio->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Pronto {$this->patrimonio->bens_nome}. Seus dados foram atualizados com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Meu perfil - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/patrimonio/patrimonio", [
            "head" => $head,
            "user" => $this->user,
            "urls" => "perfil",
            "icon" => "person",
            "photo" => ($this->user->photo() ? image($this->user->photo, 360, 360) :
                theme("/assets/images/avatar.jpg", CONF_VIEW_APP))
        ]);
    }

}