<?php

/**
 * Code http pour les réponses
 */

namespace App\Enum;

enum ResponseCodeHttp: int
{
    case SUCCESS = 200;
    case NOT_FOUND = 404;
    case UNAUTHORIZED = 401;
    case UNPROCESSABLE_ENTITY  = 422;
}
