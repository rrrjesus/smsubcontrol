<?php

namespace Source\App\Beta;

use Source\Models\Patrimonio\BemMarca;
use Source\Models\User;

/**
 * Class BensMarcas
 * @package Source\App\Beta
 */
class BensMarcas extends Admin
{
    /**
     * BensMarcas constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * MARCA LISTA
     */
    public function bensmarcasLista(): void
    {
        $head = $this->seo->render(
            "Bens/Marcas - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $marca = (new BemMarca())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/bens/marca/lista", [
            "head" => $head,
            "marca" => $marca,
            "urls" => "marca",
            "icon" => "list"
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function bensMarcas(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $marcaCreate = new BemMarca();
            $marcaCreate->marca_nome = $data["marca_nome"];
            $marcaCreate->descricao = $data["descricao"];
            $marcaCreate->status = $data["status"];
            $marcaCreate->login_created = $user->login;
            $marcaCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$marcaCreate->save()) {
                $json["message"] = $marcaCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Marca {$marcaCreate->marca_nome} cadastrada com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/beta/patrimonio/marcas/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $marcaUpdate = (new BemMarca())->findById($data["bensmarcas_id"]);

            if (!$marcaUpdate) {
                $this->message->error("Você tentou gerenciar uma marca que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/marcas/lista")]);
                return;
            }

            $marcaUpdate = (new BemMarca())->findById($data["bensmarcas_id"]);
            $marcaUpdate->marca_nome = $data["marca_nome"];
            $marcaUpdate->descricao = $data["descricao"];
            $marcaUpdate->status = $data["status"];
            $marcaUpdate->login_updated = $user->login;
            $marcaUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$marcaUpdate->save()) {
                $json["message"] = $marcaUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Marca {$marcaUpdate->marca_nome} atualizada com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $marcaDelete = (new BemMarca())->findById($data["bensmarcas_id"]);

            if (!$marcaDelete) {
                $this->message->error("Você tentou deletar uma marca que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/marcas/lista")]);
                return;
            }

            $marcaDelete->destroy();

            $this->message->success("A marca {$marcaDelete->marca_nome} foi excluída com sucesso...")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonio/marcas/lista")]);

            return;
        }

        $bensmarcasEdit = null;
        if (!empty($data["bensmarcas_id"])) {
            $marcaId = filter_var($data["bensmarcas_id"], FILTER_VALIDATE_INT);
            $bensmarcasEdit = (new BemMarca())->findById($marcaId);
        }

        $head = $this->seo->render(
            "Marca - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/bens/marca/marca", [
            "head" => $head,
            "marcas" => $bensmarcasEdit,
            "urls" => "marca",
            "icon" => "person"
        ]);
    }
}