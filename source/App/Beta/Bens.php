<?php

namespace Source\App\Beta;

use Source\Models\User;
use Source\Models\Bem;
use Source\Models\Upload;
use Source\Models\Thumb;

/**
 * Class Bens
 * @package Source\App\Beta
 */
class Bens extends Admin
{
    
    /**
     * Bens constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

/**
     * APP HOME
     */
    public function bensLista(): void
    {
        $head = $this->seo->render(
            "Bens - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $patrimonio = (new Bem())->find("status = :s", "s=actived")->fetch(true);

        echo $this->view->render("widgets/bens/lista", [
            "head" => $head,
            "patrimonio" => $patrimonio,
            "urls" => "",
            "icon" => "" 
        ]);
    }

       /**
     * @param array|null $data
     * @throws \Exception
     */
    public function bens(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $bensCreate = new Bem();
            $bensCreate->first_name = $data["first_name"];
            $bensCreate->last_name = $data["last_name"];
            $bensCreate->email = $data["email"];
            $bensCreate->password = $data["password"];
            $bensCreate->level = $data["level"];
            $bensCreate->genre = $data["genre"];
            $bensCreate->datebirth = date_fmt_back($data["datebirth"]);
            $bensCreate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $bensCreate->status = $data["status"];

            //upload photo
            if (!empty($_FILES["photo"])) {
                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $bensCreate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $bensCreate->photo = $image;
            }

            if (!$bensCreate->save()) {
                $json["message"] = $bensCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Patrimônio cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/users/patrimonio/{$bensCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bensUpdate = (new Bem())->findById($data["bens_id"]);

            if (!$bensUpdate) {
                $this->message->error("Você tentou gerenciar um patrimônio que não existe")->flash();
                echo json_encode(["redirect" => url("/beta/patrimonio/bens/lista")]);
                return;
            }

            $bensUpdate->first_name = $data["first_name"];
            $bensUpdate->last_name = $data["last_name"];
            $bensUpdate->email = $data["email"];
            $bensUpdate->password = (!empty($data["password"]) ? $data["password"] : $bensUpdate->password);
            $bensUpdate->level = $data["level"];
            $bensUpdate->genre = $data["genre"];
            $bensUpdate->datebirth = date_fmt_back($data["datebirth"]);
            $bensUpdate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $bensUpdate->status = $data["status"];

            //upload photo
            if (!empty($_FILES["photo"])) {
                if ($bensUpdate->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$bensUpdate->photo}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$bensUpdate->photo}");
                    (new Thumb())->flush($bensUpdate->photo);
                }

                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $bensUpdate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $bensUpdate->photo = $image;
            }

            if (!$bensUpdate->save()) {
                $json["message"] = $bensUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Patrimônio atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateDelete = (new Bem())->findById($data["bens_id"]);

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
        if (!empty($data["bens_id"])) {
            $bemId = filter_var($data["bens_id"], FILTER_VALIDATE_INT);
            $bensEdit = (new Bem())->findById($bemId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($bensEdit ? "Bens de {$bensEdit->bens_nome}" : "Não Encontrado"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/bens/bens", [
            "app" => "beta/patrimonio/bens",
            "head" => $head,
            "bens" => $bensEdit,
            "urls" => "perfil",
            "icon" => "person"
        ]);
    }

}