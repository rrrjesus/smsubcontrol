<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * SMSUB | Class Email
 *
 * @author Rodolfo R. R. de Jesus <rodolfo.romaioli@gmail.com>
 * @package Source\Models
 */
class Email extends Model
{
    /**
     * Email constructor.
     */
    public function __construct()
    {
    }

    public function requireds(): bool
    {
    if (!$this->required()) {
            $this->message->warning("Todos os campos são obrigatórios");
            return false;
        }

    }
}