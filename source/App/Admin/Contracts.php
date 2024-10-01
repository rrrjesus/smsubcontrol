<?php

namespace Source\App\Admin;

use Source\Models\Patrimony\Contract;
use Source\Models\User;

/**
 * Class Contracts
 * @package Source\App\Beta
 */
class Contracts extends Admin
{
    /**
     * Contracts constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * MARCA LISTA
     */
    public function contracts(): void
    {
        $head = $this->seo->render(
            "Patrimônios / contratos - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $contracts = (new Contract())->find("status = :s", "s=actived")->fetch(true);
        $contract = new Contract();

        echo $this->view->render("widgets/patrimonys/contracts/list", [
            "head" => $head,
            "contracts" => $contracts,
            "urls" => "patrimonio/contratos",
            "namepage" => "Contratos",
            "name" => "Lista",
            "registers" => (object)[
                "disabled" => $contract->find("status = :s", "s=disabled")->count()
            ]
        ]);
    }

        /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function disabledContracts(): void
    {
        $head = $this->seo->render(
            "Contratos Desabilitadas - " . CONF_SITE_NAME ,
            "Lista de contratos Desativadas",
            url("/painel/patrimonio/contratos/desativados"),
            theme("/assets/images/favicon.ico")
        );

        $contract = (new Contract());
        $contracts = $contract->find("status = :s", "s=disabled")->fetch(true);

        echo $this->view->render("widgets/patrimonys/contracts/disabledList",
            [
                "admin" => "contratos",
                "head" => $head,
                "contracts" => $contracts,
                "urls" => "patrimonio/contratos",
                "namepage" => "Contratos",
                "name" => "Lista"
            ]);

    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function contract(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $contractCreate = new Contract();
            $contractCreate->contract_name = $data["contract_name"];
            $contractCreate->description = $data["description"];
            $contractCreate->login_created = $user->login;
            $contractCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o contrato e descrição para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$contractCreate->save()) {
                $json["message"] = $contractCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Contrato {$contractCreate->contract_name} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/painel/patrimonio/contratos/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $contractUpdate = (new Contract())->findById($data["contract_id"]);

            if (!$contractUpdate) {
                $this->message->error("Você tentou gerenciar um contrato que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/contratos")]);
                return;
            }

            $contractUpdate = (new Contract())->findById($data["contract_id"]);
            $contractUpdate->contract_name = $data["contract_name"];
            $contractUpdate->description = $data["description"];
            $contractUpdate->login_updated = $user->login;
            $contractUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe o contrato, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$contractUpdate->save()) {
                $json["message"] = $contractUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Contrato {$contractUpdate->contract_name} atualizada com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

          //actived
         if (!empty($data["action"]) && $data["action"] == "actived") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contractActived = (new Contract())->findById($data["contract_id"]);

            if (!$contractActived) {
                $this->message->error("Você tentou gerenciar um contrato que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/contratos")]);
                return;
            }

            $contractActived->status = "actived";
            $contractActived->login_updated = $user->login;

            if (!$contractActived->save()) {
                $json["message"] = $contractActived->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Contrato {$contractActived->contract_name} reativado com sucesso !!!")->icon("gift")->flash();
            redirect("/painel/patrimonio/contratos/desativadas");
            return;
        }

        
         //disabled
         if (!empty($data["action"]) && $data["action"] == "disabled") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contractDisabled = (new Contract())->findById($data["contract_id"]);

            if (!$contractDisabled) {
                $this->message->error("Você tentou gerenciar um contrato que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/contratos")]);
                return;
            }

            $contractDisabled->status = "disabled";
            $contractDisabled->login_updated = $user->login;

            if (!$contractDisabled->save()) {
                $json["message"] = $contractDisabled->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Contrato {$contractDisabled->contract_name} desativada com sucesso !!!")->icon("gift")->flash();
            redirect("/painel/patrimonio/contratos");
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $contractDelete = (new Contract())->findById($data["contract_id"]);

            if (!$contractDelete) {
                $this->message->error("Você tentou deletar um contrato que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/contratos")]);
                return;
            }

            $contractDelete->destroy();

            $this->message->success("o contrato {$contractDelete->contract_name} foi excluída com sucesso...")->icon("gift")->flash();
            redirect("/painel/patrimonio/contratos");
            return;
        }

        $contractEdit = null;
        if (!empty($data["contract_id"])) {
            $contractId = filter_var($data["contract_id"], FILTER_VALIDATE_INT);
            $contractEdit = (new Contract())->findById($contractId);
        }

        $head = $this->seo->render(
            "contratos - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/patrimonys/contracts/contract", [
            "head" => $head,
            "contratos" => $contractEdit,
            "urls" => "patrimonio/contratos",
            "namepage" => "Contratos",
            "name" => ($contractEdit ? "Editar" : "Cadastrar")
        ]);
    }
}