<?php

namespace Source\Models\Patrimony;

use Source\Core\Model;
use Source\Models\Patrimony\Brand;
use Source\Models\Patrimony\Product;
use Source\Models\Unit;
use Source\Models\User;
use Source\Models\userPosition;


/**
 * SMSUB | Class Patrimony
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class Patrimony extends Model
{
    /**
     * Patrimony constructor.
     */
    public function __construct()
    {
        parent::__construct("patrimonys", ["id"], ["user_id","patrimonys_name", "brand_id", "product_id", "description", "unit_id", "file_terms", "type_part_number", "part_number", "status", "photo", "observations"]);
    }

    /**
     * @param string $part_number
     * @param string $columns
     * @return null|Patrimony
     */
    public function findByPartNumber(string $part_number, string $columns = "*"): ?Patrimony
    {
        $find = $this->find("part_number = :part_number", "part_number={$part_number}", $columns);
        return $find->fetch();
    }

    /**
     * @param string $ns
     * @param string $columns
     * @return null|Patrimony
     */
    public function findByNs(string $ns, string $columns = "*"): ?Patrimony
    {
        $find = $this->find("ns = :ns", "ns={$ns}", $columns);
        return $find->fetch();
    }

    /**
     * @return Brand
     */
    public function brand(): Brand
    {
        return (new Brand())->findById($this->brand_id);
    }

    /**
     * @return null|Product
     */
    public function product(): ?Product
    {
        if($this->product_id) {
            return(new Product())->findById($this->product_id);
        }
        return null;
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

    /**
     * @return null|User
     */
    public function userPatrimony(): ?User
    {
        if($this->user_id) {
            return(new User())->findById($this->user_id);
        }
        return null;
    }

    /**
     * @return null|UserPosition
     */
    public function userPosition(string $position): ?UserPosition
    {
        if($position) {
            return(new UserPosition())->findById($position);
        }
        return null;
    }

        /**
     * @return null|Unit
     */
    public function userUnit(string $unit): ?Unit
    {
        if($unit) {
            return(new Unit())->findById($unit);
        }
        return null;
    }

    /**
     * @return null|Brand
     */
    public function productBrand(string $brand): ?Brand
    {
        if($brand) {
            return(new Brand())->findById($brand);
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function fileList(): ?string
    {
        if($this->file_terms && file_exists(CONF_UPLOAD_DIR.'/'.$this->file_terms)){
            return '<a href="../'.CONF_UPLOAD_DIR.'/'.$this->file_terms.'" role="button" class="btn btn-sm btn-outline-danger rounded-circle" target="_blank"><i class="bi bi-file-earmark-pdf"></a>';
        }else{
            return '<p class="fw-semibold" >Sem Termo</p>';
        }
        return null;
    } 

    /**
     * @return null|string
     */
    public function termList(): ?string
    {
        if($this->user_id){
            return '<a href="'.url("/beta/patrimonios/termo/{$this->id}").'" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para editar" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle fw-bold me-2"><i class="bi bi-file-earmark-word"></i></a>';
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function file(): ?string
    {
        if ($this->file_terms && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->file_terms}")) {
            return $this->file_terms;
        }

        return null;
    }

    /**
     * @return null|User
     */

    static function completeUser(): ?User
    {
        $stm = (new User())->find("status != :s","s=disabled");
        $array[] = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                    $array[] = $row->id.' - '.$row->user_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    /**
     * @return null|Product
     */

    static function completeProduct(): ?Product
    {
        $stm = (new Product())->find("status = :s","s=actived");
        $array = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                $array[] = $row->id.' - '.$row->product_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

        /**
     * @return null|Unit
     */

     static function completeUnit(): ?Unit
     {
         $stm = (new Unit())->find("status = :s","s=actived");
         $array = array();
 
         if(!empty($stm)):
             foreach ($stm->fetch(true) as $row):
                 $array[] = $row->id.' - '.$row->unit_name;
             endforeach;
             echo json_encode($array); //Return the JSON Array
         endif;
         return null;
     }

    /**
     * @return null|string
     */
    public function statusBadgeUser($status): string
    {
        if($status == 'disabled'){
            return '<span class="badge text-bg-danger ms-2">Inativo</span>';
        }else{
            return '<span class="badge text-bg-success ms-2">Ativo</span>';
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
        } elseif($this->status == 'disabled'){
            return '<span class="badge text-bg-warning ms-2">Inativo</span>';
        } else {
            return '<span class="badge text-bg-danger ms-2">Baixa</span>';
        } 
    }

    public function statusSelect(): ?string
    {
        if ($this->status == "actived") {
            return '<option value="actived" selected>Ativo</option><option value="disabled">Inativo</option><option value="writeoff">Baixa</option>';
        } elseif ($this->status == "disabled") {
            return '<option value="disabled" selected>Inativo</option><option value="actived">Ativo</option><option value="writeoff">Baixa</option>';
        } else {
            return '<option value="writeoff" selected>Baixa</option><option value="actived">Ativo</option><option value="disabled">Inativo</option>';
        }
        return null; 
    }

    public function brandSelect(): ?Brand
    {
        $stm = (new Brand())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->brand_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function productSelect(): ?Product
    {
        $stm = (new Product())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->product_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 

    public function brandproductSelect(): ?Product
    {
        $stm = (new Product())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->id.' - '.$this->brand($row->brand_id)->brand_name.' - '.$row->product_name.'</option>'; //Return the JSON Array
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
     * @return string|null
     */
    public function photo(): ?string
    {
        if ($this->photo && file_exists(__DIR__ . "/../../" .CONF_UPLOAD_DIR. "/{$this->photo}")) {
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
            return '<span class="badge text-bg-primary ms-2">Patrimony</span>';
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
        /** Patrimony Update */
        if (!empty($this->id)) {
            $patrimonyId = $this->id;

            if (!empty($this->part_number) && $this->find("type_part_number = :t AND part_number = :c AND id != :i", "t={$this->type_part_number}&c={$this->part_number}&i={$patrimonyId}", "id")->fetch()) {
                $this->message->warning("O patrimônio {$this->type_part_number} {$this->part_number} já está cadastrado");
                return false;
            }
            
            $this->update($this->safe(), "id = :id", "id={$patrimonyId}");
            
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Patrimony Create */
        if (empty($this->id)) {
            if (!empty($this->part_number) && $this->findByPartNumber($this->part_number, "id")) {
                $this->message->warning("O patrimonio {$this->type_part_number} {$this->part_number} informado já está cadastrado");
                return false;
            }

            $patrimonyId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($patrimonyId))->data();
        return true;
    }
}