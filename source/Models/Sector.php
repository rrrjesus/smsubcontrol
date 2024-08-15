<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 */
class Sector extends Model
{
    public function __construct()
    {
        parent::__construct("contact_sectors", ["id"], ["sector_name"]);
    }

    /** @param string $uri
     * @param string $columns
     * @return Sector|null
     */
    public function findyBySector(string $sector, string $columns = "*"): ?Sector
    {
        $find = $this->find("sector_name = :s", "s={$sector}", $columns);
        return $find->fetch();
    }

    public function findBySectorId(string $id, string $columns = "*"): ?Sector
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    public function bootstrapSector(
        string $sector
    ): Sector
    {
        $this->sector_name = $sector;
        return $this;
    }

    public function bootstrap(
        string $id,
        string $sector
    ): Sector
    {
        $this->id = $id;
        $this->sector_name = $sector;
        return $this;
    }

    public function bootstrapTrash(
        string $id,
        string $status,
        string $deleted_at
    ): Sector
    {
        $this->id = $id;
        $this->status = $status;
        $this->deleted_at = $deleted_at;
        return $this;
    }

    /** @return Sector|null
     */
    public function sector(): ?Sector
    {
        if(!empty($this->sector)) {
            return(new Sector())->findById($this->sector);
        }
        return null;
    }

    public function idSector(): ?Sector
    {
        if($this->sector_name) {
            return(new Sector())->findyBySector($this->sector_name);
        }
        return null;
    }

    public function updated(Sector $sector): bool // Só aceita um objeto da Classe User e bool só retorna true e false
    {
        if(!$sector->save()) {
            $this->message = $sector->message;
            return false;
        }else {
            $this->message->warning("Edição de {$sector->sector_name} salva com sucesso!!!")->icon()->flash();
        }

        return true;
    }

    public function deleted(Sector $sector): bool // Só aceita um objeto da Classe User e bool só retorna true e false
    {
        if (!$sector->save()) {
            $this->message = $sector->message;
            return false;
        }else {
            $this->message->error("Exclusão de setor : {$sector->sector_name} feita com sucesso!!!")->icon()->flash();
            redirect("/dashboard/listar-setores");
        }

        return true;
    }

    public function delet(Sector $sector): bool // Só aceita um objeto da Classe User e bool só retorna true e false
    {
        if(!$sector->delete("id = :id", "id={$this->id}")) {
            $this->message = $sector->message;
            return false;
        }else {
            $this->message->error("Exclusão definitiva de setor : {$sector->sector_name} feita com sucesso!!!")->icon()->flash();
            redirect("/dashboard/lixeira-setores");
        }
        return true;
    }

    public function reactivated(Sector $sector): bool // Só aceita um objeto da Classe User e bool só retorna true e false
    {
        if(!$sector->save()) {
            $this->message = $sector->message;
            return false;
        }else {
            $this->message->success("Reativação de : {$sector->sector_name} feita com sucesso!!!")->icon()->flash();
            redirect("/dashboard/lixeira-setores");
        }

        return true;
    }

    static function completeSector($columns): ?Sector
    {
        $stm = (new Sector())->find("status=:s","s=actived",$columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->sector_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    public function register(Sector $sector): bool // Só aceita um objeto da Classe User e bool só retorna true e false
    {
        if(!$sector->save()) {
            $this->message = $sector->message;
            return false;
        }else{
            $this->message->success("Cadastro de {$sector->sector_name} salvo com sucesso!!!")->icon()->flash();
        }

        return true;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        /** User Update */
        if (!empty($this->id)) {
            $sectorId = $this->id;

            if ($this->find("sector_name = :s AND id != :i", "s={$this->sector_name}&i={$sectorId}", "id")->fetch()) {
                $this->message->warning("O setor informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$sectorId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->find("sector_name = :s", "s={$this->sector_name}", "id")->fetch()) {
                $this->message->warning("O Setor informado já está cadastrado !!!");
                return false;
            }

            $sectorId = $this->create($this->safe());

            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($sectorId))->data();
        return true;
    }

    public function delect(): bool
    {
        /** Sector Delete */
        if (!empty($this->id)) {
            $sectorId = $this->id;

            $this->delete($this->safe(), $sectorId);

            if ($this->fail()) {
                $this->message->error("Erro ao deletar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($sectorId))->data();
        return true;
    }
}