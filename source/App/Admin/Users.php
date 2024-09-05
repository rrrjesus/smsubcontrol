<?php

namespace Source\App\Admin;

use Source\App\Admin\Dashboard;
use Source\Models\User;
use Source\Support\Thumb;
use Source\Support\Upload;

/**
 * Class Users
 * @package Source\App\Admin
 */
class Users extends Admin
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 
     */

    /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function disabledUsers(): void
    {
        $head = $this->seo->render(
            "Usuarios Registrados - " . CONF_SITE_NAME ,
            "Painel para gerenciamento de usuarios registrados",
            url("/painel/usuarios/registrados"),
            theme("/assets/images/favicon.ico")
        );

        $user = (new User());
        $users = $user->find("status = :s", "s=disabled")->fetch(true);

        echo $this->view->render("widgets/users/disabledList",
            [
                "app" => "usuarios",
                "head" => $head,
                "users" => $users
            ]);

    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function users(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " Usuarios",
            "Lista de usuarios ativos",
            url("/usuarios"),
            theme("/assets/images/favicon.ico")
        );

        $user = (new User());
        $users = $user->find("status != :s", "s=disabled")->fetch(true);

        echo $this->view->render("widgets/users/list",
            [
                "app" => "usuarios",
                "head" => $head,
                "users" => $users,
                "registers" => (object)[
                    "actived" => $user->find("status != :s", "s=disabled")->count(),
                    "disabled" => $user->find("status = :s", "s=disabled")->count()
                ]
            ]);

    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function user(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $userCreate = new User();
            $userCreate->first_name = $data["first_name"];
            $userCreate->last_name = $data["last_name"];
            $userCreate->email = $data["email"];
            $userCreate->phone = preg_replace("/[^0-9]/", "", $data["phone"]);
            $userCreate->churche_id = $data["churche_id"];
            $userCreate->password = $data["password"];
            $userCreate->level_id = $data["level_id"];
            //$userCreate->genre = $data["genre"];
            //$userCreate->datebirth = date_fmt_back($data["datebirth"]);
            //$userCreate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $userCreate->status = $data["status"];

            //upload photo
            if (!empty($_FILES["photo"])) {
                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $userCreate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $userCreate->photo = $image;
            }

            if (!$userCreate->save()) {
                $json["message"] = $userCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário {$userCreate->first_name} cadastrado com sucesso...")->icon("person")->flash();
            $json["redirect"] = url("/painel/usuarios/adicionar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userUpdate = (new User())->findById($data["user_id"]);

            if (!$userUpdate) {
                $this->message->error("Você tentou gerenciar um usuário que não existe")->icon("person")->flash();
                echo json_encode(["redirect" => url("/usuarios")]);
                return;
            }

            $userUpdate->first_name = $data["first_name"];
            $userUpdate->first_name = $data["first_name"];
            $userUpdate->last_name = $data["last_name"];
            $userUpdate->email = $data["email"];
            $userUpdate->phone = preg_replace("/[^0-9]/", "", $data["phone"]);
            $userUpdate->churche_id = $data["churche_id"];
            $userUpdate->password = (!empty($data["password"]) ? $data["password"] : $userUpdate->password);
            $userUpdate->level_id = $data["level_id"];
            $userUpdate->status = $data["status"];

            //upload photo
            if (!empty($_FILES["photo"])) {
                if ($userUpdate->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}");
                    (new Thumb())->flush($userUpdate->photo);
                }

                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $userUpdate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $userUpdate->photo = $image;
            }

            if (!$userUpdate->save()) {
                $json["message"] = $userUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário {$userUpdate->first_name} atualizado com sucesso...")->icon("person")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userDelete = (new User())->findById($data["user_id"]);

            if (!$userDelete) {
                $this->message->error("Você tentou deletar um usuário que não existe")->icon()->icon("person")->flash();
                redirect("/usuarios");
                return;
            }

            if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
                (new Thumb())->flush($userDelete->photo);
            }

            $userDelete->destroy();

            $this->message->success("O usuário {$userDelete->first_name} foi excluído com sucesso...")->icon("person")->flash();
            redirect("/usuarios");

            return;
        }

        $userEdit = null;
        if (!empty($data["user_id"])) {
            $userId = filter_var($data["user_id"], FILTER_VALIDATE_INT);
            $userEdit = (new User())->findById($userId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($userEdit ? "Perfil de {$userEdit->fullName()}" : "Novo Usuário"),
            CONF_SITE_DESC,
            url("/painel"),
            url("/painel/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/users/user", [
            "app" => "usuarios",
            "head" => $head,
            "user" => $userEdit,
            "photo" => ($this->user->photo() ? image($this->user->photo, 360, 360) :
            theme("/assets/images/avatar.jpg", CONF_VIEW_APP))
        ]);
    }
}