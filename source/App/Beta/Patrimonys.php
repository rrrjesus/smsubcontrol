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
     * PATRIMONY LIST
     */
    public function patrimony(): void
    {
       
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $patrimonysCreate = new Patrimony();
            $patrimonysCreate->modelo_id = $data["modelo_id"];
            $patrimonysCreate->imei = $data["imei"];
            $patrimonysCreate->unit_id = $data["unit_id"];
            $patrimonysCreate->descricao = $data["descricao"];
            $patrimonysCreate->status = $data["status"];
            $patrimonysCreate->observacoes = $data["observacoes"];
            $patrimonysCreate->login_created = $user->login;
            $patrimonysCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if($data["imei"] == ""){
                $json['message'] = $this->message->warning("Informe o imei para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$patrimonysCreate->save()) {
                $json["message"] = $patrimonysCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Bem {$patrimonysCreate->bem_nome} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/beta/patrimonio/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $patrimonys_id = $data["patrimonys_id"];
            $user_id = $data["user_id"];
            $modelo_id = $data["modelo_id"];
            $imei = $data["imei"];
            $unit_id = $data["unit_id"];
            $returned_at = $data["returned_at"];
            $descricao = $data["descricao"];
            $status = $data["status"];
            $observacoes = $data["observacoes"];

            $patrimonysUpdate = (new Patrimony())->findById($patrimonys_id);

            if (!$patrimonysUpdate) {
                $this->message->error("Você tentou gerenciar um bem que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/lista")]);
                return;
            }

            $patrimonysUpdate->user_id = $user_id;
            $patrimonysUpdate->modelo_id = $modelo_id;
            $patrimonysUpdate->descricao = $descricao;
            $patrimonysUpdate->unit_id = $unit_id;
            $patrimonysUpdate->imei = $imei;
            $patrimonysUpdate->status = $status;
            $patrimonysUpdate->observacoes = $observacoes;
            $patrimonysUpdate->returned_at = date_fmt($returned_at, "Y-m-d h:m:s");
            $patrimonysUpdate->login_updated = $user->login;
            $patrimonysUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if($data["descricao"] == ""){
                $json['message'] = $this->message->warning("Descreva o patrimonio !!!")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$patrimonysUpdate->save()) {
                $json["message"] = $patrimonysUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $patrimonysCreate = new BemHistorico();
            $patrimonysCreate->patrimonys_id = $patrimonys_id;
            $patrimonysCreate->user_id = $user_id;
            $patrimonysCreate->modelo_id = $modelo_id;
            $patrimonysCreate->imei = $imei;
            $patrimonysCreate->unit_id = $unit_id;
            $patrimonysCreate->descricao = $descricao;
            $patrimonysCreate->status = $status;
            $patrimonysCreate->observacoes = $observacoes;
            $patrimonysCreate->returned_at = date_fmt($returned_at, "Y-m-d h:m:s");
            $patrimonysCreate->login_created = $user->login;
            $patrimonysCreate->created_at = date_fmt('', "Y-m-d h:m:s");
            $patrimonysCreate->save();

            $json["message"] = $this->message->success("Bem {$patrimonysUpdate->bem_nome} atualizado com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateDelete = (new Patrimony())->findById($data["patrimonys_id"]);

            if (!$updateDelete) {
                $this->message->error("Você tentou deletar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/lista")]);
                return;
            }

            if ($updateDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}");
                (new Thumb())->flush($updateDelete->photo);
            }

            $updateDelete->destroy();

            $this->message->success("O patrimônio foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonio/lista")]);

            return;
        }

        $PatrimonysEdit = null;
        $historico = null;
        
        if (!empty($data["patrimonys_id"])) {
            $bemId = filter_var($data["patrimonys_id"], FILTER_VALIDATE_INT);
            $PatrimonysEdit = (new Patrimony())->findById($bemId);
            $historico = (new BemHistorico())->find("status = :s AND patrimonys_id = :b", "s=actived&b={$bemId}")->fetch(true);
        }

        $patrimonysCreates = new Patrimony();
       
        $head = $this->seo->render(
            "Patrimonios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/patrimonys/patrimony", [
            "head" => $head,
            "patrimonys" => $PatrimonysEdit,
            "patrimonyscreates" => $patrimonysCreates,
            "historico" => $historico,
            "urls" => "patrimonios",
            "namepage" => "Patrimonios",
            "name" => "Lista"
        ]);
    }

}