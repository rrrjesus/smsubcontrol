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
     * PATRIMONY LIST DISABLED
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

            $product_id = $data["product_id"];
            $imei = $data["imei"];
            $ns = $data["ns"];
            $unit_id = $data["unit_id"];
            $user_id = $data["user_id"];
            $observations = $data["observations"];

            $patrimonyCreate = new Patrimony();
            $patrimonyCreate->product_id = $product_id;
            $patrimonyCreate->imei = $imei;
            $patrimonyCreate->ns = $ns;
            $patrimonyCreate->unit_id = $unit_id;
            $patrimonyCreate->user_id = $user_id;
            $patrimonyCreate->observations = $observations;
            $patrimonyCreate->login_created = $user->login;
            $patrimonyCreate->created_at = date_fmt('', "Y-m-d h:m:s");

             //upload pdf
             if (!empty($_FILES["pdf"])) {
                $files = $_FILES["pdf"];
                $upload = new Upload();
                $pdf = $upload->file($files, $patrimonyCreate->user_id.'_'.$patrimonyCreate->ns);

                if (!$pdf) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $patrimonyCreate->term = $pdf;
            }

            if($data["product_id"] == ""){
                $json['message'] = $this->message->warning("Informe um produto para criar o patrimônio !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if($data["imei"] == "" && $data["ns"] == ""){
                $json['message'] = $this->message->warning("Informe um imei ou ns para criar o patrimônio !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if($data["unit_id"] == ""){
                $json['message'] = $this->message->warning("Informe uma unidade para criar o patrimônio !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$patrimonyCreate->save()) {
                $json["message"] = $patrimonyCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $patrimonyCreateHistory = new PatrimonyHistory();
            $patrimonyCreateHistory->patrimony_id = $patrimonyCreate->id;
            $patrimonyCreateHistory->product_id = $product_id;
            $patrimonyCreateHistory->unit_id = $unit_id;
            $patrimonyCreateHistory->user_id = $user_id;
            $patrimonyCreateHistory->imei = $imei;
            $patrimonyCreateHistory->ns = $ns;
            $patrimonyCreateHistory->observations = $observations;
            $patrimonyCreateHistory->login_updated = $user->login;
            $patrimonyCreateHistory->updated_at = date_fmt('', "Y-m-d h:m:s");
            $patrimonyCreateHistory->save();

            $this->message->success("Patrimônio {$patrimonyCreate->imei} {$patrimonyCreate->ns} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/beta/patrimonios/cadastrar");

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

            $patrimonysUpdate = (new Patrimony())->findById($patrimonys_id);

            if (!$patrimonysUpdate) {
                $this->message->error("Você tentou gerenciar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonios")]);
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
                $json['message'] = $this->message->warning("Informe um produto para gravar o patrimônio !!!")->icon()->render();
                echo json_encode($json);
                return;
            }

            if($data["imei"] == "" && $data["ns"] == ""){
                $json['message'] = $this->message->warning("Informe um imei ou ns para gravar o patrimônio !!!")->icon()->render();
                echo json_encode($json);
                return;
            }

            if($data["unit_id"] == ""){
                $json['message'] = $this->message->warning("Informe uma unidade para gravar o patrimônio !!!")->icon()->render();
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
            $patrimonysCreate->login_updated = $user->login;
            $patrimonysCreate->save();

            $this->message->success("Patrimonio {$imei} {$ns} atualizado com sucesso !!!")->icon("emoji-grin me-1")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonios")]);
            return;
        }

         //actived
         if (!empty($data["action"]) && $data["action"] == "actived") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $patrimonyActived = (new Patrimony())->findById($data["patrimonys_id"]);

            if (!$patrimonyActived) {
                $this->message->error("Você tentou gerenciar um patrimônio que não existe")->icon()->flash();
                echo json_encode(["redirect" => url("/beta/patrimonios")]);
                return;
            }

            $patrimonyActived->status = "actived";
            $patrimonyActived->login_updated = $user->login;

            if (!$patrimonyActived->save()) {
                $json["message"] = $patrimonyActived->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Patrimônio {$patrimonyActived->imei} {$patrimonyActived->ns} reativado com sucesso !!!")->icon("emoji-grin me-1")->flash();
            redirect("/beta/patrimonios");
            return;
        }

        
         //disabled
         if (!empty($data["action"]) && $data["action"] == "disabled") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $patrimonyDisabled = (new Patrimony())->findById($data["patrimonys_id"]);

            if (!$patrimonyDisabled) {
                $this->message->error("Você tentou gerenciar um patrimônio que não existe")->icon()->flash();
                echo json_encode(["redirect" => url("/beta/patrimonios")]);
                return;
            }

            $patrimonyDisabled->status = "disabled";
            $patrimonyDisabled->login_updated = $user->login;

            if (!$patrimonyDisabled->save()) {
                $json["message"] = $patrimonyDisabled->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Patrimônio {$patrimonyDisabled->imei} - {$patrimonyDisabled->ns} desativado com sucesso !!!")->icon("emoji-grin me-1")->flash();
            redirect("/beta/patrimonios");
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateDelete = (new Patrimony())->findById($data["patrimonys_id"]);

            if (!$updateDelete) {
                $this->message->error("Você tentou deletar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonios")]);
                return;
            }

            if ($updateDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$updateDelete->photo}");
                (new Thumb())->flush($updateDelete->photo);
            }

            $updateDelete->destroy();

            $this->message->success("O patrimônio foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonios")]);

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