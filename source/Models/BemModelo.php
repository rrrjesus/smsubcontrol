<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class BemModelo extends Model
{
    /**
     * BemModelo constructor.
     */
    public function __construct()
    {
        parent::__construct("bens_modelo", ["id"], ["marca_id", "modelo_nome". "descricao", "status"]);
    }

    /**
     * @param string $modelo
     * @param string $columns
     * @return null|BemModelo
     */
    public function findByModelo(string $modelo, string $columns = "*"): ?BemModelo
    {
        $find = $this->find("modelo = :modelo", "modelo={$modelo}", $columns);
        return $find->fetch();
    }

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
        if($this->status == 'actived'):
            return '<span class="badge text-bg-success ms-2">Ativo</span>';
        else:
            return '<span class="badge text-bg-danger ms-2">Inativo</span>';
        endif;  
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("O campo : Modelo é obrigatório !!!")->icon();
            return false;
        }

        /** BemModelo Update */
        if (!empty($this->id)) {
            $modeloId = $this->id;

            if ($this->find("modelo_nome = :c AND id != :i", "c={$this->modelo_nome}&i={$modeloId}", "id")->fetch()) {
                $this->message->warning("O modelo informada já está cadastrada");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$modeloId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** BemModelo Create */
        if (empty($this->id)) {
            if ($this->findByModelo($this->modelo_nome, "id")) {
                $this->message->warning("O modelo informada já está cadastrada");
                return false;
            }

            $modeloId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($modeloId))->data();
        return true;
    }
}