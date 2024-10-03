<?php

namespace Source\Models\Patrimony;

use Source\Core\Model;
use Source\Models\Patrimony\Brand;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class Product extends Model
{
    /**
     * Model constructor.
     */
    public function __construct()
    {
        parent::__construct("products", ["id"], ["brand_id", "product_name", "type_part_number", "description", "status"]);
    }

    
    /**
     * @param string $product_name
     * @param string $columns
     * @return null|Model
     */
    public function findByProduct(string $product_name, string $columns = "*"): ?Model
    {
        $find = $this->find("product_name = :product_name", "product_name={$product_name}", $columns);
        return $find->fetch();
    }
    
    /**
     * @return null|Contract
     */
    public function contract(): ?Contract
    {
        if($this->contract_id) {
            return(new Contract())->findById($this->contract_id);
        }
        return null;
    }

    /**
     * @return null|Brand
     */
    public function Brand(): ?Brand
    {
        if($this->brand_id) {
            return(new Brand())->findById($this->brand_id);
        }
        return null;
    }

   /**
     * @return null|Product
     */

     static function completeTypePartNumber(): ?Product
     {
         $stm = (new Product())->find("status = :s","s=actived");
         $array = array();
 
         if(!empty($stm)):
             foreach ($stm->fetch(true) as $row):
                 $array[] = $row->type_part_number;
             endforeach;
             echo json_encode($array); //Return the JSON Array
         endif;
         return null;
    }
    
    /**
     * @return null|string
     */
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

        /** Model Update */
        if (!empty($this->id)) {
            $productId = $this->id;

            if ($this->find("product_name = :c AND id != :i", "c={$this->product_name}&i={$productId}", "id")->fetch()) {
                $this->message->warning("O produto informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$productId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Model Create */
        if (empty($this->id)) {
            if ($this->findByProduct($this->product_name, "id")) {
                $this->message->warning("O produto informado já está cadastrado");
                return false;
            }

            $productId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($productId))->data();
        return true;
    }
}