<?php

namespace Source\Models\Patrimonio;

use Source\Core\Model;

/**
 * Rodolfo | Class Unit Active Record Pattern
 *
 * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class BemModelo extends Model
{
    /**
     * BemModelo constructor.
     */
    public function __construct()
    {
        parent::__construct("bens_modelo", ["id"], ["marca_id", "modelo_nome", "descricao", "status"]);
    }

    
    /**
     * @param string $modelo_nome
     * @param string $columns
     * @return null|BemModelo
     */
    public function findByModelo(string $modelo_nome, string $columns = "*"): ?BemModelo
    {
        $find = $this->find("modelo_nome = :modelo_nome", "modelo_nome={$modelo_nome}", $columns);
        return $find->fetch();
    }

    /**
     * @return null|BemMarca
     */
    public function marcaSelect(): ?BemMarca
    {
        $stm = (new BemMarca())->find("status=:s","s=actived")->fetch(true);

        if(!empty($stm)):
            foreach ($stm as $row):
                echo '<option value="'.$row->id.'">'.$row->brand_name.'</option>'; //Return the JSON Array
            endforeach;
        endif;
        return null;
    } 
    
    /**
     * @return null|BemMarca
     */
    public function bemMarca(): ?BemMarca
    {
        if($this->marca_id) {
            return(new BemMarca())->findById($this->marca_id);
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
    
            /** BemModelo Update */
            if (!empty($this->id)) {
                $modeloId = $this->id;
    
                if ($this->find("modelo_nome = :c AND id != :i", "c={$this->modelo_nome}&i={$modeloId}", "id")->fetch()) {
                    $this->message->warning("O modelo informado já está cadastrado");
                    return false;
                }
    
                $this->update($this->safe(), "id = :id", "id={$modeloId}");
                if ($this->fail()) {
                    $this->message->error("Erro ao atualizar, verifique os dados");
                    return false;
                }
            }
    
            /** BemModelo Create */
            if (empty($this->id)) {
                if ($this->findByModelo($this->modelo_nome, "id")) {
                    $this->message->warning("O modelo informado já está cadastrado");
                    return false;
                }
    
                $modeloId = $this->create($this->safe());
                if ($this->fail()) {
                    $this->message->error("Erro ao cadastrar, verifique os dados");
                    return false;
                }
            }
    
            $this->data = ($this->findById($modeloId))->data();
            return true;
        }
    }