<?php

/**
 * Created by Rodolfo Romaioli Ribeiro de Jesus.
 * User: D788796
 * Date: 09/06/2017
 * Time: 08:39
 */

require __DIR__ . '/../../../source/Core/Connect.php';
require __DIR__ . '/../../../source/Boot/Config.php';

use Source\Core\Connect;

function retorna($name) {

    $stmt = Connect::getInstance()->query("SELECT `id`, `unit_name`, `description`, `street`, `zip_code`, `logo`, `url` FROM units WHERE unit_name = '{$name}'");

    $arr = Array();
    if ($stmt->rowCount()) {
        while ($dados = $stmt->fetch()) {
            $arr['enderecoinp'] = $dados->street;
            $arr['cepinp'] = $dados->zip_code;
            $arr['aslogo'] = $dados->logo;
            $arr['url'] = $dados->url;
        }
    } else {
        $arr['secsubinp'] = '';
        $arr['enderecoinp'] = '';
        $arr['cepinp'] = '';
        $arr['aslogo'] = 'logo_ass_smsub';
        $arr['url'] = '';
    }
    return json_encode($arr);

}

/* só se for enviado o parâmetro, que devolve os dados */
if (isset($_GET['secsubinp'])) {
    echo retorna($_GET['secsubinp']);
}