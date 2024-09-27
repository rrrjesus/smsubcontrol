<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Support\Upload;
use Source\Support\Thumb;
use Source\Models\Patrimony\Bem;
use Source\Models\Patrimony\Patrimony;
use Source\Models\Patrimony\PatrimonyHistory;

/**
 * Class PatrimonyHistory
 * @package Source\App\Beta
 */
class PatrimonysHistory extends Admin
{
    
/**
 * PatrimonyHistory constructor.
 */
public function __construct()
{
    parent::__construct();
}

/**
     * PATRIMONY LIST
     */
    public function patrimonysHistory(): void
    {
        $head = $this->seo->render(
            "Patrimonios - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/patrimonysHistory/list", [
            "head" => $head,
            "urls" => "patrimonios/historico",
            "namepage" => "Histórico de Patrimonios",
            "name" => "Lista"
        ]);
    }


/**
 * @param array|null $data
 * @throws \Exception
 */
public function patrimonyHistory(?array $data): void
{
    
    $user = (new User())->findById($this->user->id);

    //update
    if (!empty($data["action"]) && $data["action"] == "update") {
        $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $patrimonys_id = $data["patrimonys_id"];
        $movement_id = preg_replace("/[^0-9\s]/", "", $data["movement_id"]);
        $product_id = preg_replace("/[^0-9\s]/", "", $data["product_id"]);
        $part_number = $data["part_number"];
        $unit_id_number = preg_replace("/[^0-9\s]/", "", $data["unit_id"]);
        $unit_id = substr($unit_id_number, 0, 2);  // 12
        $user_id = $data["user_id"];
        $observations = $data["observations"];

        $patrimonysHistoryUpdate = (new PatrimonyHistory())->findById($patrimonys_id);

        if (!$patrimonysHistoryUpdate) {
            $this->message->error("Você tentou gerenciar um patrimônio que não existe")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonios")]);
            return;
        }

        $patrimonysHistoryUpdate->patrimonys_id = $patrimonys_id;
        $patrimonysHistoryUpdate->movement_id = $movement_id;
        $patrimonysHistoryUpdate->product_id = $product_id;
        $patrimonysHistoryUpdate->unit_id = $unit_id;
        $patrimonysHistoryUpdate->user_id = $user_id;
        $patrimonysHistoryUpdate->part_number = $part_number;
        $patrimonysHistoryUpdate->observations = $observations;
        $patrimonysHistoryUpdate->login_updated = $user->login;

        //upload pdf
        if (!empty($_FILES["file_terms"])) {
        $files = $_FILES["file_terms"];
        $upload = new Upload();
        
        $file_terms = $upload->file($files, $patrimonysHistoryUpdate->user_id.'_'.$patrimonysHistoryUpdate->product()->type_part_number.'_'.$patrimonysHistoryUpdate->part_number);

        if (!$file_terms) {
            $json["message"] = $upload->message()->render();
            echo json_encode($json);
            return;
        }

            $patrimonysHistoryUpdate->file_terms = $file_terms;
        }

        if($data["movement_id"] == ""){
            $json['message'] = $this->message->warning("Informe um estado para gravar o patrimônio !!!")->icon()->render();
            echo json_encode($json);
            return;
        }

        if($data["product_id"] == ""){
            $json['message'] = $this->message->warning("Informe um produto para gravar o patrimônio !!!")->icon()->render();
            echo json_encode($json);
            return;
        }

        if($data["part_number"] == ""){
            $json['message'] = $this->message->warning("Informe o numero da peça para criar o patrimônio !")->icon()->render();
            echo json_encode($json);
            return;
        }

        if($data["unit_id"] == ""){
            $json['message'] = $this->message->warning("Informe uma unidade para gravar o patrimônio !!!")->icon()->render();
            echo json_encode($json);
            return;
        }

        if (!$patrimonysHistoryUpdate->save()) {
            $json["message"] = $patrimonysHistoryUpdate->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Patrimonio {$part_number} atualizado com sucesso !!!")->icon("emoji-grin me-1")->flash();
        echo json_encode(["redirect" => url("/beta/patrimonios/editar/{$patrimonysHistoryUpdate->id}")]);
        return;
    }

        //actived
        if (!empty($data["action"]) && $data["action"] == "actived") {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $patrimonyActived = (new PatrimonyHistory())->findById($data["patrimonys_id"]);

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

        $this->message->success("Patrimônio {$patrimonyActived->product()->type_part_number} {$patrimonyActived->part_number} reativado com sucesso !!!")->icon("emoji-grin me-1")->flash();
        redirect("/beta/patrimonios/desativados");
        return;
    }

    
        //disabled
        if (!empty($data["action"]) && $data["action"] == "disabled") {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $patrimonyDisabled = (new PatrimonyHistory())->findById($data["patrimonys_id"]);

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

        $this->message->success("Patrimônio {$patrimonyDisabled->product()->type_part_number} - {$patrimonyDisabled->part_number} desativado com sucesso !!!")->icon("emoji-grin me-1")->flash();
        redirect("/beta/patrimonios");
        return;
    }

        //writeoff
        if (!empty($data["action"]) && $data["action"] == "writeoff") {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $patrimonyWriteoff = (new PatrimonyHistory())->findById($data["patrimonys_id"]);

        if (!$patrimonyWriteoff) {
            $this->message->error("Você tentou gerenciar um patrimônio que não existe")->icon()->flash();
            echo json_encode(["redirect" => url("/beta/patrimonios")]);
            return;
        }

        $patrimonyWriteoff->status = "writeoff";
        $patrimonyWriteoff->login_updated = $user->login;

        if (!$patrimonyWriteoff->save()) {
            $json["message"] = $patrimonyWriteoff->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Patrimônio {$patrimonyWriteoff->product()->type_part_number} - {$patrimonyWriteoff->type_number} dado como baixa com sucesso !!!")->icon("emoji-grin me-1")->flash();
        redirect("/beta/patrimonios");
        return;
    }

    //delete
    if (!empty($data["action"]) && $data["action"] == "delete") {
        $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $patrimonyHistoryDelete = (new PatrimonyHistory())->findById($data["patrimonys_id"]);
        $patrimonyDelete = (new Patrimony())->findById($patrimonyHistoryDelete->patrimony_id);

        if (!$patrimonyHistoryDelete) {
            $this->message->error("Você tentou deletar um patrimônio que não existe")->flash();
            echo json_encode(["redirect" => url("/beta/patrimonios/editar/{$patrimonyHistoryDelete->id}")]);
            return;
        }

        // if($patrimonyHistoryDelete->movement_id == $patrimonyDelete->movement_id && $patrimonyHistoryDelete->user_id == $patrimonyDelete->user_id && $patrimonyHistoryDelete->unit_id == $patrimonyDelete->unit_id){
        //     $this->message->warning("Histórico com os campos Estado, Usuário e Unidade iguais ao do registro nâo pode ser apagado ...")->icon()->flash();
        //     redirect("/beta/patrimonios/editar/{$patrimonyHistoryDelete->patrimony_id}");
        //     return;
        // }

        if ($patrimonyHistoryDelete->file_terms && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$patrimonyHistoryDelete->file_terms}")) {
            unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$patrimonyHistoryDelete->file_terms}");
            (new Upload())->remove($patrimonyHistoryDelete->file_terms);
        }

        $patrimonyHistoryDelete->destroy();

        $this->message->success("O histórico de patrimônio id: {$patrimonyHistoryDelete->id} - {$patrimonyHistoryDelete->product()->type_part_number} {$patrimonyHistoryDelete->part_number} foi excluído com sucesso...")->flash();
        redirect("/beta/patrimonios/editar/{$patrimonyHistoryDelete->patrimony_id}");
        return;
    }

    $PatrimonysEdit = null;
    $historico = null;
    
    if (!empty($data["patrimonys_id"])) {
        $patrimonyId = filter_var($data["patrimonys_id"], FILTER_VALIDATE_INT);
        $PatrimonysEdit = (new PatrimonyHistory())->findById($patrimonyId);
        $historico = (new PatrimonyHistory())->find("patrimony_id = :p", "p={$patrimonyId}")->fetch(true);
    }

    $patrimonysCreates = new PatrimonyHistory();
    
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

/**
 * @param array|null $data
 * @throws \Exception
 */
public function term(?array $data): void
{
    //update term
    $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
    $termPrint = (new PatrimonyHistory())->findById($data["patrimonys_id"]);

    $head = $this->seo->render(
        CONF_SITE_NAME . " - Termo de - ".(!empty($termPrint->userPatrimony()->rf) ? $termPrint->userPatrimony()->rf : "Responsabilidade")." - "
        .(!empty($termPrint->userPatrimony()->user_name) ? $termPrint->userPatrimony()->user_name : "")." - ".$termPrint->product()->type_part_number.":".$termPrint->part_number ,
        CONF_SITE_DESC,
        url(),
        theme("/assets/images/favicon.ico"),
        false
    );

    echo $this->view->render("widgets/patrimonys/term", [
        "head" => $head,
        "term" => $termPrint,
        "urls" => "patrimonios/historico/termo/{$termPrint->id}",
        "namepage" => "Termo",
        "name" => "Imprimir"
    ]);
}

/**
     * APP HOME
     */
    public function bensLista(): void
    {
        $head = $this->seo->render(
            "Bens Historico - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonio = (new Bem())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/benshistorico/lista", [
            "head" => $head,
            "patrimonio" => $patrimonio,
            "urls" => "",
            "icon" => "" 
        ]);
    }

}