<?php

namespace Source\Models\Patrimonio;

use Source\Core\Model;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class BemMarca extends Model
{
    /**
     * BemMarca constructor.
     */
    public function __construct()
    {
        parent::__construct("bens_marca", ["id"], ["marca_nome", "descricao", "status"]);
    }

    /**
     * @param string $marca_nome
     * @param string $columns
     * @return null|BemMarca
     */
    public function findByMarca(string $marca_nome, string $columns = "*"): ?BemMarca
    {
        $find = $this->find("marca_nome = :marca_nome", "marca_nome={$marca_nome}", $columns);
        return $find->fetch();
    }

    public function statusSelect(): ?string
    {
        if ($this->status == "actived") {
            return '<option value="actived" selected>Ativo</option><option value="disabled">Inativo</option>';
        } else {
            return '<option value="disabled" selected>Inativo</option><option value="actived">Ativo</option>';
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

        /** BemMarca Update */
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

        /** BemMarca Create */
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