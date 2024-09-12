<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimony\Patrimony;
use Source\Models\Patrimony\BemHistorico;

/**
 * Class Patrimonys
 * @package Source\App\Beta
 */
class Patrimonys extends Admin
{
    
    /**
     * Patrimonys constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * PATRIMONY LIST
     */
    public function patrimonys(): void
    {
        $head = $this->seo->render(
            "Patrimonios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonys = (new Patrimony())->find("status = :s", "s=actived")->fetch(true);
        $patrimony = new Patrimony();

        echo $this->view->render("widgets/patrimonys/list", [
            "head" => $head,
            "patrimonys" => $patrimonys,
            "urls" => "patrimonios",
            "namepage" => "Patrimonios",
            "name" => "Lista",
            "registers" => (object)[
                "disabled" => $patrimony->find("status = :s", "s=disabled")->count()
            ]
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

            $bensCreate = new Patrimony();
            $bensCreate->modelo_id = $data["modelo_id"];
            $bensCreate->imei = $data["imei"];
            $bensCreate->unit_id = $data["unit_id"];
            $bensCreate->descricao = $data["descricao"];
            $bensCreate->status = $data["status"];
            $bensCreate->observacoes = $data["observacoes"];
            $bensCreate->login_created = $user->login;
            $bensCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if($data["imei"] == ""){
                $json['message'] = $this->message->warning("Informe o imei para criar o registro !")->icon()->render();
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

            $bens_id = $data["bens_id"];
            $user_id = $data["user_id"];
            $modelo_id = $data["modelo_id"];
            $imei = $data["imei"];
            $unit_id = $data["unit_id"];
            $returned_at = $data["returned_at"];
            $descricao = $data["descricao"];
            $status = $data["status"];
            $observacoes = $data["observacoes"];

            $bensUpdate = (new Patrimony())->findById($bens_id);

            if (!$bensUpdate) {
                $this->message->error("Você tentou gerenciar um bem que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/bens/lista")]);
                return;
            }

            $bensUpdate->user_id = $user_id;
            $bensUpdate->modelo_id = $modelo_id;
            $bensUpdate->descricao = $descricao;
            $bensUpdate->unit_id = $unit_id;
            $bensUpdate->imei = $imei;
            $bensUpdate->status = $status;
            $bensUpdate->observacoes = $observacoes;
            $bensUpdate->returned_at = date_fmt($returned_at, "Y-m-d h:m:s");
            $bensUpdate->login_updated = $user->login;
            $bensUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if($data["descricao"] == ""){
                $json['message'] = $this->message->warning("Descreva o patrimonio !!!")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$bensUpdate->save()) {
                $json["message"] = $bensUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $bensCreate = new BemHistorico();
            $bensCreate->bens_id = $bens_id;
            $bensCreate->user_id = $user_id;
            $bensCreate->modelo_id = $modelo_id;
            $bensCreate->imei = $imei;
            $bensCreate->unit_id = $unit_id;
            $bensCreate->descricao = $descricao;
            $bensCreate->status = $status;
            $bensCreate->observacoes = $observacoes;
            $bensCreate->returned_at = date_fmt($returned_at, "Y-m-d h:m:s");
            $bensCreate->login_created = $user->login;
            $bensCreate->created_at = date_fmt('', "Y-m-d h:m:s");
            $bensCreate->save();

            $json["message"] = $this->message->success("Bem {$bensUpdate->bem_nome} atualizado com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateDelete = (new Patrimony())->findById($data["bens_id"]);

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
        $historico = null;
        
        if (!empty($data["bens_id"])) {
            $bemId = filter_var($data["bens_id"], FILTER_VALIDATE_INT);
            $bensEdit = (new Patrimony())->findById($bemId);
            $historico = (new BemHistorico())->find("status = :s AND bens_id = :b", "s=actived&b={$bemId}")->fetch(true);
        }

        $bensCreates = new Patrimony();
       
        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($bensEdit ? "Patrimonys de {$bensEdit->bens_nome}" : "Não Encontrado"),
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
            "historico" => $historico,
            "urls" => "perfil",
            "icon" => "person"
        ]);
    }

}