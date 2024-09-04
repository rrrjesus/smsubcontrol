<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 */
class Churche extends Model
{
    public function __construct()
    {
        parent::__construct("app_churches", ["id"], ["churche_name"]);
    }

    /** @param string $uri
     * @param string $columns
     * @return Churche|null
     */
    public function findyByChurche(string $churche, string $columns = "*"): ?Churche
    {
        $find = $this->find("churche_name = :s", "s={$churche}", $columns);
        return $find->fetch();
    }

        /**
     * @param string $churche
     * @param string $columns
     * @return null|Churche
     */
    public function findByChurcheId(string $churche, string $columns = "*"): ?Churche
    {
        $find = $this->find("id = :i", "i={$churche}", $columns);
        return $find->fetch();
    }

    static function completeChurche($columns): ?Churche
    {
        $stm = (new Churche())->find("status=:s","s=actived",$columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->churche_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    static function selectChurcheName(): ?Churche
    {
        $stm = (new Churche())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->churche_name.'">'.$row->churche_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    }  

    static function selectChurcheId(): ?Churche
    {
        $stm = (new Churche())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->churche_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    }  
    
    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Igreja e status são obrigatórios")->icon("building");
            return false;
        }

        /** igreja Update */
        if (!empty($this->id)) {
            $churcheId = $this->id;

            if ($this->find("churche_name = :d AND id != :i", "d={$this->churche_name}&i={$churcheId}", "id")->fetch()) {
                $this->message->warning("A Igreja informado já está cadastrado")->icon("building");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$churcheId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Churche Create */
        if (empty($this->id)) {
            if ($this->findyByChurche($this->churche_name, "id")) {
                $this->message->warning("A Igreja informado já está cadastrado")->icon("building");
                return false;
            }

            $churcheId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($churcheId))->data();
        return true;
    }
}