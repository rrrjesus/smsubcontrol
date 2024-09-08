<?php

namespace Source\App\Admin;

use Source\Models\User;
use Source\Models\UserPosition;
use Source\Models\Unit;
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
        $user = (new User())->findById($this->user->id);
        
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $userCreate = new User();
            $userCreate->login = $data["login"];
            $userCreate->rf = $data["rf"];
            $userCreate->first_name = $data["first_name"];
            $userCreate->last_name = $data["last_name"];
            $userCreate->email = $data["email"];
            $userCreate->phone = preg_replace("/[^0-9]/", "", $data["phone"]);
            $userCreate->phone_fixed = preg_replace("/[^0-9]/", "", $data["phone_fixed"]);
            $userCreate->position_id = preg_replace("/[^0-9\s]/", "", $data["position_id"]);
            $userCreate->category_id = preg_replace("/[^0-9\s]/", "", $data["category_id"]);
            $userCreate->unit_id = preg_replace("/[^0-9\s]/", "", $data["unit_id"]);
            $userCreate->password = $data["password"];
            $userCreate->level_id = $data["level_id"];
            $userCreate->observations = $data["observations"];
            $userCreate->created_at = date("Y-m-d h:m:s");
            $userCreate->login_created = $user->login;

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

            if($data["login"] == "" || $data["rf"] == "" || $data["category_id"] == "" || $data["unit_id"] == "" || $data["position_id"] == "" || $data["status"] == ""){
                $json['message'] = $this->message->warning("Preencha os campos obrigatórios para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$userCreate->save()) {
                $json["message"] = $userCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário {$userCreate->first_name} cadastrado com sucesso...")->icon("person")->flash();
            $json["redirect"] = url("/painel/usuarios/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userUpdate = (new User())->findById($data["user_id"]);

            if (!$userUpdate) {
                $this->message->error("Você tentou gerenciar um usuário que não existe")->icon("person")->flash();
                echo json_encode(["redirect" => url("/painel/usuarios")]);
                return;
            }

            $userUpdate->login = $data["login"];
            $userUpdate->rf = $data["rf"];
            $userUpdate->first_name = $data["first_name"];
            $userUpdate->last_name = $data["last_name"];
            $userUpdate->email = $data["email"];
            $userUpdate->phone = preg_replace("/[^0-9]/", "", $data["phone"]);
            $userUpdate->phone_fixed = preg_replace("/[^0-9]/", "", $data["phone_fixed"]);
            $userUpdate->position_id = preg_replace("/[^0-9\s]/", "", $data["position_id"]);
            $userUpdate->category_id = preg_replace("/[^0-9\s]/", "", $data["category_id"]);
            $userUpdate->unit_id = preg_replace("/[^0-9\s]/", "", $data["unit_id"]);
            $userUpdate->password = (!empty($data["password"]) ? $data["password"] : $userUpdate->password);
            $userUpdate->level_id = $data["level_id"];
            $userUpdate->status = (new User())->statusInputDecode($data["status"]);
            $userUpdate->observations = $data["observations"];
            $userUpdate->login_updated = $user->login;

            if (!empty($_FILES["photo"])) {
                $file = $_FILES["photo"];
                $upload = new Upload();

                if ($userUpdate->photo()) {
                    (new Thumb())->flush("storage/{$userUpdate->photo}");
                    $upload->remove("storage/{$userUpdate->photo}");
                }

                if (!$userUpdate->photo = $upload->image($file, "{$userUpdate->first_name} {$userUpdate->last_name} " . time(), 360)) {
                    $json["message"] = $upload->message()->before("Ooops {$userUpdate->user->first_name}! ")->after(".")->render();
                    echo json_encode($json);
                    return;
                }
            }

            if($data["login"] == "" || $data["rf"] == "" || $data["category_id"] == "" || $data["unit_id"] == "" || $data["position_id"] == "" || $data["status"] == ""){
                $json['message'] = $this->message->warning("Preencha os campos obrigatórios para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$userUpdate->save()) {
                $json["message"] = $userUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário {$userUpdate->login} - {$userUpdate->first_name} atualizado com sucesso !!!")->icon("person")->flash();
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

        $userposition = new UserPosition();
        $unit = new Unit();

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
            "userposition" => $userposition,
            "unit" => $unit,
            "photo" => ($this->user->photo() ? image($this->user->photo, 360, 360) :
            theme("/assets/images/avatar.jpg", CONF_VIEW_ADMIN))
        ]);
    }
}