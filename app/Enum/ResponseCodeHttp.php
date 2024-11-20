<?php

/**
 * Code http pour les réponses
 */

namespace App\Enum;

enum ResponseCodeHttp: int
{
    case SUCCESS = 200;
    case NOT_FOUND = 404;
    case ERROR_LOGIN = 401;
    case ERROR_REGISTER = 422;
}
