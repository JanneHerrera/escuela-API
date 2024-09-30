<?php

namespace App\Enums;

enum Status: string
{
    case Regular = 'R';
    case Irregular = 'I';
    case Condicionado = 'C';
    case Proceso = 'P';
}
