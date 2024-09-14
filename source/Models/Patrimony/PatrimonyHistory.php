<?php

namespace Source\Models\Patrimony;

use Source\Core\Model;
use Source\Models\Unit;
use Source\Models\User;
use Source\Models\Patrimony\Brand;
use Source\Models\Patrimony\Product;


/**
 * SMSUB | Class  PatrimonyHistory
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class  PatrimonyHistory extends Model
{
    /**
     *  PatrimonyHistory constructor.
     */
    public function __construct()
    {
        parent::__construct("patrimonys_historys", ["id"], ["patrimony_id", "user_id","patrimonys_name", "brand_id", "product_id", "description", "unit_id", "imei", "status", "photo", "observations", "created_at"]);
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
     * @return null|PatrimonyMarcas
     */
    public function productBrand(string $brand): ?Brand
    {
        if($brand) {
            return(new Brand())->findById($brand);
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
     * @return bool
     */
    public function save(): bool
    {
        if ($this->find("unit_id = :d AND imei = :i AND user_id = :u", "d={$this->unit_id}&i={$this->imei}&u={$this->user_id}", "patrimony_id")->fetch()) {
            return false;
        }

        $patrimonyId = $this->create($this->safe());

        if ($this->fail()) {
            $this->message->error("Erro ao cadastrar Histórico, verifique os dados");
            return false;
        }

        $this->data = ($this->findById($patrimonyId))->data();
        return true;
    }
}