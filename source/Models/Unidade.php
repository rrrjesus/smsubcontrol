<?php

namespace Source\Models;

use Source\Core\Model;

class Unidade extends Model
{
    public function __construct()
    {
        parent::__construct("unidades", ["id"], ["unidade_nome", "description", "street", "zip_code", "logo"]);
    }

    static function completeName($columns): ?Unidade
    {
        $stm = (new Unidade())->find("","",$columns);
        $array[] = array();

        if(!empty($stm)):
            foreach ($stm->fetch(true) as $row):
                    $array[] = $row->unidade_nome;
            endforeach;
            echo json_encode($array); //Return the JSON Array
        endif;
        return null;
    }
}