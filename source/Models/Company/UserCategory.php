<?php

namespace Source\Models\Company;

use Source\Core\Model;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class UserCategory extends Model
{
    /**
     * UserCategory constructor.
     */
    public function __construct()
    {
        parent::__construct("user_categories", ["id"], ["category_name"]);
    }

    /**
     * @return null|string
     */
    public function status(): ?string
    {
        if ($this->status == "actived") {
            return '<option value="actived" selected>Ativado</option><option value="disabled">Desativado</option>';
        } else {
            return '<option value="disabled" selected>Desativado</option><option value="actived">Ativado</option>';
        }
        return null; 
    }

    /**
     * @return string
     */
    public function statusBadge(): string
    {
        if($this->status == 'actived'){
            return '<span class="badge text-bg-success ms-2">Ativo</span>';
        } else {
            return '<span class="badge text-bg-danger ms-2">Inativo</span>';
        }  
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("O campo : Cargo é obrigatório !!!")->icon();
            return false;
        }

        /** UserCategory Update */
        if (!empty($this->id)) {
            $categoryId = $this->id;

            if ($this->find("category_name = :c AND id != :i", "c={$this->category_name}&i={$categoryId}", "id")->fetch()) {
                $this->message->warning("O categoria informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$categoryId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** UserCategory Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->category_name, "id")) {
                $this->message->warning("O categoria informado já está cadastrado");
                return false;
            }

            $categoryId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($categoryId))->data();
        return true;
    }
}