<?php

namespace App\Models;

enum Action: int
{
    case Prichod = 0;
    case Obed = 1;
    case Odchod = 2;
    case SluzobnaCesta = 3;
    case Sukromne = 4;
    case LekarZamestnanec = 5;
    case LekarSprievod = 6;
    case HomeOffice = 7;

    public const ActionStrings = ['Príchod', 'Obed', 'Odchod', 'Služobná cesta', 'Súkromne', 'Lekár zamestnanec', 'Lekár sprievod', 'Home office'];

    public static function getString(Action $action) {
        return Action::ActionStrings[$action->value];
    }
}