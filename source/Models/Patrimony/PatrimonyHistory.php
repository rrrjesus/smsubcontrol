<?php

namespace Source\Models\Patrimony;

use Source\Core\Model;
use Source\Models\Unit;
use Source\Models\User;
use Source\Models\UserPosition;
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
        parent::__construct("patrimonys_historys", ["id"], ["patrimony_id", "user_id","patrimonys_name", "product_id", "description", "unit_id", "file_terms", "type_part_number", "part_number", "status", "photo", "observations", "created_history", "login_created"]);
    }

    /**
     * @param string $patrimony_id
     * @param string $columns
     * @return null|PatrimonyHistory
     */
    public function findByPatrimonyId(string $patrimony_id, string $columns = "*"): ?PatrimonyHistory
    {
        $find = $this->find("patrimony_id = :patrimony_id", "patrimony_id={$patrimony_id}", $columns);
        return $find->fetch();
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
     * @return null|string
     */
    public function fileList(): ?string
    {
        if(!empty($this->file_terms) && file_exists(CONF_UPLOAD_DIR.'/'.$this->file_terms)){
            return '<a href="../../../'.CONF_UPLOAD_DIR.'/'.$this->file_terms.'" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para visualizar termo assinado" class="btn btn-sm btn-outline-danger rounded-circle" target="_blank"><i class="bi bi-file-earmark-pdf"></a>';
        }else{
            return '';
        }
        return null;
    } 

    /**
     * @return null|string
     */
    public function termList(): ?string
    {
        if($this->user_id){
            return '<a href="'.url("/beta/patrimonios/historico/termo/{$this->id}").'" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para visualizar termo para assinar" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-file-earmark-word"></i></a>';
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

        /** PatrimonyHistory Update */
        if (!empty($this->patrimony_id)) {

            $patrimonyId = $this->patrimony_id;

            if($this->find("unit_id = :d AND part_number = :p AND user_id = :u", "d={$this->unit_id}&p={$this->part_number}&u={$this->user_id}", "patrimony_id")->fetch()) {
                $this->update($this->safe(), "patrimony_id = :patrimony_id AND user_id = :user_id AND unit_id = :unit_id", "patrimony_id={$patrimonyId}&user_id={$this->user_id}&unit_id={$this->unit_id}");
            } else {
                $patrimonyId = $this->create($this->safe());
            }

            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

         /** Patrimony Create */
         if (empty($this->id)) {
            if ($this->find("unit_id = :d AND part_number = :p AND user_id = :u", "d={$this->unit_id}&p={$this->part_number}&u={$this->user_id}", "patrimony_id")->fetch()) {
                return false;
            }

            $this->login_created = (new User())->findById($this->user->id)->login;
            $this->created_history = date("Y-m-d H:i:s");

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