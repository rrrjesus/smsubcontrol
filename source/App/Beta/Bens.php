<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimonio\Bem;

/**
 * Class Bens
 * @package Source\App\Beta
 */
class Bens extends Admin
{
    
    /**
     * Bens constructor.
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
            "Bens - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonio = (new Bem())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/bens/lista", [
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
    public function bens(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $bensCreate = new Bem();
            $bensCreate->bens_nome = $data["bens_nome"];
            $bensCreate->modelo_id = $data["modelo_id"];
            $bensCreate->imei = $data["imei"];
            $bensCreate->unit_id = $data["unit_id"];
            $bensCreate->descricao = $data["descricao"];
            $bensCreate->status = $data["status"];
            $bensCreate->observacoes = $data["observacoes"];
            $bensCreate->login_created = $user->login;
            $bensCreate->created_at = date_fmt('', "Y-m-d hh:mm:ss");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o nome, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$bensCreate->save()) {
                $json["message"] = $bensCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Bem {$bensCreate->bem_nome} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/beta/patrimonio/bens/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bensUpdate = (new Bem())->findById($data["bens_id"]);

            if (!$bensUpdate) {
                $this->message->error("Você tentou gerenciar um bem que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/bens/lista")]);
                return;
            }

            $bensUpdate = (new Bem())->findById($data["bens_id"]);
            $bensUpdate->bens_nome = $data["bens_nome"];
            $bensUpdate->modelo_id = $data["modelo_id"];
            $bensUpdate->imei = $data["imei"];
            $bensUpdate->unit_id = $data["unit_id"];
            $bensUpdate->descricao = $data["descricao"];
            $bensUpdate->status = $data["status"];
            $bensUpdate->observacoes = $data["observacoes"];
            $bensUpdate->login_updated = $user->login;
            $bensUpdate->updated_at = date_fmt('', "Y-m-d hh:mm:ss");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o bem, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$bensUpdate->save()) {
                $json["message"] = $bensUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Bem {$bensUpdate->bem_nome} atualizado com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateDelete = (new Bem())->findById($data["bens_id"]);

            if (!$updateDelete) {
                $this->message->error("Você tentou deletar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/bens/lista")]);
                return;
            }

            if ($updateDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}");
                (new Thumb())->flush($updateDelete->photo);
            }

            $updateDelete->destroy();

            $this->message->success("O patrimônio foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonio/bens/lista")]);

            return;
        }

        $bensEdit = null;
        if (!empty($data["bens_id"])) {
            $bemId = filter_var($data["bens_id"], FILTER_VALIDATE_INT);
            $bensEdit = (new Bem())->findById($bemId);
        }

        $bensCreates = new Bem();

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($bensEdit ? "Bens de {$bensEdit->bens_nome}" : "Não Encontrado"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/bens/bens", [
            "app" => "beta/patrimonio/bens",
            "head" => $head,
            "bens" => $bensEdit,
            "benscreates" => $bensCreates,
            "urls" => "perfil",
            "icon" => "person"
        ]);
    }

}