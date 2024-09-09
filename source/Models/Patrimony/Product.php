<?php

namespace Source\Models\Patrimony;

use Source\Core\Model;

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
        parent::__construct("products", ["id"], ["brand_id", "model_name", "description", "status"]);
    }

    
    /**
     * @param string $product_name
     * @param string $columns
     * @return null|Model
     */
    public function findByModelo(string $product_name, string $columns = "*"): ?Model
    {
        $find = $this->find("product_name = :product_name", "product_name={$product_name}", $columns);
        return $find->fetch();
    }

    /**
     * @return null|Brand
     */
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
                    $this->message->warning("O product informado já está cadastrado");
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
                if ($this->findByModelo($this->product_name, "id")) {
                    $this->message->warning("O product informado já está cadastrado");
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