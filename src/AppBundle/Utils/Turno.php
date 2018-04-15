<?php

namespace AppBundle\Utils;

class Turno
{

    public static function getOptions()
    {
        $a=[
            'Mañana' => 0,
            'Tarde' => 1
        ];
        return $a;
    }

    public static function getName($status)
    {
        $items = self::getOptions();
        $items = array_flip($items);
        if (isset($items[$status])) {
            return $items[$status];
        } else {
            return '';
        }
    }
}
