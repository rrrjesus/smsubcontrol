<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Unit;

/**
 * SMSUB | Class Contact
 *
 * @author Rodolfo <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class Contact extends Model
{
    /**
     * Contact constructor.
     */
    public function __construct()
    {
        parent::__construct("contacts", ["id"], ["unit_id", "contact_name", "ramal", "status"]);
    }

    /**
     * @param string $ramal
     * @param string $columns
     * @return null|Contact
     */
    public function findByRamal(string $ramal, string $columns = "*"): ?Contact
    {
        $find = $this->find("ramal = :ramal", "ramal={$ramal}", $columns);
        return $find->fetch();
    }

    /**
     * @return string
     */
    public function statusBadge(): string
    {
        if($this->status == 'actived'):
            return '<span class="badge text-bg-success ms-2">ATIVO</span>';
        else:
            return '<span class="badge text-bg-danger ms-2">INATIVO</span>';
        endif;  
    }


    /**
     * @return null|Unit
     */
    public function unit(): ?Unit
    {
        if($this->unit_id) {
            return(new Unit())->findById($this->unit_id);
        }
        return null;
    }

    static function completeUnit($columns): ?Unit
    {
        $stm = (new Unit())->find("status= :s","s=confirmed", $columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->unit_name;
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

        /** Contact Update */
        if (!empty($this->id)) {
            $contactId = $this->id;

            if ($this->find("ramal = :ramal AND id != :i", "ramal={$this->ramal}&i={$contactId}", "id")->fetch()) {
                $this->message->warning("O ramal informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$contactId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Contact Create */
        if (empty($this->id)) {
            if ($this->findByRamal($this->ramal, "id")) {
                $this->message->warning("O ramal informado já está cadastrado !!!");
                return false;
            }

            $contactId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($contactId))->data();
        return true;
    }
}