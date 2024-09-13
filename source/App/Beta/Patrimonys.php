<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimony\Patrimony;
use Source\Models\Patrimony\PatrimonyHistory;

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
    public function disabledPatrimonys(): void
    {
        $head = $this->seo->render(
            "Patrimonios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonys = (new Patrimony())->find("status = :s", "s=disabled")->fetch(true);
        $patrimony = new Patrimony();

        echo $this->view->render("widgets/patrimonys/disabledList", [
            "head" => $head,
            "patrimonys" => $patrimonys,
            "urls" => "patrimonios",
            "namepage" => "Patrimonios",
            "name" => "Lista"
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function patrimony(?array $data): void
    {
       
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $patrimonysCreate = new Patrimony();
            $patrimonysCreate->product_id = $data["product_id"];
            $patrimonysCreate->imei = $data["imei"];
            $patrimonysCreate->ns = $data["ns"];
            $patrimonysCreate->unit_id = $data["unit_id"];
            $patrimonysCreate->user_id = $data["user_id"];
            $patrimonysCreate->status = $data["status"];
            $patrimonysCreate->observations = $data["observations"];
            $patrimonysCreate->login_created = $user->login;
            $patrimonysCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if($data["imei"] == "" || $data["ns"] == ""){
                $json['message'] = $this->message->warning("Informe um Imei ou Ns para criar o registro !")->icon()->render();
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
            $product_id = preg_replace("/[^0-9\s]/", "", $data["product_id"]);
            $imei = $data["imei"];
            $ns = $data["ns"];
            $unit_id_number = preg_replace("/[^0-9\s]/", "", $data["unit_id"]);
            $unit_id = substr($unit_id_number, 0, 2);  // 12
            $user_id = preg_replace("/[^0-9\s]/", "", $data["user_id"]);
            $observations = $data["observations"];
            $created_at = $data["created_at"];
            $login_created = $data["login_created"];

            $patrimonysUpdate = (new Patrimony())->findById($patrimonys_id);

            if (!$patrimonysUpdate) {
                $this->message->error("Você tentou gerenciar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/lista")]);
                return;
            }

            $patrimonysUpdate->product_id = $product_id;
            $patrimonysUpdate->unit_id = $unit_id;
            $patrimonysUpdate->user_id = $user_id;
            $patrimonysUpdate->imei = $imei;
            $patrimonysUpdate->ns = $ns;
            $patrimonysUpdate->observations = $observations;
            $patrimonysUpdate->login_updated = $user->login;
            $patrimonysUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if($data["product_id"] == ""){
                $json['message'] = $this->message->warning("Informe uma unidade para salvar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if($data["unit_id"] == ""){
                $json['message'] = $this->message->warning("Informe uma unidade para salvar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$patrimonysUpdate->save()) {
                $json["message"] = $patrimonysUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $patrimonysCreate = new PatrimonyHistory();
            $patrimonysCreate->patrimony_id = $patrimonys_id;
            $patrimonysCreate->product_id = $product_id;
            $patrimonysCreate->unit_id = $unit_id;
            $patrimonysCreate->user_id = $user_id;
            $patrimonysCreate->imei = $imei;
            $patrimonysCreate->ns = $ns;
            $patrimonysCreate->observations = $observations;
            $patrimonysCreate->login_created = $login_created;
            $patrimonysCreate->criado = $created_at;
            $patrimonysCreate->login_updated = $user->login;
            $patrimonysCreate->updated_at = date_fmt('', "Y-m-d h:m:s");
            $patrimonysCreate->save();

            $json["message"] = $this->message->success("Bem {$imei} {$ns} {$created_at} atualizado com sucesso !!!")->icon("emoji-grin me-1")->render();
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
            $patrimonyId = filter_var($data["patrimonys_id"], FILTER_VALIDATE_INT);
            $PatrimonysEdit = (new Patrimony())->findById($patrimonyId);
            $historico = (new PatrimonyHistory())->find("status = :s AND patrimony_id = :p", "s=actived&p={$patrimonyId}")->fetch(true);
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
            "urls" => ($PatrimonysEdit ? "patrimonios/editar/{$PatrimonysEdit->id}" : "patrimonios"),
            "namepage" => "Patrimonios",
            "name" => ($PatrimonysEdit ? "Editar" : "Cadastrar")
        ]);
    }

}