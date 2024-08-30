<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class PatrimonioMarca extends Model
{
    /**
     * PatrimonioMarca constructor.
     */
    public function __construct()
    {
        parent::__construct("patrimonio_marca", ["id"], ["marca_nome". "descricao", "status"]);
    }

    /**
     * @param string $marca
     * @param string $columns
     * @return null|PatrimonioModelo
     */
    public function findByMarca(string $marca, string $columns = "*"): ?PatrimonioMarca
    {
        $find = $this->find("marca = :marca", "marca={$marca}", $columns);
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
            $this->message->warning("O campo : Marca é obrigatório !!!")->icon();
            return false;
        }

        /** PatrimonioMarca Update */
        if (!empty($this->id)) {
            $marcaId = $this->id;

            if ($this->find("marca_nome = :c AND id != :i", "c={$this->marca_nome}&i={$marcaId}", "id")->fetch()) {
                $this->message->warning("A marca informada já está cadastrada");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$marcaId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** PatrimonioMarca Create */
        if (empty($this->id)) {
            if ($this->findByMarca($this->marca_nome, "id")) {
                $this->message->warning("A marca informada já está cadastrada");
                return false;
            }

            $marcaId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($marcaId))->data();
        return true;
    }
}