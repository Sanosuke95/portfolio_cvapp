<?php

/**
 * Code http pour les réponses
 */

namespace App\Enum;

enum ResponseCodeHttp: int
{
    case SUCCES_LOGIN = 200;
    case ERROR_LOGIN = 401;
    case SUCCES_REGISTER = 200;
    case ERROR_REGISTER = 422;
}
