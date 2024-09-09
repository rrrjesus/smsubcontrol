<?php

namespace Source\App\Admin;

use Source\Models\Patrimony\Brand;
use Source\Models\User;

/**
 * Class Brands
 * @package Source\App\Beta
 */
class Brands extends Admin
{
    /**
     * Brands constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * MARCA LISTA
     */
    public function brands(): void
    {
        $head = $this->seo->render(
            "Bens/Marcas - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $brands = (new Brand())->find("status = :s", "s=actived")->fetch(true);
        $brand = new Brand();

        echo $this->view->render("widgets/brand/list", [
            "head" => $head,
            "brands" => $brands,
            "urls" => "marcas",
            "icon" => "list",
            "registers" => (object)[
                "disabled" => $brand->find("status = :s", "s=disabled")->count()
            ]
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function brand(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $brandCreate = new Brand();
            $brandCreate->brand_name = $data["brand_name"];
            $brandCreate->description = $data["description"];
            $brandCreate->status = $data["status"];
            $brandCreate->login_created = $user->login;
            $brandCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$brandCreate->save()) {
                $json["message"] = $brandCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Marca {$brandCreate->brand_name} cadastrada com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/patrimonio/patrimonio/marcas/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $brandUpdate = (new Brand())->findById($data["brands_id"]);

            if (!$brandUpdate) {
                $this->message->error("Você tentou gerenciar uma marca que não existe")->flash();
                echo json_encode(["redirect" => url("/patrimonio/patrimonio/marcas/lista")]);
                return;
            }

            $brandUpdate = (new Brand())->findById($data["brands_id"]);
            $brandUpdate->brand_name = $data["brand_name"];
            $brandUpdate->description = $data["description"];
            $brandUpdate->status = $data["status"];
            $brandUpdate->login_updated = $user->login;
            $brandUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$brandUpdate->save()) {
                $json["message"] = $brandUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Marca {$brandUpdate->brand_name} atualizada com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $brandDelete = (new Brand())->findById($data["brands_id"]);

            if (!$brandDelete) {
                $this->message->error("Você tentou deletar uma marca que não existe")->flash();
                echo json_encode(["redirect" => url("/patrimonio/patrimonio/marcas/lista")]);
                return;
            }

            $brandDelete->destroy();

            $this->message->success("A marca {$brandDelete->brand_name} foi excluída com sucesso...")->flash();
            echo json_encode(["redirect" => url("/patrimonio/patrimonio/marcas/lista")]);

            return;
        }

        $brandsEdit = null;
        if (!empty($data["brands_id"])) {
            $brandId = filter_var($data["brands_id"], FILTER_VALIDATE_INT);
            $brandsEdit = (new Brand())->findById($brandId);
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
            "marcas" => $brandsEdit,
            "urls" => "marca",
            "icon" => "person"
        ]);
    }
}