<?php

namespace Source\Models;

use Source\Core\Model;

class Unit extends Model
{
    public function __construct()
    {
        parent::__construct("units", ["id"], ["unidade_nome", "description", "street", "zip_code", "logo"]);
    }

    static function completeName($columns): ?Unit
    {
        $stm = (new Unit())->find("","",$columns);
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