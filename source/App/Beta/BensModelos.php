<?php

namespace Source\App\Beta;

use Source\Models\Patrimonio\Bem;
use Source\Models\Patrimonio\BemModelo;
use Source\Models\User;

/**
 * Class BensModelos
 * @package Source\App\Beta
 */
class BensModelos extends Admin
{
    /**
     * BensModelos constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * MODELO LISTA
     */
    public function bensmodelosLista(): void
    {
        $head = $this->seo->render(
            "Bens/Modelos - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $modelo = (new BemModelo())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/bens/modelo/lista", [
            "head" => $head,
            "modelo" => $modelo,
            "urls" => "modelo",
            "icon" => "list"
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function bensModelos(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $modeloCreate = new BemModelo();
            $modeloCreate->modelo_nome = $data["modelo_nome"];
            $modeloCreate->descricao = $data["descricao"];
            $modeloCreate->status = $data["status"];
            $modeloCreate->login_created = $user->login;
            $modeloCreate->created_at = date_fmt('', "Y-m-d hh:mm:ss");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o modelo, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$modeloCreate->save()) {
                $json["message"] = $modeloCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Modelo {$modeloCreate->modelo_nome} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/beta/patrimonio/modelos/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $modeloUpdate = (new BemModelo())->findById($data["bensmodelos_id"]);

            if (!$modeloUpdate) {
                $this->message->error("Você tentou gerenciar um modelo que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/modelos/lista")]);
                return;
            }

            $modeloUpdate = (new BemModelo())->findById($data["bensmodelos_id"]);
            $modeloUpdate->marca_id = $data["marca_id"];
            $modeloUpdate->modelo_nome = $data["modelo_nome"];
            $modeloUpdate->descricao = $data["descricao"];
            $modeloUpdate->status = $data["status"];
            $modeloUpdate->login_updated = $user->login;
            $modeloUpdate->updated_at = date_fmt('', "Y-m-d hh:mm:ss");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o modelo, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$modeloUpdate->save()) {
                $json["message"] = $modeloUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Modelo {$modeloUpdate->modelo_nome} atualizado com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $modeloDelete = (new BemModelo())->findById($data["bensmodelos_id"]);

            if (!$modeloDelete) {
                $this->message->error("Você tentou deletar uma modelo que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/modelos/lista")]);
                return;
            }

            $modeloDelete->destroy();

            $this->message->success("A modelo {$modeloDelete->modelo_nome} foi excluída com sucesso...")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonio/modelos/lista")]);

            return;
        }

        $bensmodelosEdit = null;
        if (!empty($data["bensmodelos_id"])) {
            $modeloId = filter_var($data["bensmodelos_id"], FILTER_VALIDATE_INT);
            $bensmodelosEdit = (new BemModelo())->findById($modeloId);
        }

        $bensFunctions = new BemModelo();

        $head = $this->seo->render(
            "Modelo - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/bens/modelo/modelo", [
            "head" => $head,
            "modelos" => $bensmodelosEdit,
            "bensfunctions" => $bensFunctions,
            "urls" => "modelo",
            "icon" => "person"
        ]);
    }
}