<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class User extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["id"], ["first_name", "last_name", "email", "password"]);
    }

    /**
     * @param string $email
     * @param string $columns
     * @return null|User
     */
    public function findByEmail(string $email, string $columns = "*"): ?User
    {
        $find = $this->find("email = :email", "email={$email}", $columns);
        return $find->fetch();
    }

    public function statusSelected(): ?string
    {
        if ($this->status == "registered") {
            return '<option value="registered" selected>Registrado</option><option value="confirmed">Confirmado</option><option value="disabled">Desabilitado</option>';
        } elseif ($this->status == "confirmed") {
            return '<option value="confirmed" selected>Confirmado</option><option value="registered">Registrado</option><option value="disabled">Desabilitado</option>';
        } else {
            return '<option value="disabled" selected>Desabilitado</option><option value="registered">Registrado</option><option value="confirmed">Confirmado</option>';
        }
        return null; 
    }

    public function statusInput(): ?string
    {
        if ($this->status == "registered") {
            return 'Registrado';
        } elseif ($this->status == "confirmed") {
            return 'Ativo';
        } else {
            return 'Inativo';
        }
        return null; 
    }

    /**
     * @return null|Unidade
     */
    public function userUnidade(): ?Unidade
    {
        if($this->unit_id) {
            return(new Unidade())->findById($this->unit_id);
        }
        return null;
    }

    /**
     * @return null|UserPosition
     */
    public function userPosition(): ?UserPosition
    {
        if($this->position_id) {
            return(new UserPosition())->findById($this->position_id);
        }
        return null;
    }

    /**
     * @return null|UserCategory
     */
    public function userCategory(): ?UserCategory
    {
        if($this->category_id) {
            return(new UserCategory())->findById($this->category_id);
        }
        return null;
    }

    public function level(): ?Level    {
        if($this->level_id) {
            return(new Level())->findById($this->level_id);
        }
        return null;
    }

    public function churche(): ?Churche
    {
        if($this->churche_id) {
            return(new Churche())->findById($this->churche_id);
        }
        return null;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return string|null
     */
    public function photo(): ?string
    {
        if ($this->photo && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->photo}")) {
            return $this->photo;
        }

        return null;
    }

    /**
     * @return string
     */
    public function levelBadge(): string
    {
        if($this->level_id == 1):
            return '<span class="badge text-bg-primary ms-2">User</span>';
        elseif($this->level_id == 2):
            return '<span class="badge text-bg-light ms-2">Edit*</span>';
        elseif($this->level_id == 3):
            return '<span class="badge text-bg-info ms-2">Edit</span>';
        elseif($this->level_id == 4):
            return '<span class="badge text-bg-success ms-2">Adm*</span>';
        else:
            return '<span class="badge text-bg-warning ms-2">Adm</span>';
        endif;  
    }

    static function completeUser($columns): ?User
    {
        $stm = (new User())->find("status= :s","s=confirmed", $columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->first_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome, sobrenome, email  são obrigatórios !!!")->icon();
            return false;
        }

        if (!is_email($this->email)) {
            $this->message->warning("O e-mail informado não tem um formato válido")->icon();
            return false;
        }

        if (!is_passwd($this->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->warning("A senha deve ter entre {$min} e {$max} caracteres");
            return false;
        } else {
            $this->password = passwd($this->password);
        }

        /** User Update */
        if (!empty($this->id)) {
            $userId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$userId}", "id")->fetch()) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$userId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email, "id")) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $userId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($userId))->data();
        return true;
    }
}