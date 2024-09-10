<?php

namespace Source\Models;

use Source\Core\Model;

class Unit extends Model
{
    public function __construct()
    {
        parent::__construct("units", ["id"], ["unit_name", "description", "street", "zip_code", "logo"]);
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

    public function photoList(): ?string
    {
        if($this->photo && file_exists('themes/'.CONF_VIEW_ADMIN.'/assets/images/assinatura/'.$this->photo)){
            return '<a href="../themes/'.CONF_VIEW_ADMIN.'/assets/images/assinatura/'.$this->photo.'" target="_blank">
                    <img src="../themes/'.CONF_VIEW_ADMIN.'/assets/images/assinatura/'.$this->photo.'" height="40" width="40" class="img-thumbnail rounded-circle float-left"></a>';
        }else{
            return '<a href="../storage/images/avatar.jpg" target="_blank">
                    <img src="../storage/images/avatar.jpg" class="img-thumbnail rounded-circle float-left"
                    height="40" width="40"></a>';
        }
        return null;
    } 
    
    public function photoListDisabled(): ?string
    {
        if($this->photo && file_exists(CONF_UPLOAD_DIR.'/'.$this->photo)){
            return '<a href="../../'.CONF_UPLOAD_DIR.'/'.$this->photo.'" target="_blank">
                    <img src="'.image($this->photo, 30,30).'" class="img-thumbnail rounded-circle float-left"></a>';
        }else{
            return '<a href="../../storage/images/avatar.jpg" target="_blank">
                    <img src="../../storage/images/avatar.jpg" class="img-thumbnail rounded-circle float-left"
                    height="40" width="40"></a>';
        }
        return null;
    } 

    static function completeName($columns): ?Unit
    {
        $stm = (new Unit())->find("","",$columns);
        $array[] = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                    $array[] = $row->unit_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }

    static function completeUnit(): ?Unit
    {
        $stm = (new Unit())->find("status= :s","s=actived");
        $array[] = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                    $array[] = $row->id.' - '.$row->unit_name;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }
}