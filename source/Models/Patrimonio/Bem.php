<?php

namespace Source\Models\Patrimonio;

use Source\Core\Model;
use Source\Models\Unit;
use Source\Models\User;


/**
 * SMSUB | Class Bem
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class Bem extends Model
{
    /**
     * Bem constructor.
     */
    public function __construct()
    {
        parent::__construct("bens", ["id"], ["bens_nome", "marca_id", "modelo_id", "descricao", "unit_id", "imei", "status", "photo", "observacoes"]);
    }

    /**
     * @param string $imei
     * @param string $columns
     * @return null|Bem
     */
    public function findByImei(string $imei, string $columns = "*"): ?Bem
    {
        $find = $this->find("imei = :imei", "imei={$imei}", $columns);
        return $find->fetch();
    }

    /**
     * @return AppCategory
     */
    public function bemMarca(): BemMarca
    {
        return (new BemMarca())->findById($this->marca_id);
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

    public function statusSelect(): ?string
    {
        if ($this->status == "actived") {
            return '<option value="actived" selected>Ativo</option><option value="disabled">Inativo</option>';
        } else {
            return '<option value="disabled" selected>Inativo</option><option value="actived">Ativo</option>';
        }
        return null; 
    }

    public function marcaSelect(): ?BemMarca
    {
        $stm = (new BemMarca())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->marca_nome.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function modeloSelect(): ?BemModelo
    {
        $stm = (new BemModelo())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->modelo_nome.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function marcamodeloSelect(): ?BemModelo
    {
        $stm = (new BemModelo())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->id.' - '.$this->bemMarcas($row->marca_id)->marca_nome.' - '.$row->modelo_nome.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function unitSelect(): ?Unit
    {
        $stm = (new Unit())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->unit_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function userSelect(): ?User
    {
        $stm = (new User())->find("status != :s","s=trash")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->login.' - '.$row->fullName().'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    static function completeUser($columns): ?User
    {
        $stm = (new User())->find("status != :s","s=trash", $columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->first_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    static function completeSector($columns): ?Sector
    {
        $stm = (new Sector())->find("status=:s","s=post",$columns);
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->sector_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    public function statusInput(): ?string
    {
        if ($this->status == "actived") {
            return 'Ativo';
        } else {
            return 'Inativo';
        }
        return null; 
    }

    /**
     * @return null|BemMarca
     */
    public function bemMarcai(): ?BemMarca
    {
        if($this->marca_id) {
            return(new BemMarca())->findById($this->marca_id);
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
     * @return null|UserCategory
     */
    public function userCategory(): ?UserCategory
    {
        if($this->category_id) {
            return(new UserCategory())->findById($this->category_id);
        }
        return null;
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
            return '<span class="badge text-bg-primary ms-2">Bem</span>';
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

    /**
     * @return bool
     */
    public function save(): bool
    {
        /** Bem Update */
        if (!empty($this->id)) {
            $bemId = $this->id;

            if ($this->find("imei = :c AND id != :i", "c={$this->imei}&i={$bemId}", "id")->fetch()) {
                $this->message->warning("O imei informado já está cadastrado");
                return false;
            }
            
            $this->update($this->safe(), "id = :id", "id={$bemId}");
            
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Bem Create */
        if (empty($this->id)) {
            if ($this->findByImei($this->imei, "id")) {
                $this->message->warning("O imei informado já está cadastrado");
                return false;
            }

            $bemId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($bemId))->data();
        return true;
    }
}