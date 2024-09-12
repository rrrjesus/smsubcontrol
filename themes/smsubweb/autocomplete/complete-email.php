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

function retorna($nome) {

    $stmt = Connect::getInstance()->query("SELECT `id`, `user_name`, `email` FROM signatures WHERE CONCAT(user_name) = '{$nome}'");

    $arr = Array();
    if ($stmt->rowCount()) {
        while ($dados = $stmt->fetch()) {
            $arr['nomeinp'] = $dados->user_name;
            $arr['emailinp'] = substr($dados->email, 0, -27);
        }
    }
    else {
        $arr['nomeinp'] = '';
        $arr['emailinp'] = '';
    }
    return json_encode($arr);

}

/* só se for enviado o parâmetro, que devolve os dados */
if (isset($_GET['nomeinp'])) {
    echo retorna($_GET['nomeinp']);
}