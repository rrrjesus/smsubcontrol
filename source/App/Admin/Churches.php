<?php

namespace Source\App\Admin;

use Source\Models\Churche;

/**
 * Class churches
 * @package Source\App\Admin
 */
class Churches extends Admin
{
    /**
     * churches constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function Churches(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " Igrejas Ativas",
            "Lista de igrejas Ativas",
            url("/igrejas"),
            theme("/assets/images/favicon.ico")
        );

        $churche = (new Churche());
        $churches = $churche->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/churches/list",
            [
                "app" => "control",
                "head" => $head,
                "churches" => $churches,
                "registers" => (object)[
                    "actived" => $churche->find("status = :s", "s=actived")->count(),
                    "disabled" => $churche->find("status = :s", "s=disabled")->count()
                ]
            ]);

    }

        /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function disabledChurches(): void
    {
        $head = $this->seo->render(
            "Igrejas Desativados- " . CONF_SITE_NAME ,
            "Lista de igrejas Desativadas",
            url("/igrejas/desativadas"),
            theme("/assets/images/favicon.ico")
        );

        $churche = (new Churche());
        $churches = $churche->find("status = :s", "s=disabled")->fetch(true);
        $disabled = $churche->find("status = :s", "s=disabled")->count();

        if(empty($disabled)) {
            $this->message->error("Não existem mais igrejas desativadas")->icon("building")->flash();
            redirect("/igrejas");
            return;
        }

        echo $this->view->render("widgets/churches/disabledList",
            [
                "app" => "control",
                "head" => $head,
                "churches" => $churches,
                "registers" => (object)[
                    "disabled" => $churche->find("status = :s", "s=disabled")->count()
                ]
            ]);

    }

     /**
     * @param array|null $data
     * @throws \Exception
     */
    public function churche(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $churcheCreate = new Churche();
            $churcheCreate->churche_name = $data["churche_name"];
            $churcheCreate->status = $data["status"];

            if (!$churcheCreate->save()) {
                $json["message"] = $churcheCreate->message()->icon("building")->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Igreja {$churcheCreate->churche_name} cadastrada com sucesso...")->icon("building")->flash();
            $json["redirect"] = url("/igrejas");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $churcheUpdate = (new Churche())->findById($data["churche_id"]);

            if (!$churcheUpdate) {
                $this->message->error("Você tentou gerenciar uma igreja que não existe")->icon("building")->flash();
                redirect("/igrejas");
                return;
            }

            $churcheUpdate->churche_name = $data["churche_name"];
            $churcheUpdate->status = $data["status"];

            if (!$churcheUpdate->save()) {
                $json["message"] = $churcheUpdate->message()->icon("building")->render();
                echo json_encode($json);
                return;
            }

            $this->message->warning("Igreja {$churcheUpdate->churche_name} atualizado com sucesso...")->icon("building")->flash();
            $json["redirect"] = url("/igrejas");
            echo json_encode($json);
            return;

            
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $churcheDelete = (new Churche())->findById($data["churche_id"]);

            if (!$churcheDelete) {
                $this->message->error("Você tentou deletar uma Igreja que não existe")->icon("building")->flash();
                redirect("/igrejas");
                return;
            }

            $churcheDelete->destroy();

            $this->message->success("Registro de {$churcheDelete->churche_name} excluido com sucesso...")->icon("building")->flash();
            redirect("/igrejas");
            return;
            
        }

        $churcheEdit = null;
        if (!empty($data["churche_id"])) {
            $churcheId = filter_var($data["churche_id"], FILTER_VALIDATE_INT);
            $churcheEdit = (new Churche())->findById($churcheId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($churcheEdit ? "{$churcheEdit->churche_name}" : "Nova Igreja"),
            CONF_SITE_DESC,
            url("/painel"),
            url("/painel/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/churches/churche", [
            "app" => "churches/churche",
            "head" => $head,
            "churche" => $churcheEdit
        ]);
    }

     /** @param array $data
     * @return void */

     public function activedChurche(?array $data): void
     {
 
         if (!empty($data["churche_id"])) {
             $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
             $churcheActived = (new Churche())->findById($data["churche_id"]);
 
             if (!$churcheActived) {
                 $this->message->error("Você tentou gerenciar uma Igreja que não existe")->icon("building")->flash();
                 redirect("/igrejas");
                 return;
             }
 
             $churcheActived->status = "actived";
             $churcheActived->updated_at = (new \DateTime())->format("Y-m-d H:i:s");
 
             if (!$churcheActived->save()) {
                 $churcheActived->message()->icon()->flash();
                 redirect("/igrejas");
                 return;
             }
 
             $this->message->success("Registro de {$churcheActived->churche_name} reativada com sucesso...")->icon("building")->flash();
             redirect("/igrejas/desativadas");
             return;
         }
     }
    /** @param array $data
     * @return void */

     public function disabledChurche(?array $data): void
     {
 
         if (!empty($data["churche_id"])) {
             $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
             $churcheDisabled = (new Churche())->findById($data["churche_id"]);
 
             if (!$churcheDisabled) {
                 $this->message->error("Você tentou gerenciar um grupo que não existe")->icon("building")->flash();
                 redirect("/igrejas");
                 return;
             }
 
             $churcheDisabled->status = "disabled";
             $churcheDisabled->updated_at = (new \DateTime())->format("Y-m-d H:i:s");
 
             if (!$churcheDisabled->save()) {
                 $churcheDisabled->message()->icon()->flash();
                 redirect("/igrejas");
                 return;
             }
 
             $this->message->success("Registro de {$churcheDisabled->churche_name} desativado com sucesso...")->icon("building")->flash();
             redirect("/igrejas");
             return;
         }
     }
}