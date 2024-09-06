<?php

namespace Source\Models\Patrimonio;

use Source\Core\Model;
use Source\Models\Unit;
use Source\Models\User;


/**
 * SMSUB | Class  BemHistorico
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class  BemHistorico extends Model
{
    /**
     *  BemHistorico constructor.
     */
    public function __construct()
    {
        parent::__construct("bens_historico", ["id"], ["bens_id", "modelo_id", "descricao", "unit_id", "imei", "status", "photo", "observacoes"]);
    }

    /**
     * @return null|User
     */
    public function user(): ?User
    {
        if($this->user_id) {
            return(new User())->findById($this->user_id);
        }
        return null;
    }

    /**
     * @return null|BemMarcas
     */
    public function bemMarcas(string $marca): ?BemMarca
    {
        if($marca) {
            return(new BemMarca())->findById($marca);
        }
        return null;
    }

    /**
     * @return null|Unit
     */
    public function bemUnidade(): ?Unit
    {
        if($this->unit_id) {
            return(new Unit())->findById($this->unit_id);
        }
        return null;
    }

    /**
     * @return null|BemModelo
     */
    public function bemModelo(): ?BemModelo
    {
        if($this->modelo_id) {
            return(new BemModelo())->findById($this->modelo_id);
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
        if ($this->find("imei = :i AND user_id = :u", "i={$this->imei}&u={$this->user_id}", "bens_id")->fetch()) {
            return false;
        }

        $bemId = $this->create($this->safe());

        if ($this->fail()) {
            $this->message->error("Erro ao cadastrar Histórico, verifique os dados");
            return false;
        }

        $this->data = ($this->findById($bemId))->data();
        return true;
    }
}